.. include:: /Includes.rst.txt


FAQ
^^^

- I need more options/settings! What can I do?

  You can define your own settings via TypoScript and you can use them in your templates! Here an example:

TypoScript:

::

   plugin.tx_camaliga.settings.myvar = 'showall'

HTML-Template / JavaScript:

::

   var myvar = {settings.myvar};

