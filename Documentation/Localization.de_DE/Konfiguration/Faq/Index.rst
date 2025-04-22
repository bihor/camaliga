.. include:: /Includes.rst.txt

FAQ
^^^

- Ich brauche mehr Konfigurationsmöglichkeiten! Was kann ich tun?

  Du kannst deine eigenen “settings” per TypoScript definieren und in den
  Templates benutzen! Hier ein Beispiel:

TypoScript:

::

   plugin.tx_camaliga.settings.myvar = 'showall'

HTML-Template / JavaScript:

::

   var myvar = {settings.myvar};

