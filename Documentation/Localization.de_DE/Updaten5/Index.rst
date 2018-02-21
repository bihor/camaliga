

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


Updaten auf Camaliga 5.0.0
--------------------------

In der Version 5.0.0 von Camaliga hat sich einiges verändert.
Dies betrifft hauptsächlich die erweiterten Templates als auch die FlexForms.
Wegen den Änderungen an den FlexForms sollte man das Update-Skript im Extension-Manager ausführen!
Das Upadte-Skript aktualisiert die FlexForms einer jeden Seite, wo Camaliga benutzt wird.

Zudem sind nun folgende Templates nicht mehr auswählbar: MapExtended, AdGalleryExtended und GalleryviewExtended.
Man kann nun fast jedes Templates als ein erweitertes Template verwenden. Dazu muss man lediglich diese Zeilen hinzufügen:

::

  <f:if condition="{settings.extended.enable} == 1">
   <f:form action="search" name="camaliga">
	<div class="well">
	  <h3>{f:translate(key: 'options', default: 'Options')}</h3>
	  <f:render partial="Options" arguments="{_all}" />
	  <f:form.submit name="search" value="{f:translate(key: 'search', default: 'search')}" class="btn btn-primary" />
	  <f:form.hidden name="template" value="Galleryview" />
	</div>
   </f:form>
  </f:if>

Die Templates mit der Endung Extended.html werden deshalb nicht mehr benötigt!
Die oben genannten 3 Templates werden deshalb in der Version 6.0.0 entfernt,
da man nun die normalen Templates zu erweiterten Templates machen kann.
Mehr dazu findet man im Kapitel "Administration / Erweiterte Templates".
Falls du eines der drei Templates benutzt, benutzte demnächst ein normales Template
und füge dort die oben genannten Zeilen hinzu und ändere dabei beim Parameter template den Template-Namen.
Aktiviere es mit TypoScript oder den FlexForms:

::

  plugin.tx_camaliga.settings.extended.enable = 1
