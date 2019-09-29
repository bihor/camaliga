

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

Bei der Konfiguration im Extension-Manager kann man 3 Sachen einstellen:

- Man kann neu erzeugte Felder dort angeben.

- Man kann vorhandene Felder deaktivieren, wenn man sie nicht braucht.

- Man kann entscheiden, ob man FAL-Bilder oder den Ordner /uploads/tx_camaliga benutzen will.
  Dieser Punkt ist sehr entscheidend und kann später nur noch schwer geändert werden.
  Außerdem muss man die Extension deinstallieren und neu installieren, nachdem man hier eine Änderung vorgenommen hat.
  Das ist sehr wichtig, damit TYPO3 die Bild-Konfiguration umstellt.
  Lies das Kapitel Administration → Scheduler-Tasks, bevor du was umstellst!
  Beachte weiterhin: die Standardeinstellung ist, den Ordner /uploads/tx_camaliga zu benutzen. 