<?php
defined('TYPO3_MODE') or die();

/**
 * Registers a Backend Module
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'Quizpalme.Camaliga',
    'web',	 // Make module a submodule of 'web'
    'imports',	// Submodule key
    '',			// Position
    array(
        \Quizpalme\Camaliga\Controller\BackendController::class => 'index, thumb',
    ),
    array(
        'access' => 'user,group',
        'icon'   => 'EXT:camaliga/ext_icon.gif',
        'labels' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf',
    )
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_camaliga_domain_model_content', 'EXT:camaliga/Resources/Private/Language/locallang_csh_tx_camaliga_domain_model_content.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_camaliga_domain_model_content');
