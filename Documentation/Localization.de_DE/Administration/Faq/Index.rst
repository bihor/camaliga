

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


FAQ
^^^

- Wie kann ich Übersetzungstexte ändern? Hier ein TypoScript-Beispiel:

  ::

     plugin.tx_camaliga._LOCAL_LANG.de.more = Zur Website

- Wie kann ich Felder im Backend umbenennen oder verbergen?

  Siehe Kapitel “Konfiguration / Seiten-TSConfig”.
  Man kann viele optionale Felder auch über die Konfiguration im Extension-Manager ausschalten.

- Wie kann ich den Feld-Typ ändern?

  Siehe Kapitel "Administration / Camaliga-Tabellen erweitern"