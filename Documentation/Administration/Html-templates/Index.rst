

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


HTML-Templates
^^^^^^^^^^^^^^

- This extension comes with a lot of example HTML-templates, but in most
  cases you need do download and use an external jQuery plugin for that template. You can include the JS- and CSS-files
  with the cam:addPublicResources-ViewHelper (see chapter ViewHelpers).

- The FlexForm template-list is separated in 3 sections: templates for which you do not need anything else,
  templates for which you need Twitter Bootstrap and templates for which you need an external plugin.

- Here you find a list of the templates and where you find
  more informations about the used jQuery plugin. You find installation hints in every HTML file
  (typo3conf/ext/camaliga/Resources/Private/Templates/Content/).

=========================  ==================================================================================================================
Template                   Information
=========================  ==================================================================================================================
AdGallery.html             Template that uses the AD Gallery plugin. Outdated!
                           Note: you must install AD Gallery separately.

                           Infos: https://archive.codeplex.com/?p=adgallery
Bootstrap.html             Template for the Twitter Bootstrap 4 Carousel.

                           Infos: https://getbootstrap.com/docs/4.2/components/carousel/

                           Demo: http://www.quizpalme.de/fotos/kunst/bootstrap-kunst.html
Carousel.html              A carousel that uses the Camaliga-plugin. Default template. Not responsive!
                           Note: all item-settings affect only here.

                           Demo: http://www.quizpalme.de/fotos/externe-fotos.html
CarouselSeparated.html     A template with 2 separated carousels that uses the Camaliga-plugin.
Collapse.html              Template for Twitter Bootstrap 4 Collapse/Accordion.

                           Infos: https://getbootstrap.com/docs/4.2/components/collapse/

                           Demo: http://www.quizpalme.de/reiseberichte/reiseempfehlungen/berge.html
Coolcarousel.html          Template that uses the Coolcarousel plugin.
                           Note: you must install Coolcarousel separately.

                           Infos: http://coolcarousels.frebsite.nl/c/66/
Ekko.html                  Template that uses the Bootstrap-Ekko-Lightbox. Not: you must install Ekko separately.
                           Runs only, if you set settings.more.setModulo=1

                           Infos: http://www.jqueryscript.net/lightbox/Simple-Gallery-Lightbox-Plugin-with-jQuery-Bootstrap-Ekko-Lightbox.html
Elastislide.html           Template that uses the Elastislide plugin.
                           Note: you must install Elastislide separately.

                           Infos: http://tympanus.net/codrops/2011/09/12/elastislide-responsive-carousel/

                           Demo: http://www.quizpalme.de/fotos/kunst/elastislide-kunst.html
Elegant.html               Template that uses the Elegant Responsive Pure CSS3 Slider.

                           Infos: https://codepen.io/rizkykurniawanritonga/full/shmwC

                           Demo: http://www.quizpalme.de/reiseberichte/rheinsteig/tour5.html
FancyBox.html              Template that uses only the FancyBox plugin.
                           Note: you must install FancyBox separately.

                           Infos: http://fancyapps.com/fancybox/

                           Demo: http://www.quizpalme.de/reiseberichte/malta-2014/gozo.html
Flexslider2.html           Template that uses the FlexSlider 2 plugin.
                           Note: you must install Flexslider 2 separately.

                           Infos: http://flexslider.woothemes.com/thumbnail-slider.html

                           Demo: http://www.quizpalme.de/fotos/kunst/flexslider-kunst.html
Flipster.html              Template that uses the jQuery.Flipster plugin.
                           Note: you must install Flexslider 2 separately.

                           Infos: https://github.com/drien/jquery-flipster

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/flipster.html
FractionSlider.html        Deprecated: use the extension fp_fractionslider instead.
                           Template that uses the FractionSlider-Plugin.
                           Note: you must install FractionSlider separat separately.

                           Infos: http://jacksbox.de/fractionslider-demos/background-animation/
Fullwidth.html             Template that uses the "jQuery Full Width Image Slider" plugin.
                           Note: you must install "jQuery Full Width Image Slider" separately.

                           Infos: https://github.com/JoeBonham/jQuery-Full-Width-Image-Slider
GalleryView.html           Template that uses the GalleryView plugin.
                           Note: you must install GalleryView separately.

                           Infos: https://github.com/jackwanders/GalleryView

                           Demo: http://www.quizpalme.de/fotos/jugendstil.html
Innerfade.html             Template that uses the Innerfade plugin.
                           Note: you must install Innerfade separately.

                           Infos: http://medienfreunde.com/lab/innerfade/

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/innerfade.html
Isotope.html               Template that uses the Isotope plugin.
                           Note: you must install Isotope separately.

                           Infos: http://isotope.metafizzy.co/

                           Demo: http://www.quizpalme.de/autor.html
Lightslider.html           Template that uses the lightSlider plugin.
                           Note: you must install jQuery lightSlider separately.

                           Infos: http://sachinchoolur.github.io/lightslider/index.html

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/lightslider.html
List.html                  List view.
ListExtended.html          List view with more fields.

                           Demo: http://www.quizpalme.de/astronomische-uhren/liste-astronomischer-uhren.html
Map.html                   A google map.

                           Demo: http://www.quizpalme.de/astronomische-uhren/astronomische-uhr/camaliga/showExtended/Content/415.html
Modal.html                 Template for Twitter Bootstrap 4 Modal. Use the field custom1 for the modal-button.

                           Infos: https://getbootstrap.com/docs/4.2/components/modal/

                           Demo: http://www.quizpalme.de/reiseberichte/reiseempfehlungen/alle-empfehlungen.html
Openstreetmap.html         Template that uses the Openstreetmap and Leaflet with markercluster.
                           Note: you must install Leaflet and Leaflet.markercluster separately.

                           Infos: https://github.com/Leaflet/Leaflet.markercluster

                           Demo: http://www.quizpalme.de/autor/thermensaunas.html
Owl2.html                  Template that uses the responsive Owl2 plugin.
                           Note: you must install OWL2 separately.

                           Infos: https://owlcarousel2.github.io/OwlCarousel2/

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/owl2.html
Parallax.html              Template that uses "Simple Parallax Scrolling".
                           Note 1: you must install Simple Parallax Scrolling separately.
                           Note 2: you need to set settings.img.with,.height,.thumbHeight and settings.more.speed.

                           Infos: http://pixelcog.github.io/parallax.js/

                           Demo: http://www.quizpalme.de/
Random.html                Shows a random element. Not cached.
Responsive.html            A simple responsive template.

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/responsive.html
ResponsiveCarousel.html    Template that uses the responsiveCarousel plugin.
                           Note: you must install responsiveCarousel separately.

                           Infos: http://basilio.github.io/responsiveCarousel/
Revolution.html            Deprecated: use the extension fp_fractionslider instead.
                           Template that uses the famous Revolution Slider.
                           Note: you must install the Revolution Slider separately.

                           Infos: https://codecanyon.net/item/slider-revolution-responsive-jquery-plugin/2580848
Roundabout.html            Template that uses the jQuery Roundabout plugin.
                           Note: you must install Roundabout separately.

                           Infos: https://github.com/fredleblanc/roundabout
Scrollable.html            Template that uses the old jQuery TOOLS Scrollable plugin.
                           Note: you must install jQuery TOOLS Scrollable separately.

                           Infos: http://jquerytools.org/demos/scrollable/index.html
Search.html                An advanced/extended template with all features! It contains a proximity search.
                           You need the opengeodb-tables for this template. Not cached.
                           The action of this template will be used for every search. You will need it,
                           if you enable the search/extended version!
Sgallery.html              Template that uses the S Gallery plugin.
                           Note: you must install S Gallery separately.

                           Infos: http://sarasoueidan.com/blog/s-gallery/
Show.html                  Single view.
ShowExtended.html          Single view with more fields.

                           Demo: http://www.quizpalme.de/astronomische-uhren/astronomische-uhr/camaliga/showExtended/Content/45.html
Skdslider.html             Template that uses the SKDslider plugin.
                           Note: you must install SKDslider separately.

                           Infos: http://dandywebsolution.com/skdslider/
Slick.html                 Template that uses the slick carousel plugin.
                           Note: you must install slick separately.

                           Infos: http://kenwheeler.github.io/slick/

                           Demo: http://www.quizpalme.de/reiseberichte/rheinsteig/tour1.html
Tab.html                   Template that uses the Bootstrap 4 Tabs.

                           Demo: http://www.quizpalme.de/autor/reiseziele.html
Test.html                  Only for tests...
=========================  ==================================================================================================================
