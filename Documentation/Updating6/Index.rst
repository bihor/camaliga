

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


Updating to camaliga 6.0.0
--------------------------

There are important changes in version 6.0.0 of Camaliga so it is now compatible with TYPO3 7 LTS.

In addition, the following templates and actions were removed: MapExtended, AdGalleryExtended and GalleryviewExtended
(see Updating to camaliga 5.0.0).

The most important change is how to change the path to your templates. If you change the path with TypoScript Constants
you have nothing to do, but if you change the path with TypoScript Setup, you need to change your settings!
Old method:

::

  plugin.tx_camaliga {
	view {
		templateRootPath = fileadmin/Resources/Camaliga/Template/
		partialRootPath = fileadmin/Resources/Camaliga/Partial/
		layoutRootPath = fileadmin/Resources/Camaliga/Layout/
	}
  }

New method:

::

  plugin.tx_camaliga {
	view {
		templateRootPaths.1 = fileadmin/Resources/Camaliga/Template/
		partialRootPaths.1 = fileadmin/Resources/Camaliga/Partial/
		layoutRootPaths.1 = fileadmin/Resources/Camaliga/Layout/
	}
  }

You need to add "s.1" to the views!

You can use the update-script of camaliga to do this job.
But the update-script worksonly, if you change the path to the templates directly like this:
"plugin.tx_camaliga.view.partialRootPath ="
In all other cases you need to change the path to the templates manualy.

Hint: you can use my extension backendtools to find all pages that uses the camaliga extension.
You can use the extension additional_reports too.