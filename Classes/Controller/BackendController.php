<?php
namespace Quizpalme\Camaliga\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kurt Gusbeth <info@quizpalme.de>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BackendController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * contentRepository
	 *
	 * @var \Quizpalme\Camaliga\Domain\Repository\ContentRepository
	 * @inject
	 */
	protected $contentRepository;
	
	/**
	 * Zähler
	 *
	 * @var \integer
	 */
	protected $nr = 0;
	

	/**
	 * Ordner-ID
	 *
	 * @return integer
	 */
	protected function getCurrentPageId() {
		$pageId = (integer) \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
		if ($pageId > 0) {
		  return $pageId;
		}
		// get current site root
		$rootPages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid', 'pages', 'deleted=0 AND hidden=0 AND is_siteroot=1', '', '', '1');
		if (count($rootPages) > 0) {
		  return (integer) $rootPages[0]['uid'];
		}
		// fallback
		return (integer) self::DEFAULT_BACKEND_STORAGE_PID;
	}

	/**
	 * action index
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('pid', intval($this->getCurrentPageId()));
	}

	/**
	 * action thumb
	 *
	 * @return void
	 */
	public function thumbAction() {
		$pid = intval($this->getCurrentPageId());
		$saved = 0;
		$configurationUtility = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
		$enableFal = intval($configurationUtility['enableFal']);
		
		// save new order first
		if ($this->request->hasArgument('camelements')) {
			$updateA = array();
			$order = $this->request->getArgument('camelements');
			if (is_array($order)) {
				foreach ($order as $key => $value) {
					if ($key > 0 && $value > 0) {
						$updateA['sorting'] = $value;
						$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_camaliga_domain_model_content', 'uid=' . intval($key), $updateA);
						$saved = 1;
					}
				}
			}
		}
		
		// Elemente sortiert holen
		$contents = $this->contentRepository->findAll('sorting', 'asc', FALSE, array($pid));
		
		$this->view->assign('fal', $enableFal);
		$this->view->assign('pid', $pid);
		$this->view->assign('saved', $saved);
		$this->view->assign('contents', $contents);
	}
	
	
	/**
	 * action Karussell-import
	 *
	 * @return void
	 */
	public function importAction() {
		$oldIDs = array();
		$pid = intval($this->getCurrentPageId());
		$res = $GLOBALS['TYPO3_DB']->sql_query("SHOW TABLES LIKE 'tx_karussell_inhalt'");
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)>0) {
			// get Karussell-entries for current PID
			$entries = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_karussell_inhalt', 'deleted=0 AND hidden=0 AND pid=' . $pid, 'sys_language_uid, sorting', '', '');
			if (count($entries) > 0) {
				if ($this->request->hasArgument('cimport') || $this->request->hasArgument('dimport')) {
					// Import
					$insert = array();
					$insert['pid'] = $pid;
					$insert['tstamp'] = time();
					$insert['crdate'] = time();
					$insert['cruser_id'] = $GLOBALS['BE_USER']->user['uid'];
					for ($i=0; $i<count($entries); $i++) {
						$insert['sorting'] = $entries[$i]['sorting'];
						$insert['title'] = $entries[$i]['titel'];
						$insert['shortdesc'] = $entries[$i]['meldung'];
						$insert['link'] = $entries[$i]['link'];
						$insert['image'] = $this->checkImage($entries[$i]['bild']);
						$insert['t3_origuid'] = ($entries[$i]['t3_origuid']) ? intval($oldIDs[$entries[$i]['t3_origuid']]) : 0;
						$insert['l10n_parent'] = ($entries[$i]['l10n_parent']) ? intval($oldIDs[$entries[$i]['l10n_parent']]) : 0;
						$insert['sys_language_uid'] = $entries[$i]['sys_language_uid'];
						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_camaliga_domain_model_content', $insert);
						if ($success){
		                    $oldIDs[$entries[$i]['uid']] = $GLOBALS['TYPO3_DB']->sql_insert_id();
						}
						copy(PATH_site . 'uploads/tx_karussell/'.$entries[$i]['bild'], PATH_site . 'uploads/tx_camaliga/' . $insert['image']);
						if ($this->request->hasArgument('dimport'))
							unlink(PATH_site . 'uploads/tx_karussell/'.$entries[$i]['bild']);
					}
					$this->addFlashMessage(
							\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:import.ok', 'OK'),
							'OK',
							\TYPO3\CMS\Core\Messaging\FlashMessage::OK);
					if ($this->request->hasArgument('dimport')) {
						$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_karussell_inhalt', 'deleted=0 AND hidden=0 AND pid=' . $pid);
						$this->addFlashMessage(
							\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:import.del', 'deleted'),
							'OK',
							\TYPO3\CMS\Core\Messaging\FlashMessage::OK);
					}
				}
				
				$this->view->assign('entries', $entries);
				$this->view->assign('error', 0);
			} else {
				$this->view->assign('error', 1);
			}
		} else {
			$this->view->assign('error', 1);
		}
	}

	/**
	 * action tt_news-import
	 *
	 * @return void
	 */
	public function importNewsAction() {
		$pid = intval($this->getCurrentPageId());
		$oldIDs = array();
		$res = $GLOBALS['TYPO3_DB']->sql_query("SHOW TABLES LIKE 'tt_news'");
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)>0) {
			// get News-entries for current PID
			$entries = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tt_news', 'deleted=0 AND hidden=0 AND pid=' . $pid, '', 'tstamp DESC', '');
			if (count($entries) > 0) {
				if ($this->request->hasArgument('cimport') || $this->request->hasArgument('dimport')) {
					// Import
					$insert = array();
					$insert['pid'] = $pid;
					$insert['cruser_id'] = $GLOBALS['BE_USER']->user['uid'];
					for ($i=0; $i<count($entries); $i++) {
						$link = $entries[$i]['links'];
						if ($link) {
							if (strtoupper(substr($link, 0, 5)) == '<LINK') {
								$linkArray = explode(' ', $link);
								$link = $linkArray[1];
							}
						} else {
							$link = '';
						}
						$insert['sorting'] = $i+1;
						$insert['tstamp'] = $entries[$i]['tstamp'];
						$insert['crdate'] = $entries[$i]['crdate'];
						$insert['title'] = $entries[$i]['title'];
						$insert['shortdesc'] = ($entries[$i]['short']) ? $entries[$i]['short'] : '';
						$insert['longdesc'] = ($entries[$i]['bodytext']) ? $entries[$i]['bodytext'] : '';
						$insert['link'] = $link;
						$insert['image'] = $this->checkImage($entries[$i]['image']);
						$insert['sys_language_uid'] = $entries[$i]['sys_language_uid'];
						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_camaliga_domain_model_content', $insert);
						if ($success){
							$oldIDs[$entries[$i]['uid']] = $GLOBALS['TYPO3_DB']->sql_insert_id();
						}
						if ($entries[$i]['image']) {
							copy(PATH_site . 'uploads/pics/' . $entries[$i]['image'], PATH_site . 'uploads/tx_camaliga/' . $insert['image']);
							if ($this->request->hasArgument('dimport') && is_file(PATH_site.'uploads/pics/' . $entries[$i]['image']))
								unlink(PATH_site.'uploads/pics/' . $entries[$i]['image']);
						}
					}
					
					// Kategorien ebenfalls kopieren
					$i = 0;
					$catArray = array();
					$mmArray  = array();
					foreach ($oldIDs as $key => $value) {
						$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('mm.uid_foreign, mm.uid_local, mm.sorting AS mmsort, cat.uid, cat.crdate, cat.tstamp, cat.title, cat.description, cat.sorting AS catsort',
								'`tt_news_cat` AS cat, `tt_news_cat_mm` AS mm',
								'cat.uid=mm.uid_foreign AND mm.uid_local=' . $key);
						$rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
						if ($rows>0) {
							while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
								$uid = $row['uid'];
								$catArray[$uid] = array();
								$catArray[$uid]['crdate'] = $row['crdate'];
								$catArray[$uid]['tstamp'] = $row['tstamp'];
								$catArray[$uid]['title'] = $row['title'];
								$catArray[$uid]['description'] = $row['description'];
								$catArray[$uid]['sorting'] = $row['catsort'];
								$mmArray[$i] = array();
								$mmArray[$i]['uid_local'] = $row['uid_local'];		// Die News
								$mmArray[$i]['uid_foreign'] = $row['uid_foreign'];	// Die Kategorie
								$mmArray[$i]['sorting'] = $row['mmsort'];
								$i++;
							}
						}
						$GLOBALS['TYPO3_DB']->sql_free_result($res);
					}
					// Kategorien einfügen
					foreach ($catArray as $key => $values) {
						$values['pid'] = $pid;
						$values['cruser_id'] = $GLOBALS['BE_USER']->user['uid'];
						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_category', $values);
						if ($success){
							$catArray[$key]['uid'] = $GLOBALS['TYPO3_DB']->sql_insert_id();
						}
					}
					// Kategorie-Relationen einfügen
					$mmInsertArray = array('tablenames' => 'tx_camaliga_domain_model_content', 'fieldname' => 'categories');
					foreach ($mmArray as $key => $values) {
						$mmInsertArray['uid_local'] = $catArray[$values['uid_foreign']]['uid'];	// Die Kategorie
						$mmInsertArray['uid_foreign'] = $oldIDs[$values['uid_local']];			// Das Camaliga-Element
						$mmInsertArray['sorting'] = $values['sorting'];
						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_category_record_mm', $mmInsertArray);
					}
					
					// Meldung
					$this->addFlashMessage(
							\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:import.ok', 'OK'),
							'OK',
							\TYPO3\CMS\Core\Messaging\FlashMessage::OK);
					if ($this->request->hasArgument('dimport')) {
						$GLOBALS['TYPO3_DB']->exec_DELETEquery('tt_news', 'deleted=0 AND hidden=0 AND pid=' . $pid);
						$this->addFlashMessage(
							\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:import.del', 'deleted'),
							'OK',
							\TYPO3\CMS\Core\Messaging\FlashMessage::OK);
					}
				}
				
				$this->view->assign('entries', $entries);
				$this->view->assign('error', 0);
			} else {
				$this->view->assign('error', 1);
			}
		} else {
			$this->view->assign('error', 1);
		}
	}
	
	

	/**
	 * Prüft, ob ein Bild schon vorhanden ist
	 *
	 * @return string
	 */
	function checkImage($bild) {
		if (is_file(PATH_site . 'uploads/tx_camaliga/' . $bild)) {
			// wenn das Bild schon da ist, den Dateinamen ändern!
			for ($j=1;$j<500;$j++) {
				if (!is_file(PATH_site . 'uploads/tx_camaliga/' . $j . '_' . $bild)) {
					$bild = $j . '_' . $bild;
					break;
				}
			}
		}
		return $bild;
	}
}
?>
