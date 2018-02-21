<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Camaliga: carousel/map/list/gallery',
    'EXT:camaliga/ext_icon.gif'
);

if (TYPO3_MODE === 'BE') {
	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Quizpalme.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'imports',	// Submodule key
		'',			// Position
		array(
			'Backend' => 'index, thumb, thumb7, import, importNews',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf',
		)
	);
}

// Add static file...
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Camaliga (carousel/map/list/gallery)');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_camaliga_domain_model_content', 'EXT:camaliga/Resources/Private/Language/locallang_csh_tx_camaliga_domain_model_content.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_camaliga_domain_model_content');

// Kategorien. Mehr Infos dazu hier: http://wiki.typo3.org/TYPO3_6.0#Category und https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Categories/Index.html
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    $_EXTKEY,
    'tx_camaliga_domain_model_content',
    'categories'
);

// Folder icon
// $TCA['pages']['ctrl']['typeicon_classes']['contains-camaliga'] = 'ext-camaliga-folder-icon';
// \TYPO3\CMS\Backend\Sprite\SpriteManager::addTcaTypeIcon('pages', 'contains-camaliga', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY).'ext_icon_camaliga_folder.gif');
?>