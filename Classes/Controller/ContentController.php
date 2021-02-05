<?php
namespace Quizpalme\Camaliga\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Extbase\Annotation as Extbase;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kurt Gusbeth <info@Quizpalme.de>
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
 * Content Controller: der Körper der Extension
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ContentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

	/**
	 * contentRepository
	 *
	 * @var \Quizpalme\Camaliga\Domain\Repository\ContentRepository
	 */
	protected $contentRepository;
	
	/**
	 * configurationManager
	 * 
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;
	
	/**
	 * templatePath
	 *
	 * @var string	Pfad zu den Templates
	 */
	protected $templatePath;
	
	/**
	 * Injects the configuration manager, retrieves the plugin settings from it, 
	 * merges / overrides the FlexForm settings with Typoscript settings if FlexForm setting is empty
	 *
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager Instance of the Configuration Manager
	 * @return void
	 */
	public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
	{
		//parent::injectConfigurationManager($configurationManager);
		$this->configurationManager = $configurationManager;
		$tsSettings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
		);
		for ($i=10; $i>0; $i--) {
			$this->templatePath = $tsSettings['plugin.']['tx_camaliga.']['view.']['templateRootPaths.'][$i];
			if ($this->templatePath) {
				break;
			}
		}
		$tsSettings = $tsSettings['plugin.']['tx_camaliga.']['settings.'];
		$originalSettings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS
		);
		
		// start override
		if (isset($tsSettings['overrideFlexformSettingsIfEmpty']) && $tsSettings['overrideFlexformSettingsIfEmpty']==1) {
			// if flexform setting is empty and value is available in TS
			foreach ($tsSettings as $key=>$value) {
				if ($key == 'img.' || $key == 'item.' || $key == 'extended.' || $key == 'bootstrap.') {
					continue;
				}
				if (!$originalSettings[$key] && isset($value)) {
					$originalSettings[$key] = $value;
				}
			}
			if (is_array($tsSettings['img.'])) {
				foreach ($tsSettings['img.'] as $key=>$value) {
					if ((!$originalSettings['img'][$key] && $originalSettings['img'][$key]!=='0') && isset($value)) {
						$originalSettings['img'][$key] = $value;
					}
				}
			}
			if (is_array($tsSettings['item.'])) {
				foreach ($tsSettings['item.'] as $key=>$value) {
					if ((!$originalSettings['item'][$key] && $originalSettings['item'][$key]!=='0') && isset($value)) {
						$originalSettings['item'][$key] = $value;
					}
				}
			}
			if (is_array($tsSettings['more.'])) {
				foreach ($tsSettings['more.'] as $key=>$value) {
					if ((!$originalSettings['more'][$key] && $originalSettings['more'][$key]!=='0') && isset($value)) {
						$originalSettings['more'][$key] = $value;
					}
				}
			}
			if (is_array($tsSettings['extended.'])) {
				foreach ($tsSettings['extended.'] as $key=>$value) {
					if ((!$originalSettings['extended'][$key] && $originalSettings['extended'][$key]!=='0') && isset($value)) {
						$originalSettings['extended'][$key] = $value;
					}
				}
			}
			if (is_array($tsSettings['bootstrap.'])) {
				foreach ($tsSettings['bootstrap.'] as $key=>$value) {
					if ((!$originalSettings['bootstrap'][$key] && $originalSettings['bootstrap'][$key]!=='0') && isset($value)) {
						$originalSettings['bootstrap'][$key] = $value;
					}
				}
			}
			if (is_array($tsSettings['seo.'])) {
				foreach ($tsSettings['seo.'] as $key=>$value) {
					if ((!$originalSettings['seo'][$key] && $originalSettings['seo'][$key]!=='0') && isset($value)) {
						$originalSettings['seo'][$key] = $value;
					}
				}
			}
			if (is_array($tsSettings['maps.'])) {
				foreach ($tsSettings['maps.'] as $key=>$value) {
					if ((!$originalSettings['maps'][$key] && $originalSettings['maps'][$key]!=='0') && isset($value)) {
						$originalSettings['maps'][$key] = $value;
					}
				}
			}
		}
		$this->settings = $originalSettings;
	}
	
	/**
	 * Injects the content-Repository
	 * 
	 * @param \Quizpalme\Camaliga\Domain\Repository\ContentRepository $contentRepository
	 */ 
	public function injectContentRepository(\Quizpalme\Camaliga\Domain\Repository\ContentRepository $contentRepository)
	{ 
		$this->contentRepository = $contentRepository; 
	}
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction()
	{
		if ($this->settings['extended']['enable'] == 1) {
			// extended-Version laden - this->template = 'ListExtended'; ?
			$this->listExtendedAction();
		} else {
		    // @extensionScannerIgnoreLine
		    $cobjData = $this->configurationManager->getContentObject();
		    $content_uid = $cobjData->data['uid'];
		    $content_pid = $cobjData->data['pid'];    // statt $GLOBALS["TSFE"]->id;
		    
			$storagePidsArray = $this->contentRepository->getStoragePids();
			$storagePidsComma = implode(',', $storagePidsArray);
			if (!$storagePidsComma) {
				// nix ausgewählt => aktuelle PID nehmen
			    $storagePidsComma = intval($content_pid);
				$storagePidsArray = array($storagePidsComma);
				$storagePidsOnly  = array($storagePidsComma);
			} else {
				$storagePidsOnly = array();
			}
			$categoryUids = array();
			if ($this->settings['defaultCatIDs']) {
				$defaultCats = explode(',', $this->settings['defaultCatIDs']);
				foreach ($defaultCats as $defCat) {
					$selected = intval(trim($defCat));
					$categoryUids[$selected] = $selected;
				}
			}
			$debug = '';
			
			if (!empty($categoryUids)) {
				$normalCatMode = ($this->settings['normalCategoryMode'] == 'or') ? false : true;
				if ($this->settings['debug']) {
					$debug .= 'findByCategories("' . implode(",", $categoryUids) . '",,,0,' . $this->settings['sortBy'] . ',' . $this->settings['sortOrder'] . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ',' . $this->settings['normalCategoryMode'] . ',' . $this->settings['limit'] . ")\n";
				}
				$contents = $this->contentRepository->findByCategories($categoryUids, '', '', 0, $this->settings['sortBy'], $this->settings['sortOrder'], $this->settings['onlyDistinct'], $storagePidsOnly, $normalCatMode, $this->settings['limit']);
			} else {
				if ($this->settings['debug']) {
					$debug .= 'findAll(' . $this->settings['sortBy'] . ',' . $this->settings['sortOrder'] . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ',' . $this->settings['limit'] . ")\n";
				}
				$contents = $this->contentRepository->findAll($this->settings['sortBy'], $this->settings['sortOrder'], $this->settings['onlyDistinct'], $storagePidsOnly, $this->settings['limit']);
			}
			if ($this->settings['random']) {
				$contents = $this->sortObjects($contents);
			}
			if ($this->settings['getLatLon']) {
				$debug .= $this->getLatLon($contents);
			}
			
			if ($this->settings['more']['setModulo']) {
				$i = 0;
				$j = 0;
				$mod = intval($this->settings['item']['items']);
				foreach ($contents as $content) {
					if (($i % $mod) == 0) { $j++; $content->setModuloBegin($j); }
					$i++;
					if ((($i % $mod) == 0) || ($i == $contents->count())) { $content->setModuloEnd($j); }
				}
			}
			
			$this->view->assign('fal', 1);
			$this->view->assign('uid', $content_uid);
			$this->view->assign('pid', $content_pid);
			$this->view->assign('contents', $contents);
			$this->view->assign('storagePIDsArray', $storagePidsArray);	// alle PIDs als Array
			$this->view->assign('storagePIDsComma', $storagePidsComma);	// alle PIDs kommasepariert
			$item_width = intval($this->settings['item']['width']);
			$padding_item_width = $item_width + 2 * intval($this->settings['item']['padding']);
			$total_item_width = $padding_item_width + 2 * intval($this->settings['item']['margin']);
			$total_width = intval($this->settings['item']['items']) * $total_item_width;
			$this->view->assign('paddingItemWidth', $padding_item_width);
			$this->view->assign('totalItemWidth', $total_item_width);
			$this->view->assign('itemWidth', (($this->settings['addPadding']) ? $padding_item_width : $item_width));
			$this->view->assign('totalWidth', $total_width);
			$item_height = intval($this->settings['item']['height']);
			$padding_item_height = $item_height + 2 * intval($this->settings['item']['padding']);
			$total_item_height = $padding_item_height + 2 * intval($this->settings['item']['margin']);
			$this->view->assign('paddingItemHeight', $padding_item_height);
			$this->view->assign('totalItemHeight', $total_item_height);
			$this->view->assign('itemHeight', (($this->settings['addPadding']) ? $padding_item_height : $item_height));
			$this->view->assign('onlySearchForm', 0);
			$this->view->assign('debug', $debug);
		}
	}
	
	/**
	 * action listExtended
	 *
	 * @return void
	 */
	public function listExtendedAction()
	{
		$this->settings['extended']['enable'] = 1;
		$search = false;	// search by user selection?
		$sortBy = ($this->request->hasArgument('sortBy')) ? $this->request->getArgument('sortBy') : $this->settings['sortBy'];
		$sortOrder = ($this->request->hasArgument('sortOrder')) ? $this->request->getArgument('sortOrder') : $this->settings['sortOrder'];
		$sword = ($this->request->hasArgument('sword')) ? $this->request->getArgument('sword') : '';
		$place = ($this->request->hasArgument('place')) ? $this->request->getArgument('place') : '';
		$radius = ($this->request->hasArgument('radius')) ? intval($this->request->getArgument('radius')) : 0;
		if ($this->request->hasArgument('content')) {
			$cUid = intval($this->request->getArgument('content'));
			if ($cUid > 0) {
				$search = true;
			}
		}
		$languageAspect = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class)->getAspect('language');
		$sys_language_uid = $languageAspect->getId();
		
		// @extensionScannerIgnoreLine
		$cobjData = $this->configurationManager->getContentObject();
		$content_uid = $cobjData->data['uid'];
		$content_pid = $cobjData->data['pid'];    // statt $GLOBALS["TSFE"]->id;
		
		$distanceArray = [];
		$categoryUids = [];
		$start = ($this->request->hasArgument('start')) ? intval($this->request->getArgument('start')) : 1;
		$storagePidsArray = $this->contentRepository->getStoragePids();
		$storagePidsComma = implode(',', $storagePidsArray);
		$storagePidsData = [];
		$storagePidsOnly = [];
		$debug = '';
		
		if (!empty($storagePidsArray)) {
			// bei mehr als einer PID eine Auswahl anbieten
			$storagePidsData_tmp = $this->contentRepository->getStoragePidsData();
			foreach ($storagePidsArray as $value) {
				// es kommt eben auf die Reihenfolge der Einspeisung an!
				$storagePidsData[$value] = $storagePidsData_tmp[$value]; 
			}
			$defPids = ',' . str_replace(' ', '', $this->settings['defaultStoragePids']) . ',';
			foreach ($storagePidsArray as $aPID) {
				// Prüfen, ob nur bestimmte Ordner ausgewählt sind
				if ($this->request->hasArgument('search')) {
					// PID übermittelt?
					if ($this->request->hasArgument('pid_' . $aPID)) {
						if ($this->request->getArgument('pid_' . $aPID) == $aPID) {
							$storagePidsData[$aPID]['selected'] = $aPID;
							$storagePidsOnly[] = intval($aPID);
						}
					}
				} else if ($this->settings['defaultStoragePids']) {
					// Default-PID vorhanden?
					if (strpos($defPids, ',' . $aPID . ',') !== false) {
						$storagePidsData[$aPID]['selected'] = $aPID;
						$storagePidsOnly[] = intval($aPID);
					}
				}
			}
		} else if (!$storagePidsComma) {
			// nix ausgewählt => aktuelle PID nehmen
		    $storagePidsComma = intval($content_pid);
			$storagePidsArray = array($storagePidsComma);
			$storagePidsOnly  = array($storagePidsComma);
		}
		// gets all categories, which we want for the options
		$categoryRepository = $this->objectManager->get('Quizpalme\\Camaliga\\Domain\\Repository\\CategoryRepository');
		if ($this->settings['category']['storagePids']) {
			if ($this->settings['category']['storagePids'] == -1) {
				$catStoragePids = [];		// alle kategorien
			} else {
				$catStoragePids = explode(',', $this->settings['category']['storagePids']);		// category-folder
			}
		} else {
			$catStoragePids = $storagePidsArray;	// camaliga-folder(s)
		}
		$all_cats = $categoryRepository->getAllCats($this->settings['category']['sortBy'], $this->settings['category']['orderBy'], $catStoragePids);
		$cats = $categoryRepository->getCategoriesAndParents($all_cats);
		
		// checke ausgewählte Kategorien
		foreach ($cats as $uid => $row) {
			$selected = ($this->request->hasArgument('cat'.$uid)) ?	intval($this->request->getArgument('cat'.$uid)) : 0;
			$cats[$uid]['selected'] = $selected;
			if ($selected > 0) {
				$categoryUids[$selected] = $selected;
				$search = true;
			}
			if (count($row['childs'])>0) {
				foreach ($row['childs'] as $child_uid => $child) {
					$selected = ($this->request->hasArgument('cat'.$uid.'_'.$child_uid)) ?	intval($this->request->getArgument('cat'.$uid.'_'.$child_uid)) : 0;
					$cats[$uid]['childs'][$child_uid]['selected'] = $selected;
					if ($selected > 0) {
						$categoryUids[$uid] = ($categoryUids[$uid]) ? $categoryUids[$uid].",$selected" : $selected;
						$search = true;
					}
				}
			}
		}
		
		// es wurde gesucht
		if ($this->request->hasArgument('search')) {
			$search = true;
		}
		
		if ($search && $this->settings['extended']['saveSearch'] == 1) {
			// Suchparameter in Cookie speichern
			$searchCookie = [];
			$searchCookie['sortBy'] = $sortBy;
			$searchCookie['sortOrder'] = $sortOrder;
			$searchCookie['sword'] = $sword;
			$searchCookie['place'] = $place;
			$searchCookie['radius'] = $radius;
			$searchCookie['storagePidsOnly'] = $storagePidsOnly;
			$searchCookie['categoryUids'] = $categoryUids;
			//$searchCookie['start'] = $start;
			// Cookie speichern
			$GLOBALS['TSFE']->fe_user->setKey('ses', 'camaliga' . $content_uid, serialize($searchCookie));
			$GLOBALS['TSFE']->fe_user->storeSessionData();
		} else	if (!$search && $this->settings['extended']['saveSearch'] == 1) {
			// Suchparameter aus Cookie laden
			$cookie = $GLOBALS['TSFE']->fe_user->getKey('ses', 'camaliga' . $content_uid);
			if ($cookie) {
				$searchCookie = unserialize($cookie);
				$sortBy = $searchCookie['sortBy'];
				$sortOrder = $searchCookie['sortOrder'];
				$sword = $searchCookie['sword'];
				$place = $searchCookie['place'];
				$radius = $searchCookie['radius'];
				$storagePidsOnly = $searchCookie['storagePidsOnly'];
				$categoryUids = $searchCookie['categoryUids'];
				foreach ($storagePidsArray as $aPID) {	// reset
					$storagePidsData[$aPID]['selected'] = 0;
				}
				foreach ($storagePidsOnly as $aPID) {	// set new
					$storagePidsData[$aPID]['selected'] = $aPID;
				}
				foreach ($categoryUids as $defCat) {
					foreach (explode(',', $defCat) as $selected) {
						$uid = intval(trim($selected));
						$parent = $all_cats[$uid]['parent'];
						if ($cats[$parent]['description'] == 'checkbox') {
							$cats[$parent]['childs'][$uid]['selected'] = $selected;
						} else {
							$cats[$parent]['selected'] = $selected;
						}
					}
				}
			}
		} else if (!$search && $this->settings['defaultCatIDs']) {
			// keine Suche, keine Cookies => default cats auswählen
			$defaultCats = explode(',', $this->settings['defaultCatIDs']);
			foreach ($defaultCats as $defCat) {
				$uid = $selected = intval(trim($defCat));
				$parent = $all_cats[$uid]['parent'];
				if ($cats[$parent]['description'] == 'checkbox') {
					$cats[$parent]['childs'][$uid]['selected'] = $selected;
					$categoryUids[$parent] = ($categoryUids[$parent]) ? $categoryUids[$parent].','.$selected : $selected;
				} else {
					$cats[$parent]['selected'] = $selected;
					$categoryUids[$selected] = $selected;
				}
			}
		}
		
		// Suche
		if (!$search && $this->settings['extended']['onlySearchForm'] == 1) {
			$contents = array();
			$this->view->assign('onlySearchForm', 1);
		} else {
			if ($cUid > 0) {
				// nur ein bestimmtes Element anzeigen
				if ($this->settings['debug']) {
					$debug .= 'findByUids(array(' . $cUid . "))\n";
				}
				$contents = $this->contentRepository->findByUids(array($cUid));
			} else if (!empty($categoryUids)) {
				// Umfangreiche Suche betreiben
				// official solution (not enough): http://wiki.typo3.org/TYPO3_6.0#Category
				// Sort categories (doesnt work): http://www.php-kurs.com/arrays-mehrdimensional.htm 
				// find entries by category-uids
				if ($this->settings['debug']) {
					$debug .= 'findByCategories("' . implode(",", $categoryUids) . '",' . $sword . ',' . $place . ',' . $radius . ',' . $sortBy . ',' . $sortOrder . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ', TRUE' . ',' . $this->settings['limit'] . ")\n";
				}
				$contents = $this->contentRepository->findByCategories($categoryUids, $sword, $place, $radius, $sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly, true,  $this->settings['limit']);
			} else if ($sword || $place) {
				// Komplexe Suche, aber ohne Kategorien
				if ($this->settings['debug']) {
					$debug .= 'findComplex( ,' . $sword . ',' . $place . ',' . $radius . ',' . $sortBy . ',' . $sortOrder . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ',' . $this->settings['limit'] . ")\n";
				}
				$contents = $this->contentRepository->findComplex(array(), $sword, $place, $radius, $sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly, $this->settings['limit']);
			} else {
				// Simple Suche
				if ($this->settings['debug']) {
					$debug .= 'findAll(' . $sortBy . ',' . $sortOrder . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ',' . $this->settings['limit'] . ")\n";
				}
				$contents = $this->contentRepository->findAll($sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly, $this->settings['limit']);
			}
			if ($place)	{
				$distanceArray = $this->contentRepository->getDistanceArray();	// Distanz-Array vorhanden?
			}
			if ($this->settings['random']) {
				$contents = $this->sortObjects($contents);	// zufällig umsortieren?
			}
			if ($this->settings['getLatLon']) {
				$debug .= $this->getLatLon($contents);	// Position suchen? Bringt nach einer Umkreissuche freilich nichts!
			}
			$this->view->assign('onlySearchForm', 0);
		}

		if ($this->settings['more']['setModulo']) {
			$i = 0;
			$j = 0;
			$mod = intval($this->settings['item']['items']);
			foreach ($contents as $content) {
				if (($i % $mod) == 0) { $j++; $content->setModuloBegin($j); }
				$i++;
				if ((($i % $mod) == 0) || ($i == $contents->count())) { $content->setModuloEnd($j); }
			}
		}
		
		$this->view->assign('fal', 1);
		$this->view->assign('lang', $sys_language_uid);
		$this->view->assign('uid', $content_uid);
		$this->view->assign('pid', $content_pid);
		$this->view->assign('contents', $contents);
		$this->view->assign('sortBy_selected', $sortBy);
		$this->view->assign('sortOrder_selected', $sortOrder);
		$this->view->assign('all_categories', $all_cats);
		$this->view->assign('categories', $cats);
		$this->view->assign('defaultCatIDs', $this->settings['defaultCatIDs']);
		$this->view->assign('storagePIDsArray', $storagePidsArray);	// alle PIDs als Array
		$this->view->assign('storagePIDsComma', $storagePidsComma);	// alle PIDs kommasepariert
		$this->view->assign('storagePIDsData', $storagePidsData);	// alle Daten zu den PIDS
		$this->view->assign('start', $start);
		$item_width = intval($this->settings['item']['width']);
		$padding_item_width = $item_width + 2 * intval($this->settings['item']['padding']);
		$total_item_width = $padding_item_width + 2 * intval($this->settings['item']['margin']);
		$total_width = intval($this->settings['item']['items']) * $total_item_width;
		$this->view->assign('paddingItemWidth', $padding_item_width);
		$this->view->assign('totalItemWidth', $total_item_width);
		$this->view->assign('itemWidth', (($this->settings['addPadding']) ? $padding_item_width : $item_width));
		$this->view->assign('totalWidth', $total_width);
		$item_height = intval($this->settings['item']['height']);
		$padding_item_height = $item_height + 2 * intval($this->settings['item']['padding']);
		$total_item_height = $padding_item_height + 2 * intval($this->settings['item']['margin']);
		$this->view->assign('paddingItemHeight', $padding_item_height);
		$this->view->assign('totalItemHeight', $total_item_height);
		$this->view->assign('itemHeight', (($this->settings['addPadding']) ? $padding_item_height : $item_height));
		$this->view->assign('sword', $sword);
		$this->view->assign('place', $place);
		$this->view->assign('radius', $radius);
		if ($this->settings['extended']['radiusValues']) {
			$radiusArray = array();
			$radiusTemp = explode(',', $this->settings['extended']['radiusValues']);
			foreach ($radiusTemp as $aRadius) {
				$radiusArray[$aRadius] = $aRadius . ' km';
			}
			$this->view->assign('radiusArray', $radiusArray);
			if (count($distanceArray) > 0) {
				// Entferungen bei den Elementen setzen
				foreach ($contents as $element) {
					$element->setDistance($distanceArray[$element->getUid()]);
				}
			}
			$this->view->assign('rsearch', 1);
		} else {
			$this->view->assign('rsearch', 0);
		}
		$this->view->assign('debug', $debug);
	}
	
	/**
	 * action teaser
	 *
	 * @return void
	 */
	public function teaserAction()
	{
        // @extensionScannerIgnoreLine
        $cobjData = $this->configurationManager->getContentObject();
        $content_uid = $cobjData->data['uid'];
        $content_pid = $cobjData->data['pid'];
        
        $debug = '';
        $ids = explode(',', $this->settings['teaserIDs']);
        if ($this->settings['debug']) {
            $debug .= 'findByUids(array(' . $this->settings['teaserIDs'] . '),' . $this->settings['sortBy'] . ',' . $this->settings['sortOrder'] . ")\n";
        }
        $contents = $this->contentRepository->findByUids($ids, $this->settings['sortBy'], $this->settings['sortOrder']);
        
        $this->view->assign('uid', $content_uid);
        $this->view->assign('pid', $content_pid);
        $this->view->assign('contents', $contents);
        $item_width = intval($this->settings['item']['width']);
        $padding_item_width = $item_width + 2 * intval($this->settings['item']['padding']);
        $total_item_width = $padding_item_width + 2 * intval($this->settings['item']['margin']);
        $total_width = intval($this->settings['item']['items']) * $total_item_width;
        $this->view->assign('paddingItemWidth', $padding_item_width);
        $this->view->assign('totalItemWidth', $total_item_width);
        $this->view->assign('itemWidth', (($this->settings['addPadding']) ? $padding_item_width : $item_width));
        $this->view->assign('totalWidth', $total_width);
        $item_height = intval($this->settings['item']['height']);
        $padding_item_height = $item_height + 2 * intval($this->settings['item']['padding']);
        $total_item_height = $padding_item_height + 2 * intval($this->settings['item']['margin']);
        $this->view->assign('paddingItemHeight', $padding_item_height);
        $this->view->assign('totalItemHeight', $total_item_height);
        $this->view->assign('itemHeight', (($this->settings['addPadding']) ? $padding_item_height : $item_height));
        $this->view->assign('debug', $debug);
	}
	
	/**
	 * action search
	 *
	 * @return void
	 */
	public function searchAction()
	{
	    $template = ($this->request->hasArgument('template')) ? $this->request->getArgument('template') : '';
	    if (!$template) {
	        $template = $this->settings['extended']['template'];
	    }
		if ($template) {
			$this->view->setTemplatePathAndFilename($this->templatePath . 'Content/' . $template . '.html');
		}
		$this->listExtendedAction();
	}
	

	/**
	 * set SEO head?
	 *
	 * @param \Quizpalme\Camaliga\Domain\Model\Content $content
	 * @return void
	 */
	protected function setSeo(\Quizpalme\Camaliga\Domain\Model\Content $content)
	{
		$title = $content->getTitle();
		$desc = preg_replace("/[\n\r]/"," - ", $content->getShortdesc());
		if ($this->settings['seo']['setTitle'] == 1) {
			$GLOBALS['TSFE']->page['title'] = $title;
		}
		if (($this->settings['seo']['setDescription'] == 1) && $desc) {
			$GLOBALS['TSFE']->page['description'] = $desc;
		}
		if ($this->settings['seo']['setIndexedDocTitle'] == 1) {
			$GLOBALS['TSFE']->indexedDocTitle = $title;
		}
		if ($this->settings['seo']['setOgTitle'] == 1) {
			$this->response->addAdditionalHeaderData('<meta property="og:title" content="' . $title .'">');
		}
		if (($this->settings['seo']['setOgDescription'] == 1) && $desc) {
			$this->response->addAdditionalHeaderData('<meta property="og:description" content="' . $desc . '">');
		}
		if ($this->settings['seo']['setOgImage'] == 1) {
			$server = ($_SERVER['HTTPS']) ? 'https://' : 'http://';
			$server .= $_SERVER['SERVER_NAME'];
			$image = '';
			if ($content->getFalimage() && $content->getFalimage()->getUid()) {
				$typo3FALRepository = $this->objectManager->get("TYPO3\\CMS\\Core\\Resource\\FileRepository");
				$fileObject = $typo3FALRepository->findFileReferenceByUid($content->getFalimage()->getUid());
				$fileObjectData = $fileObject->toArray();
				$image = $server . '/' . $fileObjectData['url'];
			}
			if ($image) {
				$this->response->addAdditionalHeaderData('<meta property="og:image" content="' . $image . '">');
			}
		}
	}
	
	/**
	 * action show one element. ignorevalidation added because of validation erros
	 *
	 * @param \Quizpalme\Camaliga\Domain\Model\Content $content
	 * @Extbase\IgnoreValidation("content")
	 * @return void
	 */
	public function showAction(\Quizpalme\Camaliga\Domain\Model\Content $content)
	{
		if ($this->settings['extended']['enable'] == 1) {
			// extended-Version laden
			// $this->view->setTemplatePathAndFilename($this->templatePath . 'Content/ShowExtended.html');
			$this->showExtendedAction($content);
		} else {
			$this->setSeo($content);
				
			$this->view->assign('fal', 1);
			$this->view->assign('content', $content);
			$this->view->assign('error', 0);
		}
	}

	/**
	 * action show one element, extended. ignorevalidation added because of validation erros
	 *
 	 * @param \Quizpalme\Camaliga\Domain\Model\Content $content
	 * @Extbase\IgnoreValidation("content")
	 * @return void
	 */
	public function showExtendedAction(\Quizpalme\Camaliga\Domain\Model\Content $content)
	{
		$this->setSeo($content);
			
		$this->view->assign('fal', 1);
		$this->view->assign('content', $content);
		$this->view->assign('error', 0);
		if ($content->getMother()) {
			// wir haben hier ein Kind
			$this->view->assign('parent', $this->contentRepository->findByUid($content->getMother()->getUid()));
			$this->view->assign('hasParent', 1);
			$this->view->assign('childs', $this->contentRepository->findByMother2($content->getMother()->getUid(), $content->getUid()));
		} else {
			// wir haben hier die Mutter
			$this->view->assign('parent', '');
			$this->view->assign('hasParent', 0);
			$this->view->assign('childs', $this->contentRepository->findByMother2($content->getUid(), 0));
		}
	}
	
	/* ************************************* weitere Templates *************************** */
	
	/**
	 * action carousel
	 *
	 * @return void
	 */
	public function carouselAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action separated carousel
	 *
	 * @return void
	 */
	public function carouselSeparatedAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action magnific popup
	 *
	 * @return void
	 */
	public function magnificAction()
	{
	    if ($this->settings['extended']['enable']) {
	        $this->listExtendedAction();
	    } else {
	        $this->listAction();
	    }
	}
	
	/**
	 * action roundabout
	 *
	 * @return void
	 */
	public function roundaboutAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action flipster
	 *
	 * @return void
	 */
	public function flipsterAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action bootstrap
	 *
	 * @return void
	 */
	public function bootstrapAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action collapse
	 *
	 * @return void
	 */
	public function collapseAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action modal
	 *
	 * @return void
	 */
	public function modalAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action tab
	 *
	 * @return void
	 */
	public function tabAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action S Gallery
	 *
	 * @return void
	 */
	public function sgalleryAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action AD Gallery
	 *
	 * @return void
	 */
	public function adGalleryAction()
	{
		if ($this->settings['extended']['enable']) {
		//	$this->template = 'AdGalleryExtended';
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action Coolcarousel
	 *
	 * @return void
	 */
	public function coolcarouselAction()
	{
	    if ($this->settings['extended']['enable']) {
	        $this->listExtendedAction();
	    } else {
	        $this->listAction();
	    }
	}

	/**
	 * action Ekko Lightslider
	 *
	 * @return void
	 */
	public function ekkoAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action Elastislide
	 *
	 * @return void
	 */
	public function elastislideAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action Elegant CSS3 Slider
	 *
	 * @return void
	 */
	public function elegantAction()
	{
	    if ($this->settings['extended']['enable']) {
	        $this->listExtendedAction();
	    } else {
	        $this->listAction();
	    }
	}
	
	/**
	 * action FancyBox
	 *
	 * @return void
	 */
	public function fancyBoxAction()
	{
	    if ($this->settings['extended']['enable']) {
	        $this->listExtendedAction();
	    } else {
	        $this->listAction();
	    }
	}
	
	/**
	 * action GalleryView
	 *
	 * @return void
	 */
	public function galleryviewAction()
	{
	    if ($this->settings['extended']['enable']) {
	        $this->listExtendedAction();
	    } else {
	        $this->listAction();
	    }
	}

	/**
	 * action Innerfade
	 *
	 * @return void
	 */
	public function innerfadeAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action FlexSlider 2
	 *
	 * @return void
	 */
	public function flexslider2Action()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action Lightslider
	 *
	 * @return void
	 */
	public function lightsliderAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action Fullwidth
	 *
	 * @return void
	 */
	public function fullwidthAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action Responsive carousel
	 * 
	 * @return void
	 */
	public function responsiveAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action Responsive carousel (2)
	 *
	 * @return void
	 */
	public function responsiveCarouselAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action OWL carousel 2
	 *
	 * @return void
	 */
	public function owl2Action()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action Bootstrap+Isotope
	 *
	 * @return void
	 */
	public function isotopeAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action Stellar Parallax
	 *
	 * @return void
	 */
	public function parallaxAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action FractionSlider
	 *
	 * @return void
	 */
	public function fractionSliderAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action SDKSlider
	 *
	 * @return void
	 */
	public function skdsliderAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action slick
	 *
	 * @return void
	 */
	public function slickAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action test
	 *
	 * @return void
	 */
	public function testAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action Map
	 *
	 * @return void
	 */
	public function mapAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action OpenStreetMap
	 *
	 * @return void
	 */
	public function openstreetmapAction()
	{
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action one random uncached element
	 *
	 * @return void
	 */
	public function randomAction()
	{
		$contents = $this->contentRepository->findRandom();
		
		$this->view->assign('fal', 1);
		$this->view->assign('contents', $contents);
	}
	
	/**
	 * action new
	 *
	 * @param \Quizpalme\Camaliga\Domain\Model\Content $content
	 * @param int $error	Error-Code
	 * @return void
	 */
	public function newAction(\Quizpalme\Camaliga\Domain\Model\Content $content = NULL, $error = 0)
	{
		if (!$content) {
			$content = $this->objectManager->get('Quizpalme\\Camaliga\\Domain\\Model\\Content');
		}
		// gets all categories, which we want
		$cats = $this->getCategoriesAndParents();
		
		$this->view->assign('error', $error);
		$this->view->assign('content', $content);
		$this->view->assign('categories', $cats);
	}
	
	/**
	 * action create
	 *
	 * @param \Quizpalme\Camaliga\Domain\Model\Content $content
	 * @return void
	 */
	public function createAction(\Quizpalme\Camaliga\Domain\Model\Content $content)
	{
	    $error = 0;
	    $debug = '';
	    $mediaFolder = $this->settings['img']['folderForNewEntries'];
	    if (!$content->getTitle()) {
	        $error = 1;
	    }
	    
	    if ($error >= 1) {
	        $this->redirect('new', NULL, NULL, ['content' => $content, 'error' => $error]);
	    } else {
	        $persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
	        //$content->setHidden(1);
	        if ($content->getUid() > 0) {
	            $this->contentRepository->update($content);
	        } else {
	            $this->contentRepository->add($content);
	            $persistenceManager->persistAll();
	        }
			$position = [];					// GPS-Koordinaten
			$categoryUids = [];				// was ausgewählt wurde
			$uid = $content->getUid();
			
	        if ($this->request->hasArgument('image')) {
	        	// Alte Lösungen für einen Bild-Upload:
	        	// https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Fal/UsingFal/ExamplesFileFolder.html
	        	// https://www.typo3tiger.de/blog/post/extbase-fal-filereference-im-controller-erzeugen.html
	        	// https://various.at/news/image-upload-mit-typo3
	        	// https://stackoverflow.com/questions/57828620/how-to-access-uploaded-files-in-frontend-in-the-controller-in-typo3
	        	// https://www.ophidia.net/typo3-8-filereference-aus-bild-erzeugen/
	            $uploadedFileData = $this->request->getArgument('image'); //$_FILES['image'];
	            if (substr($uploadedFileData['type'], 0, 5) == 'image') {
	    	        $storage = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->getDefaultStorage();
	    	        $delete1 = '';
	    	        $delete2 = '';
	    	        if ($this->settings['getLatLon']) {
						$position = $this->getLatLonOfImage($uploadedFileData['tmp_name']);
	    	        }
	    	        
	    	        # check if target folder exist or create it
	    	        if ($storage->hasFolder($mediaFolder)) {
	    	            $targetFolder = $storage->getFolder($mediaFolder);
	    	        } else {
	    	            $targetFolder = $storage->createFolder($mediaFolder);
	    	        }
	    	        
	    	        # add uploaded file
	    	        $imageFile = $targetFolder->addUploadedFile($uploadedFileData, \TYPO3\CMS\Core\Resource\DuplicationBehavior::RENAME);
	    	        $infos = $imageFile->getProperties();
					
	    	        if (($infos['width'] > $this->settings['img']['width']) || ($infos['height'] > $this->settings['img']['height'])) {
		    	        # resize uploaded image       //$image = $imageService->getImage($imgPath);
		    	        $imageService = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Service\\ImageService');
		    	        $processingInstructions = array(
		    	        	'maxWidth' => $this->settings['img']['width'],
		    	        	'maxHeight' => $this->settings['img']['height'],
		    	        );
		    	        $imageFileResized = $imageService->applyProcessingInstructions($imageFile, $processingInstructions);
		    	        $persistenceManager->persistAll();
	    	        	// aufräumen, geht hier aber noch nicht: $imageFile->delete(); und $imageFileResized->delete();
	    	        	$imageFileToUse = $imageFileResized->copyTo($targetFolder);
	    	        	$delete1 = $imageService->getImageUri($imageFile);
	    	        	$delete2 = $imageService->getImageUri($imageFileResized);
	    	        } else {
	    	        	$imageFileToUse = $imageFile;
	    	        }
	    	        
	    	        # create reference; but not all Options are used :-(
	    	        $resourceFactory = $this->objectManager->get('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');
	    	        $falFileReference = $resourceFactory->createFileReferenceObject(
	    	        	[
	    	        		'uid_local' => $imageFileToUse->getUid(),
	    	        		'uid_foreign' => $uid,
	    	        		'uid' => uniqid('NEW_'),
	    	        		'tablenames' => 'tx_camaliga_domain_model_content',
	    	        		'fieldname' => 'falimage',
	    	        		'table_local' => 'sys_file',
	    	        		'crop' => null,
	    	        	]
	    	        );
	    	        $imageFileReference = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Domain\\Model\\FileReference');
	    	        $imageFileReference->setOriginalResource($falFileReference);
	    	        
	    	        # set reference and position in Camaliga
	    	        $content->setFalimage($imageFileReference);
					if ($position['latitude']) {
						$content->setLatitude($position['latitude']);
						$content->setLongitude($position['longitude']);
					}
	    	        $this->contentRepository->update($content);
	    	        $persistenceManager->persistAll();
	    	        if ($content->getFalimage()) {
	    	        	// the FAL image is not set correct in sys_file_reference. We correct that...
	    	        	$falID = $content->getFalimage()->getUid();
	    	        	$content->repairFALreference($falID);
	    	        	if ($this->settings['debug']) {
	    	        		$debug .= 'Uploaded image: ' . $infos['identifier'] . "\n";
	    	        	}
	    	        }
	    	        if ($delete1) {
	    	        	$imageFile->delete();
	    	        	if ($this->settings['debug']) {
	    	        		$debug .= 'Deleting this image (1): ' . $delete1 . "\n";
	    	        	}
	    	        }
	    	        if ($delete2) {
	    	        	$imageFileResized->delete();
	    	        	if ($this->settings['debug']) {
	    	        		$debug .= 'Deleting this image (2): ' . $delete2 . "\n";
	    	        	}
	    	        }
	            }
	        }
	        
	        // Position mittels Ort bestimmen?
	        if ($this->settings['getLatLon'] && $this->settings['maps']['key'] && !$position['latitude']) {
	        	$contents = [];
	        	$contents[] = $content;
	        	$debug .= $this->getLatLon($contents);
	        }
	        
	        # Slug bilden! Achtung: uniqueInSite funktioniert hier nicht!
	        $fieldConfig = $GLOBALS['TCA']['tx_camaliga_domain_model_content']['columns']['slug']['config'];
	        $slugHelper = GeneralUtility::makeInstance(\TYPO3\CMS\Core\DataHandling\SlugHelper::class, 'tx_camaliga_domain_model_content', 'slug', $fieldConfig);
	        $connection = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getConnectionForTable('tx_camaliga_domain_model_content');
	        $queryBuilder = $connection->createQueryBuilder();
	        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction::class));
	        $statement = $queryBuilder->select('*')->from('tx_camaliga_domain_model_content')->where(
	        	$queryBuilder->expr()->eq('uid', $uid)
        	)->execute();
        	$record = $statement->fetch();
        	// Klappt nicht: $record = get_object_vars($content);
       		$slug = $slugHelper->generate($record, $content->getPid());
       		$content->setSlug($slug);
	        
       		# sorting setzen
       		$statement = $queryBuilder->select('sorting')->from('tx_camaliga_domain_model_content')->where(
       		    $queryBuilder->expr()->eq('pid', intval($content->getPid()))
       		)->orderBy('sorting', 'DESC')->setMaxResults(1)->execute();
       		$record = $statement->fetch();
       		$content->setSorting($record['sorting'] + 64);
       		
	        // Kategorien: get all categories, which we want
	        $cats = $this->getCategoriesAndParents();
	        // checke ausgewählte Kategorien
	        foreach ($cats as $uid => $row) {
	        	$selected = ($this->request->hasArgument('cat'.$uid)) ?	intval($this->request->getArgument('cat'.$uid)) : 0;
	        	$cats[$uid]['selected'] = $selected;
	        	if ($selected > 0) {
	        		$categoryUids[$selected] = 1;
	        	}
	        	if (count($row['childs'])>0) {
	        		foreach ($row['childs'] as $child_uid => $child) {
	        			$selected = ($this->request->hasArgument('cat'.$uid.'_'.$child_uid)) ?	intval($this->request->getArgument('cat'.$uid.'_'.$child_uid)) : 0;
	        			$cats[$uid]['childs'][$child_uid]['selected'] = $selected;
	        			if ($selected > 0) {
	        				$categoryUids[$selected] = 1;
	        			}
	        		}
	        	}
	        }
	        $categoryRepository = $this->objectManager->get('Quizpalme\\Camaliga\\Domain\\Repository\\CategoryRepository');
	        foreach ($categoryUids as $key => $value) {
	        	$category = $categoryRepository->findOneByUid($key);
	        	$content->addCategory($category);
	        }
	        
	        $this->contentRepository->update($content);
	        
	        // Anzeige
	        $this->view->assign('content', $content);
	        $this->view->assign('debug', $debug);
	        $this->view->assign('categories', $cats);
	        //$this->view->assign('data', $infos);
	    }
	}
	
	/**
	* Zufälliges sortieren der Ergebnisse
	* 
	* @return array 
	*/ 
	private function sortObjects($objects)
	{
	   /** 
	   * zuerst holen wir uns alle gewünschten Objekte, welche später in Fuid in zufälliger Reihenfolge ausgegeben werden sollen 
	   * und erstellen ein zusätzelichen Array, in welches mittels array_push() die UIDs der Objekte   geschrieben werden 
	  */
	  $uidArray = array();
	  foreach($objects as $object) { 
	    array_push($uidArray, $object->getUid()); 
	  } 
	   /** 
	   * shuffle verwürfelt den Inhalt das UID Arrays 
	   * außerdem erstellen wir ein neues Array, welches später von der Funktion zurückgegeben wird
	   */
	  shuffle($uidArray); 
	  $objectArray = array(); 
	  /** 
	  * für jeden Eintrag im UID Array gehen wir durch die vorhandenen Objekte 
	  * und wenn die aktuelle uid im Array = der Uid des aktuellen Objektes ist 
	  * wir das Objekt in das $objectArray geschrieben und zurückgegeben 
	  */ 
	  foreach ($uidArray as $uid) { 
	     foreach($objects as $object) { 
	      if($uid == $object->getUid()) { 
	       array_push($objectArray, $object); 
	      } 
	     } 
	  } 
	  return $objectArray; 
	}
	
	/**
	 * Latitude und Longitude zu einer Adresse ermitteln
	 * Lösung von hier: http://stackoverflow.com/questions/8633574/get-latitude-and-longitude-automatically-using-php-api
	 */
	private function getLatLon(&$objects)
	{
		/**
		 * prüfen, welche Objekte eine Adresse (mind. einen Ort), aber keine Position haben
		 */
	    //$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
	    $debug = '';
	    if (is_object($objects) || is_array($objects)) {
		  foreach($objects as $object) {
			if (($object->getLatitude() == 0) && ($object->getLongitude() == 0) && $object->getCity()) {
				$address = $object->getStreet();
				if ($object->getZip()) {
					$address .= ($address) ? ', ' . $object->getZip() : $object->getZip();
				}
				if ($object->getCity()) {
					$address .= ($address) ? ', ' . $object->getCity() : $object->getCity();
				}
				if ($object->getCountry()) {
					$address .= ($address) ? ', ' . $object->getCountry() : $object->getCountry();
				}
				$address = urlencode($address);
				$url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=' . $this->settings['maps']['key'];
				// get the json response
				$resp_json = file_get_contents($url);
				// decode the json
				$resp = json_decode($resp_json, true);
				// response status will be 'OK', if able to geocode given address
				if ($resp['status']=='OK'){
				    // get the important data
				    $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
				    $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
				    //$formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
				    if ($lati || $longi) {    // && $formatted_address){
				        $object->setLatitude($lati);
				        $object->setLongitude($longi);
				        $this->contentRepository->update($object);
				        //$persistenceManager->persistAll();
				        //echo "position berechnet: $lat, $long";
				    }
				    if ($this->settings['debug']) {
				        $debug .= 'geocode answer to address "' . $address . '": ' . $lati .' / ' . $longi . "\n"; //  . ' (' . $formatted_address.
				    }
				} elseif ($this->settings['debug']) {
				    $debug .= 'geocode response to address "' . $address . '": ' . $resp['status'] . "\n";
				}
			}
		  }
	   }
	   return $debug;
	}
	
	/**
	 * Latitude und Longitude von einem Bild ermitteln
	 * Lösung von hier: https://stackoverflow.com/questions/5449282/reading-geotag-data-from-image-in-php
	 * 
	 * @return array 
	 */
	private function getLatLonOfImage($fileName)
	{
		//get the EXIF all metadata from Images
		$result = [];
		$gps = [];
		$exif = exif_read_data($fileName);
		if(isset($exif["GPSLatitudeRef"])) {
			$LatM = 1;
			$LongM = 1;
			if($exif["GPSLatitudeRef"] == 'S') {
				$LatM = -1;
			}
			if($exif["GPSLongitudeRef"] == 'W') {
				$LongM = -1;
			}

			//get the GPS data
			$gps['LatDegree']=$exif["GPSLatitude"][0];
			$gps['LatMinute']=$exif["GPSLatitude"][1];
			$gps['LatgSeconds']=$exif["GPSLatitude"][2];
			$gps['LongDegree']=$exif["GPSLongitude"][0];
			$gps['LongMinute']=$exif["GPSLongitude"][1];
			$gps['LongSeconds']=$exif["GPSLongitude"][2];

			//convert strings to numbers
			foreach($gps as $key => $value){
				$pos = strpos($value, '/');
				if($pos !== false){
					$temp = explode('/',$value);
					$gps[$key] = $temp[0] / $temp[1];
				}
			}

			//calculate the decimal degree
			$result['latitude']  = $LatM * ($gps['LatDegree'] + ($gps['LatMinute'] / 60) + ($gps['LatgSeconds'] / 3600));
			$result['longitude'] = $LongM * ($gps['LongDegree'] + ($gps['LongMinute'] / 60) + ($gps['LongSeconds'] / 3600));
			$result['datetime']  = $exif["DateTime"];
		}
		return $result;
	}
	
	/**
	 * Kategorien und deren Kinder holen
	 * 
	 * @return array 
	 */
	private function getCategoriesAndParents()
	{
		$categoryRepository = $this->objectManager->get('Quizpalme\\Camaliga\\Domain\\Repository\\CategoryRepository');
		if ($this->settings['category']['storagePids']) {
			if ($this->settings['category']['storagePids'] == -1) {
				$catStoragePids = [];		// alle kategorien
			} else {
				$catStoragePids = explode(',', $this->settings['category']['storagePids']);		// category-folder
			}
		} else {
			$storagePidsArray = $this->contentRepository->getStoragePids();
			if (empty($storagePidsArray)) {
				// nix ausgewählt => aktuelle PID nehmen
				$storagePidsArray = array(intval($GLOBALS["TSFE"]->id));
			}
			$catStoragePids = $storagePidsArray;	// camaliga-folder(s)
		}
		$all_cats = $categoryRepository->getAllCats($this->settings['category']['sortBy'], $this->settings['category']['orderBy'], $catStoragePids);
		return $categoryRepository->getCategoriesAndParents($all_cats);
	}
}
?>