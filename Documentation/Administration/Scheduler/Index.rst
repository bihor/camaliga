.. include:: /Includes.rst.txt


Scheduler-Tasks
^^^^^^^^^^^^^^^

- There are 3/4 scheduler tasks/commands: import and export CSV files. You can configure many things in this both tasks.

- The third scheduler task can move images from the /uploads/tx_camaliga-folder to FAL.
  Please make a backup of the camaliga-table and your uploads-images before you switch to FAL!
  After you have switched all your images to FAL, you need to tell Camaliga that it should use the FAL images.
  Go to the extension manager and configure camaliga there. Click at the checkbox "Use images from FAL instead of images from uploads/".
  Now you must uninstall and install camaliga again (or delete all caches).

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

Note: this task was removed in version 10!

- The fourth scheduler task can fill the slug-field after an update. The field didn´t existed before camaliga 9.1.1 and that´s why you should use this task
  to fill the slug-field with values.

Note: this task was replaced in version 11 with a scheduler command (scheduler - Execute console commands)!
And this task was removed in version 12.
