

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


Linkhandler
^^^^^^^^^^^

With the TypoScript configuration and the Page TSconfig you can set it up,
that you can also link to the single view of a camaliga element directly in the RTE.

- In the page TSconfig add this (replace the 64!):

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


- Then you need some TypoScript setup (replace 112!):

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