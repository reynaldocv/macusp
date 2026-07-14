<?php
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");	
	$vs_secao_obras = _t("MAC USP Artworks");
	$vs_secao_nobras = _t("Other Artworks");
	$vs_secao_publicações = _t("Publications");

	$o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");
	
	if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
		$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";

?>
<div class="row">
	
	<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<!--<div class="detailNavBgLeft">-->
			<!--{{{previousLink}}}{{{resultsLink}}}-->
		<!--</div>--><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	
	<div class="col-sm-7 col-md-7 col-md-offset-1 col-lg-7 col-lg-offset-0">
		<div class="row">			
			<div class='col-md-12 col-lg-12'>
				<div class="container">
					<BR>
					<H1>{{{^ca_occurrences.preferred_labels.name}}}</H1>
					<!--<H6>{{{^ca_occurrences.type_id}}}{{{<ifdef code="ca_occurrences.idno">, ^ca_occurrences.idno</ifdef>}}}</H6>-->
				</div><!-- end col -->
			<div>
		</div><!-- end row -->
		<div class="row">			
			<div class='col-sm-6 col-md-6 col-lg-6'>
				<div class="container">
					<div>
						{{{<ifdef code = 'ca_entities' restrictToRelationshipTypes='local_exposicao'>
								<b><?php print _t("Local da exposição").":"; ?></b><br>
								<unit relativeTo='ca_entities' restrictToRelationshipTypes='local_exposicao'>
									^ca_entities.preferred_labels
								</unit>
							</ifdef>
						}}}
					</div>
			
					<!--<span style="font-family: Arial, Helvetica, sans-serif; font-size: 10pt; padding-top:2pt">
						{{{^ca_occurrences.local_exposicao.local_exibicao_mac.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromTop=2%delimiter=_->_}}}
					</span>-->

					<?php 

						$vs_template = '^ca_occurrences.endereco_exposicao.cidade_endereco_expo.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=4%delimiter=$';
						$sentence = $t_item->getWithTemplate($vs_template);

						$cities = explode('$', $sentence);

						$local =  ""; 

						if (sizeof($cities) >= 3)
						{
							$local = "$cities[2], <b>$cities[1]</b>"; 									
						}

						print $local; 


					?>

					<ifdef code="ca_occurrences.exhibitionBeginDate">
					<div>
						<b>Início:</b> 
							{{{^ca_occurrences.exhibitionBeginDate}}}
							
						<ifdef code="ca_occurrences.exhibitionEndDate"> |
							<b> Fim:</b> {{{^ca_occurrences.exhibitionEndDate}}}
						</ifdef>
					</div>
					</ifdef>
					<br>
					<div>
						{{{
						<ifdef code ="ca_occurrences.conceito_exposicao"><b>Sinopse:</b> ^ca_occurrences.conceito_exposicao <br></ifdef>
						}}}
					</div>	
				</div>		
				
			</div><!-- end col -->
			<div class='col-md-6 col-lg-6'>
				<!--<div><b><?php print _t("Instituição responsável").":"; ?></b> 
					{{{<unit relativeTo='ca_entities'>
						^ca_entities.preferred_labels (^relationship_typename)
					</unit>}}}
				</div>-->

				<!--<div><b><?php print _t("Instituição responsável").":"; ?></b> 
					{{{<unit relativeTo='ca_entities' restrictToRelationshipTypes='Instituicao_responsavel'>
						^ca_entities.preferred_labels
					</unit>}}}
				</div>-->
				
				<ifdef code="ca_entities" restrictToRelationshipTypes="Instituicao_responsavel">
					<div><b>
						
						{{{<ifcount code='ca_entities' restrictToRelationshipTypes='Instituicao_responsavel' delimiter=' ' min='1' max='1'>
								<?php print _t("Instituição").":"; ?>
						</ifcount>}}}

						{{{<ifcount code='ca_entities' restrictToRelationshipTypes='Instituicao_responsavel' delimiter=' ' min='2'>
								<?php print _t("Instituições").":"; ?>
						</ifcount>}}}
			
						</b> 
						<ul>
							{{{<unit relativeTo='ca_entities' restrictToRelationshipTypes='Instituicao_responsavel' delimiter=' '>
									<li>^ca_entities.preferred_labels </li>
							</unit>}}}

						<ul>
					</div>
				</ifdef>

				<ifcount code="ca_entities" restrictToRelationshipTypes="Organizador|Curator|Auditor|Avaliador|Editor|" min="1">		
					<div><b>

						{{{<ifcount code='ca_entities' restrictToRelationshipTypes='Organizador|Curator|Auditor|Avaliador|Editor|' delimiter=' ' min='1' max='1'>
								<?php print _t("Responsável").":"; ?>
						</ifcount>}}}

						{{{<ifcount code='ca_entities' restrictToRelationshipTypes='Organizador|Curator|Auditor|Avaliador|Editor|' delimiter=' ' min='2'>
								<?php print _t("Responsáveis").":"; ?>
						</ifcount>}}}
						</b> 

						<ul>
							{{{<unit relativeTo='ca_entities' restrictToRelationshipTypes='Organizador|Curator|Auditor|Avaliador|Editor|' delimiter=' '>
								<li>^ca_entities.preferred_labels (^relationship_type_code)</li>
							</unit>}}}
						<ul>
					</div>
				</ifcount>
								
			</div><!-- end col -->
		</div><!-- end row -->	
	
		<div  class="row">

			<?php
				//print $t_item->getWithTemplate("^ca_occurrences.itens_nao_mac");

				/*$vs_template = '<unit relativeTo="ca_occurrences.related" restrictToTypes="exhibition">
									^ca_occurrences.occurrence_id
								</unit>';*/

				$vs_template = '<unit relativeTo="ca_occurrences.related" restrictToTypes="item_Lista_nao_MAC" delimiter="$">
									^ca_occurrences.occurrence_id
								</unit>';
				
				$occurrences_ids  = $t_item->getWithTemplate($vs_template); 
				
				//print $occurrences_ids;

				$occurrences_ids = str_replace(" ", "", $occurrences_ids);

				$tem_obras_extras = true;
				$va_artworks_nao_mac_ids = explode('$', $occurrences_ids);
				array_pop($va_artworks_nao_mac_ids);

				$nro_artworks = sizeof($va_artworks_nao_mac_ids);

				$tem_obras_extras = false;
				if ($nro_artworks > 0)
				{
					$tem_obras_extras = True;
				}

				#calculando as publicações relacionadas à exposição
					
				$vs_template = '<unit relativeTo="ca_occurrences.related" restrictToTypes="publicacao" delimiter="$">^ca_occurrences.occurrence_id</unit>';
				$publication_ids = $t_item->getWithTemplate($vs_template);

				$publication_ids = str_replace(" ", "", $publication_ids);
				
				$tem_publicacoes = false;
				if (trim($publication_ids))
				{
					$tem_publicacoes = true;
					
					$va_publicacoes_ids = explode('$', $publication_ids);					
					$numero_publicacoes = sizeof($va_publicacoes_ids);
				}

				
				
				
			?>
			
			{{{<ifcount code="ca_objects" min="1">
				<BR><BR>
				
				<a name='works'></a>
				<div class='row'>
					<div class="col-sm-12 ">
						<H6>
							<span style="margin-left:10px;font-weight:bold; font-size:13px">
								<?php print _t($vs_secao_obras) ?>  (^ca_objects.related._count)
							</span>
							
							<?php if ($tem_obras_extras)
							{
							?>
							<span style="margin-left:30px">
								<a href="#otherWorks" style="text-decoration:none; color:#454545">
								<?php print _t($vs_secao_nobras) . " (" . $nro_artworks . ")"; ?>
								</a>
							</span>
							<?php
							}
							?>	
							<?php if ($tem_publicacoes)
							{
							?>
							<span style="margin-left:30px">
								<a href="#publications" style="text-decoration:none; color:#454545">
								<?php print _t($vs_secao_publicações) . " (" . $numero_publicacoes . ")"; ?>
								</a>
							</span>
							<?php
							}
							?>	
						</H6>
						<HR>
						<div class="row">
							<div id="browseResultsContainer">
								<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>
							</div><!-- end browseResultsContainer -->
						</div><!-- end row -->
						
						<script type="text/javascript">
							jQuery(document).ready(function() {
								jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'MacuspSearch', 'works', array('search' => 'occurrence_id:^ca_occurrences.occurrence_id', 'view' => 'list'), array('dontURLEncodeParameters' => true)); ?>", function() {
									jQuery('#browseResultsContainer').jscroll({
										autoTrigger: true,
										loadingHtml: '<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>',
										padding: 20,
										nextSelector: 'a.jscroll-next'
									});
								});
								
								
							});
						</script>
					</div>
				<div>
			</ifcount>}}}

			<?php if ($tem_obras_extras)
			{
			?>
			<a name='otherWorks'></a>
			<div class='row'>
				<div class="col-sm-12 ">
					<H6>
						<span style="">
							<a href="#works" style="text-decoration:none; color:#454545">
								<?php print _t($vs_secao_obras) ?> ({{{^ca_objects.related._count}}})
							</a>
						</span>
						
						<span style="margin-left:30px;font-weight:bold; font-size:13px">
							<?php print _t($vs_secao_nobras) . " (" . $nro_artworks . ")"; ?>
						</span>
						<?php if ($tem_publicacoes or True)
							{
							?>
							<span style="margin-left:30px">
								<a href="#publications" style="text-decoration:none; color:#454545">
								<?php print _t($vs_secao_publicações) . " (" . $numero_publicacoes . ")"; ?>
								</a>
							</span>
							<?php
							}
							?>	
					</H6>
					<HR>
					
					<div class="row">
						<div class="col-sm-12 ">
							<?php
								// Separa os códigos das exposições num array
								$vn_col_span = 4;
								$vn_col_span_sm = 4;
								$vn_col_span_xs = 12;
								$vb_refine = false;
								
								foreach ($va_artworks_nao_mac_ids as $vn_id)
								{
									//Os códigos estão vindo com espaço
									// Lê a publicação do banco
									$qr_res = new ca_occurrences($vn_id);
									$vs_table = "ca_occurrences"; 
									
									//$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
									$vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels"), '', $vs_table, $vn_id);
									//$vs_label_detail_link = "hola"; 

									$info = True; 
									include("boxes/ca_objects_list_off.php"); 						
									
									print "$vs_result_output";
								}
							?>
						</div>
					
					</div>
		
				</div>	
			</div>
			<?php
			}
			?>
			

			<?php if ($tem_publicacoes)
			{
			?>
			<a name='publications'></a>
			<div class='row'>
				<div class="col-sm-12 ">
					<H6>
						<span style="">
							<a href="#works" style="text-decoration:none; color:#454545">
							<?php print _t($vs_secao_obras) ?> ({{{^ca_objects.related._count}}})
							</a>
						</span>
						<?php if ($tem_obras_extras)
							{
							?>
							<span style="margin-left:30px">
								<a href="#otherWorks" style="text-decoration:none; color:#454545">
								<?php print _t($vs_secao_nobras) . " (" . $nro_artworks . ")"; ?>
								</a>
							</span>
							<?php
							}
						?>	
						<?php if ($tem_publicacoes or True)
							{
							?>
							<span style="margin-left:30px;font-weight:bold; font-size:13px">								
								<?php print _t($vs_secao_publicações) . " (" . $numero_publicacoes . ")"; ?>								
							</span>
							<?php
							}
							?>	
					</H6>
					<HR>
					
					<div class="row">
						<div class="col-sm-12 ">
							<?php
								// Separa os códigos das exposições num array
								$vn_col_span = 6;
								$vn_col_span_sm = 6;
								$vn_col_span_xs = 12;
								$vb_refine = false;
								
								foreach ($va_publicacoes_ids as $vn_id)
								{
									//Os códigos estão vindo com espaço
									// Lê a publicação do banco
									$qr_res = new ca_occurrences($vn_id);
									$vs_table = "ca_occurrences"; 
									
									//$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
									$vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels"), '', $vs_table, $vn_id);
									//$vs_label_detail_link = "hola"; 

									$info = True; 
									include("boxes/ca_publications_list.php"); 						
									
									print "$vs_result_output";
								}
							?>
						</div>
					
					</div>
		
				</div>	
			</div>
			<?php
			}
			?>
		<!-- end container -->


		
		</div>
		</div>
		</div>
	</div>
		
		
	
	<div class='col-sm-3 col-md-3 col-lg-3'>
		<div id='additional-info' class='additional-info'>
            <div class='message'> <?php print _t("Quick tips"); ?> 
			</div>
			<ul>
				<li><?php print _t("Click on the icon %1 for details about a work.", "<span class='glyphicon glyphicon-info-sign'></span>") ?></li>					
			</ul>
        </div>
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


<script>
	function getInfoArtist(idno)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>");         

        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'artist'); ?>', {idno}, function(data) {
            jQuery("#additional-info").html(data); 
        }); 
    }   

	function getInfoExhibition(idno)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>");         

        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'exhibition'); ?>', {idno}, function(data) {
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
	function getInfoNoWork(idno)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>");         

        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'noWork'); ?>', {idno}, function(data) {
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
			header.style.top = String(Math.max(window.pageYOffset - 120, 0)) + "px";
		}
		else
		{
			
		}
	}
</script>
