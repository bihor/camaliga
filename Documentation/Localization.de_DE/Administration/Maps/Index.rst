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


Karten
^^^^^^

- Es gibt 3 Templates mit Karten-Ausgabe aller Einträge: Map.html, Search.html und Openstreetmap.html.
  Die ersten beiden benutzen die "Google maps" und das letzte Template die "Openstreetmap".
  Search.html wird für die nicht gecachte Suche benutzt. Theoretisch kann man da alles reinpacken, was nicht gecached werden soll.

- Wenn du die "Google maps" benutzen willst, brauchst du noch einen Google API key. Hier findest du Infos dazu:
  https://developers.google.com/maps/documentation/javascript/get-api-key?hl=de

- Wenn du die "Openstreetmap" benutzen willst, brauchst du noch einen Tile-Server, denn dieses Template läuft mit Leaflet.

  Beachte: nicht alle Tile-Server kann man gratis benutzen. Eine Liste mit Tile-Servern findest du hier:
  https://leaflet-extras.github.io/leaflet-providers/preview/

  Beachte: du musst die Leaflet-Dateien selber downloaden von dem Leaflet-Server:
  http://leafletjs.com/download.html

  Beachte weiterhin: der Standard-Pfad zu den Leaflet-Dateien sieht so aus:
  fileadmin/Resources/Public/Styles/leaflet.css und fileadmin/Resources/Public/Scripts/Leaflet/leaflet.js.

- Wenn du "Google maps" benutzt, kannst du noch einen Routenplanner einschalten. Den gibt es bei "Openstreetmap" nicht.

- Für das Geocoding braucht man zwingend einen Google Maps API key, denn ohne geht nichts mehr. Wenn man keinen key angibt, bleibt der Punkt
  "Versuche die Position zu einer Adresse automatisch zu finden?" ergebnislos.

- Man kann auch das Clustering von Markern für beide Karten einschalten. Wenn du Openstreetmap benutzt, musst du noch die leaflet.markercluster-Dateien downloaden:
  https://github.com/Leaflet/Leaflet.markercluster

  Beachte: der Standard-Pfad zu den leaflet.markercluster-Dateien ist:
  fileadmin/Resources/Public/Scripts/Leaflet/Leaflet.markercluster/dist/MarkerCluster.css,
  fileadmin/Resources/Public/Scripts/Leaflet/Leaflet.markercluster/dist/MarkerCluster.Default.css und
  fileadmin/Resources/Public/Scripts/Leaflet/Leaflet.markercluster/dist/leaflet.markercluster.js.
