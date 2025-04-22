.. include:: /Includes.rst.txt


Slug
^^^^

Ab TYPO3 9 kann man routeEnhancers benutzen, um das Format der Links zu Einzelseiten zu ändern. Hier ein Beispiel für die yaml-Datei::

	routeEnhancers:
	  CamaligaPlugin:
	    type: Extbase
	    limitToPages: [24]
	    extension: Camaliga
	    plugin: Show
	    routes:
	      - { routePath: '/more/{camaliga_uid}', _controller: 'Content::show', _arguments: {'camaliga_uid': 'content'} }
	    defaultController: 'Content::list'

limitToPages ist optional. Man kann die Regel auf bestimmte Seiten beschränken, die Einzelansichten anzeigen. Ersetze die 24!
In diesem Beispiel wird die uid eines Camaliga-Elements hinter "more" eingefügt. Hier ein anderes Beispiel, welches das Slug-Feld benutzt::

	routeEnhancers:
	  CamaligaPlugin:
		type: Extbase
		limitToPages: [24]
		extension: Camaliga
		plugin: Show
		routes:
		  - { routePath: '/eintrag/{camaliga_title}', _controller: 'Content::show', _arguments: {'camaliga_title': 'content'} }
		defaultController: 'Content::list'
		aspects:
		  camaliga_title:
			type: PersistedAliasMapper
			tableName: 'tx_camaliga_domain_model_content'
			routeFieldName: 'slug'

Achtung 1: wenn man das slug-Feld benutzt, sollte man sicher sein, dass die slug-Felder auch befüllt sind.
Dazu kann man einen Scheduler-Task von camaliga benutzen.

Achtung 2: wenn man 2 Felder für das slug-Feld konfiguriert hat, wird '_' oder '-' statt '/' als Separator benutzt, wegen diesem Problem:
https://forge.typo3.org/issues/87333

Achtung 3: wenn man die "Einzelansicht 2" (erweiterte Einzelansicht) benutzt, muss man Content::show durch
Content::showExtended ersetzen.

Achtung 4: vor Camaliga 12 muss man bei plugin: Pi1 statt Show benutzen. Und ab Camaliga 12 muss man Show evtl. durch
Showextended ersetzen, wenn man nicht die normale Single-Ansicht benutzt!


Man kann auch Kategorien in den routeEnhancers verwenden. Allerdings geht das nur mit Kategorien eines "parents".
Wenn der parent die ID 10 hat, kann man so einen routeEnhancer für die Suche nach Camaliga-Elementen, die eine Kategorie haben, deren parent 10 ist::

    routeEnhancers:
      CatCamaliga:
        type: Extbase
        extension: Camaliga
        plugin: Show
        limitToPages:
          - 45
        routes:
          -
            routePath: '/{category-name}'
            _controller: 'Content::search'
            _arguments:
              category-name: cat10
        defaultController: 'Content::search'
        aspects:
          category-name:
            type: PersistedAliasMapper
            tableName: sys_category
            routeFieldName: slug

Zusätzlich muss man das Template per TypoScript setzen, dass bei der Suche verwendet werden soll::

	plugin.tx_camaliga.settings.extended.template = Openstreetmap


Hier noch 2 nicht so schöne / alte Beispiele::

	routeEnhancers:
	  CamaligaPlugin:
		type: Extbase
		limitToPages: [382]
		extension: Camaliga
		plugin: Pi1
		routes:
		  - { routePath: '/googlemaps/{camaliga_place}', _controller: 'Content::map', _arguments: {'camaliga_place': 'content'} }
		defaultController: 'Content::map'
		aspects:
		  camaliga_place:
			type: PersistedPatternMapper
			tableName: 'tx_camaliga_domain_model_content'
			routeFieldPattern: '^(?P<city>.+)-(?P<uid>\d+)$'
			routeFieldResult: '{city}-{uid}'

In diesem Beispiel wird die Stadt und die uid eines Camaliga-Eintrags benutzt, um ihn dann auf einer Google-maps-Karte anzuzeigen.
Achtung: zur Zeit gibt es noch kein slug-Feld in der Camaliga-Tabelle, sodass keine Konvertierung zu einem guten Link-String stattfindet.
Es tauchen also z.B. ggf. Leerzeichen im Link auf.
Beachte: das Beispiel funktioniert nur, wenn man kein "/" bei der Stadt verwendet.

Man kann das ganze auch anders schreiben. Das Ergebnis ist allerdings das gleiche (aber ohne /googlemaps)::

	routeEnhancers:
	  CamaligaPlugin:
		type: Plugin
		limitToPages: [382]
		namespace: 'tx_camaliga_pi1'
		routePath: '/{content}'
		requirements:
		  content: '[0-9]{1..5}'
		aspects:
		  content:
			type: PersistedPatternMapper
			tableName: 'tx_camaliga_domain_model_content'
			routeFieldPattern: '^(?P<city>.+)-(?P<uid>\d+)$'
			routeFieldResult: '{city}-{uid}'

Weitere Informationen dazu findet man hier: https://typo3worx.eu/2018/12/typo3-routing-extensions-and-enhancers/
