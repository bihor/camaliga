<?php
namespace Quizpalme\Camaliga\Task;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Core\Core\Environment;
use Quizpalme\Camaliga\Domain\Model\Category;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use Quizpalme\Camaliga\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\BackendWorkspaceRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

class CsvImportTask extends AbstractTask
{
	/**
	 * CSV file
	 *
	 * @var string
	 */
	protected $csvfile;

	/**
	 * Header of the CSV file
	 *
	 * @var string
	 */
	protected $header;
	
	/**
	 * Fields to export
	 *
	 * @var string
	 */
	protected $fields;
	
	/**
	 * Uid of the folder
	 *
	 * @var integer
	 */
	protected $page = 0;

	/**
	 * Uid of the cats
	 *
	 * @var integer
	 */
	protected $catpage = 0;
	
	/**
	 * Uid of the language
	 *
	 * @var integer
	 */
	protected $language = 0;
	
	/**
	 * Separator
	 *
	 * @var string
	 */
	protected $separator;

	/**
	 * Delimiter
	 *
	 * @var string
	 */
	protected $delimiter;

	/**
	 * Category-Delimiter
	 *
	 * @var string
	 */
	protected $catdelimiter;
	
	/**
	 * Convert from UTF-8 to ISO?
	 *
	 * @var integer
	 */
	protected $convert = 0;

	/**
	 * Delete entries first?
	 *
	 * @var integer
	 */
	protected $delete = 0;

	/**
	 * Simulate only?
	 *
	 * @var integer
	 */
	protected $simulate = 0;
	
	/**
  * @var ConfigurationManagerInterface
  */
 protected $configurationManager;
	
	
	/**
	 * Get the value of the csv file
	 *
	 * @return string
	 */
	public function getCsvfile() {
		return $this->csvfile;
	}

	/**
	 * Set the value of the private property csvfile.
	 *
	 * @param string $csvfile Path to the csv file
	 * @return void
	 */
	public function setCsvfile($csvfile) {
		$this->csvfile = $csvfile;
	}

	/**
	 * Get the header of the csv file
	 *
	 * @return string
	 */
	public function getHeader() {
		return $this->header;
	}
	
	/**
	 * Set the value of the private property header.
	 *
	 * @param string $header Header of the csv file
	 * @return void
	 */
	public function setHeader($header) {
		$this->header = $header;
	}
	
	/**
	 * Get the value of fields
	 *
	 * @return string
	 */
	public function getFields() {
		return $this->fields;
	}
	
	/**
	 * Set the value of the private property fields.
	 *
	 * @param string $fields Fields to export
	 * @return void
	 */
	public function setFields($fields) {
		$this->fields = $fields;
	}
	
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
	 * Get the value of the protected property page
	 *
	 * @return integer UID of the start page for this task
	 */
	public function getCatPage() {
		return $this->catpage;
	}
	
	/**
	 * Set the value of the private property page
	 *
	 * @param integer $page UID of the start page for this task.
	 * @return void
	 */
	public function setCatPage($catpage) {
		$this->catpage = ($catpage) ? 1 : 0;
	}
	
	/**
	 * Get the value of the protected property language
	 *
	 * @return integer UID of the language for this task
	 */
	public function getLanguage() {
		return $this->language;
	}
	
	/**
	 * Set the value of the private property language
	 *
	 * @param integer $page UID of the language for this task.
	 * @return void
	 */
	public function setLanguage($language) {
		$this->language = $language;
	}
	
	/**
	 * Get the separator
	 *
	 * @return string
	 */
	public function getSeparator() {
		return $this->separator;
	}
	
	/**
	 * Set the value of the separator
	 *
	 * @param string $separator
	 * @return void
	 */
	public function setSeparator($separator) {
		$this->separator = $separator;
	}

	/**
	 * Get the delimiter
	 *
	 * @return string
	 */
	public function getDelimiter() {
		return $this->delimiter;
	}
	
	/**
	 * Set the value of the delimiter
	 *
	 * @param string $delimiter
	 * @return void
	 */
	public function setDelimiter($delimiter) {
		$this->delimiter = $delimiter;
	}

	/**
	 * Get the catdelimiter
	 *
	 * @return string
	 */
	public function getCatdelimiter() {
		return $this->catdelimiter;
	}
	
	/**
	 * Set the value of the catdelimiter
	 *
	 * @param string $catdelimiter
	 * @return void
	 */
	public function setCatdelimiter($catdelimiter) {
		$this->catdelimiter = $catdelimiter;
	}
	
	/**
	 * Get the value of the protected property convert
	 *
	 * @return integer
	 */
	public function getConvert() {
		return $this->convert;
	}
	
	/**
	 * Set the value of the private property convert
	 *
	 * @param integer $convert
	 * @return void
	 */
	public function setConvert($convert) {
		$this->convert = ($convert) ? 1 : 0;
	}

	/**
	 * Get the value of the protected property delete
	 *
	 * @return integer
	 */
	public function getDelete() {
		return $this->delete;
	}
	
	/**
	 * Set the value of the private property delete
	 *
	 * @param integer $delete
	 * @return void
	 */
	public function setDelete($delete) {
		$this->delete = ($delete) ? 1 : 0;
	}

	/**
	 * Get the value of the protected property simulate
	 *
	 * @return integer
	 */
	public function getSimulate() {
		return $this->simulate;
	}
	
	/**
	 * Set the value of the private property simulate
	 *
	 * @param integer $simulate
	 * @return void
	 */
	public function setSimulate($simulate) {
		$this->simulate = ($simulate) ? 1 : 0;
	}
	
	
	public function execute() {
		$successfullyExecuted = TRUE;
		$insert = [];
		$ln = "\r\n";							// line break
		$pid = (int) $this->getPage();			// folder with camaliga elements
		$syslanguid = (int) $this->getLanguage();	// sys_language_uid ID
		$separator = $this->getSeparator();		// Texttrenner
		$delimiter = $this->getDelimiter();		// Feldtrenner
		$catpage = ($this->getCatPage()) ? TRUE : FALSE;	// search cats only in the pid-folder?
		$convert = ($this->getConvert()) ? TRUE : FALSE;	// convert from ASCII to UTF-8?
		$delete = ($this->getDelete()) ? TRUE : FALSE;		// delete entries first?
		$simulate = ($this->getSimulate()) ? TRUE : FALSE;	// simulate import?
		$fields = $this->getFields();			// fields for import
		$fields_names = explode(',', $fields);	// field-array
		
		// files sortiert nach Name, dann umkehren
		$path = Environment::getPublicPath() . '/' . $this->getCsvfile();
		$files = array_filter(glob($path), 'is_file');
		$total = count($files);
		if ($total > 1) $files = array_reverse($files);
		$newestFile = '';
		foreach ($files as $file) {
			$newestFile = $file;				// take only the first found file
			break;
		}
		if (!$newestFile) {
			return FALSE;	// keine Datei gefunden
		}
		
		if ($delete && !$simulate) {
			// erst löschen
			$uids = [];
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_camaliga_domain_model_content');
			$statement = $queryBuilder
			->select('uid')
			->from('tx_camaliga_domain_model_content')
			->where(
				$queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($pid, \PDO::PARAM_INT))
			)
			->andWhere(
				$queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter($syslanguid, \PDO::PARAM_INT))
			)
			->orderBy('sorting')
			->executeQuery();
			while ($row = $statement->fetchAssociative()) {
				$uids[] = $row['uid'];
			}
					
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category_record_mm');
			$affectedRows = $queryBuilder
			->delete('sys_category_record_mm')
			->where(
				$queryBuilder->expr()->in('uid_foreign', $queryBuilder->createNamedParameter($uids, Connection::PARAM_INT_ARRAY))
			)
			->executeStatement();
			
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_camaliga_domain_model_content');
			$affectedRows = $queryBuilder
			->delete('tx_camaliga_domain_model_content')
			->where(
				$queryBuilder->expr()->in('uid', $queryBuilder->createNamedParameter($uids, Connection::PARAM_INT_ARRAY))
			)
			->executeStatement();
		}
		
		// Step 0: init
		$configurationArray = [
			'persistence' => [
				'storagePid' => '',
				'classes' => [
					Category::class => [
						'mapping' => [
							'recordType' => 0,
							'tableName' => 'sys_category'
						]
					]
				]
			]
		];
		$this->configurationManager = GeneralUtility::makeInstance(ConfigurationManager::class);
		$this->configurationManager->setConfiguration($configurationArray);
		
		// Step 1: search all categories
		$catArray = [];
		$catParentArray = [];
		$cat_pids = [];
		if ($catpage) {
			$cat_pids[] = $pid;
		}
		$categoryRepository = GeneralUtility::makeInstance(CategoryRepository::class);
		$all_cats = $categoryRepository->getAllCats('uid', 'asc', $cat_pids);
		foreach ($all_cats as $row) {
			$catArray[$row['title']] = $row['uid'];
			if (!isset($catParentArray[$row['parent']]) || !is_array($catParentArray[$row['parent']])) {
				$catParentArray[$row['parent']] = [];
			}
			$catParentArray[$row['parent']][$row['title']] = $row['uid'];
		}
		
		// Step 2: max sorting till now
		$sorting=0;
		if (!$delete) {
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_camaliga_domain_model_content');
			$statement = $queryBuilder
			->select('sorting')
			->from('tx_camaliga_domain_model_content')
			->where(
				$queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($pid, \PDO::PARAM_INT))
			)
			->andWhere(
				$queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter($syslanguid, \PDO::PARAM_INT))
			)
			->orderBy('sorting', 'DESC')
			->setMaxResults(1)
			->executeQuery();
			while ($row = $statement->fetchAssociative()) {
				$sorting = $row['sorting'];
			}
		}
		
		// Step 3: Import
		$lines = [];
		if ($newestFile) {
			$lines = file($newestFile);
		}
		if ( count($lines) > 1 ) {
			$nr = 0;
			$fields_values = [];
			$fields_values['pid'] = $pid;
			$fields_values['tstamp'] = time();
			$fields_values['crdate'] = time();
			$fields_values['sys_language_uid'] = $syslanguid;
		//	$fields_values['cruser_id'] = $GLOBALS['BE_USER']->user["uid"];
			$handle = fopen ($newestFile, "r");              // Datei zum Lesen oeffnen

			if ($separator) {
				while ( ($fields_read = fgetcsv ($handle, 2000, $delimiter, $separator)) !== FALSE ) {
					if ($nr==0) {
						//$fields_names = $Felder;
					} else if ($fields_read[0] || $fields_read[1]) {
						$sorting++;
						$fields_values['sorting'] = $sorting;
						$result = $this->insertLine($fields_names, $fields_values, $fields_read, $simulate, $convert, $catArray, $catParentArray);
						if ($simulate) {
							$insert[] = $result;
						} else if (!$result) {
							$successfullyExecuted = FALSE;
						}
					} else {
						throw new \InvalidArgumentException(
							'No row in import-file found.',
							'1495476972'
						);
					}
					$nr++;
				}
			} else {
				while ( ($fields_read = fgetcsv ($handle, 2000, $delimiter)) !== FALSE ) {
					if ($nr==0) {
						//$fields_names = $Felder;
					} else if ($fields_read[0] || $fields_read[1]) {
						$sorting++;
						$fields_values['sorting'] = $sorting;
						$result = $this->insertLine($fields_names, $fields_values, $fields_read, $simulate, $convert, $catArray, $catParentArray);
						if ($simulate) {
							$insert[] = $result;
						} else if (!$result) {
							$successfullyExecuted = FALSE;
						}
					} else {
						throw new \InvalidArgumentException(
							'No row in import-file found.',
							'1495476972'
							);
					}
					$nr++;
				}
			}
			
			fclose ($handle);
			if ($simulate && count($insert)>0) {
				$output = $this->build_table($insert);
				// vielleicht so: https://readthedocs.org/projects/bartacus-bundle/downloads/pdf/stable/
				$message = GeneralUtility::makeInstance(FlashMessage::class,
						$output,
						'Simulation:', // the header is optional
						ContextualFeedbackSeverity::INFO,
						FALSE
				);
				$flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
				$messageQueue = $flashMessageService->getMessageQueueByIdentifier();
				$messageQueue->addMessage($message);
			}
		} else {
			$successfullyExecuted = FALSE;
		}
		return $successfullyExecuted;
	}
	
	/**
	 * Inserts a line to the database
	 *
	 * @return	mixed
	 */
	function insertLine($names, $values, $fields, $simulate, $convert, $catArray, $catParentArray) {
		$success_global = TRUE;
		$connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_camaliga_domain_model_content');
		$fieldConfig = $GLOBALS['TCA']['tx_camaliga_domain_model_content']['columns']['slug']['config'];
		$slugHelper = GeneralUtility::makeInstance(SlugHelper::class, 'tx_camaliga_domain_model_content', 'slug', $fieldConfig);
		
		for ($i=0; $i<count($names); $i++) {
			$feld = trim((string) $names[$i]);
			if (!str_starts_with($feld, 'category')) {
				if ($convert) {
					$values[$feld] = trim(iconv('iso-8859-1','utf-8',(string) $fields[$i]));
				} else {
					$values[$feld] = trim((string) $fields[$i]);
				}
			}
		}
		if (!$simulate) {
			$queryBuilder = $connection->createQueryBuilder();
			$success_camaliga = $queryBuilder
			->insert('tx_camaliga_domain_model_content')
			->values($values)
			->executeStatement();
			if ($success_camaliga) {
				$values['uid'] = $queryBuilder->getConnection()->lastInsertId();
				
				// slug setzen!
				$queryBuilder = $connection->createQueryBuilder();
				$statement = $queryBuilder->select('*')->from('tx_camaliga_domain_model_content')->where(
					$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($values['uid'], \PDO::PARAM_INT))
				)->executeQuery();
				$record = $statement->fetchAssociative();
				$slug = $slugHelper->generate($record, $record['pid']);
					
				// Update
				$queryBuilder = $connection->createQueryBuilder();
				$queryBuilder->update('tx_camaliga_domain_model_content')->where(
					$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($values['uid'], \PDO::PARAM_INT))
				)->set('slug', $slug)->executeStatement();
			} else {
				$values['uid'] = 0;
				$success_global = FALSE;
			}
		} else {
			$values['uid'] = 0;
		}
		
		if (($values['uid'] > 0) || $simulate) {
			// Kategorie-Relationen einfügen? Kategorien müssen vorhanden sein!
			$cats = 0;
			$catIDs = []; 
			for ($i=0; $i<count($names); $i++) {
				$feld = $names[$i];
				if (str_starts_with((string) $feld, 'category')) {
					// eine Kategorie ist dran
					if (substr((string) $feld, 8, 8) == '-parent:') {
						// Vater wurde angegeben
						$cat = '';
						$cat_parent = substr((string) $feld, 16);
					} else {
						// Wurde eine Kategorie angegeben: wenn ja, dann werte 0 oder 1 aus
						$cat = substr((string) $feld, 9);
						$cat_parent = '';
					}
					
					if ($cat_parent) {
						// a) Vater-Kategorie im Header angegeben
						$catParentID = ($convert) ? trim(iconv('iso-8859-1','utf-8',(string) $catArray[$cat_parent])) : trim((string) $catArray[$cat_parent]);
						$catName = ($convert) ? trim(iconv('iso-8859-1','utf-8',(string) $fields[$i])) : trim((string) $fields[$i]);
						$catNameArray = explode(',', $catName);
						foreach ($catNameArray as $oneCatName)
							$catIDs[] = $catParentArray[$catParentID][trim($oneCatName)];
					} else if ($cat) {
						// b) Kategorie im Header angegeben
						if (trim((string) $fields[$i]) == 1) {	// nur eine 1 wird in der Spalte akzeptiert
							$catName = ($convert) ? trim(iconv('iso-8859-1','utf-8',$cat)) : trim($cat);
							$catIDs[] = $catArray[$catName];
						}
					} else {
						// c) Kategorie in den Zeilen angegeben
						$catName = ($convert) ? trim(iconv('iso-8859-1','utf-8',(string) $fields[$i])) : trim((string) $fields[$i]);
						$catIDs[] = $catArray[$catName];
					}
				}
			}
			
			if (count($catIDs) > 0) {
				foreach ($catIDs as $catID) {
					if ($catID > 0) {
						if ($simulate) {
							if ($values['categories']) {
								$values['categories'] .= ', ' . $catID;
							} else {
								$values['categories'] = $catID;
							}
						} else {
							// Kategorie-Relationen einfügen
							$mmInsertArray = ['tablenames' => 'tx_camaliga_domain_model_content', 'fieldname' => 'categories'];
							$mmInsertArray['uid_local'] = $catID;	// Die Kategorie
							$mmInsertArray['uid_foreign'] = $values['uid'];			// Das Camaliga-Element
							$mmInsertArray['sorting'] = ($cats+1)*10;
							$mmInsertArray['sorting_foreign'] = ($cats+1)*10;
							$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category_record_mm');
							$success_cats = $queryBuilder
							->insert('sys_category_record_mm')
							->values($mmInsertArray)
							->executeStatement();
							if ($success_cats) {
								$cats++;
							} else {
								$success_global = FALSE;
							}
						}
					}
				}
			}
			
			if (!$simulate && ($cats > 0)) {
				$queryBuilder = $connection->createQueryBuilder();
				$queryBuilder
				->update('tx_camaliga_domain_model_content')
				->where(
					$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($values['uid'], \PDO::PARAM_INT))
				)
				->set('categories', $cats)
				->executeStatement();
			}
		}
		
		if ($simulate) {
			return $values;
		} else {
			return $success_global;
		}
	}

	/**
	 * Aray nach Tabelle
	 *
	 * @return	string
	 */
	function build_table($array){
		// HTML ist leider nicht mehr erlaubt :-(
		$html = '';
		// header row
		foreach($array[0] as $key=>$value){
			$html .= $key . '; ';
		}
		$html .= "###\n\r";
		// data rows
		foreach( $array as $key=>$value){
			foreach($value as $key2=>$value2){
				$html .= strip_tags((string) $value2) . '; ';
			}
			$html .= "###\n\r";
		}
		return $html;
	}
}