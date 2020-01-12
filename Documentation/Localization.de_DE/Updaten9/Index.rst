

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


Updaten auf Camaliga 9.0.0
--------------------------

In Camaliga 9.0.0 gibt es einige Änderungen bezüglich der Kategorien.
Zum einen wurde die Extension-Konfiguration categoryMode entfernt, da die Kategorien nicht mehr intern ermittelt werden, sondern
mittels Core-Methoden. Weiterhin kann man jetzt angeben, in welchem Order die Kategorien liegen.
Siehe dazu Kapitel "Konfiguration / TypoScript-Referenz". Mit der Einstellung::

 plugin.tx_camaliga.settings.category.storagePids = 100,123
 
kann man nun einen alternativen Ordner für die Kategorien definieren.

Es gibt aber auch eine "breaking"-Änderung. Also eine Änderung, die nicht abwärtskompatibel ist. Wenn die Variable
{content.categoriesAndParents} in einem Template benutzt wird, welches nicht in dieser Extension liegt, muss man an dieser Stelle hier::

  <f:for each="{catMMval.childs}" as="catMMchildVal" iteration="iteration"><f:if condition="{iteration.isLast}">
		<f:then>{catMMchildVal}.</f:then><f:else>{catMMchildVal}, </f:else></f:if></f:for>

noch ein ".title" bei catMMchildVal hinzufügen::

  <f:for each="{catMMval.childs}" as="catMMchildVal" iteration="iteration"><f:if condition="{iteration.isLast}">
		<f:then>{catMMchildVal.title}.</f:then><f:else>{catMMchildVal.title}, </f:else></f:if></f:for>

Grund: catMMchildVal von catMMval.childs ist jetzt ein Array (wie bei {content.categories}) und kein String mehr.
Verfügbar sind dabei: uid, title und description.

Deprecation: dieses Feature wird in Version 10.0 entfernt! Also das Skript noch mit Camaliga 9 ausführen!