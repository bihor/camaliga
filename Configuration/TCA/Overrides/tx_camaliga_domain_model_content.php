<?php
// Kategorien. Mehr Infos dazu hier:
// http://wiki.typo3.org/TYPO3_6.0#Category und https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Categories/Index.html
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
		'camaliga',
		'tx_camaliga_domain_model_content',
		'categories'
);
?>