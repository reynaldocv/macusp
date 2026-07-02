
<div class="row">

{{{form}}}

<div class='advancedContainer'>

	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by title of exhibition.") ?>">
			<?php print _t("Title of Exhibition") ?></span>
			{{{ca_occurrences.preferred_labels.name%label=<?php print _t("Title of Exhibition") ?>}}}
		</div>
	</div>

	<div class='row'>
		<div class="advancedSearchField col-sm-6">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by a particular date or date range.") ?>">
			<?php print _t("Opening date") ?></span>
			{{{ca_occurrences.exhibitionBeginDate%label=<?php print _t("Opening date") ?>&useDatePicker=0&width=40}}}
		</div>
		
		<div class="advancedSearchField col-sm-6">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by a particular date or date range.") ?>">
			<?php print _t("Closing date") ?></span>
			{{{ca_occurrences.exhibitionEndDate%label=<?php print _t("Closing date") ?>&useDatePicker=0&width=40}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by Artist.") ?>">
				<?php print _t("Artists of a exhibitions)") ?>
			</span>
			{{{ca_entities.preferred_labels.displayname/curator%label=<?php print _t("Institutions or persons related to the exhibition") ?>}}}
		</div>
	</div>
	

	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by curator or institution.") ?>">
				<?php print _t("Institutions or persons related to the exhibition (Ex. Institution responsible for the exhibition, Curator)") ?>
			</span>
			{{{ca_entities.preferred_labels.displayname/curator,co_curador,assistente_curadoria,curador_responsavel%label=<?php print _t("Institutions or persons related to the exhibition") ?>}}}
		</div>
	</div>
	
	
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by name of institution or city.") ?>">
				<?php print _t("Place of exhibition (Ex. Institution that hosted the exhibition, City)") ?>
			</span>
			<!-- {{{ca_entities.preferred_labels.displayname/local_exposicao%width=220px}}} -->
			{{{endereco_exposicao%label=<?php print _t("Place of exhibition") ?>}}}
		</div>
	</div>

	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by name of institution or city.") ?>">
				<?php print _t("Place of exhibition (Ex. Institution that hosted the exhibition, City)") ?>
			</span>
			<!-- {{{ca_entities.preferred_labels.displayname/local_exposicao%width=220px}}} -->
			{{{endereco_exposicao%label=<?php print _t("Place of exhibition") ?>}}}
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
	
