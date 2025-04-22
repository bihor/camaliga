.. include:: /Includes.rst.txt


Categories
^^^^^^^^^^

- This extension uses the normal TYPO3 categories. There are different ways to use this categories.
  In {categories} are all categories and childs. You can use this in your template to see them::

  <f:debug>{categories}</f:debug>

- With {content.categories} you can display only the used categories.
  With {content.categoriesAndParents} you can display only the used categories with their parents.
  Both variables are arrays. They contain this values/strings: uid, title and description.


.. important::

   Every category need to have a parent! So you need at least 2 levels. The root-category can not be used.
   In the extended mode you will need at least 3 levels. With settings.extendedCategoryMode=1 you can search for
   parent-categories (level 2) too. They are then called "all" in the search-form with the radio-buttons.
