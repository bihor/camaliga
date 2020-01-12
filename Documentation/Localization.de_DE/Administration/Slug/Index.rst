

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


Slug
^^^^

Ab TYPO3 9 kann man routeEnhancers benutzen, um das Format der Links zu Einzelseiten zu ändern. Hier ein Beispiel für die yaml-Datei::

	routeEnhancers:
	  CamaligaPlugin:
	    type: Extbase
	    limitToPages: [24]
	    extension: Camaliga
	    plugin: Pi1
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
		plugin: Pi1
		routes:
		  - { routePath: '/eintrag/{camaliga_title}', _controller: 'Content::show', _arguments: {'camaliga_title': 'content'} }
		defaultController: 'Content::list'
		aspects:
		  camaliga_title:
			type: PersistedAliasMapper
			tableName: 'tx_camaliga_domain_model_content'
			routeFieldName: 'slug'

Achtung 1: wenn man das slug-Feld benutzt, sollte man sicher sein, dass die slug-Felder auch befüllt sind. Dazu kann man einen Scheduler-Task von camaliga benutzen.

Achtung 2: wenn man 2 Felder für das slug-Feld konfiguriert hat, wird '_' oder '-' statt '/' als Separator benutzt, wegen diesem Problem:
https://forge.typo3.org/issues/87333

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

RealUrl
^^^^^^^

Bis TYPO3 8 kann man RealUrl benutzen, um das Format der Links zu Einzelseiten zu ändern. Hier ein Beispiel für die RealUrl-config-Datei::

  'postVarSets' => array(
    '_DEFAULT' => array(
    ...

	  'camaliga' => array( // this key must be unique
	      array(
		  'GETvar' => 'tx_camaliga_pi1[action]',
	      ),
	      array(
		  'GETvar' => 'tx_camaliga_pi1[controller]',
	      ),
	      array(
		  'GETvar' => 'tx_camaliga_pi1[content]',
	      ),
	  ),

    ...
   ),
  ),