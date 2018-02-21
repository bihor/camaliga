

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


Bekannte Probleme
-----------------

- Die Kategorien eines Elements werden nicht sortiert ausgegeben.

- Die Kategorie-Relationen der übersetzten Elemente sind bugy:
  `https://forge.typo3.org/issues/61923
  <https://forge.typo3.org/issues/61923>`_

- Es werden keine zugeordneten Kategorien nach einem Update auf TYPO3 6.2 mehr angezeigt.
  Lösung: man muss das Update-Skript ausführen, um diesen TYPO3-Bug zu beheben.

- TypoScript-Links von TYPO3 8.7 verdaut der Link-Viewhelper von TYPO3 noch nicht.
  Das ist ein Bug in TYPO3 8.7.

- Wenn du einen Bug findest, melde ihn unter TYPO3 Forge:
  `http://forge.typo3.org/projects/show/extension-camaliga
  <http://forge.typo3.org/projects/show/extension-camaliga>`_
