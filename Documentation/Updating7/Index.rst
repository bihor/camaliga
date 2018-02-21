

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


Updating to camaliga 7.0.0
--------------------------

3 templates are gone: AdGalleryFancyBox, GalleryviewFancyBox and OwlSimpleModal.
Use the regular templates with this setting instead::

 plugin.tx_camaliga.settings.more.addLightbox = 1