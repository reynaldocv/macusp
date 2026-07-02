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

				$vs_data_birthday = "<h7>☼ $vs_data_birthday </h7>"; 
			}

			if (trim($vs_data_deathday)){
				$idx = strpos($vs_data_deathday, "➜");
				
				if ($idx != false)
					$vs_data_deathday = "".substr($vs_data_deathday, $idx + 3)."";
				
				$vs_data_deathday = "<h7>&nbsp;†  $vs_data_deathday </h7>"; 
			}
			
			$vs_data = "$vs_data_birthday $vs_data_deathday";
			
			
			$preDetails = ""; 
			$postDetails = "$vs_data_birthday <br> $vs_data_deathday";

			if ($info === True )
			{
				$infoClick = "<span class='glyphicon glyphicon-info-sign' onclick='getInfoArtist($vn_id)'></span>"; 
			}
			
			//$vs_rep_detail_link = ""; 
			$vs_result_output = "
			<div class='bResultListItemCol bResultListItemCol-artist col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
				<div class='bResultListItem bResultListItem-artist' id='row{$vn_id}' onmouseover='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").hide();'>
					<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
					<div class='bResultListItemContent bResultListItemContent-artist '><div class='text-center bResultListItemImg bResultListItemImg-artist'>{$vs_rep_detail_link}</div>
						<div class='bResultListItemText'>
							$preDetails 
							<small></small>{$vs_label_detail_link}
							<div class='box-contains'>{$postDetails}</div>
							$infoClick
						</div><!-- end bResultListItemText -->
					</div><!-- end bResultListItemContent -->				
				</div><!-- end bResultListItem -->
			</div><!-- end col -->";	
			
		}
		else{
			$vs_rep_detail_link = "<a href='#'>".$vs_default_placeholder_tag."</a>";					
			$vs_label_detail_link = "<a href='#'>"._("Name")."</a>"; 
			$postDetails = "<h7>☼  País de nascimento, ano de nascimento.</h7> <br>
							<h7>&nbsp;† País de morte, ano de morte (se pertinente).</h7>"; 
			$vn_col_span_xs_default = 8; 
			$vn_col_span_sm_default = 8; 
			$vn_col_span_default = 8; 

			$vs_result_output = "
			<div class='bResultListItemCol bResultListItemCol-artist col-xs-{$vn_col_span_xs_default} col-sm-{$vn_col_span_sm_default} col-md-{$vn_col_span_default}'>
				<div class='bResultListItem bResultListItem-artist' id='row{$vn_id}' onmouseover='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").hide();'>
					<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
					<div class='bResultListItemContent bResultListItemContent-artist '><div class='text-center bResultListItemImg bResultListItemImg-artist'>{$vs_rep_detail_link}</div>
						<div class='bResultListItemText'>
							$preDetails 
							<small></small>{$vs_label_detail_link}
							<div class='box-contains'>{$postDetails}</div>
							$infoClick
						</div><!-- end bResultListItemText -->
					</div><!-- end bResultListItemContent -->				
				</div><!-- end bResultListItem -->
			</div><!-- end col -->";	

		}
		
	}
	catch (Exception $e) {
		$vs_result_output = "Program error..."; 
	}
	?>