<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Quizpalme.' . $_EXTKEY,
	'Pi1',
	array(
		'Content' => 'list, listExtended, show, showExtended, random, search, carousel, carouselSeparated, responsiveCarousel, coolcarousel, ekko, lightslider, sgallery, skdslider, scrollable, roundabout, flipster, flexslider2, fullwidth, galleryview, fancyBox, elastislide, innerfade, bootstrap, collapse, modal, tab, adGallery, owl2, isotope, slick, parallax, revolution, fractionSlider, responsive, map, openstreetmap',
	),
	array(
		'Content' => 'random, search',
	)
);

// Hooks for ke_search
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('ke_search')) {
	// register custom indexer hook
	// adjust this to your namespace and class name
	// adjust the autoloading information in composer.json, too!
	$customIndexerClassName = 'Quizpalme\Camaliga\Hooks\KeSearchIndexer';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] = $customIndexerClassName;
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][] = $customIndexerClassName;
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:camaliga/Configuration/TSconfig/ContentElementWizard.txt">');

// Add page TSConfig für den Linkvalidator
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('linkvalidator')) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:camaliga/Configuration/TSconfig/Page/mod.linkvalidator.txt">');
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
			'extension' => $_EXTKEY,
			'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:tasks.title',
			'description' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:tasks.description',
			'additionalFields' => 'Quizpalme\\Camaliga\\Task\\CsvExportAdditionalFieldProvider'
	);
	
	// Add CSV-import task (sheduler)
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Quizpalme\\Camaliga\\Task\\CsvImportTask'] = array(
			'extension' => $_EXTKEY,
			'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:itasks.title',
			'description' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:itasks.description',
			'additionalFields' => 'Quizpalme\\Camaliga\\Task\\CsvImportAdditionalFieldProvider'
	);

	// Add uploads/ to FAL task (sheduler)
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Quizpalme\\Camaliga\\Task\\MoveUploadsToFalTask'] = array(
			'extension' => $_EXTKEY,
			'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:faltasks.title',
			'description' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:faltasks.description',
			'additionalFields' => 'Quizpalme\\Camaliga\\Task\\MoveUploadsToFalFieldProvider'
	);
	
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
?>