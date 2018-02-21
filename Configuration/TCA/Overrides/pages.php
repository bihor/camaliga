<?php
defined('TYPO3_MODE') or die();

// Override icon
$GLOBALS['TCA']['pages']['columns']['module']['config']['items'][] = [
    0 => 'Camaliga',
    1 => 'camaliga',
    2 => 'ext-camaliga-folder-icon'
];

$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-camaliga'] = 'ext-camaliga-folder-icon';