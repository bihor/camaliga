<?php
$configurationUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('camaliga');
$disableFurtherImages = (bool)$configurationUtility['disableFurtherImages'];
$disableAddress = (bool)$configurationUtility['disableAddress'];
$disableContact = (bool)$configurationUtility['disableContact'];
$disableCustom = (bool)$configurationUtility['disableCustom'];
$disableMother = (bool)$configurationUtility['disableMother'];
$slugField1 = $configurationUtility['slugField1'];
$slugField2 = $configurationUtility['slugField2'];

$pre = 'fal';
$slugFields = [];
if ($slugField1) {
	$fieldsArray = explode(' ', trim($slugField1));
	if (count($fieldsArray) > 1) {
		$slugField1a = [];
		foreach ($fieldsArray as $field) {
			$slugField1a[] = $field;
		}
	} else {
		$slugField1a = $slugField1;
	}
} else {
	$slugField1a = 'title';
}
$slugFields[] = $slugField1a;
if ($slugField2) {
	$fieldsArray = explode(' ', trim($slugField2));
	if (count($fieldsArray) > 1) {
		$slugField2a = [];
		foreach ($fieldsArray as $field) {
			$slugField2a[] = $field;
		}
	} else {
		$slugField2a = $slugField2;
	}
	$slugFields[] = $slugField2a;
}

$tcaArray = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'versioningWS' => true,
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
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
		'searchFields' => 'title,shortdesc,longdesc,street,zip,city,country,person,custom1',
		'iconfile' => 'EXT:camaliga/Resources/Public/Icons/tx_camaliga_domain_model_content.gif'
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, slug, shortdesc, longdesc, link, '.$pre.'image'),
	),
	'columns' => array(
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'default' => 0,
				'items' => [
					['', 0],
				],
				'foreign_table' => 'tx_camaliga_domain_model_content',
				'foreign_table_where' => 'AND {#tx_camaliga_domain_model_content}.{#pid}=###CURRENT_PID### AND {#tx_camaliga_domain_model_content}.{#sys_language_uid} IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
		't3ver_label' => [
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			],
		],
		'hidden' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'items' => [
					[
						0 => '',
						1 => '',
						'invertStateDisplay' => true
					]
				],
			],
		],
		'starttime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'endtime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
				'range' => [
					'upper' => mktime(0, 0, 0, 1, 1, 2038)
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
	    'tstamp' => [
	        'config' => [
	            'type' => 'passthrough',
	        ],
	    ],
	    'crdate' => [
	        'config' => [
	            'type' => 'passthrough',
	        ],
	    ],
	    'sorting' => [
	        'config' => [
	            'type' => 'passthrough',
	        ],
	    ],
		'title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			],
		],
		'slug' => [
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.slug',
			'config' => [
				'type' => 'slug',
				'generatorOptions' => [
					'fields' => $slugFields,
					'fieldSeparator' => '_',
					'prefixParentPageSlug' => false,
					'replacements' => [
						'/' => '',
						'[' => '',
						']' => '',
						'(' => '',
						')' => '',
					],
				],
				'fallbackCharacter' => '-',
				'eval' => 'uniqueInSite',
				'default' => ''
			]
		],
		'shortdesc' => [
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.shortdesc',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 3,
				'eval' => 'trim'
			],
		],
		'longdesc' => [
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.longdesc',
			'config' => [
				'type' => 'text',
				'enableRichtext' => true,
				'eval' => 'trim',
			],
		],
		'link' => [
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.link',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputLink',
			],
		],
		$pre.'image' => [
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image',
			'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types'
            ],
		],
        'categories' => [
            'config' => [
                'type' => 'category',
            ],
        ],
	),
);

if (!$disableFurtherImages) {
	$tcaArray['columns'][$pre.'image2'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image2',
		'config' => [
            'type' => 'file',
            'maxitems' => 1,
            'allowed' => 'common-image-types'
        ],
	);
	$tcaArray['columns'][$pre.'image3'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image3',
		'config' => [
            'type' => 'file',
            'maxitems' => 1,
            'allowed' => 'common-image-types'
        ],
	);
	$tcaArray['columns'][$pre.'image4'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image4',
		'config' => [
            'type' => 'file',
            'maxitems' => 1,
            'allowed' => 'common-image-types'
        ],
	);
	$tcaArray['columns'][$pre.'image5'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.image5',
		'config' => [
            'type' => 'file',
            'maxitems' => 1,
            'allowed' => 'common-image-types'
        ],
	);
	$tcaArray['types']['1']['showitem'] .=  ',falimage2,--linebreak--, falimage3,--linebreak--, falimage4,--linebreak--, falimage5';
}

if (!$disableAddress) {
	$tcaArray['columns']['street'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.street',
		'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['zip'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.zip',
		'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['city'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.city',
		'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['country'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.country',
		'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['latitude'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.latitude',
		'config' => array(
                'type' => 'input',
                'size' => 15,
                'eval' => 'trim,Quizpalme\\Camaliga\\Evaluation\\Double9Evaluation',
                'default' => '0.000000000'
        ),
	);
	$tcaArray['columns']['longitude'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.longitude',
		'config' => array(
                'type' => 'input',
                'size' => 15,
                'eval' => 'trim,Quizpalme\\Camaliga\\Evaluation\\Double9Evaluation',
                'default' => '0.000000000'
        ),
	);
	$tcaArray['types']['1']['showitem'] .= ',street,--linebreak--,zip, city,--linebreak--, country,--linebreak--, latitude, longitude';
}

if (!$disableContact) {
	$tcaArray['columns']['person'] = array(
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.person',
			'config' => array(
					'type' => 'input',
					'size' => 25,
					'eval' => 'trim'
			),
	);
	$tcaArray['columns']['phone'] = array(
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.phone',
			'config' => array(
					'type' => 'input',
					'size' => 25,
					'eval' => 'trim'
			),
	);
	$tcaArray['columns']['mobile'] = array(
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.mobile',
			'config' => array(
					'type' => 'input',
					'size' => 25,
					'eval' => 'trim'
			),
	);
	$tcaArray['columns']['email'] = array(
			'exclude' => true,
			'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.email',
			'config' => array(
					'type' => 'input',
					'size' => 30,
					'eval' => 'trim'
			),
	);
	$tcaArray['types']['1']['showitem'] .= ', person,--linebreak--,phone, mobile,--linebreak--, email';
}

if (!$disableCustom) {
	$tcaArray['columns']['custom1'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.custom1',
		'config' => array(
				'type' => 'input',
				'size' => 25,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['custom2'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.custom2',
		'config' => array(
				'type' => 'input',
				'size' => 25,
				'eval' => 'trim'
		),
	);
	$tcaArray['columns']['custom3'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.custom3',
		'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
		),
	);
	$tcaArray['types']['1']['showitem'] .= ',custom1, custom2, custom3';
}

if (!$disableMother) {
	$tcaArray['columns']['mother'] = array(
		'exclude' => true,
		'label' => 'LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.mother',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_camaliga_domain_model_content',
			'size' => '1',
			'maxitems' => '1',
			'minitems' => '0',
            'default' => 0
		),
	);
	$tcaArray['types']['1']['showitem'] .= ',mother';
}

$tcaArray['types']['1']['showitem'] .= ',--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime,--div--;LLL:EXT:camaliga/Resources/Private/Language/locallang_db.xlf:tx_camaliga_domain_model_content.categories, categories';

return $tcaArray;
