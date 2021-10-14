

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


Administration
--------------

- After you decided which layout template you want to use, you should customize that HTML-template and the CSS-file.

- Copy this 2 folders into a folder in your fileadmin-folder:

::

  typo3conf/ext/camaliga/Resources/Private/Templates/Content
  typo3conf/ext/camaliga/Resources/Public/Css

- If you select e.g. the folder fileadmin/ext/camaliga, then set the
  path to that folder with TypoScript-Constants:

::

   plugin.tx_camaliga.view.templateRootPath = fileadmin/ext/camaliga/

- Or with TypoScript-Setup:

::

   plugin.tx_camaliga.view.templateRootPaths.1 = fileadmin/ext/camaliga/

- Note: the folder “Content” must be in that specified folder.

- Now you can edit the HTML-template-file. Which one? Its not hard to
  find the right one. If the template includes JS- or CSS-files, copy
  them to your fileadmin-folder and import them via TypoScript. They are
  included in the template only for the demonstration purpose. Remove
  them then from the template.Note: you find more information about each
  template at the beginning of a template and in the chapter tutorial.


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Extension-Manager/Index
   Html-templates/Index
   Extended-Templates/Index
   Maps/Index
   Umkreissuche/Index
   TemplateVariables/Index
   ViewHelper/Index
   Categories/Index
   TheBackendModule/Index
   Slug/Index
   Scheduler/Index
   Extend/Index
   Faq/Index
