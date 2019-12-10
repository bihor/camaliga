

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


ViewHelpers
^^^^^^^^^^^

- Camaliga comes with two ViewHelpers: one for the camaliga content and one to include JS- or CSS-files.

- The ViewHelper for the camaliga content can be used at single pages. Why?
  If you want to display camaliga-content on different places on your page, you can use this ViewHelper in your
  page-template to display some informations. You can use it like this in your page-template::

    {namespace cam=Quizpalme\Camaliga\ViewHelpers}

  And later on::

    <cam:content param="<h1>camaliga_title</h1><br><small>camaliga_shortdesc</small>" />

  You can use this variables in the param-parameter:
  camaliga_title, camaliga_shortdesc, camaliga_link, camaliga_image, camaliga_street, camaliga_zip, camaliga_city, camaliga_country,
  camaliga_phone, camaliga_mobile, camaliga_email, camaliga_latitude, camaliga_longitude, camaliga_custom1, camaliga_custom_2, camaliga_custom3.

- The second ViewHelper can be used similar. First set the namespace at the top of the template.
  Then use the ViewHelper to include JS- oder CSS-files like this::

    <cam:addPublicResources path="{f:uri.resource(path:'css/Carousel.css')}"></cam:addPublicResources>
    <cam:addPublicResources path="{f:uri.resource(path:'JavaScript/jquery.camaliga.js')}" compress="FALSE" footer="TRUE"></cam:addPublicResources>

  This is an example of the template Carousel.html. Use see, which parameters can be set.
  The ViewHelper indicates the files on the file-ending .css or .js. Second example with all parameters::

    <cam:addPublicResources path="fileadmin/Resources/Public/Scripts/galleryview/css/jquery.galleryview-3.0-dev.css"></cam:addPublicResources>
    <cam:addPublicResources path="fileadmin/Resources/Public/Scripts/galleryview/js/jquery.galleryview-3.0-dev.js" compress="FALSE" footer="TRUE" library=""></cam:addPublicResources>
