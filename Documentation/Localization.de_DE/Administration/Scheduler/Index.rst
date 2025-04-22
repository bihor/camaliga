.. include:: /Includes.rst.txt


Scheduler-Tasks
^^^^^^^^^^^^^^^

- Es gibt 3/4 Planer-Tasks/Kommandos: Import und Export von CSV-Dateien. In den Tasks kann man jede Menge Einstellungen vornehmen!
  Der 3. Planer kann Bilder aus dem /uploads/tx_camaliga-Ordner nach FAL verschieben/umändern.
  Bitte ein Backup der Camaliga-Tabellen und der uploads-Bilder machen, bevor du diesen Task benutzt!
  Nachdem man diesen Task ausgeführt hat, muss man noch Camaliga sagen, dass es FAL benutzen soll.
  Gehe zum Erweiterungsmanager und klicke auf Camaliga. Klicke dann auf "Use images from FAL instead of images from uploads/".
  Dann muss man Camaliga kurz deinstallieren und wieder neu installieren.

- Zu guter letzt musst du noch deine geänderten Templates anpassen! Merge sie mit den Templates aus dem typo3conf-Ordner.
  Altes Beispiel::

    <f:if condition="{content.image} != ''">
	  <f:image src="/uploads/tx_camaliga/{content.image}" maxHeight="{settings.img.thumbHeight}" alt="{content.title}" title="{content.title}" />
    </f:if>

- Neues Beispiel::

    <f:if condition="{content.falimage.uid}">
	  <f:image src="{content.falimage.uid}" maxHeight="{settings.img.thumbHeight}" alt="{content.title}" title="{content.title}" treatIdAsReference="1" />
    </f:if>

Beachte: gelöschte Elemente werden ignoriert!

Beachte: dieser Task wurde in Version 10 gelöscht!

- Der 4. Task kann das slug-Feld befüllen. Da es vor camaliga 9.1.1 nicht existierte, ist es bei alten Einträgen leer.
  Dieser Task befüllt alle slug-Felder mit Werten.

Achtung: dieser Task wurde in Version 11 durch einen Command ersetzt (scheduler - Execute console commands)!
Und der Task wurde in Version 12 gelöscht!
