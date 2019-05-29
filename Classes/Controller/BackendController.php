<?php
namespace Quizpalme\Camaliga\Controller;

use TYPO3\CMS\Extbase\Annotation as Extbase;

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
	 * @Extbase\Inject
	 * @var \Quizpalme\Camaliga\Domain\Repository\ContentRepository
	 */
	protected $contentRepository;
	
	/**
	 * Zähler
	 *
	 * @var integer
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
}
?>
