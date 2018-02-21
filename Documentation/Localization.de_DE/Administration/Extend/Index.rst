

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


Camaliga-Tabellen erweitern
^^^^^^^^^^^^^^^^^^^^^^^^^^^

- Ich brauche mehr Felder! Was kann ich tun?

Das ist nicht sehr schwer. Am besten macht man das mit der Extension extension_builder.
Im Kapitel "Extending models or map to existing tables" wird beschrieben, wie das geht:

http://docs.typo3.org/typo3cms/extensions/extension_builder/Developer/ExtendingModels.html

Bei "Extend existing model class" muss man das hier eingeben::

	\quizpalme\Camaliga\Domain\Model\Content

Unter "Properties" fügt man dann die neuen Felder hinzu, die man mit Camaliga verwenden will.


Leider ist das Ergebnis der Extension nicht ganz brauchbar. Ich weiß nicht, was dabei raus kommt, aber es läuft nicht, wie es sollte.
Deshalb sollte man zum Schluss noch die /Configuration/TCA/Overrides/tx_camaliga_domain_model_content.php (ehemals ext_tables.php) bearbeiten.
Lösche dort alles und füge so was ein::

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

Dabei muss man "camaliga_addon" durch den Extension-Name austauschen und "custom4" durch dein neues Feld.
Tipp: dies ist ein Beispiel aus der Extension camaliga_addon. Unten findet man einen Link dazu.
Am besten downloaden und dort nachsehen, wie es geht.

Als nächstes muss noch Camaliga konfiguriert werden. Man muss nun Camaliga angeben, welche Felder es zusätzlich holen soll. Dazu geht man in den Erweiterungsmanager und klickt dort auf Camaliga um es zu konfigurieren. Füge deine neuen Felder nun unter 'Select this extended fields too (without comma, e.g. "custom4 custom5 custom6")' hinzu. Benutze das Space-Zeichen zum trennen der Felder. Theoretisch kann man so auch Felder holen, auf die man sonst keinen direkten Zugriff hat (z.B. tstamp)...

So, jetzt kannst du deine neuen Felder benutzen! Deine neuen Felder kannst du nun in jedem Template benutzen. So kannst du darauf zugreifen::

	{content.extended.custom4}

Dabei musst du noch "custom4" durch den Namen deines Feldes ersetzen. Das ist alles.


- Ich möchte nur einen bestehenden Feld-Typ ändern! Wie geht das?

Du brauchst eine Extension mit der Datei "Configuration/TCA/Overrides/tx_camaliga_domain_model_content.php". Dort kann man die TCA überschreiben.
Hier ein Beispiel::

	$GLOBALS['TCA']['tx_camaliga_domain_model_content']['columns']['shortdesc']['config']['rows'] = 6;

Man findet ein weiteres Beispiel in der Extension camaliga_addon. Dort wird aus einer Textarea ein RTE-Feld beim Feld Kurzbeschreibung.


- Wo finde ich die Extension camaliga_addon?

Auf meiner Homepage unter: http://www.quizpalme.de/autor/download/myquizpoll-addons.html
