

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

- Diese Extension kommt mit zahlenreichen HTML-Beispiel-Templates, aber
  in vielen Fällen muss man dafür erst noch ein externes jQuery-Plugin downloaden und einbinden. Letzteres macht man am besten
  mit dem cam:addPublicResources-ViewHelper (siehe Kapitel ViewHelpers).

- Bei den FlexForms ist die Template-Auswahl-Liste in 3 Teile gegliedert: Templates für die man kein Plugin braucht,
  Templates für die man Bootstrap braucht und Templates für die man ein externes Plugin braucht.

- Hier nun eine Liste der HTML-Templates und wo man weitere Informationen zum benutzen jQuery-Plugin findet.
  Installationsanleitungen findet man im jeweiligen Template
  (typo3conf/ext/camaliga/Resources/Private/Templates/Content/).

=========================  =========================================================================================================================
Template                   Information
=========================  =========================================================================================================================
AdGallery.html             Template, welches das AD Gallery-Plugin benutzt. Veraltert!
                           Achtung: man muss AD Gallery separat installieren.

                           Infos: http://adgallery.codeplex.com/documentation
Bootstrap.html             Template für das Twitter Bootstrap 4 Carousel.

                           Infos: https://getbootstrap.com/docs/4.2/components/carousel/

                           Demo: http://www.quizpalme.de/foto-galerien/moderne-kunst/bootstrap-ansicht
Carousel.html              Karussell, welches das Camaliga-Plugin benutzt. Standard-Template. Nicht responsive!

                           Demo: http://www.quizpalme.de/foto-galerien/externe-fotos
CarouselSeparated.html     Ein Template, das 2 separate Karussells mit dem Camaliga-Plugin benutzt.
Collapse.html              Template für Twitter Bootstrap 4 Collapse/Accordion.

                           Infos: https://getbootstrap.com/docs/4.2/components/collapse/

                           Demo: http://www.quizpalme.de/reiseberichte/reiseempfehlungen/top-10-natur/berge
Coolcarousel.html          Template, welches das Coolcarousel-Plugin benutzt.
                           Achtung: man muss Coolcarousel separat installieren.

                           Infos: http://coolcarousels.frebsite.nl/c/66/
Ekko.html                  Template, welches die Bootstrap-Ekko-Lightbox benutzt. Achtung: man muss Ekko separat installieren.
                           Funktioniert nur, wenn man settings.more.setModulo=1 setzt.

                           Infos: http://www.jqueryscript.net/lightbox/Simple-Gallery-Lightbox-Plugin-with-jQuery-Bootstrap-Ekko-Lightbox.html
Elastislide.html           Template, welches das Elastislide-Plugin benutzt.
                           Achtung: man muss Elastislide separat installieren.

                           Infos: http://tympanus.net/codrops/2011/09/12/elastislide-responsive-carousel/

                           Demo: http://www.quizpalme.de/foto-galerien/moderne-kunst/elastislide-ansicht
Elegant.html               Template, welches den "Elegant Responsive Pure CSS3 Slider" benutzt.

                           Infos: https://codepen.io/rizkykurniawanritonga/full/shmwC

                           Demo: http://www.quizpalme.de/reiseberichte/rheinsteig/unkel-linz
FancyBox.html              Template, welches nur das FancyBox-Plugin benutzt.
                           Achtung: man muss FancyBox separat installieren.

                           Infos: http://fancyapps.com/fancybox/

                           Demo: http://www.quizpalme.de/reiseberichte/malta-2014/gozo
Flexslider2.html           Template, welches das FlexSlider 2-Plugin benutzt.
                           Achtung: man muss Flexslider 2 separat installieren.

                           Infos: http://flexslider.woothemes.com/thumbnail-slider.html

                           Demo: http://www.quizpalme.de/foto-galerien/moderne-kunst/flexslider-ansicht
Flipster.html              Template, welches das jQuery.Flipster-Plugin benutzt.
                           Achtung: man muss jQuery.Flipster separat installieren.

                           Infos: https://github.com/drien/jquery-flipster

                           Demo: http://www.quizpalme.de/foto-galerien/externe-fotos/jqueryflipster-beispiel
FractionSlider.html        Deprecated: benutze stattdessen die Extension fp_fractionslider.
                           Template, welches das FractionSlider-Plugin benutzt.
                           Achtung: man muss den FractionSlider separat installieren.

                           Infos: http://jacksbox.de/fractionslider-demos/background-animation/
Fullwidth.html             Template, welches das "jQuery Full Width Image Slider"-Plugin benutzt.
                           Achtung: man muss "jQuery Full Width Image Slider" separat installieren.

                           Infos: https://github.com/JoeBonham/jQuery-Full-Width-Image-Slider
GalleryView.html           Template, welches das GalleryView-Plugin benutzt.
                           Achtung: man muss GalleryView separat installieren.

                           Infos: https://github.com/jackwanders/GalleryView

                           Demo: http://www.quizpalme.de/foto-galerien/jugendstil-highlights
Innerfade.html             Template, welches das Innerfade-Plugin benutzt.
                           Achtung: man muss Innerfade separat installieren.

                           Infos: http://medienfreunde.com/lab/innerfade/

                           Demo: http://www.quizpalme.de/foto-galerien/externe-fotos/jqueryinnerfade-beispiel
Isotope.html               Template, welches das Isotope-Plugin benutzt.
                           Achtung: man muss Isotope separat installieren.

                           Infos: http://isotope.metafizzy.co/

                           Demo: http://www.quizpalme.de/autor
Lightslider.html           Template, welches das lightSlider-Plugin benutzt.
                           Achtung: man muss jQuery lighSlider separat installieren.

                           Infos: http://sachinchoolur.github.io/lightslider/index.html

                           Demo: http://www.quizpalme.de/foto-galerien/externe-fotos/lightslider-beispiel
List.html                  Listen-Ansicht.
ListExtended.html          Listen-Ansicht mit mehr Feldern.

                           Demo: http://www.quizpalme.de/astronomische-uhren/liste-astronomischer-uhren
Map.html                   Eine "google map".
Modal.html                 Template für Twitter Bootstrap 4 Modal. Benutze das Feld custom1 für den Modal-Button.

                           Infos: https://getbootstrap.com/docs/4.2/components/modal/

                           Demo: http://www.quizpalme.de/reiseberichte/reiseempfehlungen/alle-empfehlungen
Openstreetmap.html         Template, welches die Openstreetmap und Leaflet mit markercluster benutzt.
                           Achtung: man muss Leaflet und Leaflet.markercluster separat installieren.

                           Infos: https://github.com/Leaflet/Leaflet.markercluster

                           Demo: http://www.quizpalme.de/astronomische-uhren/kartenansicht-astr-uhren
Owl2.html                  Template, welches das responsive Owl2-Plugin benutzt.
                           Achtung: man muss OWL2 separat installieren.

                           Infos: https://owlcarousel2.github.io/OwlCarousel2/

                           Demo: http://www.quizpalme.de/foto-galerien/externe-fotos/owl2-beispiel
Parallax.html              Template, welches "Simple Parallax Scrolling" benutzt.
                           Achtung 1: man muss Simple Parallax Scrolling separat installieren.
                           Achtung 2: man muss settings.img.with,.height,.thumbHeight und settings.more.speed setzen.

                           Infos: http://pixelcog.github.io/parallax.js/

                           Demo: http://www.quizpalme.de/
Random.html                Zeigt ein zufälliges Element an. Wird nicht gecached.
Responsive.html            Ein simples responsives Template.

                           Demo: http://www.quizpalme.de/foto-galerien/externe-fotos/responsive-beispiel
ResponsiveCarousel.html    Template, welches das responsiveCarousel-Plugin benutzt.
                           Achtung: man muss responsiveCarousel separat installieren.

                           Infos: http://basilio.github.io/responsiveCarousel/
Revolution.html            Deprecated: benutze stattdessen die Extension fp_fractionslider.
                           Template, welches den berühmten Revolution Slider benutzt.
                           Achtung: man muss den Revolution Slider separat installieren.

                           Infos: https://codecanyon.net/item/slider-revolution-responsive-jquery-plugin/2580848
Roundabout.html            Template, welches das jQuery-Roundabout-Plugin benutzt. Veraltert!
                           Achtung: man muss Roundabout separat installieren.

                           Infos: https://github.com/fredleblanc/roundabout
Scrollable.html            Template, welches das alte jQuery TOOLS Scrollable-Plugin benutzt. Veraltert!
                           Achtung: man muss jQuery TOOLS Scrollable separat installieren.

                           Infos: http://jquerytools.org/demos/scrollable/index.html
Search.html                Ein erweitertes Template mit allen möglichen Features! Dazu gehört u.a
                           eine Umkreissuche, für die man opengeodb-Tabellen benötigt. Wird nicht gecached.
                           Man braucht dieses Template, wenn man die Suche einschaltet, denn es wird über diese
                           "action" gesucht.
Sgallery.html              Template, welches das S Gallery-Plugin benutzt. Veraltert!
                           Achtung: man muss S Gallery separat installieren.

                           Infos: http://sarasoueidan.com/blog/s-gallery/
Show.html                  Einzelansicht.
ShowExtended.html          Einzelansicht mit mehr Feldern.
Skdslider.html             Template, welches das SKDslider-Plugin benutzt. Veraltert!
                           Achtung: man muss SKDslider separat installieren.

                           Infos: http://dandywebsolution.com/skdslider/
Slick.html                 Template, welches das slick-Plugin benutzt.
                           Achtung: man muss slick separat installieren.

                           Infos: http://kenwheeler.github.io/slick/

                           Demo: http://www.quizpalme.de/reiseberichte/rheinsteig/bonn-oberdollendorf
Tab.html                   Template, welches Bootstrap 4 Tabs benutzt.

                           Demo: http://www.quizpalme.de/autor/meine-reiseziele
Test.html                  Nur für Tests...
=========================  =========================================================================================================================
