

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

- Achtung: diese Anleitung ist veraltert! In TYPO3 9 gibt es einen internen Linkhandler, den man stattdessen benutzen sollte!

- Mittels der TypoScript-Konfiguration und über Seiten-TSconfig kann man es einrichten,
  dass man auch auf die Einzelansicht eines Camaliga-Elements direkt im RTE verlinken kann.

  Dazu braucht man allerdings noch eine Zusatz-Extension. Sie heißt "linkhandler". Leider ist die Extension im TER völlig veraltert.
  Für TYPO3 7.6 findet man eine gute Version von linkhandler hier:

  https://github.com/cobwebch/linkhandler

  Man muss nun Linkhandler auf eine andere Art verwenden als früher. Hier ein Beispiel:

- Im Seiten-TS-Config fügt man das hier hinzu (die 64 ersetzen!):

::

  TCEMAIN.linkHandler.camaliga {
    handler = Cobweb\Linkhandler\RecordLinkHandler
    label = Camaliga
    configuration {
        table = tx_camaliga_domain_model_content
        storagePid = 64
    }
    displayAfter = page
    scanAfter = page
  }


- Dann braucht man noch etwas TypoScript-Setup (die 112 ersetzen!):

::

  plugin.tx_linkhandler.camaliga {
    // Do not force link generation when the news records are hidden or deleted.
    forceLink = 0

    typolink {
        parameter = 112
        additionalParams = &tx_camaliga_pi1[content]={field:uid}&tx_camaliga_pi1[controller]=Content&tx_camaliga_pi1[action]=show
        additionalParams.insertData = 1
        useCacheHash = 1
    }
  }