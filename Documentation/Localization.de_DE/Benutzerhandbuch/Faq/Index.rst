.. include:: /Includes.rst.txt


FAQ
^^^

- Wie kann ich das Layout anpassen?

  Siehe Kapitel Administration.

- Was ist der Unterschied zwischen normalen und erweiterten Templates?

  Die erweiterten List- und Maps-Templates sind automatisch erweiterte Templates welche ein Suchformular beinhalten:
  Sortierung und Einschränkungen (benutzt auch die Kategorien). Das
  erweiterte Single-Template zeigt noch die Google-Karte und ggf. das Eltern- bzw. die Kinder-Elemente.
  Man braucht die erweiterten Templates nicht mehr, da man mittlerweile fast jedes Template erweitern kann.
  Mehr dazu siehe im Kapitel Administration → Erweiterte Templates

- Kann ich auch responsive Bilder wie picture und srcset benutzen?

  Ja, das geht. Ein srcset-Beispiel findest du im Template Bootstrap.html.

- Die Suche läuft nicht. Was ist los?

  Die Suche benutzt nur das Template, welches via "plugin.tx_camaliga.view.templateRootPaths.1" gesetzt wurde.
  Alle anderen Templates werden ignoriert. Weiterhin muss das Template Search.html vorhanden sein, auch wenn es nicht ausgegeben wird.

- Es läuft nicht! Wo kann der Fehler liegen?

  Es kann mehrere Ursachen geben. Als erstes sollte man sich die JavaScript-Konsole ansehen.
  Wie man dahin kommt, ist bei jedem Browser anders. Die JavaScript-Konsole wird in der Regel etwas sagen.
  Daraus kann man z.B. schliessen, dass jQuery noch nicht geladen wurde oder das das benötigte jQuery-Plugin fehlt.
  Falls der Aufruf des jQuery-Plugins fehl schlägt, vergewissere dich davon, dass es schon geladen wurde.
  Beachte dabei, dass du manche jQuery-Plugins erst downloaden musst! Falls du jQuery
  erst im Footer lädst, musst du sämtliche JavaScripts aus den HTML-Templates auch in den Footer-Bereich verschieben.
  Falls die JavaScript-Konsole nichts ausspuckt, sollte man einen Blick in den HTML-Quelltext werfen.
  Falls dort keine Elemente zu sehen sind, wurde wahrscheinlich vergessen, den Ordner mit den Elementen auszuwählen.
  Achtung: TYPO3 7 entfernt manchmal JavaScript, wenn es nicht mit CDATA gewrappt ist. TYPO3 8 hingegen entfernt alles
  was mit CDATA gewrappt ist. Entferne also alle CDATA, wenn du TYPO3 8 benutzt.

- Es läuft, aber es sieht elendig aus! Was ist los?

  Falls du ein externes jQuery-Plugin benutzt, musst du dich mit deren Dokumentation auseinander setzen.
  Ansonsten kannst du mich um Rat fragen...
