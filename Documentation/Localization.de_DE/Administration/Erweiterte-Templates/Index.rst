

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


Erweiterte Templates
^^^^^^^^^^^^^^^^^^^^

Erweiterte Templates sind Templates, die mehr Informationen ausgeben als die normalen Templates.
Außerdem bieten sie eine Suchmöglichkeit (nach Kategorien und eine Volltextsuche). Mehr dazu findet man in anderen Kapiteln.
Seit camaliga 5.0.0 gibt es nun drei Möglichkeiten, diese erweiterten Templates/Funktionen zu benutzen:

- Für die Listen-Ansicht kann man gleich ein erweitertes Template auswählen.
  Da die erweiterte List-Action gecached wird, kann man das Suchformular mit dem Parameter no_cache=1 an sich selbst senden.
  Das ist freilich keine elegante Lösung, aber dennoch eine praktische Lösung.
  Bis zur Version 4.0.0 gab es noch mehr Templates, die nach diesem Prinzip funktionierten, aber die werden nicht mehr
  angeboten. Deshalb sollte man jetzt noch weiter lesen.

- Das erweiterte Google-Karten/Maps-Template wird überhaupt nie gecached, weshalb man dort den no_cache=1 Parameter nicht braucht.
  Das Template heißt nicht wie früher MapExtended.html, sondern Search.html. Das Suchformular wird dort über ein Partial eingebunden.
  Jeder, der kein Caching braucht oder jeder, dem die anderen Lösungen nicht gefallen, sollte das Search-Template benutzen.
  Man kann es freilich für alles benutzen.

- Der 3. Weg sieht so aus: man sendet das Suchformular an die search-action.
  Da die search-action nicht gecached wird, braucht man den no_cache-Parameter nicht.
  Dafür wird aber das Search.html-Template auf jeden Fall gebraucht.
  Wer jetzt nicht immer zwei Templates pflegen will, kann beim Suchformular noch einen Parameter mit angeben:

::

	<f:form.hidden name="template" value="List" />

Mit Hilfe des hidden-Parameters template gibt man an, welches Template nach der Suche benutzt werden soll.
Das sollte dann den gleichen Namen haben, wie das Template, welches man benutzt.
Der Vorteil: man kann das ganze in fast jedem Template so machen.
Aufgrund eines TYPO3-Bugs braucht man das Search.html-Template aber dennoch, obwohl es nicht benutzt wird.
Damit das ganze überhaupt funktioniert, muss man nun die Suche noch einschalten. Entweder über die FlexForms
im Reiter "Erweiterte Optionen" oder per TypoScript:

::

  plugin.tx_camaliga.settings.extended.enable = 1

Ein Zeit-Test hat übrigens ergeben, dass es Jacke wie Hose ist, welche Variante man wählt. Alle Varianten sind gleich langsam.
Ob man am Anfang ein leeres Suchformular ausgeben will oder gleich eine gefüllte Seite, kann man auch einstellen.
Und so sieht ein fertiges Beispiel der Variante 3 aus, welches man in fast jedes Template einbauen kann:

::

  <f:if condition="{settings.extended.enable} == 1">
   <f:form action="search" name="camaliga">
	<div class="well">
	  <h3>{f:translate(key: 'options', default: 'Options')}</h3>
	  <f:render partial="Options" arguments="{_all}" />
	  <f:form.submit name="search" value="{f:translate(key: 'search', default: 'search')}" class="btn btn-primary" />
	  <f:form.hidden name="template" value="List" />
	</div>
   </f:form>
  </f:if>

Nachdem man das in sein Template eingebaut hat, braucht man noch das Partial "Options", dass man aus dem typo3conf-Ordner
benutzen kann oder auch in den fileadmin-Ordner kopieren kann. Den Pfad zum Partial gibt man so an via TypoScript-Setup:

::

  plugin.tx_camaliga.view.partialRootPaths.1 = fileadmin/templates/Partials/

Beachte: die RealUrl-Doku sagt, dass man die Generierung des cHash bei nicht cache-baren Plugins ausschalten sollte.
Nun kann man noch zum f:form noCacheHash="true" hinzufügen, aber dann funktioniert die Suche nicht mehr.
Toller Ratschlag also...
Damit die Suche wieder funktioniert, muss man noch auf eine weitere Seite weiterleiten - also noch ein pageUid hinzufügen.
Neues Beispiel:

::

  <f:form action="search" name="camaliga" noCacheHash="true" pageUid="{settings.searchId}">

Beachte weiterhin: bei der Suche nach dem angegebenen Template wird nur der Ordner benutzt, der unter der höchsten
Nummer zu finden ist. Also z.B. nur der hier angegebene Ordner: view.templateRootPaths.1 und nicht auch der hier:
view.templateRootPaths.0.