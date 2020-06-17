

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


Updating to TYPO3 6.2
---------------------

If you are using categories that you have used in TYPO3 6.0 or 6.1
you need to execute an update script when you are updating to TYPO3 6.2.

- Go to the Extensionmanager and search the Camaliga plugin.

- Click on the green execute icon in the right area.

- The script will perform this SQL statement:

  UPDATE sys_category_record_mm
  SET fieldname = 'categories'
  WHERE tablenames='tx_camaliga_domain_model_content' AND fieldname=''  


.. important::

   You need a camaliga version below 9.2.6 to use this update script. Furthermore you need the extension typo3db_legacy when using TYPO3 9 or 10.