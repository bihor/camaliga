

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Extend the Camaliga tables
^^^^^^^^^^^^^^^^^^^^^^^^^^

- I need more fields! What can I do?

Thats not really hard. You can use the extension extension_builder for doing that.
Please read the chapter "Extending models or map to existing tables":

http://docs.typo3.org/typo3cms/extensions/extension_builder/Developer/ExtendingModels.html

Write this in the field "Extend existing model class"::

	\quizpalme\Camaliga\Domain\Model\Content

Under "Properties" you can define all your fields you will need for Camaliga.


Save and install the extension. You will see, that you will not see your new fields.
I do not know what the extension_builder has done, but I know how you can fix this problem.
You will need to edit /Configuration/TCA/Overrides/tx_camaliga_domain_model_content.php (former ext_tables.php) of your new extension.
Remove everything in that file and add something like this::

	$tmp_camaliga_addon_columns = array(
	  'custom4' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:camaliga_addon/Resources/Private/Language/locallang_db.xlf:tx_camaligaaddon_domain_model_content.custom4',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	  ),
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_camaliga_domain_model_content',$tmp_camaliga_addon_columns, 1);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_camaliga_domain_model_content', '--div--;Meine Felder, custom4');

Replace "camaliga_addon" with the name of your extension and replace "custom4" with your new field.

The best way: download my camaliga_addon (link at the bottom) extension and take a look into its code.
There you can see, how it works.

Now you need to configure Camaliga. Go to the extension manager and click at Camaliga to configure the extension. You had to add your new fields in the field 'Select this extended fields too (without comma, e.g. "custom4 custom5 custom6")'. Use the space character to seperate your fields. Camaliga will make an array of that field and that fields will be selected then extra. You could select protected fields too with this method (e.g. tstamp)...

Finally you can use your new fields in every Camaliga template file. You can use them like this::

	{content.extended.custom4}

Replace "custom4" with your new field name. Thats all.


- I want to change a field type! How can I do it?

You need an extension with the file "Configuration/TCA/Overrides/tx_camaliga_domain_model_content.php". There you can override the TCA.
Here an example::

	$GLOBALS['TCA']['tx_camaliga_domain_model_content']['columns']['shortdesc']['config']['rows'] = 6;

You find another example im my extension camaliga_addon. The extension changes the field shortdesc into an RTE field.


- Where can I find the extension camaliga_addon?

It's on my homepage: http://www.quizpalme.de/autor/download/myquizpoll-addons.html
