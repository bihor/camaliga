<?php
namespace Quizpalme\Camaliga\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class CsvExportTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
	 * CSV file
	 *
	 * @var string
	 */
	protected $csvfile;

	/**
	 * Uid of the folder
	 *
	 * @var integer
	 */
	protected $page = 0;

	/**
	 * Category uids
	 *
	 * @var string
	 */
	protected $cats;

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
	 * Get the category uids
	 *
	 * @return string
	 */
	public function getCats() {
		return $this->cats;
	}
	
	/**
	 * Set the value of cats.
	 *
	 * @param string $cats	category uids
	 * @return void
	 */
	public function setCats($cats) {
		$this->cats = $cats;
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
	
	
	public function execute() {
		$successfullyExecuted = TRUE;
		$ln = "\r\n";							// line break
		$uid = (int) $this->getPage();			// folder with camaliga elements
		$cats = trim($this->getCats());			// select only camaliga elements with this parent category uids
		$catsArray = explode(',', $cats);
		$lang_uid = 0;							// language uid: bisher fest. TODO: auch einstellbar!
		$fields = $this->getFields();			// fields to export
		$fieldArry = explode(',', $fields);		// field-array
		$separator = $this->getSeparator();		// Texttrenner
		$delimiter = $this->getDelimiter();		// Feldtrenner
		$cat_del = $this->getCatdelimiter();	// Feldtrenner bei Kategorien
		$convert = ($this->getConvert()) ? TRUE : FALSE;	// convert from UTF-8 to ASCII?
		$text = $this->getHeader();
		if ($convert)
			$text = iconv('utf-8', 'iso-8859-1', $text);
		$content = $text . $ln;					// header of the csv file
		$cat_keys = array();					// uids of category names
		$cat_parents = array();					// parent of the categories
		$cat_rel = array();						// camaliga-category-relations
		$cat_counts = array();					// count $cats categories
		$i = 0;									// Counter
		
		// Step 1: select all categories of the current language
		$categoriesUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Quizpalme\\Camaliga\\Utility\\AllCategories');
		$all_cats = $categoriesUtility->getCategoriesarrayComplete($lang_uid);
		
		// Step 2: store more category datas in arrays
		foreach ($all_cats as $key => $one_cat) {
			$cat_keys[$one_cat['title']] = $key;
			$cat_parents[$key] = $one_cat['parent'];
		}

		// Step 3: select camaliga-category-relations
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid_foreign, uid_local',
				'tx_camaliga_domain_model_content AS camaliga, sys_category_record_mm AS mm',
				'mm.uid_foreign=camaliga.uid AND camaliga.hidden=0 AND camaliga.deleted=0 AND camaliga.sys_language_uid=' . $lang_uid . ' AND camaliga.pid=' . $uid,
				'',
				'camaliga.uid');
		$rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
		if ($rows>0) {
			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
				$uid_cam = $row['uid_foreign'];
				$uid_cat = $row['uid_local'];
				if (!is_array($cat_rel[$uid_cam]))
					$cat_rel[$uid_cam] = array();
				if ($cat_rel[$uid_cam][$cat_parents[$uid_cat]])
					$cat_rel[$uid_cam][$cat_parents[$uid_cat]] .= $cat_del;
				$cat_rel[$uid_cam][$cat_parents[$uid_cat]] .= $all_cats[$uid_cat]['title'];
				foreach ($catsArray as $aCat) {
					if ($aCat == $uid_cat)	// gesuchte Kategorie vorhanden?
						$cat_counts[$uid_cam]++;
				}
			}
		}
				
		// Step 4: select camaliga entries
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*',
				'tx_camaliga_domain_model_content',
				'hidden=0 AND deleted=0 AND sys_language_uid=' . $lang_uid . ' AND pid=' . $uid,
				'',
				'sorting ASC');
		$rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
		if ($rows>0) {
			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
				$uid = $row['uid'];
				if (!$cats || ($cat_counts[$uid]>0)) {
					if ($i > 0)
						$content .= $ln;
					$j = 0;
					foreach ($fieldArry as $field) {
						if ($j>0)
							$content .= $delimiter;
						if (substr(trim($field), 0, 10) != '"category:') {
							$text = preg_replace( "/\r|\n/", " ", $row[trim($field)]);
							if ($convert) $text = iconv('utf-8', 'iso-8859-1', $text);
							$content .= $separator . $text . $separator;
						} else {
							$cat = trim(substr(trim($field), 10, -1));	// Name der parent kategorie
							$text = ($convert) ? iconv('utf-8', 'iso-8859-1', $cat_rel[$uid][$cat_keys[$cat]]) : $cat_rel[$uid][$cat_keys[$cat]];
							$content .= $separator . $text . $separator;	// Kinder einer gesuchten Kategorie
						}
						$j++;
					}
					$i++;
				}
			}
		} else {
			$successfullyExecuted = FALSE;
		}
		$GLOBALS['TYPO3_DB']->sql_free_result($res);
		
		$fp = fopen(PATH_site . $this->getCsvfile(), 'w');
		$ergebnis = fwrite($fp, $content);
		fclose($fp);
		if (!$ergebnis)
			$successfullyExecuted = FALSE;
		
		//echo "Anzahl exportiert: " . $i;
		return $successfullyExecuted;
	}
}
