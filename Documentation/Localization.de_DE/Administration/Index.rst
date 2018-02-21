

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


Administration
--------------

- Nachdem man sich für ein Layout entschieden hat, sollte man das HTML-
  Template und die CSS-Datei anpassen.

- Kopiere dazu diese 2 Ordner in einen Ordner im fileadmin-Verzeichnis:

::

  typo3conf\ext\camaliga\Resources\Private\Templates\Content
  typo3conf\ext\camaliga\Resources\Public\css

- Wenn du z.B. den Ordner fileadmin/ext/camaliga genannt hast, dann gibt
  den Pfad dazu mit TypoScript-Konstanten so an:

::

   plugin.tx_camaliga.view.templateRootPath = fileadmin/ext/camaliga/

- Oder mit TypoScript-Setup so:

::

   plugin.tx_camaliga.view.templateRootPaths.1 = fileadmin/ext/camaliga/

- Achtung: in diesem Ordner muss dann der Ordner “Content” drin liegen.

- Nun kann man das HTMl-Template bearbeiten. Welches? Das ist nicht
  schwer, da die Namen treffend gewählt sind. Falls das Template JS-
  oder CSS-Dateien enthält, kopiere die auch in den fileadmin-Ordner und
  binde sie via TypoScript ein. Sie werden nur zu Demo-Zwecken im
  Template eingebunden. Entferne sie dann aus dem Template.Bemerkung:
  man findet mehr Informationen zu jedem Template am Anfang eines
  Template. Weitere Infos findet man auch im Kapitel Tutorial.


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Extension-Manager/Index
   Html-templates/Index
   Erweiterte-Templates/Index
   Umkreissuche/Index
   Template-variablen/Index
   ViewHelper/Index
   Kategorien/Index
   DasBackend-modul/Index
   Scheduler/Index
   Extend/Index
   Faq/Index

