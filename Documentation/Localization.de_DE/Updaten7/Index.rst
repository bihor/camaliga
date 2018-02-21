

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


Updaten auf Camaliga 7.0.0
--------------------------

Auch in Camaliga 7.0.0 gibt es wieder einige Änderungen. 3 weitere Templates wurden entfernt:
AdGalleryFancyBox, GalleryviewFancyBox und OwlSimpleModal.
Benutze stattdessen die normalen Templates mit dieser Einstellung::

 plugin.tx_camaliga.settings.more.addLightbox = 1
