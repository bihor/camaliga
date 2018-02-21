

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


Updating to camaliga 5.0.0
--------------------------

In version 5.0.0 of Camaliga a lot has changed. This concerns mainly the extended/advanced templates as well as the flexforms.
Because of the changes to the flexforms, you should run the update script in the Extension Manager!
The Upadte script updates the flexforms of each page where Camaliga is used.

In addition, the following templates are no longer selectable: MapExtended, AdGalleryExtended and GalleryviewExtended.
You can now use almost any template as an extended/advanced template. For this you have to add these lines:

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

The templates with the ending Extended.html are therefore no longer needed!
The above 3 templates are therefore removed in version 6.0.0,
because you can make the normal templates to advanced templates now.
More can be found in the chapter "Administration / Extended templates".
If you use one of the three templates, use soon a normal template
and add there the above lines and change the parameter template.
Activate it with TypoScript or FlexForms:

::

  plugin.tx_camaliga.settings.extended.enable = 1
