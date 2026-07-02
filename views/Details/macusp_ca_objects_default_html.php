<?php
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");	
	$vs_secao_obras = _t("MAC USP Artworks");
	$vs_secao_nobras = _t("Other Artworks");

	$idno = $t_item->get("ca_objects.rank");

	$o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");
	
	if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
		$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";

?>
<div class="row">	
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>		
	</div><!-- end col -->
	
	<div class="col-sm-7 col-md-7 col-md-offset-1 col-lg-7 col-lg-offset-0">		
		<div class="row">			
			<div class='col-sm-7 col-md-7 col-lg-7'>
				{{{representationViewer}}}	
				
			</div><!-- end col -->
			<div class='col-md-5 col-lg-5'>
				
				<div style="container">
					<!-- Artista -->
					<div class='artists-h1'>
						<!--{{{<unit relativeTo="ca_entities" delimiter=" | " restrictToRelationshipTypes="creator,collective_creator,editor,produtor,organizador">
							<l>^ca_entities.preferred_labels ^ca_entities.rank </l>
						</unit>}}}-->
						<?php 						
						$artists = $t_item->getWithTemplate("<unit relativeTo='ca_entities' delimiter=';' restrictToRelationshipTypes='creator,collective_creator,editor,produtor,organizador'>
												<l>^ca_entities.preferred_labels.displayname </l>
												</unit>");

						print $artists; 						
						
						?>
					</div>
					
					<!-- Título, Data -->
					<p>{{{^ca_objects.preferred_labels.name
					<ifdef code="ca_objects.versao_titulo_portugues.titulo_portugues"> [^ca_objects.versao_titulo_portugues.titulo_portugues]</ifdef>
					<ifdef code="ca_objects.datePeriod.datePeriod">
						, ^ca_objects.datePeriod.datePeriod
						<ifdef code="ca_objects.datePeriod.complemento_data">
					 	(^ca_objects.datePeriod.complemento_data)
						</ifdef>
						}}}
					</ifdef>
					</p>
					
					
					<!-- Título do álbum/série -->
					<p>{{{<ifdef code="ca_objects.AlbumSerieInstalacao.tipoasi">
					^ca_objects.AlbumSerieInstalacao.tipoasi: ^ca_objects.AlbumSerieInstalacao.tituloasi <ifdef code="ca_objects.versao_portugues_album.titulo_portugues_album">[^ca_objects.versao_portugues_album.titulo_portugues_album]</ifdef>
					</ifdef>
					}}}</p>
					<!-- Título do álbum/série -->
					<!--<p>{{{<ifdef code="ca_objects.AlbumSerieInstalacao.tipoasi">
					^ca_objects.AlbumSerieInstalacao.tipoasi: ^ca_objects.AlbumSerieInstalacao.tituloasi <ifdef code="ca_objects.versao_portugues_album.titulo_portugues_album">[^ca_objects.versao_portugues_album.titulo_portugues_album]</ifdef>
					</ifdef>
					}}}</p>-->
					
					<!-- Dados editoriais -->
					<p>{{{<ifdef code="ca_objects.dadoseditoriais">
					<ifdef code="ca_objects.dadoseditoriais.local">^ca_objects.dadoseditoriais.local</ifdef><ifdef code="ca_objects.dadoseditoriais.editora">, ^ca_objects.dadoseditoriais.editora</ifdef><ifdef code="ca_objects.dadoseditoriais.numeroedicao">, ^ca_objects.dadoseditoriais.numeroedicao</ifdef><ifdef code="ca_objects.dadoseditoriais.numero_exemplares">, ^ca_objects.dadoseditoriais.numero_exemplares</ifdef><ifdef code="ca_objects.dadoseditoriais.datadadoseditoriais">, ^ca_objects.dadoseditoriais.datadadoseditoriais</ifdef><ifdef code="ca_objects.dadoseditoriais.numdepaginas">, ^ca_objects.dadoseditoriais.numdepaginas</ifdef><ifdef code="ca_objects.dadoseditoriais.obs_dados_editoriais">, ^ca_objects.dadoseditoriais.obs_dados_editoriais</ifdef>
					</ifdef>
					}}}</p>
					
					<!-- Técnica -->
					{{{<ifdef code="ca_objects.technicalAttribute">
						<ifnotdef code="ca_objects.dados_audiovisuais">
							<p style="line-height:18px">
								^ca_objects.technicalAttribute
							</p>
						</ifnotdef>
					</ifdef>}}}
					
					<p align="justify"> {{{
						<ifdef code="ca_objects.dados_audiovisuais">
							<ifdef code="ca_objects.dados_audiovisuais.formato_original">^ca_objects.dados_audiovisuais.formato_original</ifdef>
							<ifdef code="ca_objects.dados_audiovisuais.sonoridade">, ^ca_objects.dados_audiovisuais.sonoridade</ifdef>
							<ifdef code="ca_objects.dados_audiovisuais.cromia">, ^ca_objects.dados_audiovisuais.cromia</ifdef>
							<ifdef code="ca_objects.dados_audiovisuais.duracao">, ^ca_objects.dados_audiovisuais.duracao</ifdef>
							<ifdef code="ca_objects.dados_audiovisuais.complemento_audiovisual"><br> ^ca_objects.dados_audiovisuais.complemento_audiovisual</ifdef>
							<ifdef code="ca_objects.dados_audiovisuais.obs_audiovisual"><br> ^ca_objects.dados_audiovisuais.obs_audiovisual</ifdef>
						</ifdef>}}}
					</p>

					<?php
					if ($t_item->get("ca_objects.dimensions.dimensions_height"))
					{
						$vs_descritivos_dimensoes = $t_item->get("ca_objects.dimensions.Descritivos");
						$vs_alturas_dimensoes = $t_item->get("ca_objects.dimensions.dimensions_height");
						$vs_larguras_dimensoes = $t_item->get("ca_objects.dimensions.dimensions_width");
						$vs_profundidades_dimensoes = $t_item->get("ca_objects.dimensions.dimensions_depth");
						
						$vs_descritivos_dimensoes = explode(";", $vs_descritivos_dimensoes);
						$vs_alturas_dimensoes = explode(";", $vs_alturas_dimensoes);
						$vs_larguras_dimensoes = explode(";", $vs_larguras_dimensoes);
						$vs_profundidades_dimensoes = explode(";", $vs_profundidades_dimensoes);
						
						$contador_dimensoes = 0;
						foreach($vs_descritivos_dimensoes as $dimensao)
						{
							if (!$vs_descritivos_dimensoes[$contador_dimensoes])
							{
								if ($vs_alturas_dimensoes[$contador_dimensoes])
								{
									//print "<p>" . number_format($vs_alturas_dimensoes[$contador_dimensoes], 1, ",", ".") . " x " . number_format($vs_larguras_dimensoes[$contador_dimensoes], 1, ",", ".");
								
									print "<p>" . $vs_alturas_dimensoes[$contador_dimensoes] . " x " . $vs_larguras_dimensoes[$contador_dimensoes];
									if ($vs_profundidades_dimensoes[$contador_dimensoes])
									{
										print " x " . $vs_profundidades_dimensoes[$contador_dimensoes];
									}
									
									//print " cm" . "</p>";
								}
							
								$contador_dimensoes++;
							}
						}
					}
					?>
					{{{<ifdef code="ca_objects.acquisitionNote">
						<p align="justify">^ca_objects.acquisitionNote</p>
					</ifdef>}}}
					
					<!-- Histórico -->
					<p align="justify">{{{
					<ifdef code="ca_objects.historico_procedencia">
						<if rule="^ca_objects.historico_procedencia.info_legenda =~ /Sim/">
							^ca_objects.historico_procedencia.historico_procedencia_info%delimiter=._
						</if>
					</ifdef>
					}}}</p>
					
					<!-- Tombo -->
					{{{<ifdef code="ca_objects.idno">
						<p>^ca_objects.idno</p>
					</ifdef>}}}

					{{{<ifcount code="ca_places" min="1" max="1"><H6>Related place</H6></ifcount>}}}
					{{{<ifcount code="ca_places" min="2"><H6>Related places</H6></ifcount>}}}
					{{{<unit relativeTo="ca_objects_x_places" delimiter="<br/>"><unit relativeTo="ca_places"><l>^ca_places.preferred_labels</l></unit> (^relationship_typename)</unit>}}}
					
					{{{<ifcount code="ca_list_items" min="1" max="1"><H6>Related Term</H6></ifcount>}}}
					{{{<ifcount code="ca_list_items" min="2"><H6>Related Terms</H6></ifcount>}}}
					{{{<unit relativeTo="ca_objects_x_vocabulary_terms" delimiter="<br/>"><unit relativeTo="ca_list_items"><l>^ca_list_items.preferred_labels.name_plural</l></unit> (^relationship_typename)</unit>}}}
				
				</div>
								
			</div><!-- end col -->
		</div><!-- end row -->
		
		<div class="row">
			<div class='col-md-12 col-lg-12'>
				<?php
		$vs_template = '^ca_occurrences._count%restrictToTypes=exhibition';
		$numero_exposicoes = $t_item->getWithTemplate($vs_template);

		$vs_template = '<unit relativeTo="ca_occurrences" restrictToTypes="exhibition" sort="ca_occurrences.exhibitionBeginDate" sortDirection="ASC" >^ca_occurrences.occurrence_id</unit>';
				
		$exposicoes_ids = $t_item->getWithTemplate($vs_template);
		
		$tem_exposicoes = false;
		if ($exposicoes_ids)
		{
			$tem_exposicoes = true;
			$exposicoes_ids = str_replace(" ", "", $exposicoes_ids);
			$exposicoes_ids = explode(";", $exposicoes_ids);
			
		}

		#print_r($exposicoes_ids);  

		#print("<br><br><br><br>");

		
		$vs_template = '^ca_occurrences._count%restrictToTypes=publicacao';
		$numero_publicacoes = $t_item->getWithTemplate($vs_template);
		
		$vs_template = '<unit relativeTo="ca_occurrences" restrictToTypes="publicacao" sort="ca_occurrences.exhibitionBeginDate" sortDirection="ASC" >^ca_occurrences.occurrence_id</unit>';

		$publicacoes_ids = $t_item->getWithTemplate($vs_template);
		
		$tem_publicacoes = false;
		if ($publicacoes_ids)
		{
			$tem_publicacoes = true;
			
			// Separa os códigos das obras num array
			$publicacoes_ids = str_replace(" ", "", $publicacoes_ids);
			$publicacoes_ids = explode(";",  $publicacoes_ids);
		}
		
		#print_r($publicacoes_ids); 

	?>
	
	<a name='exposicoes'></a>
	<div class="row" style="margin-top:50px;">
	
		<?php if ($numero_exposicoes)
		{
		?>
			<if rule="^index = 1">
				<H6>
				<span style="font-weight:bold; font-size:13px">
					<?php print _t("Exhibitions") . " (" . $numero_exposicoes . ")"; ?>
				</span>
					
				<?php if ($numero_publicacoes)
				{
				?>
				<span style="margin-left:30px">
					<a href="#publicacoes" style="text-decoration:none; color:#454545">
					<?php print _t("Publications") . " (" . $numero_publicacoes . ")"; ?>
					</a>
				</span>
				<?php
				}
				?>
				</H6>
				<HR>
			</if>
		<?php
		}
		?>

		
		<?php 
		$vn_col_span = 6;
		$vn_col_span_sm = 6;
		$vn_col_span_xs = 12;
		$vb_refine = false;		
		
		foreach ($exposicoes_ids as $vn_id)
		{
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

	<a name='publicacoes'></a>
	<div class="row" style="margin-top:20px;">
	
		<?php if ($numero_publicacoes)
		{
		?>
			<if rule="^index = 1">
				<H6>
				<span>
				<?php if ($numero_exposicoes)
				{
				?>
					<a href="#exposicoes" style="text-decoration:none; color:#454545">
						<?php print _t("Exhibitions") . " (" . $numero_exposicoes . ")"; ?>
					</span>
				<?php
				}
				?>
				
				<span 
				<?php if ($numero_publicacoes)
				{
					?>
						style="margin-left:30px"
					<?php
				}
				?>
				>
					<span style="font-weight:bold; font-size:13px">
					<?php print _t("Publications") . " (" . $numero_publicacoes . ")"; ?>
					</a>
				</span>
				
				</H6>
				<HR>
			</if>
		<?php 
		}
		?>
	
		<?php 

		$vn_col_span = 6;
		$vn_col_span_sm = 6;
		$vn_col_span_xs = 12;
		$vb_refine = false;		

		foreach ($publicacoes_ids as $vn_id)
		{
			
							
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
				
			</div><!-- end col -->
		</div><!-- end row -->

		
	</div>
	<div class='col-sm-3 col-md-3 col-lg-3'>
		<div id='additional-info' class='additional-info'>
            <div class='message'> <?php print _t("Quick tips"); ?> </div>
			<ul>
				<li><?php print _t("Click on the icon %1 for details about a work, exhibition, or publication.", "<span class='glyphicon glyphicon-info-sign'></span>") ?></li>					
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
            jQuery("#additional-info").html(data["results"] + data["button"]); 
        }); 
    }   

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
