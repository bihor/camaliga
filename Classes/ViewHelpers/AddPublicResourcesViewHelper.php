<?php
namespace Quizpalme\Camaliga\ViewHelpers;
/**
 * AddPublicResourcesViewHelper-ViewHelper from tx_news:
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 * 
 * {namespace cam=Quizpalme\Camaliga\ViewHelpers}
 * <cam:addPublicResources path="path/to/style.css"></cam:content>
 * A ViewHelper to include JS- and CSS-files
 *
 * @package camaliga
 */
class AddPublicResourcesViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * AddPublicResourcesViewHelper-ViewHelper
     * 
	 * @param string  $path 	Path to the CSS/JS file which should be included
	 * @param boolean $compress Define if file should be compressed
	 * @param boolean $footer 	Only JS files: Whether the file should be included in the footer
	 * @param boolean $library 	Whether the file should be included as a library
	 * @param boolean $addSlash	Add a slash at the beginning?
	 * @return void
     */
	public function render($path, $compress = FALSE, $footer = FALSE, $library = '', $addSlash = FALSE) {
		if(TYPO3_MODE === 'FE') {
			$path = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($path);
		}
		if ($path === '' || !file_exists($path)) {
			return;
		}
		$path = substr($path,strlen(PATH_site));
		$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
		if ($ext !== 'css' && $ext !== 'js') {
			return;
		}
		if (TYPO3_MODE === 'FE') {
			$pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
			// alt: $GLOBALS['TSFE']->getPageRenderer();
		} else {
			// wird noch nicht gebraucht
		//	$doc = $this->getDocInstance();
		//	$pageRenderer = $doc->getPageRenderer();
			return;
		}
		// KGB: am Anfang wird manchmal noch ein / benötigt!
		if ($addSlash && substr($path,0,1) != '/')
			$path = '/' . $path;
		// JS
		if ($ext === 'js') {
			if ($footer) {
				if ($library != '') {
					$pageRenderer->addJsFooterLibrary($library, $path, NULL, $compress);
				} else {
					$pageRenderer->addJsFooterFile($path, NULL, $compress);
				}
			} else {
				if ($library) {
					$pageRenderer->addJsLibrary($library, $path, NULL, $compress);
				} else {
					$pageRenderer->addJsFile($path, NULL, $compress);
				}
			}				

		// CSS
		} elseif ($ext === 'css') {
			if ($libray) {
				$pageRenderer->addCssLibrary($path, 'stylesheet', 'all', '', $compress);
			} else {
				$pageRenderer->addCssFile($path, 'stylesheet', 'all', '', $compress);
			}
		}
	}
}
?>
