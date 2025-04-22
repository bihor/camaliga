.. include:: /Includes.rst.txt


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
Bootstrap.html             Template for the Bootstrap 5 Carousel.

                           Infos: https://getbootstrap.com/docs/5.2/components/carousel/

                           Demo: https://www.quizpalme.de/foto-galerien/moderne-kunst/bootstrap-ansicht
Carousel.html              A carousel that uses the Camaliga-plugin. Default template. Not responsive!
                           Note: all item-settings affect only here.

                           Demo: https://www.quizpalme.de/foto-galerien/externe-fotos
CarouselSeparated.html     A template with 2 separated carousels that uses the Camaliga-plugin.
Collapse.html              Template for Bootstrap 5 Collapse/Accordion.

                           Infos: https://getbootstrap.com/docs/5.2/components/collapse/

                           Demo: https://www.quizpalme.de/reiseberichte/reiseempfehlungen/top-10-natur/berge
Create.html                Template after the new-action.
Ekko.html                  Template that uses the Bootstrap-Ekko-Lightbox.
                           Note: you must install Ekko separately.
                           Runs only, if you set settings.more.setModulo=1

                           Infos: http://www.jqueryscript.net/lightbox/Simple-Gallery-Lightbox-Plugin-with-jQuery-Bootstrap-Ekko-Lightbox.html
Elastislide.html           Template that uses the Elastislide plugin.
                           Note: you must install Elastislide separately.

                           Infos: http://tympanus.net/codrops/2011/09/12/elastislide-responsive-carousel/

                           Demo: https://www.quizpalme.de/foto-galerien/moderne-kunst/elastislide-ansicht
Elegant.html               Template that uses the Elegant Responsive Pure CSS3 Slider.

                           Infos: https://codepen.io/rizkykurniawanritonga/full/shmwC

                           Demo: https://www.quizpalme.de/reiseberichte/rheinsteig/unkel-linz
FancyBox.html              Template that uses only the FancyBox plugin.
                           Note: you must install FancyBox separately.

                           Infos: http://fancyapps.com/fancybox/

                           Demo: https://www.quizpalme.de/reiseberichte/malta-2014/gozo
Flexslider2.html           Template that uses the FlexSlider 2 plugin.
                           Note: you must install Flexslider 2 separately.

                           Infos: http://flexslider.woothemes.com/thumbnail-slider.html

                           Demo: https://www.quizpalme.de/foto-galerien/moderne-kunst/flexslider-ansicht
Flipster.html              Template that uses the jQuery.Flipster plugin.
                           Note: you must install Flexslider 2 separately.

                           Infos: https://github.com/drien/jquery-flipster

                           Demo: https://www.quizpalme.de/foto-galerien/externe-fotos/jqueryflipster-beispiel
Fullwidth.html             Template that uses the "jQuery Full Width Image Slider" plugin.
                           Note: you must install "jQuery Full Width Image Slider" separately.

                           Infos: https://github.com/JoeBonham/jQuery-Full-Width-Image-Slider
GalleryView.html           Template that uses the GalleryView plugin.
                           Note: you must install GalleryView separately.

                           Infos: https://github.com/jackwanders/GalleryView

                           Demo: https://www.quizpalme.de/foto-galerien/jugendstil-highlights
Innerfade.html             Template that uses the Innerfade plugin.
                           Note: you must install Innerfade separately.

                           Infos: https://github.com/wesbaker/jquery.innerFade

                           Demo: https://www.quizpalme.de/foto-galerien/externe-fotos/jqueryinnerfade-beispiel
Isotope.html               Template that uses the Isotope plugin.
                           Note: you must install Isotope separately.

                           Infos: http://isotope.metafizzy.co/

                           Demo: https://www.quizpalme.de/autor
Lightslider.html           Template that uses the lightSlider plugin.
                           Note: you must install jQuery lightSlider separately.

                           Infos: http://sachinchoolur.github.io/lightslider/index.html

                           Demo: https://www.quizpalme.de/foto-galerien/externe-fotos/lightslider-beispiel
List.html                  List view.
ListExtended.html          List view with more fields.

                           Demo: https://www.quizpalme.de/astronomische-uhren/liste-astronomischer-uhren
Magnific.html              Template that uses the "Magnific Popup" plugin.
                           Note 1: you must install Magnific Popup separately.
                           Note 2: you need to set settings.img.thumbWidth and .thumbHeight.

                           Infos: https://dimsemenov.com/plugins/magnific-popup/

                           Demo: https://www.quizpalme.de/astronomische-uhren/sonnenuhren
Map.html                   A google map.
Modal.html                 Template for Bootstrap 5 Modal. Use the field custom1 for the modal-button.

                           Infos: https://getbootstrap.com/docs/5.2/components/modal/

                           Demo: https://www.quizpalme.de/reiseberichte/reiseempfehlungen/alle-empfehlungen
Nanogallery2.html          Template for the jQuery nanogallery2 plugin.
                           Note: you must install nanogallery2 separately.

                           Infos: https://nanogallery2.nanostudio.org/
New.html                   Here you can create new elements in the FE.
Openstreetmap.html         Template that uses the Openstreetmap and Leaflet with markercluster.
                           Note: you must install Leaflet and Leaflet.markercluster separately.

                           Infos: https://github.com/Leaflet/Leaflet.markercluster

                           Demo: https://www.quizpalme.de/astronomische-uhren/kartenansicht-astr-uhren
Owl2.html                  Template that uses the responsive Owl2 plugin.
                           Note: you must install OWL2 separately.

                           Infos: https://owlcarousel2.github.io/OwlCarousel2/

                           Demo: https://www.quizpalme.de/foto-galerien/externe-fotos/owl2-beispiel
Parallax.html              Template that uses "Simple Parallax Scrolling".
                           Note 1: you must install Simple Parallax Scrolling separately.
                           Note 2: you need to set settings.img.with,.height,.thumbHeight and settings.more.speed.

                           Infos: http://pixelcog.github.io/parallax.js/

                           Demo: https://www.quizpalme.de/
Random.html                Shows a random element. Not cached.
Responsive.html            A simple responsive template.

                           Demo: https://www.quizpalme.de/foto-galerien/externe-fotos/responsive-beispiel
ResponsiveCarousel.html    Template that uses the responsiveCarousel plugin.
                           Note: you must install responsiveCarousel separately.

                           Infos: http://basilio.github.io/responsiveCarousel/
Roundabout.html            Template that uses the jQuery Roundabout plugin. Outdated!
                           Note: you must install Roundabout separately.

                           Infos: https://github.com/fredleblanc/roundabout
Search.html                An advanced/extended template with all features! It contains a proximity search.
                           You need the opengeodb-tables for this template. Not cached.
                           The action of this template will be used for every search. You will need it,
                           if you enable the search/extended version!
Sgallery.html              Template that uses the S Gallery plugin. Outdated!
                           Note: you must install S Gallery separately.

                           Infos: http://sarasoueidan.com/blog/s-gallery/
Show.html                  Single view.
ShowExtended.html          Single view with more fields.
Skdslider.html             Template that uses the SKDslider plugin. Outdated!
                           Note: you must install SKDslider separately.

                           Infos: http://dandywebsolution.com/skdslider/
Slick.html                 Template that uses the slick carousel plugin.
                           Note: you must install slick separately.

                           Infos: https://kenwheeler.github.io/slick/

                           Demo: https://www.quizpalme.de/reiseberichte/rheinsteig/bonn-oberdollendorf
Tab.html                   Template that uses the Bootstrap 5 Tabs.

                           Infos: https://getbootstrap.com/docs/5.2/components/navs-tabs/

                           Demo: https://www.quizpalme.de/autor/meine-reiseziele
Teaser.html                Template that shows only some selected camaliga elements.
=========================  ==================================================================================================================
