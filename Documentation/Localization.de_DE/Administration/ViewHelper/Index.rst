.. include:: /Includes.rst.txt


ViewHelpers
^^^^^^^^^^^

- Camaliga besitzt(e) einen ViewHelper für Camaliga-Elemente und einen ViewHelper um JS- oder CSS-Dateien zu laden.

- Den ViewHelper für Camaliga-Elemente kann man bei Seiten-Templates benutzen. Wozu?
  Nun, wenn man Infos eines Elements an verschiedenen Stellen darstellen will, muss man nicht mehrere Plugins benutzen.
  Stattdessen kann man auch das Seiten-Template anpassen und dort diesen ViewHelper benutzen.
  Das ganze funktioniert freilich nur auf Camaliga-Single-Seiten und ist nützlich, wenn man z.B. den Titel
  in einem Jumbotron darstellen will. Man kann den ViewHelper wie folgt im Seiten-Template benutzen. Am Anfang::

    {namespace cam=Quizpalme\Camaliga\ViewHelpers}

  Und weiter unten::

    <cam:content param="<h1>camaliga_title</h1><br><small>camaliga_shortdesc</small>" />

  Man kann diese param-Parameter benutzen:
  camaliga_title, camaliga_shortdesc, camaliga_link, camaliga_image, camaliga_street, camaliga_zip, camaliga_city, camaliga_country,
  camaliga_phone, camaliga_mobile, camaliga_email, camaliga_latitude, camaliga_longitude, camaliga_custom1, camaliga_custom_2, camaliga_custom3.

- Den anderen ViewHelper kann man auf ähnliche Weise benutzen. Diesen Viewhelper sollte man aber NICHT mehr benutzen, da es
  ab TYPO3 10 eine Alternative dazu gibt, nämlich Viewhelpers aus dem TYPO3-Core:
  https://docs.typo3.org/other/typo3/view-helper-reference/master/en-us/typo3/fluid/latest/Asset/Script.html
  und
  https://docs.typo3.org/other/typo3/view-helper-reference/master/en-us/typo3/fluid/latest/Asset/Css.html

  In TYPO3 9 kann man ihn noch benutzen. Ab TYPO3 12 steht er nicht mehr zur Verfügung!
  Zuerst setzt man den Namespace wie oben und weiter unten nutzt man ihn dann so zum einbinden von JS- oder CSS-Dateien::

    <cam:addPublicResources path="{f:uri.resource(path:'Css/Carousel.css')}"></cam:addPublicResources>
    <cam:addPublicResources path="{f:uri.resource(path:'JavaScript/jquery.camaliga.js')}" compress="FALSE" footer="TRUE"></cam:addPublicResources>

  Das Beispiel stammt aus dem Carousel.html Template. Da kann man also schon mal sehen, welche Parameter man angeben kann.
  Die CSS- und JS-Dateien werden Anhand der Endung erkannt. Zweites Beispiel mit allen Parametern::

    <cam:addPublicResources path="fileadmin/Resources/Public/Scripts/galleryview/css/jquery.galleryview-3.0-dev.css"></cam:addPublicResources>
    <cam:addPublicResources path="fileadmin/Resources/Public/Scripts/galleryview/js/jquery.galleryview-3.0-dev.js" compress="FALSE" footer="TRUE" library=""></cam:addPublicResources>
