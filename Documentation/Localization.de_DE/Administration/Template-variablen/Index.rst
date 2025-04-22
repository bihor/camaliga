.. include:: /Includes.rst.txt

Template-Variablen
^^^^^^^^^^^^^^^^^^

- Man kann einige Variablen in den Fluid-Templates benutzten. Die werden
  nun hier erklärt. Zuerst findet man die Variablen, die man in normalen
  Templates benutzen kann, dann diejenigen, die man zusätzlich in den
  erweiterten Templates benutzen kann.

=========================  ===============================================================================================
Variable                   Beschreibung (Beispiele findet man in List.html und Show.html)
=========================  ===============================================================================================
fal                        Immer 1. Früher: Bilder aus dem FAL (1) oder aus dem Ordner uploads/camaliga (0) benutzen?
lang                       UID der Sprache.
uid                        UID des Plugin (Content-Element ID).
pid                        PID des Plugin (Seiten-ID).
storagePIDsArray           Array mit den PIDs der Datensatzsammlung.
storagePIDsComma           Komma-separierte Liste der PIDs der Datensatzsammlung.
contents                   Array mit den Camaliga-Elementen. Das Array enthält diese Variablen mit Tabellen-Inhalten:

                           title, shortdesc, longdesc, link, image, image2, caption2, image3, caption3,
                           image4, caption4, image5, caption5, street, zip, city, country,
                           latitude, longitude, person, phone, mobile, email, custom1, custom2, custom3, categories.

                           Weiterhin ganz wichtig für JavaScript: titleNl2br, shortdescNl2br, longdescNl2br und
                           streetNl2br.

                           Die Links werden im TypoLink-Format abgespeichert, weshalb noch weitere Variablen zur
                           Verfügung stehen.
                           linkResolved enthält nun den Pfad zu einer Datei, anstatt file:123 (wie link).
                           Natürlich sollte das auch für andere Link-Arten normal sein, ist es im Moment aber nicht.
                           Dafür gibt es noch die Variable links, die ein Array zurückgibt. Das ist hilfreich, wenn
                           man mehrere Links speichern will oder wenn man den Typ des Links wissen will.
                           Die Array-Keys lauten: link und type. type gleich 0: kein Link; 1: interner Link;
                           2: externer Link; 3: Datei; 4: Email-Adresse.
                           Ein Beispiel sieht man weiter unten. In den Templates wird nun f:link.typolink benutzt,
                           sodass man besser alles gleich bei der Linksetzung angibt.

                           Und wenn man die Camaliga-Tabelle erweitert: extended.
                           Das ist ein Array mit den erweiterten Feldern.
settings                   Siehe TypoScript-Einstellungen.
onlySearchForm             Wert, ob nur ein Suchformular angezeigt werden soll.
paddingItemWidth           Element-Breite + 2\*padding.
totalItemWidth             Element-Breite + 2\*padding + 2\*margin.
itemWidth                  Hängt von "addPadding" ab: Element-Breite ODER paddingItemWidth.
totalWidth                 n \* totalItemWidth.
paddingItemHeight          Element-Höhe + 2\*padding.
totalItemHeight            Element-Höhe + 2\*padding + 2\*margin.
itemHeight                 Hängt von "addPadding" ab: Element-Höhe ODER paddingItemHight.
debug                      Debug-Ausgabe, wenn settings.debug=1.
=========================  ===============================================================================================


- Benutze ein erweitertes Template nur dann, wenn du diese zusätzlichen Variablen brauchst:

===============================  ==============================================================================
Variable                         Beschreibung (Beispiele findet man in ListExtended.html)
===============================  ==============================================================================
sortBy\_selected                 Übergabevariable sortBy.
sortOrder\_selected              Übergabevariable sortOrder.
start                            Übergabevariable start.
defaultCatIDs                    Settings.defaulCatIDs.
storagePIDsData                  Array mit den Datensatzsammlungs-PIDs und der Info, welche davon ausgewählt sind.
all_categories                   Array mit allen Kategorien.
categories                       Array mit Kategorien und den übergeordneten Kategorien.
contents.categoriesAndParents    Array mit allen benutzten Kategorien und den übergeordneten Kategorien.
sword                            Volltext-Such-Wort.
place                            Ort, der gesucht wird.
radius                           Ausgewählter Radius in km.
radiusArray                      Auswählbare Radius-Werte.
rsearch                          Wert, der sagt, ob die Umkreissuche aktiv ist.
===============================  ==============================================================================


- Wenn settings.more.setModulo = 1 gesetzt wird, gibt es noch diese Variablen (abhängig von settings.item.items):

===============================  =====================================================================================
Variable                         Beschreibung (Beispiel findet man in Ekko.html)
===============================  =====================================================================================
contents.moduloBegin             >0 nach jedem settings.item.items Element. 0 sonst. Beginnt beim 1. Element.
contents.moduloEnd               >0 nach jedem settings.item.items Element. 0 sonst. Beginnt beim \[items\]-Element.
===============================  =====================================================================================


Hier noch ein Beispiel, wenn man nicht f:link.typolink benutzen will:

::

  <f:if condition="{content.link} != ''">
	<f:if condition="{content.linkResolved} != ''">
		<f:then><a href="{content.linkResolved}" class="download">{f:translate(key: 'more')}</a></f:then>
		<f:else>
			<f:if condition="{content.link} > 0">
				<f:then><f:link.page pageUid="{content.link}" class="internal-link">{f:translate(key: 'more')}</f:link.page></f:then>
				<f:else><f:link.external uri="{content.link}" class="external-link-new-window">{f:translate(key: 'more')}</f:link.external></f:else>
			</f:if>
		</f:else>
	</f:if>
  </f:if>
