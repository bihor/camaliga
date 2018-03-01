<?php
namespace Quizpalme\Camaliga\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class MoveUploadsToFalTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
	 * Uid of the folder
	 *
	 * @var integer
	 */
	protected $page = 0;

	/**
	 * Folder path
	 *
	 * @var string
	 */
	protected $imgpath;
	
	
	/**
	 * Get the value of the protected property page
	 *
	 * @return integer UID of the start page for this task
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Set the value of the private property page
	 *
	 * @param integer $page UID of the start page for this task.
	 * @return void
	 */
	public function setPage($page) {
		$this->page = $page;
	}

	/**
	 * Get the img path
	 *
	 * @return string
	 */
	public function getImgpath() {
		return $this->imgpath;
	}
	
	/**
	 * Set the value of imgpath.
	 *
	 * @param string $imgpath	imgage path
	 * @return void
	 */
	public function setImgpath($imgpath) {
		$this->imgpath = $imgpath;
	}
	
	
	/**
     * Move image and build relations for FAL
     * 
     * @param int    $pid		PID
     * @param int    $uid		UID of a Camaliga element
     * @param int	 $sys_language_uid	Language
     * @param string $image		Image name
     * @param string $title		title+alt-tag
     * @param string $source	Counter
     * @param int    $newId		Dummy
     * @param int    $sorting	Sorting of the image
     */
	protected function moveOneImage($pid, $uid, $sys_language_uid, $image, $title, $source, $newId, $sorting) {
		//https://stackoverflow.com/questions/38241948/fal-insertion-into-sys-file-typo3
		//https://www.typo3.net/forum/thematik/zeige/thema/126046/
		//https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Fal/UsingFal/ExamplesFileFolder.html
		//http://t3-developer.com/1/ext-programmierung/techniken-in-extensions/fal-dateiupload-im-frontend/
		$resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
		$storage = $resourceFactory->getDefaultStorage();
		if ($storage->hasFolder($this->getImgpath())) {
			$targetFolder = $storage->getFolder($this->getImgpath());
		} else {
			return FALSE;
		}
		
		if (!is_file(PATH_site . 'uploads/tx_camaliga/' . $image)) {
			// wenn kein Bild vorhanden ist, ignorieren wir diesen Fall mal...
			//return TRUE;
		}
		
		$fileObject = $storage->addFile(
			PATH_site . 'uploads/tx_camaliga/' . $image,
			$targetFolder,
			$image
		);
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();
		
		// Link in der Caption?
		$link = '';
		if ((substr($title,0,4) == 'http') || (is_numeric($title))) {
			$link = $title;
			unset($title);
		} elseif (!$title) {
			unset($title);
		}
		
		//$resourceFactory = ResourceFactory::getInstance();
		//$fileObject = $resourceFactory->getFileObject((int)$file);
		//$contentElement = BackendUtility::getRecord(
		//		'tx_camaliga_domain_model_content',
		//		(int)$uid
		//);
		// Assemble DataHandler data
		$newId = 'NEW1234';
		$data = array();
		$data['sys_file_reference'][$newId] = array(
				'table_local' => 'sys_file',
				'uid_local' => $fileObject->getUid(),
				'tablenames' => 'tx_camaliga_domain_model_content',
				'uid_foreign' => $uid,
				'fieldname' => 'falimage' . $source,
				'pid' => $pid,
				'title' => $title,
				'alternative' => $title,
				'link' => $link,
			//	'tstamp' => time(),
			//	'crdate' => time(),
			//	'cruser_id' => $GLOBALS['BE_USER']->user["uid"],
			//	'sorting_foreign' => 10,
				'sorting' => $sorting,
				'sys_language_uid' => $sys_language_uid
		);
	/*	$data['tx_camaliga_domain_model_content'][$uid] = array(
				'image' => $newId
		); */
		// Get an instance of the DataHandler and process the data
		/** var \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler */
		//$dataHandler = GeneralUtility::makeInstance(DataHandler::class);
		$dataHandler = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\DataHandling\DataHandler');
		$dataHandler->start($data, array());
		$dataHandler->process_datamap();
		// Error or success reporting
		if (count($dataHandler->errorLog) === 0) {
			// noch kein return
			//return TRUE;
		} else {
			return FALSE;
		}
		
		
		// insert into sys_file_reference: wird nicht mehr gebraucht!
	/*	$success_reference = $GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_file_reference', $data['sys_file_reference'][$newId]);
		if ($success_reference) {
			$data['sys_file_reference'][$newId]['uid'] = $GLOBALS['TYPO3_DB']->sql_insert_id();
		} else {
			return FALSE;
		}
		*/
		// update camaliga-element
		$updateA = [];
		$updateA['image' . $source] = '';
		$updateA['falimage' . $source] = 1;
		$updateA['tstamp'] = time();
		if ($source) {
			$updateA['caption' . $source] = '';
		}
		$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_camaliga_domain_model_content', 'uid=' . $uid, $updateA);
		
		// delete image in the uploads-folder: ist aber nicht nötig, da das Bild verschoben wurde!
		//unlink();
		
		return TRUE;
	}
	
	public function execute() {
		$successfullyExecuted = TRUE;
		$pid = (int) $this->getPage();			// folder with camaliga elements
		$maxi = 0;								// Counter
		$camArray = array();

		// select all visible camaliga elements of one folder
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'uid, t3_origuid, sys_language_uid, l10n_parent, image, image2, image3, image4, image5, title, caption2, caption3, caption4, caption5, falimage, falimage2, falimage3, falimage4, falimage5',
				'tx_camaliga_domain_model_content',
				'deleted=0 AND pid=' . $pid,
				'',
				'uid ASC');
		$rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
		if ($rows>0) {
			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
				$camArray[$row['uid']] = $row;
			}
		}
		$GLOBALS['TYPO3_DB']->sql_free_result($res);
		
		foreach ($camArray as $row) {
			if ($row['image'] && !$row['falimage']) {
				$maxi++;
				$ergebnis = $this->moveOneImage($pid, $row['uid'], $row['sys_language_uid'], $row['image'], $row['title'], '', $maxi, 4);
				if (!$ergebnis) $successfullyExecuted = FALSE;
			}
			if ($row['image2'] && !$row['falimage2']) {
				$maxi++;
				$ergebnis = $this->moveOneImage($pid, $row['uid'], $row['sys_language_uid'], $row['image2'], $row['caption2'], '2', $maxi, 8);
				if (!$ergebnis) $successfullyExecuted = FALSE;
			}
			if ($row['image3'] && !$row['falimage3']) {
				$maxi++;
				$ergebnis = $this->moveOneImage($pid, $row['uid'], $row['sys_language_uid'], $row['image3'], $row['caption3'], '3', $maxi, 16);
				if (!$ergebnis) $successfullyExecuted = FALSE;
			}
			if ($row['image4'] && !$row['falimage4']) {
				$maxi++;
				$ergebnis = $this->moveOneImage($pid, $row['uid'], $row['sys_language_uid'], $row['image4'], $row['caption4'], '4', $maxi, 32);
				if (!$ergebnis) $successfullyExecuted = FALSE;
			}
			if ($row['image5'] && !$row['falimage5']) {
				$maxi++;
				$ergebnis = $this->moveOneImage($pid, $row['uid'], $row['sys_language_uid'], $row['image5'], $row['caption5'], '5', $maxi, 64);
				if (!$ergebnis) $successfullyExecuted = FALSE;
			}
		}
		
		return $successfullyExecuted;
	}
}
