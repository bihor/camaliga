

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


Verlinkung
^^^^^^^^^^

- Mittels der TypoScript-Konfiguration und über Seiten-TSconfig kann man es einrichten,
  dass man auch auf die Einzelansicht eines Camaliga-Elements direkt im RTE verlinken kann.

- Im Seiten-TSconfig fügt man das hier hinzu (die 64 ersetzen!):

::

  TCEMAIN.linkHandler.tx_camaliga_domain_model_content {
    handler = TYPO3\CMS\Recordlist\LinkHandler\RecordLinkHandler
    label = Camaliga
    configuration {
        table = tx_camaliga_domain_model_content
        storagePid = 64
        hidePageTree = 1
    }
    scanAfter = page
  }


- Dann braucht man noch etwas TypoScript-Setup (die 112 ersetzen!):

::

  config.recordLinks.tx_camaliga_domain_model_content {
    typolink {
        parameter = 112
        additionalParams.data = field:uid
        additionalParams.wrap = &tx_camaliga_pi1[content]=|&tx_camaliga_pi1[controller]=Content&tx_camaliga_pi1[action]=show
        useCacheHash = 1
    }
    // Do not force link generation when the records are hidden or deleted.
    forceLink = 0
  }