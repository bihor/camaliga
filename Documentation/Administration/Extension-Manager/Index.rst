

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

At the configuration in the extension-manager you can set 3 things:

- You can define new fields, which you have created.

- You can disable all fields you don't need.

- You can decide, if you want to use FAL-images or the /uploads/tx_camaliga folder.
  Note: you need to uninstall and install the extension again, after changing this point,
  because TYPO3 changes the image configuration only then. Furthermore: you can move images from /uploads to FAL
  with a scheduler task. Read the chapter Administration → Scheduler-Tasks before you change a value!
  The default value is to use the /uploads/tx_camaliga folder!