

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
AdGallery.html             Template, welches das AD Gallery-Plugin benutzt.
                           Achtung: man muss AD Gallery separat installieren.

                           Infos: http://adgallery.codeplex.com/documentation

                           Demo: http://www.quizpalme.de/fotos/kunst/adgallery.html
Bootstrap.html             Template für das Twitter Bootstrap 4 Carousel.

                           Infos: https://getbootstrap.com/docs/4.2/components/carousel/

                           Demo: http://www.quizpalme.de/fotos/kunst/bootstrap-kunst.html
Carousel.html              Karussell, welches das Camaliga-Plugin benutzt. Standard-Template.
                           Achtung: alle Elemente-Einstellungen wirken sich nur hier aus.

                           Demo: http://www.quizpalme.de/fotos/externe-fotos.html
CarouselSeparated.html     Ein Template, das 2 separate Karussells mit dem Camaliga-Plugin benutzt.
Collapse.html              Template für Twitter Bootstrap Collapse/Accordion.

                           Infos: http://getbootstrap.com/javascript/#collapse

                           Demo: http://www.quizpalme.de/reiseberichte/reiseempfehlungen/berge.html
Coolcarousel.html          Template, welches das Coolcarousel-Plugin benutzt.
                           Achtung: man muss Coolcarousel separat installieren.

                           Infos: http://coolcarousels.frebsite.nl/c/66/

                           Demo: http://www.quizpalme.de/fotos/kunst/coolcarousel-ansicht.html
Ekko.html                  Template, welches die Bootstrap-Ekko-Lightbox benutzt. Achtung: man muss Ekko separat installieren.
                           Funktioniert nur, wenn man settings.more.setModulo=1 setzt.

                           Infos: http://www.jqueryscript.net/lightbox/Simple-Gallery-Lightbox-Plugin-with-jQuery-Bootstrap-Ekko-Lightbox.html
Elastislide.html           Template, welches das Elastislide-Plugin benutzt.
                           Achtung: man muss Elastislide separat installieren.

                           Infos: http://tympanus.net/codrops/2011/09/12/elastislide-responsive-carousel/

                           Demo: http://www.quizpalme.de/fotos/kunst/elastislide-kunst.html
Elegant.html               Template, welches den "Elegant Responsive Pure CSS3 Slider" benutzt.
                           Funktioniert z.Z. aber nur mit genau 5 Elementen! Es sei denn man ändert die CSS-Datei.

                           Infos: https://codepen.io/rizkykurniawanritonga/full/shmwC

                           Demo: http://www.quizpalme.de/reiseberichte/rheinsteig/tour5.html
FancyBox.html              Template, welches nur das FancyBox-Plugin benutzt.
                           Achtung: man muss FancyBox separat installieren.

                           Infos: http://fancyapps.com/fancybox/

                           Demo: http://www.quizpalme.de/reiseberichte/malta-2014/gozo.html
Flexslider2.html           Template, welches das FlexSlider 2-Plugin benutzt.
                           Achtung: man muss Flexslider 2 separat installieren.

                           Infos: http://flexslider.woothemes.com/thumbnail-slider.html

                           Demo: http://www.quizpalme.de/fotos/kunst/flexslider-kunst.html
Flipster.html              Template, welches das jQuery.Flipster-Plugin benutzt.
                           Achtung: man muss jQuery.Flipster separat installieren.

                           Infos: https://github.com/drien/jquery-flipster

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/flipster.html
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

                           Demo: http://www.quizpalme.de/fotos/jugendstil.html
Innerfade.html             Template, welches das Innerfade-Plugin benutzt.
                           Achtung: man muss Innerfade separat installieren.

                           Infos: http://medienfreunde.com/lab/innerfade/

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/innerfade.html
Isotope.html               Template, welches das Isotope-Plugin benutzt.
                           Achtung: man muss Isotope separat installieren.

                           Infos: http://isotope.metafizzy.co/

                           Demo: http://www.quizpalme.de/autor.html
Lightslider.html           Template, welches das lightSlider-Plugin benutzt.
                           Achtung: man muss jQuery lighSlider separat installieren.

                           Infos: http://sachinchoolur.github.io/lightslider/index.html

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/lightslider.html
List.html                  Listen-Ansicht.
ListExtended.html          Listen-Ansicht mit mehr Feldern.

                           Demo: http://www.quizpalme.de/astronomische-uhren/liste-astronomischer-uhren.html
Map.html                   Eine "google map".

                           Demo: http://www.quizpalme.de/astronomische-uhren/astronomische-uhr/camaliga/showExtended/Content/415.html
Modal.html                 Template für Twitter Bootstrap Modal. Benutze das Feld custom1 für den Modal-Button.

                           Infos: http://getbootstrap.com/javascript/#modals

                           Demo: http://www.quizpalme.de/reiseberichte/reiseempfehlungen/alle-empfehlungen.html
Owl2.html                  Template, welches das responsive Owl2-Plugin benutzt.
                           Achtung: man muss OWL2 separat installieren.

                           Infos: https://owlcarousel2.github.io/OwlCarousel2/

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/owl2.html
Openstreetmap.html         Template, welches die Openstreetmap und Leaflet mit markercluster benutzt.
                           Achtung: man muss Leaflet und Leaflet.markercluster separat installieren.

                           Infos: https://github.com/Leaflet/Leaflet.markercluster

                           Demo: http://www.quizpalme.de/autor/thermensaunas.html
Parallax.html              Template, welches "Simple Parallax Scrolling" benutzt.
                           Achtung 1: man muss Simple Parallax Scrolling separat installieren.
                           Achtung 2: man muss settings.img.with,.height,.thumbHeight und settings.more.speed setzen.

                           Infos: http://pixelcog.github.io/parallax.js/

                           Demo: http://www.quizpalme.de/
Random.html                Zeigt ein zufälliges Element an. Wird nicht gecached.
Responsive.html            Ein simples responsives Template.

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/responsive.html
ResponsiveCarousel.html    Template, welches das responsiveCarousel-Plugin benutzt.
                           Achtung: man muss responsiveCarousel separat installieren.

                           Infos: http://basilio.github.io/responsiveCarousel/
Revolution.html            Deprecated: benutze stattdessen die Extension fp_fractionslider.
                           Template, welches den berühmten Revolution Slider benutzt.
                           Achtung: man muss den Revolution Slider separat installieren.

                           Infos: https://codecanyon.net/item/slider-revolution-responsive-jquery-plugin/2580848
Roundabout.html            Template, welches das Roundabout-Plugin benutzt.
                           Achtung: man muss Roundabout separat installieren.

                           Infos: http://fredhq.com/projects/roundabout/

                           Demo: http://www.quizpalme.de/fotos/externe-fotos/roundabout.html
Scrollable.html            Template, welches das alte jQuery TOOLS Scrollable-Plugin benutzt.
                           Achtung: man muss jQuery TOOLS Scrollable separat installieren.

                           Infos: http://jquerytools.org/demos/scrollable/index.html
Search.html                Ein erweitertes Template mit allen möglichen Features! Dazu gehört u.a
                           eine Umkreissuche, für die man opengeodb-Tabellen benötigt. Wird nicht gecached.
                           Man braucht dieses Template, wenn man die Suche einschaltet, denn es wird über diese
                           "action" gesucht.
Sgallery.html              Template, welches das S Gallery-Plugin benutzt.
                           Achtung: man muss S Gallery separat installieren.

                           Infos: http://sarasoueidan.com/blog/s-gallery/

                           Demo: http://www.quizpalme.de/fotos/kunst/sgallery.html
Show.html                  Einzelansicht.
ShowExtended.html          Einzelansicht mit mehr Feldern.

                           Demo: http://www.quizpalme.de/astronomische-uhren/astronomische-uhr/camaliga/showExtended/Content/45.html
Skdslider.html             Template, welches das SKDslider-Plugin benutzt.
                           Achtung: man muss SKDslider separat installieren.

                           Infos: http://dandywebsolution.com/skdslider/
Slick.html                 Template, welches das slick-Plugin benutzt.
                           Achtung: man muss slick separat installieren.

                           Infos: http://kenwheeler.github.io/slick/

                           Demo: http://www.quizpalme.de/reiseberichte/rheinsteig/tour1.html
Tab.html                   Template, welches Bootstrap 4 Tabs benutzt.

                           Demo: http://www.quizpalme.de/autor/reiseziele.html
Test.html                  Nur für Tests...
=========================  =========================================================================================================================
