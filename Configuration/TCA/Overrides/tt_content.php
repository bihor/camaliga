<?php
// Einbindung Flexform 
$pluginSignature = 'camaliga_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue( $pluginSignature, 'FILE:EXT:camaliga/Configuration/FlexForms/flexform_pi1.xml' );

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		'camaliga',
		'Pi1',
		'Camaliga: carousel/map/list/gallery',
		'EXT:camaliga/ext_icon.gif'
);
?>