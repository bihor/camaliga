

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


Scheduler-Tasks
^^^^^^^^^^^^^^^

- There are 3 Scheduler Tasks: import and export CSV files. You can configure many things in both tasks.
  The third task can move images from the /uploads/tx_camaliga-folder to FAL.
  Please make a backup of the camaliga-table and your uploads-images before you switch to FAL!
  After you have switched all yout images to FAL, you need to tell Camaliga that it should use the FAL images.
  Go to the extension manager and configure camaliga there. Click at the checkbox "Use images from FAL instead of images from uploads/".
  Now you must uninstall and install camaliga again.

- Finally you must change your customised templates! Merge it with the templates from the typo3conf-folder.
  Old example::

    <f:if condition="{content.image} != ''">
	  <f:image src="/uploads/tx_camaliga/{content.image}" maxHeight="{settings.img.thumbHeight}" alt="{content.title}" title="{content.title}" />
    </f:if>

- New example::

    <f:if condition="{content.falimage.uid}">
	  <f:image src="{content.falimage.uid}" maxHeight="{settings.img.thumbHeight}" alt="{content.title}" title="{content.title}" treatIdAsReference="1" />
    </f:if>

Note: deleted elements will be ignored!
