<?php 
	try{
		if ($qr_res)
		{
			$vs_surname = $qr_res->get("{$vs_table}.preferred_labels.surname");
			$vs_forename = $qr_res->get("{$vs_table}.preferred_labels.forename");
			//$vs_preferred_labels 	= caDetailLink($this->request, $vs_surname.(($vs_surname && $vs_forename) ? ", " : "").$vs_forename, '', $vs_table, $vn_id);
					
			$vs_data_birthday = $qr_res->getWithTemplate("
				^ca_entities.DadosBiograficos.LocalNascimento.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=2%delimiter=_➜_
				<ifdef code='ca_entities.DadosBiograficos.AnoNascimento'>
					(^ca_entities.DadosBiograficos.AnoNascimento)
				</ifdef>"
				);
			

			$vs_data_deathday = $qr_res->getWithTemplate("
				^ca_entities.DadosBiograficos.LocalMorte.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=2%%delimiter=_➜_
				<ifdef code='ca_entities.DadosBiograficos.AnoMorte'>
					(^ca_entities.DadosBiograficos.AnoMorte)
				</ifdef>
				");

			if (trim($vs_data_birthday)){
				$idx = strpos($vs_data_birthday, "➜");
				
				if ($idx != false)
					$vs_data_birthday = "".substr($vs_data_birthday, $idx + 3)."";

				$vs_data_birthday = "<p>☼ $vs_data_birthday </p>"; 
			}

			if (trim($vs_data_deathday)){
				$idx = strpos($vs_data_deathday, "➜");
				
				if ($idx != false)
					$vs_data_deathday = "".substr($vs_data_deathday, $idx + 3)."";
				
				$vs_data_deathday = "<p>&nbsp;†  $vs_data_deathday </p>"; 
			}
			
			$vs_data = "$vs_data_birthday $vs_data_deathday";
			
			$vn_label = $qr_res->get("ca_entities.preferred_labels.displayname");
			$vs_label_link = caNavLink($this->request, $vn_label , '', "","artistsDetail","artist/".$vn_id);
			
			##$preDetails = ""; 
			##$postDetails = "<h7>$vs_data_birthday</h7><h7>$vs_data_deathday</h7>";

			if ($info === True )
			{
				$infoClick = "<span class='glyphicon glyphicon-info-sign' onclick='getInfoArtist($vn_id)'></span>"; 
			}
			
			//$vs_rep_detail_link = ""; 
			
		}
		else{
			
			
			$vs_rep_detail_link = "<a href='#'>".$vs_default_placeholder_tag."</a>";
					
			$vs_label_detail_link = "<a href='#'>"._("Name")."</a>"; 

			$postDetails = "<h7><p>†  País de nascimento, ano de nascimento.</p></h7> 
							<h7><p>☼ País de morte, ano de morte (se pertinente).</p></h7>"; 
			
			

		}
		$vs_result_output = "
			<div class='bResultList bResultList-artist-name  col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
				{$vs_label_detail_link}		 		
			</div><!-- end col -->";	
	}
	catch (Exception $e) {

		$vs_result_output = "Program error..."; 
	}
	?>