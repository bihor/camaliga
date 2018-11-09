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


Maps
^^^^

- There are 3 map templates: Map.html, Search.html and Openstreetmap.html. The first two displays a google map. The last one displays an Openstreetmap.
  Search.html is used for the uncached search action. You could use that action for everything that should be uncached.

- If you want to use the "Google maps", you need a Google API key. You find more infos here:
  https://developers.google.com/maps/documentation/javascript/get-api-key

- If you want to use the "Openstreetmap", you need an tile-server, because this template works with Leaflet.

  Note: not every tile-server is free of charge. You find some tile-providers here:
  https://leaflet-extras.github.io/leaflet-providers/preview/

  Note: you need to download the Leaflet-files from the Leaflet-server:
  http://leafletjs.com/download.html

  Note: the default path for the Leaflet-files are:
  fileadmin/Resources/Public/Styles/leaflet.css and fileadmin/Resources/Public/Scripts/Leaflet/leaflet.js.

- If you use "Google maps", you can enable an route planner too. This does not work for "Openstreetmap".

- You can use the feature "get geocode" only if you have a google account, because for this feature you need
  a google maps api key too. The geocoding works only if you specify a google maps api key.

- You can enable clustering of markers for both maps. If you use Openstreetmap, you need to download the leaflet.markercluster-files too:
  https://github.com/Leaflet/Leaflet.markercluster
  Note: the default path to the leaflet.markercluster-files are: fileadmin/Resources/Public/Scripts/Leaflet/Leaflet.markercluster/dist/MarkerCluster.css,
  fileadmin/Resources/Public/Scripts/Leaflet/Leaflet.markercluster/dist/MarkerCluster.Default.css and
  fileadmin/Resources/Public/Scripts/Leaflet/Leaflet.markercluster/dist/leaflet.markercluster.js.
