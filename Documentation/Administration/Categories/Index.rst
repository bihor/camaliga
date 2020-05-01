

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


Categories
^^^^^^^^^^

- This extension uses the normal TYPO3 categories. There are different ways to use this categories.
  In {categories} are all categories and childs. You can use this in your template to see them::
  
  <f:debug>{categories}</f:debug>

- With {content.categories} you can display only the used categories.
  With {content.categoriesAndParents} you can display only the used categories with their parents.
  Both variables are arrays. They contain this values/strings: uid, title and description.