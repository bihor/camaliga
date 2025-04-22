.. include:: /Includes.rst.txt


Extend the Camaliga tables
^^^^^^^^^^^^^^^^^^^^^^^^^^

- I need more fields! What can I do?

Thats not really hard. You can use the extension extension_builder for doing that.
Please read the chapter "Extending models or map to existing tables":

http://docs.typo3.org/typo3cms/extensions/extension_builder/Developer/ExtendingModels.html

Write this in the field "Extend existing model class"::

	\Quizpalme\Camaliga\Domain\Model\Content

Under "Properties" you can define all your fields you will need for Camaliga.

It does not matter which name you give to the database-table or your extension.

Save and not install the extension, because the result is not as expected.
I do not know what the extension_builder has done, but I know how you can fix this problem.
You will need to edit /Configuration/TCA/Overrides/tx_camaliga_domain_model_content.php of your new extension.
Remove everything in that file but not the lines like this ones::

	$tmp_camaliga_addon_columns = [

	    'lokal' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:camaliga_addon/Resources/Private/Language/locallang_db.xlf:tx_camaligaaddon_domain_model_zusatz.lokal',
	        'config' => [
	            'type' => 'input',
	            'size' => 30,
	            'eval' => 'trim'
	        ],
	    ],
	    'spielort' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:camaliga_addon/Resources/Private/Language/locallang_db.xlf:tx_camaligaaddon_domain_model_zusatz.spielort',
	        'config' => [
	            'type' => 'input',
	            'size' => 30,
	            'eval' => 'trim'
	        ],
	    ],

	];

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_camaliga_domain_model_content',$tmp_camaliga_addon_columns);

Replace "camaliga_addon" with the name of your extension. Now you need to add a linke tike this one::

  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_camaliga_domain_model_content', '--div--;LLL:EXT:camaliga_addon/Resources/Private/Language/locallang_db.xlf:tx_camaligaaddon_domain_model_zusatz,lokal, spielort');

Customise it and install the extension.

The best way: download my camaliga_addon (link at the bottom) extension and take a look into its code.
There you can see, how it works.

Now you need to configure Camaliga. Go to the Admin tools->Settings->Extension Configuration and click at Camaliga to configure the extension.
You had to add your new fields in the field 'Select this extended fields too (without comma, e.g. "custom4 custom5 custom6")'.
Use the space character to seperate your fields. Camaliga will make an array of that field and that fields will be selected then extra.
You could select protected fields too with this method (e.g. tstamp)...

Finally you can use your new fields in every Camaliga template file. You can use them like this::

	{content.extended.lokal}

Replace "lokal" with your new field name. Thats all.


- I want to change a field type! How can I do it?

You need an extension with the file "Configuration/TCA/Overrides/tx_camaliga_domain_model_content.php". There you can override the TCA.
Here an example::

	$GLOBALS['TCA']['tx_camaliga_domain_model_content']['columns']['shortdesc']['config']['rows'] = 6;



- Where can I find the extension camaliga_addon?

It's on my homepage: http://www.quizpalme.de/autor/typo3-extensions
