
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
					<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php print _t("Search by artist name.") ?>"><?php print _t("Artist's name") ?></span>
					{{{ca_entities.preferred_labels.displayname}}}
				
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















