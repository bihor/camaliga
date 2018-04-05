<?php

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Update class for the extension manager.
 *
 * @package TYPO3
 */
class ext_update {
	
	/**
	 * Array of flash messages (params) array[][status,title,message]
	 *
	 * @var array
	 */
	protected $messageArray = array();

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseConnection;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];
	}

	/**
	 * Main update function called by the extension manager.
	 *
	 * @return string
	 */
	public function main() {
		$this->processUpdates();
		return $this->generateOutput();
	}

	/**
	 * Called by the extension manager to determine if the update menu entry should by showed.
	 *
	 * @return bool
	 */
	public function access() {
		return TRUE;
	}

	/**
	 * The actual update function. Add your update task in here.
	 *
	 * @return void
	 */
	protected function processUpdates() {
		// The category relation needs to be updated when updating to Typo3 6.2
		$title = 'Update tx_camaliga_domain_model_content category-relation (changes in TYPO3 6.2.0)';

		// Update new record
		$update = array('fieldname' => 'categories');
		$this->databaseConnection->exec_UPDATEquery(
			'sys_category_record_mm',
			"tablenames='tx_camaliga_domain_model_content' AND fieldname=''",
			$update
		);

		$this->messageArray[] = array(FlashMessage::OK, $title, 'sys_category_record_mm has been updated!');
		

		// The switchableControllerActions changes in version 5.0.0
		$title = 'Update FlexForms (changes in camaliga 5.0.0)';
		
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;list;Content-&gt;show<', '>Content-&gt;list;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;listExtended;Content-&gt;showExtended<', '>Content-&gt;listExtended;Content-&gt;search;Content-&gt;showExtended<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;map<', '>Content-&gt;map;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;bootstrap<', '>Content-&gt;bootstrap;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;collapse<', '>Content-&gt;collapse;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;modal<', '>Content-&gt;modal;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;tab<', '>Content-&gt;tab;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;adGallery<', '>Content-&gt;adGallery;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;coolcarousel<', '>Content-&gt;coolcarousel;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;elastislide<', '>Content-&gt;elastislide;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;fancyBox<', '>Content-&gt;fancyBox;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;flexslider2<', '>Content-&gt;flexslider2;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;flipster<', '>Content-&gt;flipster;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;fullwidth<', '>Content-&gt;fullwidth;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;galleryview<', '>Content-&gt;galleryview;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;innerfade<', '>Content-&gt;innerfade;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;isotope<', '>Content-&gt;isotope;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;lightslider<', '>Content-&gt;lightslider;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;owl<', '>Content-&gt;owl;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;owl2<', '>Content-&gt;owl2;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;responsiveCarousel<', '>Content-&gt;responsiveCarousel;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;roundabout<', '>Content-&gt;roundabout;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;sgallery<', '>Content-&gt;sgallery;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;skdslider<', '>Content-&gt;skdslider;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;slick<', '>Content-&gt;slick;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE tt_content SET pi_flexform = replace(pi_flexform, '>Content-&gt;scrollable<', '>Content-&gt;scrollable;Content-&gt;search;Content-&gt;show<') WHERE list_type='camaliga_pi1'");
		
		$this->messageArray[] = array(FlashMessage::OK, $title, 'tt_content has been updated!');
		

		// The path to the templates changed in version 6.0.0
		$title = 'Update TypoScript (changes in camaliga 6.0.0)';
		
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE sys_template SET config = replace(config, 'plugin.tx_camaliga.view.partialRootPath =', 'plugin.tx_camaliga.view.partialRootPaths.1 =') WHERE 1=1");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE sys_template SET config = replace(config, 'plugin.tx_camaliga.view.templateRootPath =', 'plugin.tx_camaliga.view.templateRootPaths.1 =') WHERE 1=1");
		$GLOBALS['TYPO3_DB']->sql_query(
				"UPDATE sys_template SET config = replace(config, 'plugin.tx_camaliga.view.layoutRootPath =', 'plugin.tx_camaliga.view.layoutRootPaths.1 =') WHERE 1=1");
		
		$this->messageArray[] = array(FlashMessage::OK, $title, 'sys_template has been updated!');


		// The fieldname for fal images was wrong in version 8.0.0
		$title = 'Update image-FAL-relations (changes in camaliga 8.0.0)';
		
		$update = array('fieldname' => 'falimage');
		$this->databaseConnection->exec_UPDATEquery(
				'sys_file_reference',
				"fieldname='image' AND tablenames='tx_camaliga_domain_model_content'",
				$update
				);
		$update = array('fieldname' => 'falimage2');
		$this->databaseConnection->exec_UPDATEquery(
				'sys_file_reference',
				"fieldname='image2' AND tablenames='tx_camaliga_domain_model_content'",
				$update
				);
		$update = array('fieldname' => 'falimage3');
		$this->databaseConnection->exec_UPDATEquery(
				'sys_file_reference',
				"fieldname='image3' AND tablenames='tx_camaliga_domain_model_content'",
				$update
				);
		$update = array('fieldname' => 'falimage4');
		$this->databaseConnection->exec_UPDATEquery(
				'sys_file_reference',
				"fieldname='image4' AND tablenames='tx_camaliga_domain_model_content'",
				$update
				);
		$update = array('fieldname' => 'falimage5');
		$this->databaseConnection->exec_UPDATEquery(
				'sys_file_reference',
				"fieldname='image5' AND tablenames='tx_camaliga_domain_model_content'",
				$update
				);
		
		$this->messageArray[] = array(FlashMessage::OK, $title, 'sys_file_reference has been updated!');
	}

	/**
	 * Generates output by using flash messages
	 *
	 * @return string
	 */
	protected function generateOutput() {
		if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version()) < 8000000) {
			$output = '';
			foreach ($this->messageArray as $messageItem) {
				/** @var \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage */
				$flashMessage = GeneralUtility::makeInstance(
					'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
					$messageItem[2],
					$messageItem[1],
					$messageItem[0]);
				$output .= $flashMessage->render();
			}
			return $output;
		} else {
			$out = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Messaging\Renderer\BootstrapRenderer::class);
			$messages = [];
			foreach ($this->messageArray as $messageItem) {
				/** @var \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage */
				$flashMessage = GeneralUtility::makeInstance(
						FlashMessage::class,
						$messageItem[2],
						$messageItem[1],
						$messageItem[0]
						);
				$messages[] = $flashMessage;
			}
			return $out->render($messages);
		}
	}
}
?>