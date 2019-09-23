

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


TypoScript-Reference
^^^^^^^^^^^^^^^^^^^^

- Here you can make some settings.

========================================  =============  =================================================================================  ===========
Property                                  Data type      Description                                                                        Default
========================================  =============  =================================================================================  ===========
view.templateRootPaths.0 & .1             string         Path to the main template.                                                         EXT:...

                                                         **Example:**

                                                         ::

                                                            plugin.tx_camaliga.view.templateRootPaths.1 = fileadmin/template/files/
view.partialRootPaths.0 & .1              string         Path to the partials of the template.                                              EXT:...
view.layoutRootPaths.0 & .1               string         Path to the layout template.                                                       EXT:...
persistence.storagePid                    int            Storage PID of the Camaliga elements. Can be defined by the plugin too.
features.rewrittenPropertyMapper          boolean        Use the rewritten property mapper?                                                 1
settings.defaultStoragePids               String / int   Comma seperated list of storage pids. This must be a subset of the
                                                         storagePids. Makes only sense if you use an extended template.

                                                         **Syntax:**

                                                         ::

                                                            [pid1],[pid2],[pid3]

                                                         **Example:**

                                                         ::

                                                            plugin.tx_camaliga.settings.defaultStoragePids = 354,349
settings.defaultCatIDs                    String / int   Default categories. Only elements with this category will be shown.
                                                         Can be changed in extended templates by the user.

                                                         **Syntax:**

                                                         ::

                                                            [cat1],[cat2],[cat3]

                                                         **Example:**

                                                         ::

                                                            plugin.tx_camaliga.settings.defaultCatIDs = 2,3
settings.listId                           int            ID of the list page.
settings.searchId                         int            ID of the page where the search should be. See chapter Admin./Ext. templ.
settings.showId                           int            ID of the single page.
settings.sortBy                           string         Sort by?                                                                           sorting

                                                         **Syntax:**

                                                         ::

                                                            sorting|crdate|tstamp|title|zip|city|country|custom1|custom2|custom3
settings.sortOrder                        string         Order by?                                                                          asc

                                                         **Syntax:**

                                                         ::

                                                            asc|desc
settings.limit                            integer        Number of elements to show (in list view). An SQL-parameter. 0=all.                0
settings.random                           boolean        Shuffle elements (random order, cached)?                                           0

                                                         0: no.

                                                         1: yes, shuffle the elements every time the cache is cleared.
settings.getLatLon                        boolean        Try to get the latitude and longitude from a google server                         0
                                                         for every entry with an address but no latitude?

                                                         0: no.

                                                         1: yes, search the position in the carousel, list or map template.
settings.onlyDistinct                     boolean        Show only distinct entries?                                                        0

                                                         0: no.

                                                         1: yes, show only the parent element when there are childs available or show a
                                                         child when there is no parent available.
settings.normalCategoryMode               string         At normal templates: how to use the categories for a search?                       and

                                                         and: and-mode.

                                                         or: or-mode.
overrideFlexformSettingsIfEmpty           boolean        Override FlexForm settings with TypoScript settings if the FlexForm                1
                                                         settings are empty?

                                                         0: no.

                                                         1: yes (works good, except for checkboxes).
settings.category.storagePids             string         Folder with categories. -1: all categories; empty: use normal folder.
settings.category.sortBy                  string         Sort categories by: sorting (default), tstamp, crdate, title or uid.
settings.category.orderBy                 string         Order categories by: asc (default) or desc.
settings.img.width                        int            Width of the images. Can be used in the template.                                  700
settings.img.height                       int            Height of the images. Can be used in the template.                                 500
settings.img.thumbWidth                   int            Thumbnail width of the images. Can be used in the template.                        195
settings.img.thumbHeight                  int            Thumbnail height of the images. Can be used in the template.                       139
settings.item.width                       int            Width of an (carousel-)item.                                                       195
settings.item.height                      int            Height of an (carousel-)item.                                                      290
settings.item.padding                     int            Padding of an (carousel-)item.                                                     0
settings.item.margin                      int            Marging of an (carousel-)item.                                                     10
settings.item.items                       int            Number of visible items (JavaScript-parameter).                                    3
settings.maps.key                         string         Google maps API key
settings.maps.language                    int            Google maps API language                                                           de
settings.maps.dontIncludeAPI              boolean        Dont include the JS with the Google maps API key?                                  0
settings.maps.includeRoute                boolean        Include a partial for a route planner?                                             0
settings.maps.clustering                  boolean        Clustering of markers?                                                             0
settings.maps.zoom                        int            Zoom level for the next 2 values                                                   5
settings.maps.startLatitude               float          Latitude for an empty map                                                          50.0
settings.maps.startLongitude              float          Longitude for an empty map                                                         10.0
settings.maps.tileLayer                   string         Path to a tile-layer-distributor (OpenStreetMap)                                   [OSM]
settings.maps.attribution                 string         Attribution for the tile layers (OpenStreetMap)                                    [OSM]
settings.maps.maxZoom                     int            Maximum zoom level                                                                 19
settings.seo.setTitle                     boolean        Change the site-title on a single site?                                            0

                                                         0: no. 1: yes, set the title of an element on a single page.
settings.seo.setIndexedDocTitle           boolean        Change the title in an sitemap of an single element?                               0

                                                         0: no. 1: yes, change the title in an sitemap.
settings.seo.setDescription               boolean        Change the meta-description on a single site?                                      0
                                                         Does not work if the metaseo-extension is installed.

                                                         0: no. 1: yes, set the shortdesc of an element as meta-description.
settings.seo.setOgTitle                   boolean        Add the og:title tag to the header on a single site?                               0

                                                         0: no; 1: yes.
settings.seo.setOgDescription             boolean        Add the og:description tag to the header on a single site?                         0

                                                         0: no; 1: yes.
settings.seo.setOgImage                   boolean        Add the og:image tag to the header on a single site if there is an image?          0

                                                         0: no. 1: yes, add the og:image meta-tag on a single page
settings.extended.enable                  boolean        Enable the extended template? See chapter "Extended templates"                     0

                                                         The following 3 settings only affect, if this option is turned on.
settings.extended.onlySearchForm          boolean        Initially only show an empty search form?                                          0
settings.extended.restrictSearch          boolean        Show fewer search options?                                                         0
settings.extended.radiusValues            string         Comma separated values for the select box at the radius search.

                                                         **Syntax:**

                                                         ::

                                                            [km1],[km2],[km3]

                                                         **Example:**

                                                         ::

                                                            plugin.tx_camaliga.settings.extended.radiusValues = 10,25,50,100

settings.extended.saveSearch              boolean        Save the search parameters in a cookie and load them later?                        0
settings.more.setModulo                   boolean        Add some modulo infos to each camaliga element?                                    0
                                                         {content.moduloBegin} and {content.moduloEnd} will be set. This values depends
                                                         on settings.item.items. See template Ekko.html for usage.
settings.more.addLightbox                 boolean        Add a lightbox to the Galleryview-template? Can be used in other templates to      0
                                                         like in Galleryview.html
settings.more.*                           mixed          Many options for silders like Flexslider2, Slick carousel, Galleryview.
settings.bootstrap.*                      mixed          See at the FlexForms and/or the Bootstrap homepage.
========================================  =============  =================================================================================  ===========

Example
~~~~~~~

Here an example with some settings:

::

   plugin.tx_camaliga {
       view.templateRootPaths.1 = fileadmin/template/camaliga/
       settings.defaultCatIDs = 4,5
       settings.showId = 410
       settings.listId = 402
   }

