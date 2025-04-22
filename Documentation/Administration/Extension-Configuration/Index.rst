.. include:: /Includes.rst.txt


Configuration via Extension Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

At the extension configuration in the settings you can set some things:

- You can define new fields, which you have created.

- You can disable all fields you don't need.

- You can make 2 settings for the extension ke_search. Both are important for the link-generation to one camaliga-entry::

  Do not switch controller and action at the ke_search hook?

  Action (e.g. show or list) for the ke_search hook, if it is not switched

- slugField1 and slugField1 defines the fields that should be used for the slug. Standard: title.
  "person city" means: person or city (if person is not set).

- You can enable a search via Openstreetmap for the coordinates for a given address in the backend.
