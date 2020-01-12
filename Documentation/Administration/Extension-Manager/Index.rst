

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


Configuration via Extension-Manager
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

At the configuration in the extension-manager you can set some things:

- You can define new fields, which you have created.

- You can disable all fields you don't need.

- You can decide, if you want to use FAL-images or the /uploads/tx_camaliga folder.
  Note: you need to uninstall and install the extension again, after changing this point,
  because TYPO3 changes the image configuration only then. Furthermore: you can move images from /uploads to FAL
  with a scheduler task. Read the chapter Administration → Scheduler-Tasks before you change a value!
  The default value is to use the /uploads/tx_camaliga folder!
  Note: using the uploads-folder is deprecated. This feature will be removed in version 10.0!

- You can make 2 settings for the extension ke_search. Both are important for the link-generation to one camaliga-entry::

  Do not switch controller and action at the ke_search hook?

  Action (e.g. show or list) for the ke_search hook, if it is not switched

- slugField1 and slugField1 defines the fields that should be used for the slug. Standard: title.
  "person city" means: person or city (if person is not set).