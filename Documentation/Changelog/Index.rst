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


ChangeLog
---------

- Here you find all the changes through the versions.

==========  ============================================================================================================================
Version     Changes
==========  ============================================================================================================================
0.1.0       Initial upload to TER.
0.1.2       Google PicasaWeb-Import and FancyBox-Template added. Documentation updated.
1.0.0       More TypoScript- and FlexForms-Settings. Carousel-Example updated.
1.1.0       More examples added. Karussell-Import improoved.
1.2.0       Major bug fixed: wrong path to the templates. More examples added.
1.2.1       Test of the new ReST documentation.
1.2.3       Documentation updated. sxw-documentation removed. Category list sorted.
1.3.0       S Gallery and jQuery.Flipster template added.
            Template Carousel.html improved.
            More size variables added.
            Bug fixed: you can use the 0 in the FlexForms too.
1.4.0       Update-script added. Execute it, if you have used the categories in Typo3 6.0 or
            6.1, after updating to Typo3 6.2.
            Categories to FlexForms added.
2.0.0       Category localisation. categoryMode to the configuration added.
            {content.categories} renamed to {content.categoriesAndParents}. The first one shows you another list now!
            See chapter Administration/Categories.

            Template-Layouts added: you can use now more layouts in one template (see chapter Page TSconfig).

            3 new fields: phone, mobile and email.

            3 new HTML-Templates (SKDslider, OWL carousel 2, Responsive Carousel).

            Hooks for the extensions linkvalidator and ke_search added.
3.0.0       The category selection works now with all examples and not only with the extended ones.

            8 new fields for the single view: images and their caption.

            Folder-image added.

            Mostly all examples modified (only improvements, e.g. for Bootstrap 3).

            Successfully tested with Typo3 7.0 and the extension compatibility6. Requirements set to Typo3 6.2.2
3.1.0       Template Tab.html (for Bootstrap) and Lightslider.html added.

            Option added: automatic search for Latitude and Longitude.

            Posibility to extend the Camaliga-table-fields.

            Typo3 7 compatibility increased (does still not work with Typo3 7.1).
3.2.0       Bug fixed: tt_news import.
            Typo3 7 compatibility increased.

            New backend form: sortable thumbnail overview.

            New templates: Isotope, jQuery Full Width Image Slider, Coolcarousel.
4.0.0       Template-list in the FlexForms rearrenged. Demo-link to the templates added in this documentation.

            New FlexForms for Bootstrap components.

            New templates: slick carousel, Bootstrap Collapse/Accordion, Bootstrap Modal.

            ke_search-Indexer renamed.

            Several improvements (e.g. category-search in the normal templates).
5.0.0       Extended templates can be enabled now by an option. See chapter "Updating to camaliga 5.0.0".

            3 templates are now deprecated. See chapter "Updating to camaliga 5.0.0".

            Brand new: full-text search and proximity search.

            New backend modules: CSV-Import and mv_cooking-Import.

            New options: sort after crdate, settings.limit, settings.extended.*

            New templates: search (see chapter "Administration / Extended templates").

            ke_search-indexer renamed!

            Bug fixed: sorting of categories at normal templates.
6.0.0       Camaliga is now TYPO3 7 LTS compatible:

            - Vendor name changed. You need to flush the general cache.
            - old methods replaced.
            - path to the templates changed: please read the chapter Configuration/TypoScript reference and Updating to camaliga 6.0.0.

            Sheduler-task for CSV export added.

            Deprecated actions and templates removed: galleryviewExtended, adGalleryExtended and mapExtended.
6.0.3       TCA-problem with TYPO3 7 fixed (maybe you need to flush the general cache).

            double7-validator fixed.

            TS settings.googleMapsKey added.
6.0.6       TYPO3 7 bugfix.

            TS added: settings.maps.key, zoom, startLatitude and startLongitude. googleMapsKey removed.
6.1.0       Template Parallax added.

            Update-Script for camaliga-version 6.0.0 added.

            TYPO3 7 related bugfix again. New icon.
6.2.0       TypoScript and FlexForm settings added: settings.more.* Added variables: {contents.moduloBegin}, {contents.moduloEnd}.

            Added templates: Ekko.

            Modified templates: AdGallery, Flexslider2, Galleryview, Parallax, Slick.
            Some of this templates can now be controller by TypoScript or FlexForms too.

            3 templates are now deprecated: AdGalleryFancyBox, GalleryviewFancyBox, OwlSimpleModal. See chapter "Administration/HTML-Templates".

            Bugfix: validation error?
6.3.0       2 ViewHelpers added: content- and addPublicResources-ViewHelper. See chapter Administration/ViewHelper.

            The additional extension camaliga_addon is now available. See chapter Administration/Extend the Camaliga tables.

            Bugfix: minor things.
6.3.1       Bugfix: minor things.
6.4.0       Template Revolution-Slider and FractionSlider added.

            Additional fields can now be disabled in the Extension-Manager.

            Fulltextsearch searches now in custom1 too.

            Some small improvments.
7.0.0       TYPO3 6.2 compatibility removed.

            Templates AdGalleryFancyBox, GalleryviewFancyBox and OwlSimpleModal removed.

            TS seo.*, maps.language, maps.dontIncludeAPI and maps.includeRoute added.

            Partial for route planner added.

            The CSV-import moved to the Scheduler.

            The PicasaWeb-Import removed.

            New db-field: contact-person. More disable-options in the extension-configuration-manager.

            New variable in the templates avaiable: {content.links}
7.1.0       Setting extended.saveSearch added.
            TYPO3 8.7 compatibility added. Note: there is still no way to parse links from TYPO3 8.
7.1.6       Some minor bugs fixed. Some changes in the documentation.
8.0.0       Support for FAL images added. FAL images can be enabled at the configuration in the extension manager.

            All templates updated. E.g. links switched to f:link.typolink.

            The Owl template removed. Use the Owl2 template instead!

            mv_cooking import removed.
8.0.1       Bugs fixed: getImgConfig and tx_camaliga_double7 removed.
8.0.2       Update-script for wrong FAL relations. Please run the update-script in the extension manager if you use FAL.
8.1.0       Scheduler task added: you can now convert uploads-images to FAL-images! Read the chapter Administration → Scheduler-Tasks.

            Layout Backend7.html replaced with Backend.html.
            
            tx_camaliga_double7 completely removed, because TYPO3 has sometimes a cache-problem with it.
==========  ============================================================================================================================
