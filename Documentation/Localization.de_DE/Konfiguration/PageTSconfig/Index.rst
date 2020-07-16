.. include:: Images.txt

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


Seiten-TSconfig
^^^^^^^^^^^^^^^

- Mittels der TypoScript-Konfiguration über Seiten-TSconfig kann man das Backend beeinflussen.
  Z.B. kann man mehrere Layouts für ein Template definieren.

Beispiel
~~~~~~~~

Hier werden 3 Layouts für ein Template definiert:

::

  tx_camaliga.templateLayouts {
    0 = Standard-Layout
    1 = Layout für die linke Spalte
    2 = Layout für die rechte Spalte
  }


- Man kann jede Nummer oder Beschreibung benutzen.
- Danach kann man über die FlexForms eins der Layouts auswählen.
- Zu guter letzt müssen die Layouts in einem beliebigen Template abgefragt werden.
  Die if-Abfrage gehört ins innere des Templates.

Beispiel
~~~~~~~~

Hier ein Beispiel mit 2 Layouts:

::

	<f:if condition="{settings.templateLayout} == 1">
		<f:then>
			<h3>{content.title}</h3>
		</f:then>
		<f:else>
			<p>Telefon-Nr.: {content.phone}<br />
			Handy-Nr.: {content.mobile}<br />
			E-Mail: <a href="mailto:{content.email}">{content.email}</a></p>
		</f:else>
	</f:if>

- Weiterhin kann man die TSconfig benutzen, um Camaliga-Felder umzubennen oder zu verstecken. Hier 2 wichtige Beispiele:

::

   TCEFORM.tx_camaliga_domain_model_content.custom1.label = Datum:
   TCEFORM.tx_camaliga_domain_model_content.custom2.disabled = 1

|img-17|

*Abbildung 17: Dies findet man im Ressources-Tab einer Seite*

- Man kann über die TSconfig auch unnötige FlexForm-Felder ausblenden. Ein Beispiel:

::

	TCEFORM {
		tt_content {
			pi_flexform {
				camaliga_pi1 {
					sDEF {
						switchableControllerActions.removeItems = Content->adGallery;Content->search;Content->show,Content->coolcarousel;Content->search;Content->show,Content->ekko;Content->search;Content->show,Content->elastislide;Content->search;Content->show,Content->fancyBox;Content->search;Content->show,Content->flipster;Content->search;Content->show,Content->fractionSlider;Content->search;Content->show,Content->fullwidth;Content->search;Content->show,Content->galleryview;Content->search;Content->show
					}
					sMORE {
						settings\.more\.setModulo.disabled = 1
						settings\.more\.slidesToShow.disabled = 1
						settings\.more\.slidesToScroll.disabled = 1
					}
				}
			}
		}
	}
