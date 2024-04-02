# camaliga

version 13.0.0

A carousel/gallery/map/list extension that can use the TYPO3 categories and different jQuery-plugins like Slick. 
Bootstrap 5 support. Indexer for ke_search. Many features.

You find the documentation at docs.typo3.org:
https://docs.typo3.org/p/quizpalme/camaliga/master/en-us/
and
https://docs.typo3.org/p/quizpalme/camaliga/master/de-de/


Version 12.0:
- Breaking: all plugins must be changed via an update-script (in the install-tool)!
- Breaking: the Viewhelper cam:addPublicResources was removed.
- Breaking: removed the templates AdGallery, Coolcarousel and Test.
- Breaking: the slug-task was removed.
- New configuration option: pluginForLinks (for ke_search).
- Note: if you use own templates, you need to add e.g. pluginName="show" to links to single-pages if pageUid="{settings.showId}" is set.
- Note: the backend-module is not ready yet.

Version 12.0.3:
- Allow the show-action at a showExtended-plugin. Allow the search-action at a map-plugin.
- Bugfix: plugin-updater.

Version 12.1:
- Important change: the Bootstrap templates supports now Bootstrap 5 instead of Bootstrap 4.

Version 13.0:
- Refactored with the rector tool.
- Setting errorId added: if no uid given, a redirect to an error page can be configured.
- Ignore validation in show and showExtended action removed!