

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

From TYPO3 9 you can use routeEnhancers to modify the format of links to single pages. Here an example for your yaml-file::

	routeEnhancers:
	  CamaligaPlugin:
	    type: Extbase
	    limitToPages: [24]
	    extension: Camaliga
	    plugin: Pi1
	    routes:
	      - { routePath: '/more/{camaliga_uid}', _controller: 'Content::show', _arguments: {'camaliga_uid': 'content'} }
	    defaultController: 'Content::list'

limitToPages is optional. You can list there all your single-pages with camaliga elements. Replace the 24!
In this example the uid of a camaliga element is used after "more". Here another example, that uses the slug-field::

	routeEnhancers:
	  CamaligaPlugin:
		type: Extbase
		limitToPages: [24]
		extension: Camaliga
		plugin: Pi1
		routes:
		  - { routePath: '/entry/{camaliga_title}', _controller: 'Content::show', _arguments: {'camaliga_title': 'content'} }
		defaultController: 'Content::list'
		aspects:
		  camaliga_title:
			type: PersistedAliasMapper
			tableName: 'tx_camaliga_domain_model_content'
			routeFieldName: 'slug'

Note 1: if you want to use the slug field, make sure it is not empty! You can use a scheduler task of camaliga to create values for the slug field.

Note 2: if you have configured 2 fields for the slug-field, '_' or '-' is used as separator and not '/', because of this problem:
https://forge.typo3.org/issues/87333


You can use categories in the routeEnhancers too, but this works only for categories of one parent-category.
If your categories have the parent category with the id 10, you can use this routeEnhancer::

    routeEnhancers:
      CatCamaliga:
        type: Extbase
        extension: Camaliga
        plugin: Pi1
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

In addition you need to define the template via TypoScript which should be used for the search action::

	plugin.tx_camaliga.settings.extended.template = Openstreetmap


Here some not so good / old examples::

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

In this example we use the city and the uid of a camaliga entry to show one entry at a Google map.
Note: here there is no convert to a good link-string.
Attention: The example will not work, if you use the "/" in the city field.

You can use another version too. The result is the same (but without /googlemaps)::

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

You find more about this things here: https://typo3worx.eu/2018/12/typo3-routing-extensions-and-enhancers/

RealUrl
^^^^^^^

In TYPO3 8 you can use RealUrl to modify the format the links to single-pages. Here an example for the RealUrl-config-file::

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