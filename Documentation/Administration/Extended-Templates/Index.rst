.. include:: /Includes.rst.txt


Extended Templates
^^^^^^^^^^^^^^^^^^

Extended/advanced templates are templates that spend more information than the normal template.
They also offer a search option (by category and a full text search). More can be found in other chapters.
Since camaliga 5.0.0 there are now three ways to use these extended templates / functions:

- For the list view you can select an extended template. Since the advanced list action is cached,
  the search form can be sent to itself with the parameter no_cache = 1.
  Admittedly, this is not an elegant solution, but a practical solution. Up to version 4.0.0, there were even more templates,
  which functioned according to this principle, but which are no longer available. Therefore, you should now read further.

- The extended Google Maps template will never be cached at all, which is why it does not need the parameter no_cache = 1 .
  The template does not mean as before MapExtended.html but search.html. The search form is integrated there via a partial.
  Anyone who does not need a caching or everyone who is not like other solutions should use the Search template.
  One can certainly use it for anything.

- The third way is: you send the search form to the search-action.
  Since the search-action is not cached, you do not need to no_cache parameter at all.
  But but the search.html template is needed in any case.
  If you dont want to maintain two templates, you can specify a template-parameter in the search form:

::

	<f:form.hidden name="template" value="List" />

The hidden-parameter template is used to specify which template is to be used after the search.
This should then have the same name as the template that you use.
The advantage: you can use this way almost in any template.
Due to a TYPO3-bugs you need the Search.html template, although it is not used.
For this to work at all, you have need to enable the search. Either on the flexforms
in the tab "Extended options" or via TypoScript:

::

  plugin.tx_camaliga.settings.extended.enable = 1

A time test has incidentally revealed that it doesnt matter which option you choose. All variants are the same slow.
And so looks a finished example of the variant 3, which can be installed in almost any template:

::

  <f:if condition="{settings.extended.enable} == 1">
   <f:form action="search" name="camaliga">
	<div class="well">
	  <h3>{f:translate(key: 'options', default: 'Options')}</h3>
	  <f:render partial="Options" arguments="{_all}" />
	  <f:form.submit name="search" value="{f:translate(key: 'search', default: 'search')}" class="btn btn-primary" />
	  <f:form.hidden name="template" value="List" />
	</div>
   </f:form>
  </f:if>

After you have installed that in your template, you still need the Partial "Options". That one of the typo3conf folder
can be used or you can also copy it in the fileadmin folder. The path to the Partial can be set like this in TypoScript setup:

::

  plugin.tx_camaliga.view.partialRootPaths.1 = fileadmin/templates/Partials/

Note: the RealUrl-documentation says, that there should no cHash for plugins that are not chacheable.
You can add noCacheHash="true" to your f:form, but then the search will not work anymore. Bad advice.
But you can fix this problem if you create a new search page and add the pageUid to your search form.
New example:

::

  <f:form action="search" name="camaliga" noCacheHash="true" pageUid="{settings.searchId}">

Note furthermore: when you use the search action and set the template variable, you should know, that that template
will be searched only in the folder with the highest number. E.g. it will be used the folder provided under:
view.templateRootPaths.1 but this one will be ignored: view.templateRootPaths.0.
