.. include:: /Includes.rst.txt


User Guide
----------

- First you need to include the static typoscript template.: Template →
  Info/Modify → Includes → Static include (From extensions) → Camaliga.

- Second: you should decide, which fields you want to use. Read the chapter Administration →
  Configuration via Extension-Manager. Thats very important for admins. Furthermore read the chapter
  Administration → Scheduler-Tasks if you are an admin.

- Now create a folder for the new elements. Change to that folder and into the list view. Create some elements:

.. figure:: /Images/camaliga_element.png

   Image 5: Create new elements

- There are several fields. You must fill out only the title. When done,
  add a new plugin to your page and select Camaliga. You will see a lot of FlexForm-options:

.. figure:: /Images/camaliga_plugin.png

   Image 6: FlexForm-options

- Select a template layout and make other settings:

.. figure:: /Images/camaliga_template.png

   Image 7: Select a layout

- Select the folder with the elements. If you don´t select something,
  the TypoScript setting is used. If there is no storagePid defined too,
  the current document will be used as storage pid.

.. figure:: /Images/camaliga_mode.png

   Image 8: Select the folder

- Done. You can make some more settings via TypoScript, e.g. the image width:

.. figure:: /Images/camaliga_typoscript.png

   Image 9: Some TypoScript settings

- See chapter Configuration for the TypoScript settings.

- If you want to use the enhanced features, then you must create some
  TYPO3 categories. There are many ways to use the categories. You can use them for a default selection or even in the frontend
  for the elements or for a user search.
  Note: the parent category is used as the description
  of the category in the exented view. Example: you have a category “Astrolabium” that
  describes your element, then you must use a parent category too that
  describes that category. In this case: “Type”. See image:

.. figure:: /Images/camaliga_cat.png

   Image 10: Create a category

.. figure:: /Images/camaliga_cat2.png

   Image 11: How to use categories

- Note: normally the categories are used as radio-button in the search.
  If you want to use checkboxes in the search, you need to write
  “checkbox” in the description of the parent category.
  Note: the parent categories are ignored in normal templates.
  Now you can use the categories in the camaliga-elements:

.. figure:: /Images/camaliga_cat3.png

   Image 12: Use the categories

- Finally you can select the categories that should be used in the plugin:

.. figure:: /Images/camaliga_category.png

   Image 13: Select the categories in the plugin-mode

- Another features is the parent-child-relation. This is important if
  you want to show on some pages only distinct elements (parents) and on
  a single page both elements. Otherwise you can use 2 different
  folders, but the relation has some other pros too.

.. figure:: /Images/camaliga_mother.png

   Image 14: Mother-Child-Relation


.. toctree::
   :maxdepth: 2
   :titlesonly:
   :glob:

   Faq/Index
