

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


Updating to camaliga 9.0.0
--------------------------

In Camaliga 9.0.0 are many changes related to the categories.
First the setting "categoryMode" in the extension-configuration was removed, because categories cames now from a core-method.
Furthermore you can now define an additional folder with the categories (see chapter "Configuration  / TypoScript-Reference")::

 plugin.tx_camaliga.settings.category.storagePids = 100,123
 
There is a "breaking"-change too. If you use the variable
{content.categoriesAndParents} in an own template outside this extension, you need to change this line::

  <f:for each="{catMMval.childs}" as="catMMchildVal" iteration="iteration"><f:if condition="{iteration.isLast}">
		<f:then>{catMMchildVal}.</f:then><f:else>{catMMchildVal}, </f:else></f:if></f:for>

You need to add ".title" at catMMchildVal::

  <f:for each="{catMMval.childs}" as="catMMchildVal" iteration="iteration"><f:if condition="{iteration.isLast}">
		<f:then>{catMMchildVal.title}.</f:then><f:else>{catMMchildVal.title}, </f:else></f:if></f:for>

Reason: catMMchildVal of catMMval.childs is now an array like in {content.categories}. You can use: uid, title and description.