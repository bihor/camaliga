

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


Kategorien
^^^^^^^^^^

- Diese Extension benutzt die normalen TYPO3-Kategorien. Es gibt verschiedene Arten diese zu benutzen.
  In {categories} sind alle Kategorien und deren Kinder zu sehen. Man kann sich das Array so im Template ansehen::
  
  <f:debug>{categories}</f:debug>

- Mit {content.categories} kann man die markierten Kategorien anzeigen.
  Mit {content.categoriesAndParents} kann man die markierten Kategorien und deren Mutter-Kategorie anzeigen.
  Beide Variablen sind Arrays. Sie enthalten diese Werte/Strings: uid, title und description.


.. important::

   Jede Kategorie muss einen "parent" haben! Man braucht also mind. 2 Levels, denn die Root-Kategorie kann nicht genutzt werden.
   Im erweiterten Modus braucht man sogar mind. 3 Levels.
  