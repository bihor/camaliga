<?php
$configurationUtility = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
$disableFurtherImages = intval($configurationUtility['disableFurtherImages']);
$disableAddress = intval($configurationUtility['disableAddress']);
$disableContact = intval($configurationUtility['disableContact']);
$disableCustom = intval($configurationUtility['disableCustom']);
$disableMother = intval($configurationUtility['disableMother']);
$enableFal = intval($configurationUtility['enableFal']);
$pre = ($enableFal) ? 'fal' : '';

if ($enableFal) {
	$imgConfig1 = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'falimage',
			[
					'appearance' => [
							'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
					],
					'foreign_types' => [
							'0' => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							]
					],
					'maxitems' => 1
			],
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
	);
	$imgConfig2 = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'falimage2',
			[
					'appearance' => [
							'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
					],
					'foreign_types' => [
							'0' => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							]
					],
					'maxitems' => 1
			],
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
	);
	$imgConfig3 = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'falimage3',
			[
					'appearance' => [
							'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
					],
					'foreign_types' => [
							'0' => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							]
					],
					'maxitems' => 1
			],
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
	);
	$imgConfig4 = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'falimage4',
			[
					'appearance' => [
							'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
					],
					'foreign_types' => [
							'0' => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							]
					],
					'maxitems' => 1
			],
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
	);
	$imgConfig5 = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'falimage5',
			[
					'appearance' => [
							'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
					],
					'foreign_types' => [
							'0' => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
									'showitem' => '
		                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                --palette--;;filePalette'
							]
					],
					'maxitems' => 1
			],
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
	);
} else {
	$imgConfig1 = array(
			'type' => 'group',
			'internal_type' => 'file',
			'uploadfolder' => 'uploads/tx_camaliga',
			'show_thumbs' => 1,
			'size' => 1,
			'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
			'disallowed' => '',
			'minitems' => 0,
			'maxitems' => 1,
	);
	$imgConfig2 = $imgConfig1;
	$imgConfig3 = $imgConfig1;
	$imgConfig4 = $imgConfig1;
	$imgConfig5 = $imgConfig1;
}

$tcaArray = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
				'disabled' => 'hidden',
				'starttime' => 'starttime',
				'endtime' => 'endtime',
		),
		'searchFields' => 'title,shortdesc,longdesc,street,zip,city,country,person,custom1',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('camaliga') . 'Resources/Public/Icons/tx_camaliga_domain_model_content.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, shortdesc, longdesc, link, '.$pre.'image',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, shortdesc, longdesc;;;richtext:rte_transform[mode=ts_links], link, '.$pre.'image;;2'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'2' => array('showitem' => ''),
	),
	'columns' => array(
			'sys_language_uid' => array(
					'exclude' => 1,
					'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
					'config' => array(
							'type' => 'select',
							'renderType' => 'selectSingle',
							'special' => 'languages',
							'items' => array(
									array(
											'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
											-1,
											'flags-multiple'
									),
							),
							'default' => 0,
					)
			),
			'l10n_parent' => array(
					'displayCond' => 'FIELD:sys_language_uid:>:0',
					'exclude' => 1,
					'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
					'config' => array(
							'type' => 'select',
               				'renderType' => 'selectSingle',
							'items' => array(
									array('', 0),
							),
							'foreign_table' => 'tx_camaliga_domain_model_content',
							'foreign_table_where' => 'AND tx_camaliga_domain_model_content.pid=###CURRENT_PID### AND tx_camaliga_domain_model_content.sys_language_uid IN (-1,0)',
			                'showIconTable' => false
					),
			),
			'l10n_diffsource' => array(
					'config' => array(
							'type' => 'passthrough',
               				'default' => ''
					),
			),
			't3ver_label' => array(
					'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
					'config' => array(
							'type' => 'input',
							'size' => 30,
							'max' => 255,
					)
			),
			'hidden' => array(
					'exclude' => 1,
					'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
					'config' => array(
							'type' => 'check',
					),
			),
			'starttime' => array(
					'exclude' => 1,
					'l10n_mode' => 'mergeIfNotBlank',
					'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
					'config' => array(
							'type' => 'input',
							'size' => 13,
							'max' => 20,
							'eval' => 'datetime',
							'checkbox' => 0,
							'default' => 0,
							'range' => array(
									'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
							),
					),
			),
			'endtime' => array(
					'exclude' => 1,
					'l10n_mode' => 'mergeIfNotBlank',
					'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
					'config' => array(
							'type' => 'input',
							'size' => 13,
							'max' => 20,
							'eval' => 'datetime',
							'checkbox' => 0,
							'default' => 0,
							'range' => array(
									'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
							),
					),
			),
			'title' => array(
					'exclude' => 0,
					'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.title',
					'config' => array(
							'type' => 'input',
							'size' => 30,
							'eval' => 'trim,required'
					),
			),
			'shortdesc' => array(
					'exclude' => 0,
					'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.shortdesc',
					'config' => array(
							'type' => 'text',
							'cols' => 40,
							'rows' => 3,
							'eval' => 'trim'
					),
			),
			'longdesc' => array(
					'exclude' => 0,
					'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.longdesc',
					'config' => array(
							'type' => 'text',
							'cols' => 40,
							'rows' => 14,
							'eval' => 'trim',
        					'softref' => 'typolink_tag,url',
					),
					'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
			),
			'link' => array(
					'exclude' => 0,
					'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.link',
					'config' => array (
							'type'     => 'input',
							'size'     => '25',
							'max'      => '255',
							'checkbox' => '',
							'eval'     => 'trim',
							'wizards' => array(
									'link' => array(
											'type' => 'popup',
											'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
											'icon' => 'actions-wizard-link',
											'module' => array(
													'name' => 'wizard_element_browser',
													'urlParameters' => array(
															'mode' => 'wizard'
													)
											),
											'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
									)
							),
							'softref' => 'typolink'
					)
			),
			$pre.'image' => array(
					'exclude' => 0,
					'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image',
					'config' => $imgConfig1,
			),
	),
);

if (!$disableFurtherImages) {
	$tcaArray['columns'][$pre.'image2'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image2',
		'config' => $imgConfig2
	);
	if (!$enableFal)
		$tcaArray['columns']['caption2'] = array(
			'exclude' => 0,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.caption2',
			'config' => array(
					'type' => 'input',
					'size' => 30,
					'eval' => 'trim'
			),
		);
	$tcaArray['columns'][$pre.'image3'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image3',
		'config' => $imgConfig3
	);
	if (!$enableFal)
		$tcaArray['columns']['caption3'] = array(
			'exclude' => 0,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.caption3',
			'config' => array(
					'type' => 'input',
					'size' => 30,
					'eval' => 'trim'
			),
		);
	$tcaArray['columns'][$pre.'image4'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image4',
		'config' => $imgConfig4
	);
	if (!$enableFal)
		$tcaArray['columns']['caption4'] = array(
			'exclude' => 0,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.caption4',
			'config' => array(
					'type' => 'input',
					'size' => 30,
					'eval' => 'trim'
			),
		);
	$tcaArray['columns'][$pre.'image5'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image5',
		'config' => $imgConfig5
	);
	if (!$enableFal)
		$tcaArray['columns']['caption5'] = array(
			'exclude' => 0,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.caption5',
			'config' => array(
					'type' => 'input',
					'size' => 30,
					'eval' => 'trim'
			),
		);
	if ($enableFal) {
		$tcaArray['interface']['showRecordFieldList'] .= ', falimage2, falimage3, falimage4, falimage5';
		$tcaArray['palettes']['2']['showitem'] = 'falimage2,--linebreak--, falimage3,--linebreak--, falimage4,--linebreak--, falimage5';
	} else {
		$tcaArray['interface']['showRecordFieldList'] .= ', image2, caption2, image3, caption3, image4, caption4, image5, caption5';
		$tcaArray['palettes']['2']['showitem'] = 'image2, caption2,--linebreak--, image3, caption3,--linebreak--, image4, caption4,--linebreak--, image5, caption5';
	}
}

if (!$disableAddress) {
	$tcaArray['columns']['street'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.street',
		'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['zip'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.zip',
		'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['city'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.city',
		'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['country'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.country',
		'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['latitude'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.latitude',
		'config' => array(
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
                'max' => 30,
                'default' => '0.00000000000000'
        ),
	);
	$tcaArray['columns']['longitude'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.longitude',
		'config' => array(
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
                'max' => 30,
                'default' => '0.00000000000000'
        ),
	);
	$tcaArray['interface']['showRecordFieldList'] .= ', street, zip, city, country, latitude, longitude';
	$tcaArray['types']['1']['showitem'] .= ',street;;3';
	$tcaArray['palettes']['3'] = array('showitem' => 'zip, city,--linebreak--, country,--linebreak--, latitude, longitude');
}

if (!$disableContact) {
	$tcaArray['columns']['person'] = array(
			'exclude' => 0,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.person',
			'config' => array(
					'type' => 'input',
					'size' => 25,
					'eval' => 'trim'
			),
	);
	$tcaArray['columns']['phone'] = array(
			'exclude' => 0,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.phone',
			'config' => array(
					'type' => 'input',
					'size' => 25,
					'eval' => 'trim'
			),
	);
	$tcaArray['columns']['mobile'] = array(
			'exclude' => 0,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.mobile',
			'config' => array(
					'type' => 'input',
					'size' => 25,
					'eval' => 'trim'
			),
	);
	$tcaArray['columns']['email'] = array(
			'exclude' => 0,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.email',
			'config' => array(
					'type' => 'input',
					'size' => 30,
					'eval' => 'trim'
			),
	);
	$tcaArray['interface']['showRecordFieldList'] .= ', person, phone, mobile, email';
	$tcaArray['types']['1']['showitem'] .= ', person;;4';
	$tcaArray['palettes']['4'] = array('showitem' => 'phone, mobile,--linebreak--, email');
}

if (!$disableCustom) {
	$tcaArray['columns']['custom1'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.custom1',
		'config' => array(
				'type' => 'input',
				'size' => 25,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['custom2'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.custom2',
		'config' => array(
				'type' => 'input',
				'size' => 25,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['custom3'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.custom3',
		'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
		),
	);
	$tcaArray['interface']['showRecordFieldList'] .= ', custom1, custom2, custom3';
	$tcaArray['types']['1']['showitem'] .= ',custom1;;5';
	$tcaArray['palettes']['5'] = array('showitem' => 'custom2, custom3');
}

if (!$disableMother) {
	$tcaArray['columns']['mother'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.mother',
		'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_camaliga_domain_model_content',
				'size' => '1',
				'maxitems' => '1',
				'minitems' => '0',
				'show_thumbs' => '0',
				'wizards' => array(
						'suggest' => array(
								'type' => 'suggest',
						),
				),
		),
	);
	$tcaArray['interface']['showRecordFieldList'] .= ',mother';
	$tcaArray['types']['1']['showitem'] .= ',mother';
}

$tcaArray['types']['1']['showitem'] .= ',--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime';

return $tcaArray;
?>