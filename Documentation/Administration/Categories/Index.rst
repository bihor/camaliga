..  include:: Images.txt

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
  With {content.categories} you can display only the used categories.
  With {content.categoriesAndParents} you can display only the used categories with their parents.

- Furthermode you can configure this extension. This is only important, if you use more than one language. You have 2 options:
  use the category-relations of the translated elements or of the original elements.
  Its recommended to ignore the category-relations of the translated camaliga-elements because of a TYPO3-bug.
  TYPO3 looses the relations to the translated categories when saving a translated camaliga-element.
  When this bug is fixed, you can configure the extension to use the relations of the translated elements.

|img-17|

*Image 15: Relations of the categories*

- You find more about categories in the chapter "User manual".