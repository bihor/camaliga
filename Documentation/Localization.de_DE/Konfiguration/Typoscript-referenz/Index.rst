

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


TypoScript-Referenz
^^^^^^^^^^^^^^^^^^^

- Hiermit kann man zahlreiche Einstellungen vornehmen.

========================================  =============  =================================================================================  ===========
Variable                                  Datentyp       Beschreibung                                                                       Standard
========================================  =============  =================================================================================  ===========
view.templateRootPaths.0 & .1             string         Pfad zu den Templates.                                                             EXT:...

                                                         **Beispiel:**

                                                         ::

                                                            plugin.tx_camaliga.view.templateRootPaths.1 = fileadmin/template/files/
view.partialRootPaths.0 & .1              string         Pfad zu den partials des Template.                                                 EXT:...
view.layoutRootPaths.0 & .1               string         Pfad zu dem layout des Template.                                                   EXT:...
persistence.storagePid                    int            Speicherort der Camaliga-Elemente. Kann auch beim Plugin angegeben werden.
features.rewrittenPropertyMapper          boolean        Benutze den neuen Property Mapper?                                                 1
settings.defaultStoragePids               String / int   Komma-separierte Liste von storage PIDs. Dies muss eine Untermenge von
                                                         storagePid sein. Macht nur bei einem erweiterten Template Sinn.

                                                         **Syntax:**

                                                         ::

                                                            [pid1],[pid2],[pid3]

                                                         **Beispiel:**

                                                         ::

                                                            plugin.tx_camaliga.settings.defaultStoragePids = 354,349
settings.defaultCatIDs                    String / int   Standard-Kategorien. Nur Elemente mit dieser Kategorie werden
                                                         angezeigt. Kann vom Benutzer in einem erweiterten Template geändert
                                                         werden.

                                                         **Syntax:**

                                                         ::

                                                            [cat1],[cat2],[cat3]

                                                         **Beispiel:**

                                                         ::

                                                            plugin.tx_camaliga.settings.defaultCatIDs = 2,3
settings.listId                           int            ID der Seite für die Listenansicht.
settings.searchId                         int            ID der Seite, wo gesucht werden soll. Siehe Kapitel Admin./Erw. Templates.
settings.showId                           int            ID der Seite für die Einzelansicht.
settings.sortBy                           string         Sortieren nach?                                                                    sorting

                                                         **Syntax:**

                                                         ::

                                                            sorting|tstamp|crdate|title|zip|city|country|custom1|custom2|custom3
settings.sortOrder                        string         Sortierreihenfolge?                                                                asc

                                                         **Syntax:**

                                                         ::

                                                            asc|desc
settings.limit                            integer        Anzahl der Elemente, die aus der Datenbank geholt werden sollen.                   0
                                                         Das ist also die Anzahl der sichtbaren Elemente bei einer Liste. 0=alle.
settings.random                           boolean        Die Elemente zufällig sortieren?                                                   0

                                                         0: nein.

                                                         1: ja, jedes mal wenn der Cache geleert wird.
settings.getLatLon                        boolean        Versuche die Latitude und Longitude automatisch zu finden?                         0
                                                         Die Position einer vorhanden Adresse ohne Latitude wird über einen
                                                         Google-Server erfragt.

                                                         0: nein.

                                                         1: ja, suche die Position in einem Karussell-, List- oder Map- Template.
settings.onlyDistinct                     boolean        Zeige nur eindeutige Elemente an?                                                  0

                                                         0: nein.

                                                         1: ja, zeige nur das übergeordnete Element an, wenn Kinder vorhanden sind
                                                         oder zeige ein Kind-Element, wenn das übergeordnete Element nicht
                                                         vorhanden ist.
settings.normalCategoryMode               string         Wie sollen bei normalen Templates die Kategorien bei der Suche berücksichtigt      and
                                                         werden?

                                                         and: und-Suche

                                                         or: oder-Suche
settings.overrideFlexformSettingsIfEmpty  boolean        Überschreibe die FlexForm-Einstellungen mit den TypoScript-                        1
                                                         Einstellungen, falls die FlexForm-Einstellung leer ist?

                                                         0: nein.

                                                         1: ja (funktioniert gut, außer bei den Checkbox-Einstellungen).
settings.img.width                        int            Breite eines Bildes. Kann im Template benutzt werden...                            700
settings.img.height                       int            Höhe eines Bildes.                                                                 500
settings.img.thumbWidth                   int            Thumbnail-Breite eines Bildes.                                                     195
settings.img.thumbHeight                  int            Thumbnail-Höhe eines Bildes.                                                       139
settings.item.width                       int            Breite eines (carousel-)Elementes.                                                 195
settings.item.height                      int            Höhe eines (carousel-)Elementes.                                                   290
settings.item.padding                     int            Padding eines (carousel-)Elementes.                                                0
settings.item.margin                      int            Marging eines (carousel-)Elementes.                                                10
settings.item.items                       int            Anzahl der sichtbaren Elemente (JavaScript-Parameter).                             3
settings.maps.key                         string         Google maps API key
settings.maps.language                    int            Google maps API language                                                           de
settings.maps.dontIncludeAPI              boolean        Das JS mit dem Google maps API key nicht einbinden?                                0
settings.maps.includeRoute                boolean        Das Partial für die Routenplannung einbinden?                                      0
settings.maps.clustering                  boolean        Clustering von Markern einschalten?                                                0
settings.maps.zoom                        int            Zoom-Level für die nächsten 2 Werte                                                5
settings.maps.startLatitude               float          Latitude für eine leere Karte                                                      50.0
settings.maps.startLongitude              float          Longitude für eine leere Karte                                                     10.0
settings.maps.tileLayer                   string         Pfad zu einem tile-Layer-Anbieter (OpenStreetMap)                                  [OSM]
settings.maps.attribution                 string         Attribution für die tile-Layers (OpenStreetMap)                                    [OSM]
settings.maps.maxZoom                     int            Maximaler Zoom-Level                                                               19
settings.seo.setTitle                     boolean        Ersetze auf den Single-Seiten den Seiten-Titel durch den Titel des                 0
                                                         angezeigten Elements?

                                                         0: nein. 1: ja, ersetzte den Titel.
settings.seo.setIndexedDocTitle           boolean        Ersetze in einer Sitemap den Titel eines Single-Elements?                          0

                                                         0: nein. 1: ja.
settings.seo.setDescription               boolean        Ersetze auf den Single-Seiten die Seiten-Beschreibung durch das Feld               0
                                                         Kurzbeschreibung? Funktioniert nicht mit der metaseo-Extension.

                                                         0: nein. 1: ja, ersetzte die meta-description.
settings.seo.setOgTitle                   boolean        Füge den og:title-Tag im Header einer Einzelansicht hinzu?                         0

                                                         0: nein; 1: ja.
settings.seo.setOgDescription             boolean        Füge den og:description-Tag im Header einer Einzelansicht hinzu?                   0

                                                         0: nein; 1: ja.
settings.seo.setOgImage                   boolean        Füge das og:image Meta-Tag zum Header hinzu auf Single-Seiten falls ein Bild       0
                                                         vorhanden ist?

                                                         0: nein. 1: ja, füge og:image mit Bild 1 hinzu.
settings.extended.enable                  boolean        Das erweiterte Template einschalten? Siehe Kapitel "Erweiterte Templates"          0

                                                         Die nachfolgenden 3 Einstellungen wirken sich nur aus, wenn diese Option
                                                         eingeschaltet ist.
settings.extended.onlySearchForm          boolean        Am Anfang nur ein leeres Suchformular anzeigen?                                    0
settings.extended.restrictSearch          boolean        Weniger Suchoptionen anzeigen?                                                     0
settings.extended.radiusValues            string         Kommaseparierte Werte für die Selectbox bei der Umkreissuche.

                                                         **Syntax:**

                                                         ::

                                                            [km1],[km2],[km3]

                                                         **Beispiel:**

                                                         ::

                                                            plugin.tx_camaliga.settings.extended.radiusValues = 10,25,50,100
settings.extended.saveSearch              boolean        Suchoptionen in einem Cookie speichern und das später benutzen?                    0
settings.more.setModulo                   boolean        Füge Modulo-Werte zu jedem Camaliga-Element hinzu?                                 0
                                                         {content.moduloBegin} und {content.moduloEnd} werden gesetzt. Diese hängen ab
                                                         von settings.item.items. Siehe Template Ekko.html für ein Beispiel.
settings.more.addLightbox                 boolean        Füge eine Lightbox beim Galleryview-Template hinzu? Kann so auch bei anderen       0
                                                         Templates wie in Galleryview.html benutzt werden.
settings.more.*                           mixed          Viele Optionen für Silders wie Flexslider2, Slick carousel, Galleryview.
settings.bootstrap.*                      mixed          Siehe bei den FlexForms und/oder der Bootstrap-Homepage.
========================================  =============  =================================================================================  ===========

Beispiel
~~~~~~~~

Hier ein Beispiel mit einigen Einstellungen:

::

   plugin.tx_camaliga {
       view.templateRootPaths.1 = fileadmin/template/camaliga/
       settings.defaultCatIDs = 4,5
       settings.showId = 410
       settings.listId = 402
   }

