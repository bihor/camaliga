<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
	function()
	{
	
		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
			'Quizpalme.Camaliga',
			'Pi1',
			[
				'Content' => 'list, listExtended, show, showExtended, random, search, teaser, carousel, carouselSeparated, elegant, responsiveCarousel, responsive, map, openstreetmap, coolcarousel, ekko, lightslider, magnific, sgallery, skdslider, roundabout, flipster, flexslider2, fullwidth, galleryview, fancyBox, elastislide, innerfade, bootstrap, collapse, modal, tab, adGallery, owl2, isotope, slick, parallax, fractionSlider, new, create',
			],
			[
				'Content' => 'random, search, new, create',
			]
		);
		
		// wizards
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:camaliga/Configuration/TSconfig/ContentElementWizard.txt">');
		
		// Add page TSConfig für den Linkvalidator
		if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('linkvalidator')) {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:camaliga/Configuration/TSconfig/Page/mod.linkvalidator.txt">');
		}
		
		/** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		$iconRegistry->registerIcon(
			'ext-camaliga-wizard-icon',
			\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
			['source' => 'EXT:camaliga/Resources/Public/Icons/ce_wiz.gif']
		);
		$iconRegistry->registerIcon(
			'ext-camaliga-folder-icon',
			\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
			['source' => 'EXT:camaliga/Resources/Public/Icons/ext_icon_camaliga_folder.gif']
		);
	}
);


// Hooks for ke_search
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('ke_search')) {
	// register custom indexer hook
	// adjust this to your namespace and class name
	// adjust the autoloading information in composer.json, too!
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] = \Quizpalme\Camaliga\Hooks\KeSearchIndexer::class;
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][] = \Quizpalme\Camaliga\Hooks\KeSearchIndexer::class;
}

// Page module hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['camaliga_pi1']['camaliga'] =
\Quizpalme\Camaliga\Hooks\PageLayoutView::class . '->getExtensionSummary';

if (TYPO3_MODE === 'BE') {
	// Page module hook - show flexform settings in page module: geht so aber nicht!
	//$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
	//$pluginSignature = strtolower($extensionName) . '_pi';
	//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info'][$pluginSignature][$_EXTKEY] =
	//	\Quizpalme\Camaliga\Hooks\PageLayoutView::class . '->getExtensionSummary';
	
	// Add CSV-export task (sheduler)
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Quizpalme\\Camaliga\\Task\\CsvExportTask'] = array(
			'extension' => 'camaliga',
			'title' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.title',
			'description' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.description',
			'additionalFields' => 'Quizpalme\\Camaliga\\Task\\CsvExportAdditionalFieldProvider'
	);
	
	// Add CSV-import task (sheduler)
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Quizpalme\\Camaliga\\Task\\CsvImportTask'] = array(
		'extension' => 'camaliga',
			'title' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:itasks.title',
			'description' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:itasks.description',
			'additionalFields' => 'Quizpalme\\Camaliga\\Task\\CsvImportAdditionalFieldProvider'
	);
	
	// Add Slug-builder task (sheduler)
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Quizpalme\\Camaliga\\Task\\BuildSlugTask'] = array(
		'extension' => 'camaliga',
		'title' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:slugtasks.title',
		'description' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:slugtasks.description'
	);
	
	// TCA-Validator
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['Quizpalme\\Camaliga\\Evaluation\\Double9Evaluation'] = '';
}
