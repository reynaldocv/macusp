
<div class="row">

{{{form}}}

<div class='advancedContainer'>

	<!-- Não vai ter busca por todos os campos
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Busca por todos os campos da base de dados."><?php print _t("Keyword") ?></span>
			{{{_fulltext%width=200px&height=1}}}
		</div>			
	</div> -->
	
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by artist name.") ?>">
			<?php print _t("Artist") ?></span>
			{{{artista%label=<?php print _t("Artist") ?>}}}
		</div>
	</div>
	
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by object title.") ?>">
			<?php print _t("title of artwork") ?></span>
			<!-- {{{ca_objects.preferred_labels%width=220px}}} -->
			{{{titulo_obra%label=<?php print _t("title of artwork") ?>}}}
		</div>
	</div>
	
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<!-- <span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Object Titles only.">Title</span> -->
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by title of album.") ?>">
			<?php print _t("title of the album, series, installation or publication") ?></span>
			{{{titulo_album%label=<?php print _t("title of the album, series, installation or publication") ?>}}}
		</div>
	</div>
	
	<div class='row'>
		<div class="advancedSearchField col-sm-4">
			<!-- <span class='formLabel' data-toggle="popover" data-trigger="hover" data-content=>Date range <i>(e.g. 1970-1979)</i></span> -->
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search records of a particular date or date range.") ?>">
			<?php print _t("date range (EX. 1970-1979 or Cast in 1960)") ?></span>
			<!-- {{{ca_objects.dates.dates_value%width=200px&height=40px&useDatePicker=0}}} -->
			<!-- {{{ca_objects.datePeriod.datePeriod%width=200px&height=40px&useDatePicker=0}}} -->
			{{{data_obra%label=<?php print _t("Date") ?>}}}
		</div>
	</div>
	
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by medium.") ?>">
			<?php print _t("Medium") ?></span>
			{{{tecnica%label=<?php print _t("Medium") ?>}}}
		</div>
	</div>
	
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by artwork editorial data.") ?>">
			<?php print _t("editorial data of artist publications (EX: City, Publisher)") ?></span>
			</span>
			{{{dados_editoriais%label=<?php print _t("editorial data of artist publications") ?>}}}
		</div>
	</div>
	
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<!-- <span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search object identifiers.">Accession number</span> -->
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by provenance.") ?>">
			<?php print _t("Provenance") ?></span>
			{{{ca_objects.acquisitionNote%label=<?php print _t("Provenance") ?>}}}
		</div>
	</div>
	
	<div class='row'>
		<div class="advancedSearchField col-sm-2">
			<!-- <span class='formLabel' data-toggle="popover" data-trigger="hover" data-content=>Accession number</span> -->
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search object identifiers.") ?>"><?php print _t("Object number") ?></span>
			{{{ca_objects.idno%width=210px}}}
		</div>
	</div>
	
	<br style="clear: both;"/>
	<div class='advancedFormSubmit'>
		<!-- <span class='btn btn-default'>{{{reset%label=Reset}}}</span>
		<span class='btn btn-default' style="margin-left: 20px;">{{{submit%label=Search}}}</span> -->
				
		<span class='btn btn-default' style="margin-left: 20px;">{{{submit%label=<?php print _t("Search") ?>}}}</span>
		<span class='btn btn-default'>{{{reset%label=<?php print _t("Reset") ?>}}}</span>
	</div>
	
</div>	

{{{/form}}}

	</div>