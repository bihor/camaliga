

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


Konfiguration via Extension-Manager
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Bei der Konfiguration im Extension-Manager kann man verschiedene Sachen einstellen:

- Man kann neu erzeugte Felder dort angeben.

- Man kann vorhandene Felder deaktivieren, wenn man sie nicht braucht.

- Man kann einstellen, wie die Links zu einem Camaliga-Eintrag bei ke_search gebildet werden sollen::

  Do not switch controller and action at the ke_search hook?

  Action (e.g. show or list) for the ke_search hook, if it is not switched

- Bei slugField1 und slugField1 kann man definieren, welche Felder für den Slug benutzt werden sollen.
  "person city" meint: person oder city (falls city nicht gesetzt ist).