

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


Updaten auf Camaliga 6.0.0
--------------------------

Auch in Camaliga 6.0.0 gibt es wieder wichtige Änderungen, damit Camaliga kompatibel mit TYPO3 7 LTS ist.

Zusätzlich wurden folgende Templates und actions gelöscht: MapExtended, AdGalleryExtended und GalleryviewExtended
(siehe Updaten auf Camaliga 5.0.0).

Die wichtigste Änderung betrifft die Änderung zu den Template-Pfaden. Wenn du den Pfad zu den Templates mittels TypoScript Constants
bisher geändert hast, musst du nichts tun, aber wenn du ihn mittels TypoScript Setup geändert hast, musst du diese Änderung anpassen.
Alte Methode:

::

  plugin.tx_camaliga {
	view {
		templateRootPath = fileadmin/Resources/Camaliga/Template/
		partialRootPath = fileadmin/Resources/Camaliga/Partial/
		layoutRootPath = fileadmin/Resources/Camaliga/Layout/
	}
  }

Neue Methode:

::

  plugin.tx_camaliga {
	view {
		templateRootPaths.1 = fileadmin/Resources/Camaliga/Template/
		partialRootPaths.1 = fileadmin/Resources/Camaliga/Partial/
		layoutRootPaths.1 = fileadmin/Resources/Camaliga/Layout/
	}
  }

Du musst also nur "s.1" bei den views hinzufügen!

Du kannst das Update-Skript von Camaliga ausführen, um diese Änderung durchzuführen.
Das Update-Skript funktioniert aber nur dann, wenn du den Pfad zu den Templates direkt so änderst:
"plugin.tx_camaliga.view.partialRootPath ="
In allen anderen Fällen musst du den Pfad per Hand ändern.

Hinweis: du kannst meine Extension backendtools benutzen, um herauszufinden, wo du überall Camaliga verwendest.
Dies ist aber auch mit der Extension additional_reports machbar.