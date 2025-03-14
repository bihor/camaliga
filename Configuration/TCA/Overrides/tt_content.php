<?php
/**
 * Register plugins, flexform and remove unused fields
 */
foreach (['list', 'listextended', 'show', 'showextended', 'carousel', 'carouselseparated', 'new', 'map', 'search', 'openstreetmap', 'random', 'teaser', 'responsive', 'elegant', 'bootstrap', 'collapse', 'modal', 'tab', 'ekko', 'elastislide', 'fancybox', 'flexslider2', 'flipster', 'fullwidth', 'galleryview', 'innerfade', 'isotope', 'lightslider', 'magnific', 'nanogallery2', 'owl2', 'parallax', 'responsivecarousel', 'roundabout', 'sgallery', 'skdslider', 'slick'] as $plugin) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Camaliga',
        ucfirst($plugin),
        'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:template.' . $plugin,
        'ext-camaliga-wizard-icon',
        'Camaliga',
        'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:template.description'
    );

    $xml = 'pi1';
    switch ($plugin) {
        case 'teaser':
            $xml = 'teaser';
            break;
        case 'showextended':
        case 'show':
            $xml = 'show';
            break;
        case 'bootstrap':
            $xml = 'bootstrap';
            break;
        case 'modal':
            $xml = 'modal';
            break;
        case 'collapse':
            $xml = 'collapse';
            break;
        case 'ekko':
        case 'elastislide':
        case 'fancybox':
        case 'flexslider2':
        case 'flipster':
        case 'fullwidth':
        case 'galleryview':
        case 'innerfade':
        case 'isotope':
        case 'lightslider':
        case 'magnific':
        case 'nanogallery2':
        case 'owl2':
        case 'parallax':
        case 'elastislide':
        case 'responsivecarousel':
        case 'roundabout':
        case 'sgallery':
        case 'skdslider':
        case 'slick':
            $xml = 'more';
            break;
    }
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['camaliga_' . $plugin] = 'pi_flexform';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        'camaliga_' . $plugin,
        'FILE:EXT:camaliga/Configuration/FlexForms/flexform_' . $xml . '.xml'
    );
}
