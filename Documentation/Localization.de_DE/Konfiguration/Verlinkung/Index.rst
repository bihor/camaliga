.. include:: /Includes.rst.txt


Verlinkung
^^^^^^^^^^

- Mittels der TypoScript-Konfiguration und über Seiten-TSconfig kann man es einrichten,
  dass man auch auf die Einzelansicht eines Camaliga-Elements direkt im RTE verlinken kann.

- Im Seiten-TSconfig fügt man das hier hinzu (die 64 ersetzen!):

::

  TCEMAIN.linkHandler.tx_camaliga_domain_model_content {
    handler = TYPO3\CMS\Backend\LinkHandler\RecordLinkHandler
    label = Camaliga
    configuration {
        table = tx_camaliga_domain_model_content
        storagePid = 64
        hidePageTree = 1
    }
    scanAfter = page
  }

Achtung: bis TYPO3 12 muss es heißen::

    handler = TYPO3\CMS\Recordlist\LinkHandler\RecordLinkHandler

- Dann braucht man noch etwas TypoScript-Setup (die 112 ersetzen!):

::

  config.recordLinks.tx_camaliga_domain_model_content {
    typolink {
        parameter = 112
        additionalParams.data = field:uid
        additionalParams.wrap = &tx_camaliga_show[content]=|&tx_camaliga_show[controller]=Content&tx_camaliga_show[action]=show
        useCacheHash = 1
    }
    // Do not force link generation when the records are hidden or deleted.
    forceLink = 0
  }

Achtung: ersetze tx_camaliga_show mit tx_camaliga_pi1 in Camaliga-Versionen unter 12.
Oder ersetze es mit tx_camaliga_showextended, wenn du nicht die normale Single-Ansicht benutzt.
