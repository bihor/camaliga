

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
	      - { routePath: '/more/{camaliga_title}', _controller: 'Content::show', _arguments: {'camaliga_title': 'content'} }
	    defaultController: 'Camaliga::list'

limitToPages ist optional. Man kann die Regel auf bestimmte Seiten beschränken, die Einzelansichten anzeigen.

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