.. include:: Images.txt

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


Tutorial
--------

- Nehmen wir mal an, du seist ein Immobilienhai und möchtest ein paar
  Wohnungen bzw. Häuser verkaufen oder vermieten. Mit dieser Extension
  kannst du deine Häuser auf verschiedene Art und Weise präsentieren.
  Auf der Homepage kannst du z.B. ein Karussell oder eine Gallerie mit
  den Highlights anzeigen. Auf einer Folgeseite kannst du eine
  Kartenansicht anbieten. Dazu dann noch eine Listenansicht mit einer
  Detailansicht. Wie das geht, verrät dieses Tutorial.

- Als erstes denke darüber nach, welche Felder du brauchst. In diesem
  Fall: Name, Beschreibung, Adresse, GEO-Daten, Preis, Grundfläche,
  Baujahr, Typ, Anzahl Zimmer, vorhandene Einrichtung. Jetzt sollte man
  sich überlegen, welche Felder sich immer ändern und welche man als
  Kategorie verwenden kann. Die Felder bis einschließlich Baujahr machen
  wir als Textfeld. Die danach als Kategorie. Wir nutzen nun custom1 als
  Preis, custom2 als Grundfläche und custom3 als Baujahr. Die Label
  werden so bei der “Seiten-TSConfig” angepasst:

::

   TCEFORM.tx_camaliga_domain_model_content.custom1.label = Preis:
   TCEFORM.tx_camaliga_domain_model_content.custom2.label = Grundfläche:
   TCEFORM.tx_camaliga_domain_model_content.custom3.label = Baujahr:

- Als nächstes legen wir die TYPO3-Kategorien an. Lege die Kategorien
  wie folgt in der Listenansicht an. Beachte dabei, dass bei der
  Kategorie “Vorhandene Einrichtung” unter Bemerkung “checkbox”
  eingetragen ist, damit bei der Suche bei dieser Kategorie eine
  checkbox statt ein Radio-Button benutzt wird.

|img-18|

*Abbildung 18: Kategorien für unsere Beispiel-Seiten*

- Nun kann man die camaliga-Elemente anlegen. Als erstes wird für jede
  Wohung/Haus ein Eintrag gemacht. Man kann bis zu 6 Bilder pro Eintrag verwenden. Wenn man fertig ist, kann man dann
  noch zusätzliche Einträge anlegen, wo man z.B. nur den Titel und ein Bild
  angibt. Außerdem wählt man ganz unten das übergeordnete Element aus.
  Die zusätzlichen Elemente werden dann nur auf der Detail-Seite
  angezeigt. Grund: auf der Detail-Seite sollen mehr als sechs Bilder
  angezeigt werden oder du möchstest verwandte Elemente anzeigen.

  .. ### BEGIN~OF~TABLE ###

  .. container:: table-row

     a
           |img-19|

           *Abbildung 19: Wähle ein übergeordnetes Element nur bei zusätzlichen
           Elementen aus*

     b
           |img-20|

           *Abbildung 20: Kategorien eines Hauses*


  .. ###### END~OF~TABLE ######

- Nun können wir die camaliga-Einträge präsentieren. Füge das statische
  TypoScript dieser Extension ein und füge das Plugin auf der Startseite
  ein. Für die Startseite wählen wir ein Karussell oder eine Gallerie.
  Dabei muss man ankreuzen: zeige nur eindeutige Elemente an, damit die
  zusätzlichen Elemente nicht mit angezeigt werden. Wenn nun nur
  Highlights auf der Startseite angezeigt werden sollen, kann man
  entweder 2 Ordner benutzen (einen für die Highlights und einen für die
  restlichen Elemente) oder man benutzt eine weitere Kategorie. Man kann mit diesem TypoScript
  nur Elemente anzeigen, die eine bestimmte Kategorie besitzen (30 ist die ID von “ja”):

::

   plugin.tx_camaliga.settings.defaultCatIDs = 30

|img-21|

*Abbildung 21: Kategorie für die Sucheinschränkung*

- Nun werden nur noch Highlights auf der Startseite angezeigt. Im
  nächsten Schritt soll das Layout des Karussell oder der Gallerie
  angepasst werden. Kopiere dafür den Ordner
  typo3conf/ext/camaliga/Resources/Private/Templates/Content und
  typo3conf/ext/camaliga/Resources/Private/Templates/Partials in dein
  fileadmin-Verzeichnis und teile den neuen Pfad mittels TypoScript mit
  (Content muss in diesem Ordner drin sein):

::

   plugin.tx_camaliga.view.templateRootPaths.1 = fileadmin/templates/Camaliga/
   plugin.tx_camaliga.view.partialRootPaths.1 = fileadmin/templates/Camaliga/

- Nun kann man die HTML-Dateien bearbeiten. Falls sie externe Dateien
  inkludiert, downloade die und kopiere sie ebenfalls ins fileadmin-
  Verzeichnis. Kopiere auch die inkludieren CSS-Dateien ins fileadmin-
  Verzeichnis und passe sie an.

- Im nächsten Schritt füge eine Google Karte, eine Listenansicht und
  eine Detail-Ansicht deiner Website hinzu. Für dieses Beispiel sollte
  man allerdings immer die extended/erweiterte Version wählen, da die
  dem Benutzer die Möglichkeit gibt, die Ergebnisse anders zu sortieren
  und nur Elemente mit bestimmten Kategorien anzuzeigen. Auch eine Volltextsuche steht dann zur Verfügung.
  Es wird dann noch das Template "Search.html" benötigt. Bei ListExtended.html kann man dies umgehen,
  indem man wieder an sich selbst sendet und noch no_cache=1 überträgt. Zudem müsste man dann diese Zeile entfernen:

::

  <f:form.hidden name="template" value="List" />

- Das Formular sähe dann so aus:

::

  <f:form action="listExtended" name="camaliga">
  ...
  <f:form.submit name="search" value="{f:translate(key: 'search', default: 'search')}" class="btn btn-primary" />
  <input type="hidden" name="no_cache" value="1" />
  </f:form>

- Mehr dazu findet man im Kapitel "Administration / Erweiterte Templates".

- Die folgenden Bilder zeigen eine erweiterte Listen- und Detail-Ansicht. Mit Hilfe der showId
  kann man eine andere Seite für die Einzelansicht wählen:

::

   plugin.tx_camaliga.settings.showId = 20

   <f:link.action action="showExtended" pageUid="{settings.showId}" arguments="{content : content}">

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   a
         |img-22|

         *Abbildung 22: Erweiterte Listenansicht mit Suchmöglichkeit*

   b
         |img-23|

         *Abbildung 23: Detailansicht mit einem zusätzlichem Kind-Element*


.. ###### END~OF~TABLE ######


===========================================
Beispiel 2: etwas wie Rezepte präsentieren.
===========================================

- Zuerst sollte die Bezeichnung der Felder im Backend umbenannt werden. Gehe dazu zu den Resourcen des Rezepte-Ordners
  und füge dort diese TypoScript-Konfiguration ein:

::

  TCEFORM.tx_camaliga_domain_model_content.zip.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.city.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.country.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.latitude.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.longitude.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.mobile.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.email.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.mother.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.falimage4.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.falimage5.disabled = 1
  TCEFORM.tx_camaliga_domain_model_content.shortdesc.label = Zutaten
  TCEFORM.tx_camaliga_domain_model_content.longdesc.label = Zubereitung
  TCEFORM.tx_camaliga_domain_model_content.street.label = Bemerkungen
  TCEFORM.tx_camaliga_domain_model_content.phone.label = Rezeptvariante
  TCEFORM.tx_camaliga_domain_model_content.custom1.label = Anzahl Personen
  TCEFORM.tx_camaliga_domain_model_content.custom2.label = Zubereitungszeit
  TCEFORM.tx_camaliga_domain_model_content.custom3.label = Informationen zur Zubereitung

- Nun kann man Rezepte anlegen und bearbeiten. Man
  könnte man auch überlegen, Rezepte aus einer CSV-Datei zu importieren. In der CSV-Datei kann man auch Kategorien wie
  Saison oder Schwierigkeitsgrad mit angeben. Die Kategorien müssen in diesem Fall aber schon in TYPO3 vorhanden sein.
  Man beachte beim Anlegen der Kategorien die Hinweise aus Beispiel 1!
  Das CSV-Import-Skript findet man im Scheduler.
  Da beim Feld Zutaten leider kein RTE vorhanden ist, könnte man dort entweder direkt HTML reinscheiben
  oder man nutzt im Template das Format nl2br. Noch besser: man wandelt das Zutaten-Feld auch in ein RTE-Feld um.
  Das macht meine Extension camaliga_addon. Siehe Kapitel "Administration / Camaliga-Tabellen erweitern".

- Man könnte nun die neuesten 5 Rezepte mit einem Bootstrap-Carousel anzeigen.
  All die Einstellungen dafür kann man bei den Erweiterungsoptionen "Layout" des Plugins Camaliga vornehmen.

- Natürlich möchte man dann noch eine Listenansicht mit einer Detailansicht haben. Da wird auch eine Volltextsuche
  und eine Suche über die Kategorien anbieten wollen, aktivieren wir bei den Erweiterungsoptionen "Erweiterte Optionen"
  den Punkt "Erweitertes Template mit Kategoriensuche aktivieren".
  Leider wird nicht nur List.html benötigt, sondern auch ein Dummy-Template Search.html, da die Suche über action "search" läuft.
  Man kopiert sich deshalb List.html, Search.html und Show.html in den fileadmin-Ordner
  und passt den Link zu den Templates wie im 1. Beispiel an.
  Eventuell kann man auch noch das Partial "Options.html" nach fileadmin kopieren und den Link dazu anpassen.
  Das fertige Show-Template könnte dann so aussehen:

::

	<f:layout name="Default" />
	<f:section name="main">
	<f:flashMessages />
	<link href="{f:uri.resource(path:'css/Single.css')}" rel="stylesheet" />

	<f:if condition="{error} == 1">
	<f:then>
	  <p><f:translate key="nothing" default="Nothing found." /></p>
	</f:then>
	<f:else>
	 <div class="carousel-single">
	  <h2>{content.title}</h2>
	  <div class="carousel-single-img">
	   <f:if condition="{content.falimage.uid}">
	    <f:image src="{content.falimage.uid}" maxHeight="{settings.img.thumbHeight}" alt="{content.title}" title="{content.title}" treatIdAsReference="1" />
       </f:if>
	  </div>
	  <div class="carousel-single-text">
		  <div class="row">
			  <div class="col-md-6">
				  <h3>Zutaten:</h3>
				<f:format.raw>{content.shortdesc}</f:format.raw>
			  </div>
			  <div class="col-md-6">
				  <h3>Sonstiges:</h3>
				  <ul>
				<f:if condition="{content.street} != ''"><li>Bemerkung: {content.street} <f:if condition="{content.link} != ''">
			<f:if condition="{content.linkResolved} != ''">
				<f:then><a href="{content.linkResolved}" class="download">downloaden</a></f:then>
				<f:else>
					<f:if condition="{content.link} > 0">
						<f:then><f:link.page pageUid="{content.link}" class="internal-link">{content.link}</f:link.page></f:then>
						<f:else><f:link.external uri="{content.link}" class="external-link-new-window">{content.link}</f:link.external></f:else>
					</f:if>
				</f:else>
			</f:if>
		</f:if></li></f:if>
				<f:if condition="{content.phone} != ''"><li>Variante: {content.phone}</li></f:if>
					<f:if condition="{content.custom1} != ''"><li>Personen: {content.custom1}</li></f:if>
					<f:if condition="{content.custom2} != ''"><li>Zubereitungszeit: {content.custom2}</li></f:if>
					<f:if condition="{content.custom3} != ''"><li>Information: {content.custom3}</li></f:if>
				<f:for each="{content.categoriesAndParents}" as="catMMval" key="catMMkey">
					<li>{catMMval.title}: <f:for each="{catMMval.childs}" as="catMMchildVal" iteration="iteration">{catMMchildVal}</f:for></li>
				</f:for>
				  </ul>
			  </div>
		  </div>
		  <h3>Zubereitung:</h3>
		<f:format.html>{content.longdesc}</f:format.html>
	  </div>

	  <div class="carousel-single-more">
      <f:if condition="{content.falimage2.uid}">
      <figure>
	   <f:image src="{content.falimage2.uid}" alt="{content.falimage2.originalResource.originalFile.alternative}" title="{content.falimage2.originalResource.originalFile.title}" treatIdAsReference="1" />
	   <figcaption>{content.falimage2.originalResource.originalFile.title}</figcaption>
	  </figure>
      </f:if>
      <f:if condition="{content.falimage3.uid}">
      <figure>
	   <f:image src="{content.falimage3.uid}" alt="{content.falimage3.originalResource.originalFile.alternative}" title="{content.falimage3.originalResource.originalFile.title}" treatIdAsReference="1" />
	   <figcaption>{content.falimage3.originalResource.originalFile.title}</figcaption>
	  </figure>
      </f:if>
      </div>
	 </div>

	 <p class="carousel-single-back"><a href="javascript:history.back();">{f:translate(key: 'back', default: 'back')}</a></p>
	 </div>
	</f:else>
	</f:if>
	</f:section>

- Das ganze `sieht dann aus wie ein Rezept von hier`_.

.. _sieht dann so aus: http://www.quizpalme.de/autor/rezepte
