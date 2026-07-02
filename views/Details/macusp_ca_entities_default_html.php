<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_entities_default_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2022 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
 
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");	
	$id_artist = $t_item->getWithTemplate("^ca_entities.rank");
	//print "<h1>Hola".$this->getVar("reynaldocv")."</h1>";
	//print_r($this->getVar("reynaldocv"));

	
?>	
		
	<div class="row">
		<!--<div class='col-xs-12 navTop'>--><!--- only shown at small screen size -->
			<!--{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}-->
		<!--</div>--><!-- end detailTop -->
		<!--<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
			<div class="detailNavBgLeft">-->
				<!--{{{previousLink}}}{{{resultsLink}}}-->
			<!--</div>--><!-- end detailNavBgLeft -->
		<!--</div>--><!-- end col -->
		<div class="col-sm-1 ">
 		</div>
		

		<div class="col-sm-7" >
			<div class="container">
				<div class='col-md-12 col-lg-12'>
					<br>
					<H1>{{{^ca_entities.preferred_labels.displayname}}}</h1>
 				</div>
				<div class='col-md-6 col-lg-6'>
					<div class="container">
						
						<!-- <H6>{{{^ca_entities.type_id}}}{{{<ifdef code="ca_entities.idno">, ^ca_entities.idno</ifdef>}}}</H6> -->

										
							<?php 								
								$vs_template = '^ca_entities.DadosBiograficos.LocalNascimento.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=4%delimiter=$';
								$sentence = $t_item->getWithTemplate($vs_template);

								$vs_template = '^ca_entities.DadosBiograficos.AnoNascimento';
								$ano = trim($t_item->getWithTemplate($vs_template));
								
								$cities = explode('$', $sentence);
								$birthdata = "";

								if (sizeof($cities) >= 3)
								{
									if ($cities[1] === "Brasil")
									{
										$birthdata = "$cities[3], $cities[2] (<b>$cities[1]</b>)"; 
									}
									else
									{
										$birthdata = "$cities[2] (<b>$cities[1]</b>)"; 
									}
								}
								if (trim($birthdata) !== "")
								{
									if ($ano !== ""){
										$birthdata .= ", $ano"; 
									}
									else {
										$birthdata .= $ano; 
									}
								}
								else{
									$birthdata = $ano; 
								}

								$vs_template = '^ca_entities.DadosBiograficos.LocalMorte.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=4%delimiter=$';
								$sentence = $t_item->getWithTemplate($vs_template);

								$vs_template = '^ca_entities.DadosBiograficos.AnoMorte';
								$ano = trim($t_item->getWithTemplate($vs_template));
								
								$cities = explode('$', $sentence);
								$deathdata = "";

								if (sizeof($cities) >= 3)
								{
									if ($cities[1] === "Brasil")
									{
										$deathdata = "$cities[3], $cities[2], (<b>$cities[1]</b>)"; 
									}
									else
									{
										$deathdata = "$cities[2] (<b>$cities[1]</b>)"; 
									}
								}
								if (trim($deathdata) !== "")
								{
									if ($ano !== ""){
										$deathdata .= ", $ano"; 
									}
									else {
										$deathdata .= $ano; 
									}
								}
								else{
									$deathdata = $ano; 
								}

								if (trim($birthdata) !== "")
								{
									$birthdata = "☼ $birthdata";
								}

								if (trim($deathdata) !== "")
								{
									$deathdata = "&nbsp† &nbsp$deathdata";
								}


								print $birthdata;
								print "<br>"; 
								print $deathdata;
								
							?>

 						
						
						
					</div>
				</div><!-- end col -->
		
			
				<div class='col-md-6 col-lg-6'>
					<div class="container">
						
						<!-- <H6>{{{^ca_entities.type_id}}}{{{<ifdef code="ca_entities.idno">, ^ca_entities.idno</ifdef>}}}</H6> -->
						
						<!--{{{<unit relativeTo="ca_objects" unique='1' delimiter="<br/>">
							<l> ^ca_objects.preferred_labels</l>
						</unit>}}}
						<br>
						{{{<unit relativeTo="ca_objects.ca_object_representations" unique='1' delimiter="<br/>">
							* ^ca_objects.preferred_labels -- ^ca_objects.ca_object_representations._count
						</unit>}}}

						{{{^ca_objects.ca_object_representations._count}}}
						{{{^ca_objects.related._count}}}
						{{{^ca_objects.related._count}}}
						{{{^ca_objects.ca_object_representations.related._count}}}

						**{{{^ca_objects.representations.count}}}
						-->

						{{{<ifdef code="ca_entities.description"><div class='unit'><H6>Biography</H6>^ca_entities.description</div></ifdef>}}}
						
						{{{<ifcount code="ca_collections" min="1" max="1"><H6>Related collection</H6></ifcount>}}}
						{{{<ifcount code="ca_collections" min="2"><H6>Related collections</H6></ifcount>}}}
						{{{<unit relativeTo="ca_entities_x_collections" delimiter="<br/>"><unit relativeTo="ca_collections"><l>^ca_collections.preferred_labels.name</l> (^relationship_typename)</unit></unit>}}}

						<!--
						{{{<ifcount code="ca_entities.related" min="1" max="1"><H6>Related person</H6></ifcount>}}}
						{{{<ifcount code="ca_entities.related" min="2"><H6>Related people</H6></ifcount>}}}
						{{{<unit relativeTo="ca_entities_x_entities" delimiter="<br/>"><unit relativeTo="ca_entities" delimiter="<br/>"><l>^ca_entities.related.preferred_labels.displayname</l></unit> (^relationship_typename)</unit>}}}
						-->
											
						{{{<ifcount code="ca_occurrences" restrictToTypes="exhibition" min="1"><H6><?php print _t("Exhibition Curating") ?></H6></ifcount>}}}
						
						{{{
							<unit relativeTo="ca_entities_x_occurrences" delimiter="<br/>" restrictToRelationshipTypes="curator">
							<unit relativeTo="ca_occurrences" delimiter="<br/>">
							<l>^ca_occurrences.preferred_labels.name</l>
							</unit> (^relationship_typename)</unit>
						}}}
						
						{{{<ifcount code="ca_occurrences" restrictToTypes="publicacao" min="1"><H6><?php print _t("Authors of Publications") ?></H6></ifcount>}}}
						
						{{{
							<unit relativeTo="ca_entities_x_occurrences" delimiter="<br/>" restrictToRelationshipTypes="autor,editor,organizador">
							<unit relativeTo="ca_occurrences" delimiter="<br/>">
							<l>^ca_occurrences.preferred_labels.name</l>
							</unit> (^relationship_typename)</unit>
						}}}
						
						<!--
						{{{<ifcount code="ca_places" min="1" max="1"><H6><?php print _t("Related Places") ?></H6></ifcount>}}}
						{{{<ifcount code="ca_places" min="2"><H6><?php print _t("Related Places") ?></H6></ifcount>}}}
						{{{<unit relativeTo="ca_entities_x_places" delimiter="<br/>"><unit relativeTo="ca_places" delimiter="<br/>">^ca_places.preferred_labels.name</unit> (^relationship_typename)</unit>}}}
						-->
		
						<H4></H4>
						
					</div>
				
				</div><!-- end col -->
			</div>
			<div class="container">
			
			<?php
				$obras_count = 0;  

				$vs_template = '<unit relativeTo="ca_objects_x_entities" restrictToTypes="art" restrictToRelationshipTypes="creator" delimiter=" ">    					
					<if rule="^ca_objects.access !~ /n/">
        				^ca_objects.object_id ^ca_objects.access;
					</if>
				</unit>'; 

				$obras_ids = $t_item->getWithTemplate($vs_template);

				if (trim($obras_ids))
				{
					$obras_count = substr_count($obras_ids, ";"); 
				}

				$vs_template = '<unit relativeTo="ca_objects" restrictToTypes="art" restrictToRelationshipTypes="creator" delimiter=" ">
					<if rule="^ca_objects.access !~ /n/">
						<unit relativeTo="ca_occurrences" restrictToTypes="exhibition" delimiter=" ">
							^ca_occurrences.occurrence_id; 
						</unit>
					</if>
					</unit>';

				$exposicoes_ids = $t_item->getWithTemplate($vs_template);
				
				$tem_exposicoes = false;
				if (trim($exposicoes_ids))
				{
					$tem_exposicoes = true;
					
					// Separa os códigos das obras num array
					$exposicoes_ids = str_replace(';', ',', $exposicoes_ids);
					$exposicoes_ids .="0"; 

					$sql = "select distinct ca_attributes.row_id, ca_attribute_values.value_decimal1
						from ca_attributes
						inner join ca_attribute_values on ca_attributes.attribute_id = ca_attribute_values.attribute_id
						where ca_attributes.element_id = 386
						and ca_attributes.row_id IN
						( " . $exposicoes_ids . ")
						order by ca_attribute_values.value_decimal1 ";
					
					$o_data = new Db();
					$qr_result_exposicoes = $o_data->query($sql);
				}
						
				// Vamos acrescentar aqui a lista das publicações em que obras desse artista foram exibidas
				$vs_template = '<unit relativeTo="ca_objects"  restrictToTypes="art" restrictToRelationshipTypes="creator"  delimiter=" ">		
					<if rule="^ca_objects.access !~ /n/">							
						<unit relativeTo="ca_occurrences" restrictToTypes="publicacao"  delimiter=" ">
							^ca_occurrences.occurrence_id; 
						</unit>					
					</if>
					</unit>';
				
				$publicacoes_ids = $t_item->getWithTemplate($vs_template);
				
				$tem_publicacoes = false;
				if (trim($publicacoes_ids))
				{
					$tem_publicacoes = true;
					
					// Separa os códigos das obras num array
					$publicacoes_ids = str_replace(';', ',', $publicacoes_ids);
					$publicacoes_ids .="0"; 

					$sql = "select distinct ca_attributes.row_id, ca_attribute_values.value_decimal1
						from ca_attributes
						inner join ca_attribute_values on ca_attributes.attribute_id = ca_attribute_values.attribute_id
						where ca_attributes.element_id = 431
						and ca_attributes.row_id IN
						( " . $publicacoes_ids . ")
						and ca_attribute_values.value_decimal1 IS NOT NULL
						order by ca_attribute_values.value_decimal1 ";
					
					$o_data = new Db();
					$qr_result_publicacoes = $o_data->query($sql);
				}
			?>
			
				{{{<ifcount code="ca_objects.creator:art">
				<BR><BR>

				<a name='obras'></a>
				
				<div class='row'>
					<div class="col-sm-12 ">
						<H6>
					<span style="font-weight:bold; font-size:13px">
						<?php print _t("Objects") ?> (<?php print $obras_count ?>) 
					</span>
					
					<?php if ($tem_exposicoes)
					{
					?>
					<span style="margin-left:30px">
						<a href="#exposicoes" style="text-decoration:none; color:#454545">
						<?php print _t("Exhibitions") . " (" . $qr_result_exposicoes->numRows() . ")"; ?>
						</a>
					</span>
					<?php
					}
					?>
					
					<?php if ($tem_publicacoes)
					{
					?>
					<span style="margin-left:30px">
						<a href="#publicacoes" style="text-decoration:none; color:#454545">
						<?php print _t("Publications") . " (" . $qr_result_publicacoes->numRows() . ")"?>
						</a>
					</span>
					<?php
					}
					?>
				</H6>
				<HR>
				</div>
				<div class="col-sm-12 ">
				<div class="row">
					<div id="browseResultsContainer">
						<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>
					</div><!-- end browseResultsContainer -->
				</div><!-- end row -->
				
				<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'MacuspSearch', 'works', array('search' => 'entity_id:^ca_entities.entity_id', 'view' => 'list'), array('dontURLEncodeParameters' => true)); ?>", function() {
							jQuery('#browseResultsContainer').jscroll({
								autoTrigger: true,
								loadingHtml: '<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>',
								padding: 20,
								nextSelector: 'a.jscroll-next'
							});
						});
						
						
					});
				</script>
				</ifcount>}}}
				
				<?php if ($tem_exposicoes)
				{
				?>
				<a name='exposicoes'></a>
				<div class='row'>
				<div class="col-sm-12 ">
					<H6>
						<span style="">
							<a href="#obras" style="text-decoration:none; color:#454545">
							<?php print _t("Objects") ?> (<?php print $obras_count ?>)
							</a>
						</span>
						
						<span style="margin-left:30px; font-weight:bold; font-size:13px">
							<?php print _t("Exhibitions") . " (" . $qr_result_exposicoes->numRows() . ")"; ?>
						</span>
						
						<?php if ($tem_publicacoes)
						{
						?>
						<span style="margin-left:30px">
							<a href="#publicacoes" style="text-decoration:none; color:#454545">
							<?php print _t("Publications") . " (" . $qr_result_publicacoes->numRows() . ")"?>
							</a>
						</span>
						<?php
						}
						?>
					
					</H6>
					
					<HR>
				
					<?php	
						$vn_col_span = 6;
						$vn_col_span_sm = 6;
						$vn_col_span_xs = 12;
						$vb_refine = false;		

						while($qr_result_exposicoes->nextRow()) 
						{
							
							$vn_id = $qr_result_exposicoes->get('row_id');
							
							// Lê a exposição do banco
							$qr_res = new ca_occurrences($vn_id);
							$vs_table = "ca_occurrences"; 
							
							$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
							$vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels"), '', $vs_table, $vn_id);
							
							$info = True; 
							include("boxes/ca_occurrences_list.php"); 

							print $vs_result_output;							
					}
					?>
				</div>
				</div>
				<?php
				}
				?>
				
				<?php if ($tem_publicacoes)
				{
				?>
				<a name='publicacoes'></a>
				<div class='row'>
					<div class="col-sm-12 ">
						<H6>
						<span style="">
							<a href="#obras" style="text-decoration:none; color:#454545">
							<?php print _t("Objects") ?> (<?php print $obras_count ?>)
							</a>
						</span>
						
						<?php if ($tem_exposicoes)
						{
						?>
						<span style="margin-left:30px">
							<a href="#exposicoes" style="text-decoration:none; color:#454545">
							<?php print _t("Exhibitions") . " (" . $qr_result_exposicoes->numRows() . ")"; ?>
							</a>
						</span>
						<?php
						}
						?>
					
						<span style="margin-left:30px; font-weight:bold; font-size:13px">
							<?php print _t("Publications") . " (" . $qr_result_publicacoes->numRows() . ")"?>
						</span>
						</H6>
					
						<HR>
					
						<?php
							while($qr_result_publicacoes->nextRow()) 
							{
								$vn_id = $qr_result_publicacoes->get('row_id');
							
								// Lê a exposição do banco
								$qr_res = new ca_occurrences($vn_id);
								$vs_table = "ca_occurrences"; 
								
								$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
								$vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels"), '', $vs_table, $vn_id);
								
								$info = True; 
								include("boxes/ca_publications_list.php"); 

								print $vs_result_output;		
							}
							?>
					</div>
				</div>
				<?php
				}
				?>
			
			</div><!-- end container -->
		</div>

		<div class="col-sm-3">
			<div id="additional-info">
				 <div class='message'> <?php print _t("Quick tips"); ?> </div>
            	 <ul>
					<li><?php print _t("Click on the icon %1 for details about a work, exhibition, or publication.", "<span class='glyphicon glyphicon-info-sign'></span>") ?></li>					
				</ul>
			</div>
 		</div>
		<div class="col-sm-1 ">
 		</div>

		
	</div><!-- end row -->

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 120
		});
	});
</script>

<script type='text/javascript'>
	function getInfoExhibition(idno, option, idSearch)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>"); 

        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'exhibition'); ?>', {idno, option, idSearch}, function(data) {
            jQuery("#additional-info").html(data); 
        }); 
    }  

	function getInfoPublication(idno, option, idSearch)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>"); 

        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'publication'); ?>', {idno, option, idSearch}, function(data) {
            jQuery("#additional-info").html(data); 
        }); 
    }  
	
	function getInfoWork(idno)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>"); 
        
        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'work'); ?>', {idno}, function(data) {
            jQuery("#additional-info").html(data); 
        }); 
    }
	
</script>

<script type='text/javascript'>
	window.onscroll = function() {myFunction()};

	var header = document.getElementById("additional-info");
	var sticky = header.offsetTop;
	
	function myFunction() {
		if (window.pageYOffset > sticky) {
			header.style.top = String(Math.max(window.pageYOffset - 150, 0)) + "px";
		}
		else{
			
		}
	}
</script>

