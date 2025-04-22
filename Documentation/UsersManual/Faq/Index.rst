.. include:: /Includes.rst.txt


FAQ
^^^

- How can I customize the layout?

  See chapter administration.

- What is the difference between a normal and an extended template?

  The extended list- and maps-templates are automatic extended templates which contains a search form:
  sorting and restriction (uses the categories too).
  The extended single-template displays a google map and the parent or child elements too.
  Note 1: the extended version is not so fast as the normal version. Use it only if you need it.
  Note 2: you dont need the extended templates, because you can extend nearly every template.
  See chapter Administration → Extended templates for more information.

- Can I use responsive images like picture or srcset?

  Yes, you can. You find an srcset-example in the template Bootstrap.html.

- The search doesn´t work. Whats wrong?

  The search uses only the template set via "plugin.tx_camaliga.view.templateRootPaths.1".
  All other templates will be ignored. Furthermore you need the template Search.html even it isn´t used.

- Its not running! Whats wrong?

  There could be more reasons. First you should take a look at the JavaScript console. What does it say?
  If the call to the jQuery plugin fails: is it allready loaded? Note that you must download external jQuery plugins
  first. If you are loading jQuery only in the footer of your page, you must move all the JavaScript from the HTML
  templates to the footer too!
  If the console says nothing, then take a look at the HTML source code.
  If there are no elements you may have forgot to select the folder with the elements in the plugin.
  Note: TYPO3 7 sometimes removes JS which is not wraped with CDATA. TYPO3 8 removes everything that is wraped with CDATA.
  So, remove the CDATA in the templates, when you are using TYPO3 8.

- It runs, but it looks ugly! Whats wrong?

  If you are using an external jQuery plugin, you must read that documentation carefully.
  Otherwise you can ask me...
