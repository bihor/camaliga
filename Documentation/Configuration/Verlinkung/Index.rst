.. include:: /Includes.rst.txt


Linkhandler
^^^^^^^^^^^

With the TypoScript configuration and the Page TSconfig you can set it up,
that you can also link to the single view of a camaliga element directly in the RTE.

- In the page TSconfig add this (replace the 64!):

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

Note: till TYPO3 12 replace the handler with this one::

    handler = TYPO3\CMS\Recordlist\LinkHandler\RecordLinkHandler

- Then you need some TypoScript setup (replace 112!):

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

Note: replace tx_camaliga_show with tx_camaliga_pi1 in Camaliga version below 12.
Or replace it with tx_camaliga_showextended if you are not using the regular single-view.
