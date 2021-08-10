# camaliga

version 11.0.0

A carousel/gallery/map/list extension that can use the TYPO3 categories and different jQuery-plugins like Slick. 
Bootstrap 4 support. Indexer for ke_search. Many features.

You find the documentation at docs.typo3.org:
https://docs.typo3.org/p/quizpalme/camaliga/master/en-us/
and
https://docs.typo3.org/p/quizpalme/camaliga/master/de-de/

New in version 11.0.0:
- Now for TYPO3 11.3 too. Support for TYPO3 9 dropped.
- Using the Openstreetmap-API for finding a position is now possible too.
- Breaking: Template Fractionslider removed (use fp_fractionslider instead)! Template nanogallery2 added.
- Breaking: Slug-task replaced with a Slug-command. You should delete the task before updating.
- Breaking: the old variable {fal} removed.
- Bugfix: don´t ignore selected pages on category-search.