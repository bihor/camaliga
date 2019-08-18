<?php
namespace Quizpalme\Camaliga\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
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
class ContentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
	public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
		//parent::injectConfigurationManager($configurationManager);
		$this->configurationManager = $configurationManager;

		/* $tsSettings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
			'Camaliga',
			'Pi1'
		); */
		$tsSettings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
		);
		for ($i=10; $i>0; $i--) {
			$this->templatePath = $tsSettings['plugin.']['tx_camaliga.']['view.']['templateRootPaths.'][$i];
			if ($this->templatePath) {
				break;
			}
		}
		/*if ($this->templatePath == 'EXT:camaliga/Resources/Private/Templates/')	// wird so nicht verdaut ;-(
		 $this->templatePath = 'typo3conf/ext/camaliga/Resources/Private/Templates/';*/
		$tsSettings = $tsSettings['plugin.']['tx_camaliga.']['settings.'];
		$originalSettings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS
		);
		/* \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($tsSettings); */ 
		
		// start override
		if (isset($tsSettings['overrideFlexformSettingsIfEmpty']) && $tsSettings['overrideFlexformSettingsIfEmpty']==1) {
			// if flexform setting is empty and value is available in TS
			foreach ($tsSettings as $key=>$value) {
				if ($key == 'img.' || $key == 'item.' || $key == 'extended.' || $key == 'bootstrap.') continue;
				if (!$originalSettings[$key] && isset($value))
					$originalSettings[$key] = $value;
			}
			if (is_array($tsSettings['img.']))
			foreach ($tsSettings['img.'] as $key=>$value) {
				if ((!$originalSettings['img'][$key] && $originalSettings['img'][$key]!=='0') && isset($value))
					$originalSettings['img'][$key] = $value;
			}
			if (is_array($tsSettings['item.']))
			foreach ($tsSettings['item.'] as $key=>$value) {
				if ((!$originalSettings['item'][$key] && $originalSettings['item'][$key]!=='0') && isset($value))
					$originalSettings['item'][$key] = $value;
			}
			if (is_array($tsSettings['more.']))
			foreach ($tsSettings['more.'] as $key=>$value) {
				if ((!$originalSettings['more'][$key] && $originalSettings['more'][$key]!=='0') && isset($value))
					$originalSettings['more'][$key] = $value;
			}
			if (is_array($tsSettings['extended.']))
			foreach ($tsSettings['extended.'] as $key=>$value) {
				if ((!$originalSettings['extended'][$key] && $originalSettings['extended'][$key]!=='0') && isset($value))
					$originalSettings['extended'][$key] = $value;
			}
			if (is_array($tsSettings['bootstrap.']))
			foreach ($tsSettings['bootstrap.'] as $key=>$value) {
				if ((!$originalSettings['bootstrap'][$key] && $originalSettings['bootstrap'][$key]!=='0') && isset($value))
					$originalSettings['bootstrap'][$key] = $value;
			}
			if (is_array($tsSettings['seo.']))
			foreach ($tsSettings['seo.'] as $key=>$value) {
				if ((!$originalSettings['seo'][$key] && $originalSettings['seo'][$key]!=='0') && isset($value))
					$originalSettings['seo'][$key] = $value;
			}
			if (is_array($tsSettings['maps.']))
			foreach ($tsSettings['maps.'] as $key=>$value) {
				if ((!$originalSettings['maps'][$key] && $originalSettings['maps'][$key]!=='0') && isset($value))
					$originalSettings['maps'][$key] = $value;
			}
		}
		$this->settings = $originalSettings;
	}
	
	/**
	 * Injects the content-Repository
	 * 
	 * @param \Quizpalme\Camaliga\Domain\Repository\ContentRepository $contentRepository
	 */ 
	public function injectContentRepository(\Quizpalme\Camaliga\Domain\Repository\ContentRepository $contentRepository) { 
		$this->contentRepository = $contentRepository; 
	}
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		if ($this->settings['extended']['enable'] == 1) {
			// extended-Version laden
			// $this->template = 'ListExtended';
			$this->listExtendedAction();
		} else {
			$storagePidsArray = $this->contentRepository->getStoragePids();
			$storagePidsComma = implode(',', $storagePidsArray);
			if (!$storagePidsComma) {		// nix ausgewählt => aktuelle PID nehmen
				$storagePidsComma = intval($GLOBALS["TSFE"]->id);
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
			
			if (count($categoryUids) > 0) {
				$normalCatMode = ($this->settings['normalCategoryMode'] == 'or') ? FALSE : TRUE;
				if ($this->settings['debug'])
					GeneralUtility::devLog('findByCategories("' . implode(",", $categoryUids) . '",,,0,' . $this->settings['sortBy'] . ',' . $this->settings['sortOrder'] . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ',' . $this->settings['normalCategoryMode'] . ',' . $this->settings['limit'] . ')', 'camaliga', 0);
				$contents = $this->contentRepository->findByCategories($categoryUids, '', '', 0, $this->settings['sortBy'], $this->settings['sortOrder'], $this->settings['onlyDistinct'], $storagePidsOnly, $normalCatMode, $this->settings['limit']);
			} else {
				if ($this->settings['debug'])
					GeneralUtility::devLog('findAll(' . $this->settings['sortBy'] . ',' . $this->settings['sortOrder'] . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ',' . $this->settings['limit'] . ')', 'camaliga', 0);
				$contents = $this->contentRepository->findAll($this->settings['sortBy'], $this->settings['sortOrder'], $this->settings['onlyDistinct'], $storagePidsOnly, $this->settings['limit']);
			}
			if ($this->settings['random']) $contents = $this->sortObjects($contents);
			if ($this->settings['getLatLon']) $this->getLatLon($contents);
			
			if ($this->settings['more']['setModulo']) {
				$i = 0;
				$j = 0;
				$mod = intval($this->settings['item']['items']);
				foreach ($contents as $content) {
					if (($i % $mod) == 0) { $j++; $content->setModuloBegin($j); }
					$i++;
					if ((($i % $mod) == 0) || ($i == $contents->count())) $content->setModuloEnd($j);
				}
			}
			
			$cobjData = $this->configurationManager->getContentObject();
			$configurationUtility = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
			$enableFal = intval($configurationUtility['enableFal']);
			
			$this->view->assign('fal', $enableFal);
			$this->view->assign('uid', $cobjData->data['uid']);
			$this->view->assign('pid', $GLOBALS["TSFE"]->id);
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
		}
	}
	
	/**
	 * action listExtended
	 *
	 * @return void
	 */
	public function listExtendedAction() {
		$this->settings['extended']['enable'] = 1;
		$search = false;	// search by user selection?
		$sortBy = ($this->request->hasArgument('sortBy')) ? $this->request->getArgument('sortBy') : $this->settings['sortBy'];
		$sortOrder = ($this->request->hasArgument('sortOrder')) ? $this->request->getArgument('sortOrder') : $this->settings['sortOrder'];
		$sword = ($this->request->hasArgument('sword')) ? $this->request->getArgument('sword') : '';
		$place = ($this->request->hasArgument('place')) ? $this->request->getArgument('place') : '';
		$radius = ($this->request->hasArgument('radius')) ? intval($this->request->getArgument('radius')) : 0;
		if ($this->request->hasArgument('content')) {
			$cUid = intval($this->request->getArgument('content'));
			if ($cUid > 0) $search = true;
		}

		$distanceArray = array();
		$categoryUids = array();
		/*
		$configurationUtility = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
		$catMode = intval($configurationUtility["categoryMode"]);
		//$catMode = intval($this->settings['categoryMode']);
		$languageAspect = GeneralUtility::makeInstance(Context::class)->getAspect('language');
		$lang = $languageAspect->getId();
		//$lang = intval($GLOBALS['TSFE']->config['config']['sys_language_uid']);
		$cat_lang = ($catMode) ? 0 : $lang;
		$tableName = 'tx_camaliga_domain_model_content';
		*/
		$start = ($this->request->hasArgument('start')) ? intval($this->request->getArgument('start')) : 1;
		$storagePidsArray = $this->contentRepository->getStoragePids();
		$storagePidsComma = implode(',', $storagePidsArray);
		$storagePidsData = array();
		$storagePidsOnly = array();
		
		if (count($storagePidsArray)>1) {
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
		} else if (!$storagePidsComma) {		// nix ausgewählt => aktuelle PID nehmen
			$storagePidsComma = intval($GLOBALS["TSFE"]->id);
			$storagePidsArray = array($storagePidsComma);
			$storagePidsOnly  = array($storagePidsComma);
		}
		if (count($storagePidsOnly)>0)
			$storagePidsOnlyComma = implode(',', $storagePidsOnly);
		else
			$storagePidsOnlyComma = $storagePidsComma;
			
		// Step 0: Categories
		$cats = [];
		// Step 1: get all categories
		//$categoriesUtility = GeneralUtility::makeInstance('Quizpalme\\Camaliga\\Utility\\AllCategories');
		$all_cats = []; //$categoriesUtility->getCategoriesarrayComplete();
		// gets all categories, which we want for the options
		$categoryRepository = $this->objectManager->get('Quizpalme\\Camaliga\\Domain\\Repository\\CategoryRepository');
		if ($this->settings['category']['storagePids']) {
			if ($this->settings['category']['storagePids'] == -1) {
				$catStoragePids = [];
			} else {
				$catStoragePids = explode(',', $this->settings['category']['storagePids']);
			}
		} else {
			$catStoragePids = $storagePidsArray;
		}
		$catRows = $categoryRepository->findAll($this->settings['category']['sortBy'], $this->settings['category']['orderBy'], $catStoragePids);
		// gets categories for this model??
		//$catRows = $myModel->getCategories();
		
		// Step 2: select categories, used by this extension AND used by this storagePids: needed for the category-restriction at the bottom
		//$catRows = $this->contentRepository->getRelevantCategories($storagePidsOnly);
		if ($catRows) {
			$parentUids = [];
			foreach ($catRows as $row) {
				// Die Parents sind für die Options sehr wichtig
				$parent = $row->getParent();
				if (!$parent) continue;
				$parentUids[$parent->getUid()] = 1;
			}
			for ($i=1; $i<=2; $i++) {
				foreach ($catRows as $row) {
					//$uid = $row['uid_local'];
					$uid = $row->getUid();
					if (($i==1 && $parentUids[$uid]==1) || ($i==2 && !$parentUids[$uid])) {
						$parent = $row->getParent();
						if (!$parent) continue;
						$all_cats[$uid] = [];
						$all_cats[$uid]['uid'] = $uid;
						$all_cats[$uid]['parent'] = $parent->getUid();
						$all_cats[$uid]['title']  = $row->getTitle();
						$all_cats[$uid]['description'] = $row->getDescription();
						
						//if (!$all_cats[$uid]['parent']) continue;
						$parent = $all_cats[$uid]['parent'];
						if (!is_array($cats[$parent])) {
							$selected = ($this->request->hasArgument('cat'.$parent)) ?
								  intval($this->request->getArgument('cat'.$parent)) : 0;
							if ($selected > 0) {
								$categoryUids[$selected] = $selected;
								$search = TRUE;
							}
							$cats[$parent] = [];
							$cats[$parent]['childs'] = [];
							$cats[$parent]['selected'] = $selected;
							$cats[$parent]['title'] = $all_cats[$parent]['title'];
							$cats[$parent]['description'] = $all_cats[$parent]['description'];
						}
						$selected = ($this->request->hasArgument('cat'.$parent.'_'.$uid)) ?
							  intval($this->request->getArgument('cat'.$parent.'_'.$uid)) : 0;
						if ($selected > 0) {
							$categoryUids[$parent] = ($categoryUids[$parent]) ? $categoryUids[$parent].",$selected" : $selected;
							$search = TRUE;
						}
						if ($all_cats[$uid]['title']) {
							$cats[$parent]['childs'][$uid] = array();
							$cats[$parent]['childs'][$uid]['selected'] = $selected;
							$cats[$parent]['childs'][$uid]['title'] = $all_cats[$uid]['title'];
						}
					}
				}
			}
		}
		
		// es wurde gesucht
		if ($this->request->hasArgument('search')) $search = TRUE;
		
		$cobjData = $this->configurationManager->getContentObject();
		$content_uid = $cobjData->data['uid'];
		
		if ($search && $this->settings['extended']['saveSearch'] == 1) {
			// Suchparameter in Cookie speichern
			$searchCookie = array();
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
				if (count($storagePidsOnly)>0)
					$storagePidsOnlyComma = implode(',', $storagePidsOnly);
				else
					$storagePidsOnlyComma = $storagePidsComma;
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
					$categoryUids[$parent] = ($categoryUids[$parent]) ? $categoryUids[$parent].",$selected" : $selected;
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
				if ($this->settings['debug'])
					GeneralUtility::devLog('findByUids(array(' . $cUid . '))', 'camaliga', 0);
				$contents = $this->contentRepository->findByUids(array($cUid));
			} else if (count($categoryUids) > 0) {
				// Umfangreiche Suche betreiben
				// official solution (not enough): http://wiki.typo3.org/TYPO3_6.0#Category
				// Sort categories (doesnt work): http://www.php-kurs.com/arrays-mehrdimensional.htm 
				// find entries by category
				// enable dev logging if set
				if ($this->settings['debug'])
					GeneralUtility::devLog('findByCategories("' . implode(",", $categoryUids) . '",' . $sword . ',' . $place . ',' . $radius . ',' . $sortBy . ',' . $sortOrder . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ', TRUE' . ',' . $this->settings['limit'] . ')', 'camaliga', 0);
				$contents = $this->contentRepository->findByCategories($categoryUids, $sword, $place, $radius, $sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly, TRUE,  $this->settings['limit']);
			} else if ($sword || $place) {
				// Komplexe Suche, aber ohne Kategorien
				if ($this->settings['debug'])
					GeneralUtility::devLog('findComplex( ,' . $sword . ',' . $place . ',' . $radius . ',' . $sortBy . ',' . $sortOrder . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ',' . $this->settings['limit'] . ')', 'camaliga', 0);
				$contents = $this->contentRepository->findComplex(array(), $sword, $place, $radius, $sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly, $this->settings['limit']);
			} else {
				// Simple Suche
				if ($this->settings['debug'])
					GeneralUtility::devLog('findAll(' . $sortBy . ',' . $sortOrder . ',' . $this->settings['onlyDistinct'] . ',' . implode(',', $storagePidsOnly) . ',' . $this->settings['limit'] . ')', 'camaliga', 0);
				$contents = $this->contentRepository->findAll($sortBy, $sortOrder, $this->settings['onlyDistinct'], $storagePidsOnly, $this->settings['limit']);
			}
			if ($place)	$distanceArray = $this->contentRepository->getDistanceArray();	// Distanz-Array vorhanden?
			if ($this->settings['random']) $contents = $this->sortObjects($contents);	// zufällig umsortieren?
			if ($this->settings['getLatLon']) $this->getLatLon($contents);	// Position suchen? Bringt nach einer Umkreissuche freilich nichts!
			$this->view->assign('onlySearchForm', 0);
		}

		if ($this->settings['more']['setModulo']) {
			$i = 0;
			$j = 0;
			$mod = intval($this->settings['item']['items']);
			foreach ($contents as $content) {
				if (($i % $mod) == 0) { $j++; $content->setModuloBegin($j); }
				$i++;
				if ((($i % $mod) == 0) || ($i == $contents->count())) $content->setModuloEnd($j);
			}
		}
				
		$configurationUtility = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
		$enableFal = intval($configurationUtility['enableFal']);
			
		$this->view->assign('fal', $enableFal);
		$this->view->assign('lang', $cobjData->data['sys_language_uid']);
		$this->view->assign('uid', $content_uid);
		$this->view->assign('pid', $GLOBALS["TSFE"]->id);
		$this->view->assign('contents', $contents);
		$this->view->assign('sortBy_selected', $sortBy);
		$this->view->assign('sortOrder_selected', $sortOrder);
		$this->view->assign('all_categories', $all_cats);
		$this->view->assign('all_cats2', $catRows);
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
	}

	/**
	 * action search
	 *
	 * @return void
	 */
	public function searchAction() {
		$template = ($this->request->hasArgument('template')) ? $this->request->getArgument('template') : '';
		if ($template)
			$this->view->setTemplatePathAndFilename($this->templatePath . 'Content/' . $template . '.html');
		$this->listExtendedAction();
	}
	

	/**
	 * set SEO head?
	 *
	 * @param \Quizpalme\Camaliga\Domain\Model\Content $content
	 * @param integer $enableFal
	 * @return void
	 */
	protected function setSeo(\Quizpalme\Camaliga\Domain\Model\Content $content, $enableFal) {
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
			if ($enableFal) {
				if ($content->getFalimage() && $content->getFalimage()->getUid()) {
					$typo3FALRepository = $this->objectManager->get("TYPO3\\CMS\\Core\\Resource\\FileRepository");
					$fileObject = $typo3FALRepository->findFileReferenceByUid($content->getFalimage()->getUid());
					$fileObjectData = $fileObject->toArray();
					$image = $server . '/' . $fileObjectData['url'];
				}
			} else {
				if ($content->getImage()) {
					$image = $server . '/uploads/tx_camaliga/' . $content->getImage();
				}
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
	public function showAction(\Quizpalme\Camaliga\Domain\Model\Content $content) {
		if ($this->settings['extended']['enable'] == 1) {
			// extended-Version laden
			// $this->view->setTemplatePathAndFilename($this->templatePath . 'Content/ShowExtended.html');
			$this->showExtendedAction($content);
		} else {
			$configurationUtility = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
			$enableFal = intval($configurationUtility['enableFal']);
			$this->setSeo($content, $enableFal);
				
			$this->view->assign('fal', $enableFal);
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
	public function showExtendedAction(\Quizpalme\Camaliga\Domain\Model\Content $content) {
		$configurationUtility = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
		$enableFal = intval($configurationUtility['enableFal']);
		$this->setSeo($content, $enableFal);
			
		$this->view->assign('fal', $enableFal);
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
	public function carouselAction() {
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
	public function carouselSeparatedAction() {
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}
	
	/**
	 * action scrollable
	 *
	 * @return void
	 */
	public function scrollableAction() {
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
	public function roundaboutAction() {
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
	public function flipsterAction() {
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
	public function bootstrapAction() {
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
	public function collapseAction() {
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
	public function modalAction() {
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
	public function tabAction() {
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
	public function sgalleryAction() {
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
	public function adGalleryAction() {
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
	public function coolcarouselAction() {
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
	public function ekkoAction() {
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
	public function elastislideAction() {
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
	public function elegantAction() {
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
	public function fancyBoxAction() {
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
	public function galleryviewAction() {
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
	public function innerfadeAction() {
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
	public function flexslider2Action() {
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
	public function lightsliderAction() {
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
	public function fullwidthAction() {
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
	public function responsiveAction() {
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
	public function responsiveCarouselAction() {
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
	public function owl2Action() {
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
	public function isotopeAction() {
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
	public function parallaxAction() {
		if ($this->settings['extended']['enable']) {
			$this->listExtendedAction();
		} else {
			$this->listAction();
		}
	}

	/**
	 * action Revolution Slider
	 *
	 * @return void
	 */
	public function revolutionAction() {
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
	public function fractionSliderAction() {
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
	public function skdsliderAction() {
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
	public function slickAction() {
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
	public function testAction() {
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
	public function mapAction() {
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
	public function openstreetmapAction() {
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
	public function randomAction() {
		$contents = $this->contentRepository->findRandom();
		$configurationUtility = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
		$enableFal = intval($configurationUtility['enableFal']);
			
		$this->view->assign('fal', $enableFal);
		$this->view->assign('contents', $contents);
	}

	/**
	* Zufälliges sortieren der Ergebnisse
	* 
	* @return array 
	*/ 
	private function sortObjects($objects) {
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
	private function getLatLon(&$objects) {
		//$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		/**
		 * prüfen, welche Objekte eine Adresse (mind. einen Ort), aber keine Position haben
		 */
	    if (is_object($objects) || is_array($objects)) {
		  foreach($objects as $object) {
			if ($object->getLatitude() == 0 && $object->getLongitude() == 0 && $object->getCity()) {
				$address = $object->getStreet();
				if ($object->getZip()) $address .= ($address) ? ', ' . $object->getZip() : $object->getZip();
				if ($object->getCity()) $address .= ($address) ? ', ' . $object->getCity() : $object->getCity();
				if ($object->getCountry()) $address .= ($address) ? ', ' . $object->getCountry() : $object->getCountry();
				$address = urlencode($address);
				$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=" . $this->settings['maps']['key'];
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
				curl_close($ch);
				if ($this->settings['debug'])
				    GeneralUtility::devLog('geocode response to address "' . $address . '": ' . $response, 'camaliga', 0);
				$response_a = json_decode($response);
				$lat = $response_a->results[0]->geometry->location->lat;
				$long = $response_a->results[0]->geometry->location->lng;
				if ($lat || $long) {
					$object->setLatitude($lat);
					$object->setLongitude($long);
					$this->contentRepository->update($object);
					//$persistenceManager->persistAll();
					//echo "position berechnet: $lat, $long";
				}
			}
		  }
	   }
	}
}
?>