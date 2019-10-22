

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
	      - { routePath: '/more/{camaliga_title}', _controller: 'Content::show', _arguments: {'camaliga_title': 'content'} }
	    defaultController: 'Camaliga::list'

limitToPages is optional. You can list there all your single-pages with camaliga elements.

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