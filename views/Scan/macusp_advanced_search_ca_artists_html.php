
<div class="row">
	{{{form}}}
	<div class='advancedContainer'>

		<!-- Não vai ter busca por todos os campos
		<div class='row'>
			<div class="advancedSearchField col-sm-12">
				<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Busca por todos os campos da base de dados.">
					<?php print _t("Keyword") ?>
				</span>
				{{{_fulltext%width=200px}}}
			</div>			
		</div> -->
		
		<div class='row'>
			<div class="advancedSearchField col-sm-12" >					
					<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by artist name.") ?>">
					<?php print _t("Artista") ?></span>
					{{{ca_entities.preferred_labels.displayname}}}
				
			</div>
		</div>		

		<div class='row'>
			<div class="advancedSearchField col-sm-6">
				<!-- <span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Object Titles only.">Title</span> -->

				<pan class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by place of birth or death.") ?>">
				<?php print _t("Place of birth or death") ?></span>


				{{{ca_places.preferred_labels.displayname/relationship_typename=nascimento%label=<?php print _t("Place of birth or death") ?>}}}				
			</div>
		</div>		

		

		<div class='row'>
			<div class="advancedSearchField col-sm-4">
				<!-- <span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Object Titles only.">Title</span> -->
				<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by year of birth.") ?>">
				<?php print _t("Year of birth") ?></span>
				{{{ca_entities.DadosBiograficos.AnoNascimento%label=<?php print _t("Year of birth") ?>&useDatePicker=0&width=200}}}
			</div>
		</div>		

		

		<div class='row'>
		
			<div class="advancedSearchField col-sm-4">
				<!-- <span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Object Titles only.">Title</span> -->
				<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by year of death.") ?>">
				<?php print _t("Year of death") ?></span>
				{{{ca_entities.DadosBiograficos.AnoMorte%label=<?php print _t("Year of death") ?>&useDatePicker=0&width=200}}}
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















