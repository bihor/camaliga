.. include:: /Includes.rst.txt

Benutzerhandbuch
----------------

- Als erstes sollte man das statische TypoScript hinzufügen: Template →
  Info/Bearbeiten → Enthält → Statische Templates einschließen (aus Erweiterungen) → Camaliga.

- Dann sollte man sich überlegen, welche Felder man braucht und wie die Bilder verwaltet werden sollen.
  Lies das Kapitel Administration → Konfiguration via Extension-Manager. Das ist sehr wichtig für Admins,
  da spätere Änderungen ggf. schwierig werden können. Lies auch das Kapitel Administration → Scheduler-Tasks
  falls du ein Admin bist.

- Erzeuge nun einen Ordner für die neuen Elemente und wechsele zu diesem
  Ordner und in die Listen-Ansicht. Man kann Camaliga-Elemente aber auch auf normanel Seiten anlegen.
  Lege ein paar neue Elemente an:

.. figure:: /Images/camaliga_element.png

   *Abbildung 5: Lege neue Elemente an*

- Es gibt verschiedene Felder. Nur der Titel ist ein Pflichtfeld. Wenn
  fertig, lege ein neues Plugin auf einer Seite an und wähle dabei das
  Camaliga-Plug-In aus. Man wird jede Menge FlexForm-Einstellungen zu sehen bekommen:

.. figure:: /Images/camaliga_plugin.png

   *Abbildung 6: FlexForm-Einstellungen*

- Wähle ein Layout und mach noch ein paar weitere Einstellungen:

.. figure:: /Images/camaliga_template.png

   *Abbildung 7: Wähle ein Layout aus*

- Wähle den Ordner mit den Elementen. Wenn nichts gewählt wird, wird die
  TypoScript-Einstellung genommen. Falls auch dort keine storagePid
  gesetzt ist, wird das aktuelle Dokument als Speicherort verwendet.

.. figure:: /Images/camaliga_mode.png

   *Abbildung 8: Wähle den Ordner*

- Fertig. Man kann auch mit TypoScript noch ein paar weitere Einstellungen vornehmen, etwa die Bild-Größe:

.. figure:: /Images/camaliga_typoscript.png

   *Abbildung 9: Einige TypoScript-Einstellungen*

- Die TypoScript-Einstellungen werden im Kapitel Konfiguration beschrieben.

- Wenn du auch die erweiterten Features dieser Extension nutzen willst,
  musst du die TYPO3-Kategorien benutzen. Man kann die Kategorien aber auch in den anderen Fällen benutzen.
  Man kann sie bei jedem Element ausgeben oder die Suche damit einschränken.
  Beachte: die übergeordnete Kategorie wird in der erweiterten Ansicht als Beschreibung der Kategorie benutzt. Beispiel:
  du hast eine Kategorie namens “Astrolabium”, dann sollte die
  übergeordnete Kategorie z.B. “Typ” heissen, da sie die Kategorie
  beschreibt. Siehe Bild:

.. figure:: /Images/camaliga_cat.png

   *Abbildung 10: Erzeuge eine Kategorie*

.. figure:: /Images/camaliga_cat2.png

   *Abbildung 11: Wie man Kategorien benutzt*

- Beachte: normallerweise werden die Kategorien als radio-Buttons in der Suche angeboten. Wenn man sie als checkbox benutzen will,
  muss man bei der übergeordneten Kategorie “checkbox” bei Bemerkungen eintragen.
  Die übergeordneten Kategorien werden nur bei den erweiterten Templates geprüft.
  Bei den normalen Templates kann man angeben, wie alle ausgewählten Kategorien berücksichtigt werden sollen (AND oder OR).
  Bei den erweiterten Templates kann man anhand der übergeordneten Kategorie bestimmen, ob ein AND oder OR benutzt werden soll.
  Nun kann man die Kategorien in den Camaliga-Elementen benutzen:

.. figure:: /Images/camaliga_cat3.png

   *Abbildung 12: Benutze die Kategorien bei den Elementen*

- Zu guter letzt kann man beim Plugin auswählen, welche Elemente anhand der vergebenen Kategorien bei der Ausgabe
  berücksichtigt werden sollen:

.. figure:: /Images/camaliga_category.png

   *Abbildung 13: Die Kategorien wählt man bei den Plugin-Einstellungen aus*

- Ein anderes Feature ist die Mutter-Kind-Beziehung. Das ist wichtig,
  wenn man auf manchen Seiten nur eindeutige Elemente anzeigen will und
  auf der Einzelansicht dann beide Elemente. Stattdessen könnte man
  natürlich auch 2 verschiedene Ordner benutzten, aber die Mutter-Kind-
  Beziehung ermöglicht auch noch weitere Schmanckerl.

.. figure:: /Images/camaliga_mother.png

   *Abbildung 14: Mutter-Kind-Beziehung bei einem Element*


.. toctree::

   Faq/Index
