# camaliga

version 12.1.0

A carousel/gallery/map/list extension that can use the TYPO3 categories and different jQuery-plugins like Slick. 
Bootstrap 5 support. Indexer for ke_search. Many features.

You find the documentation at docs.typo3.org:
https://docs.typo3.org/p/quizpalme/camaliga/master/en-us/
and
https://docs.typo3.org/p/quizpalme/camaliga/master/de-de/

New in version 11.0:
- Now for TYPO3 11 LTS too. Support for TYPO3 9 dropped.
- Using the Openstreetmap-API for finding a position is now possible too.
- Breaking: Template Fractionslider removed (use fp_fractionslider instead)! Template nanogallery2 added.
- Breaking: Slug-task replaced with a Slug-command. You should delete the task before updating.
- Breaking: the old variable {fal} removed.
- Bugfix: don´t ignore selected pages on category-search.
- Bugfix: content-Viewhelper repaired for composer-mode.
- Bugfix for TYPO3 11.5: folder css renamed to Css and plugin-icon is now in Resources/Public/Icons.
  
New in version 11.1:
- Replacement of the Viewhelper cam:addPublicResources. It is now deprecated. Use f:asset.css or f:asset.script instead.
- New method for changing the page title and the metatags. Utility PageTitle removed.
- Bugfix for TYPO3 11 (e.g. backend-layout adapted for TYPO3 11.) and PHP 8.

Version 11.2:
- ke_search Indexer needs now at least ke_search version 4.0.0.
- searchCoordinatesInBE added to the extension configuration. Searching for coordinates is now possible in the BE too.
- Important refactoring: clearing cache is necessary after update!
- Bugfix für PHP 8.

Version 11.3:
- Setting extendedCategoryMode added. Empty category entries will be ignored at the search options.
- Bugfix: metadata for images now working again.
- Bugfix: don´t ignore given storage PIDs in the show actions. Prevent viewing all camaliga-entries at one place.

Version 11.3.1:
- Bugfix for PHP 8.

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