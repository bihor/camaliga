.. include:: /Includes.rst.txt


Template variables
^^^^^^^^^^^^^^^^^^

- You can use some variables in the Fluid template. You find an
  explanation here. First you find the variables available in the normal
  templates, then those you can use additional in the extended templates.

=========================  ============================================================================================
Variable                   Description (examples in List.html and Show.html)
=========================  ============================================================================================
lang                       UID of the language.
uid                        UID of the plugin (content element ID).
pid                        PID des Plugin (Seiten-ID).
storagePIDsArray           Array with this storage PIDs.
storagePIDsComma           Comma separated list of the storage PIDs.
contents                   Array with the camaliga-elements. The array containes this variables:

                           title, shortdesc, longdesc, link, image, image2, caption2, image3, caption3,
                           image4, caption4, image5, caption5, street, zip, city, country,
                           latitude, longitude, person, phone, mobile, email, custom1, custom2, custom3, categories.

                           Further very important for JavaScript: titleNl2br, shortdescNl2br, longdescNl2br and
                           streetNl2br.

                           The links are stored in the TypoLink format. Therefore there are some more variables available.
                           linkResolved now contains the path to a file, rather than file: 123 (as link).
                           Of course, this should be normal for other link types, but it is not at the moment.
                           But there is the variable links, which is an array. It helps you if you want to save more
                           than one link or if you want to know the type of the link.
                           The avaiable array-keys: link and type. type is 0: no link; 1: internal link;
                           2: external link; 3: file; 4: email-address.
                           You will find an example after this tables. You can use it, if you don´t want to use
                           f:link.typolink. For f:link.typolink you must specify everything when you set the link.

                           And if you extend the Camaliga table: extended.
                           This is an array with the extended fields.
settings                   See TypoScript settings.
onlySearchForm             Indicates if only the search form should be shown.
paddingItemWidth           Item width + 2\*padding.
totalItemWidth             Item width + 2\*padding + 2\*margin.
itemWidth                  Depends on "addPadding": item with OR paddingItemWidth.
totalWidth                 n \* totalItemWidth.
paddingItemHeight          Item hight + 2\*padding.
totalItemHeight            Item hight + 2\*padding + 2\*margin.
itemHeight                 Depends on "addPadding": item hight OR paddingItemHight.
debug                      Debug output, if settings.debug=1.
=========================  ============================================================================================


- Use an extended template only if you need this additional variables:

=============================  ===========================================================
Variable                       Description (examples in ListExtended.html)
=============================  ===========================================================
sortBy\_selected               Argument sortBy.
sortOrder\_selected            Argument sortOrder.
start                          Argument start.
defaultCatIDs                  Settings.defaulCatIDs.
storagePIDsData                Array with the storage PIDs and the information about which are selected.
all_categories                 Array of all categories.
categories                     Array of categories and their parent category.
contents.categoriesAndParents  Array of all used categories and their parent category.
sword                          Fulltext search word.
place                          Place search word.
radius                         Selected radius.
radiusArray                    Avaiable radius values.
rsearch                        Indicates if the proximity search is active.
=============================  ===========================================================


- When you set settings.more.setModulo = 1, there are set this variables too (depends on settings.item.items):

===============================  ==========================================================================================
Variable                         Description (example in Ekko.html)
===============================  ==========================================================================================
contents.moduloBegin             >0 after every settings.item.items element. 0 otherwise. Begins at the 1. element.
contents.moduloEnd               >0 after every settings.item.items element. 0 otherwise. Begins at the \[items\] element.
===============================  ==========================================================================================


Here an example, if you don´t want to use f:link.typolink, but you should not use it anymore (deprecated):

::

  <f:if condition="{content.link} != ''">
	<f:if condition="{content.linkResolved} != ''">
		<f:then><a href="{content.linkResolved}" class="download">{f:translate(key: 'more')}</a></f:then>
		<f:else>
			<f:if condition="{content.link} > 0">
				<f:then><f:link.page pageUid="{content.link}" class="internal-link">{f:translate(key: 'more')}</f:link.page></f:then>
				<f:else><f:link.external uri="{content.link}" class="external-link-new-window">{f:translate(key: 'more')}</f:link.external></f:else>
			</f:if>
		</f:else>
	</f:if>
  </f:if>
