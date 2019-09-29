

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

Note: this here is not uptodate! TYPO3 9 has an own Linkhandler extension. Use that one instead! 

With the TypoScript configuration and the Page TSconfig you can set it up,
that you can also link to the single view of a Camaliga element directly in the RTE.

For this you need an additional extension. It is called "linkhandler". Unfortunately, the extension in TER is completely outdated.
For TYPO3 7.6 you find a good version of linkhandler here:

https://github.com/cobwebch/linkhandler

There is a new method for using the linkhandler. Here is an example:

- In the page TSConfig add this (replace the 64!):

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


- Then you need some TypoScript setup (replace 112!):

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