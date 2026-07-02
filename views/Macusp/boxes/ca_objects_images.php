<?php 
	try{
		if ($qr_res)
		{
			$vs_authors = $qr_res->getWithTemplate("<unit relativeTo='ca_entities' excludeRelationshipTypes='doador' restrictToTypes='Artista' delimiter=' '>
																			<b>^ca_entities.preferred_labels.displayname</b>
																		</unit><br>"); 

			$vs_date_work = $qr_res->getWithTemplate("<ifdef code='ca_objects.datePeriod'><unit relativeTo='ca_objects.datePeriod' delimiter=' '>^ca_objects.datePeriod </unit></ifdef>"); 
			
			$preDetails = "<h5>$vs_authors</h5>"; 
			$postDetails = "<h7>$vs_date_work</h7>"; 

			if ($info === True )
			{
				$infoClick = "<span class='glyphicon glyphicon-info-sign' onclick='getInfoWork($vn_id)'></span>"; 
			}
		}
		else{
			
			
			$vs_rep_detail_link = "<a href='#'>".$vs_default_placeholder_tag."</a>";
					
			$vs_label_detail_link = "<a href='#'>"._("Titulo")."</a>"; 
			$preDetails = "<h5>"._("Autoria")."</h5>"; 
			$postDetails = "<h7>"._("Data")."</h7>"; 
			
		}

		$vs_result_output = "
			<div class='bResultItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
				<div class='bResultItem' id='row{$vn_id}' onmouseover='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").hide();'>
					<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids' value='{$vn_id}'></div>
					<div class='bResultItemContent'><div class='text-center bResultItemImg'>{$vs_rep_detail_link}</div>
						<div class='bResultItemText'>
							$preDetails 
							<small></small>{$vs_label_detail_link}
							<div>{$postDetails}</div>
						</div><!-- end bResultItemText -->
					</div><!-- end bResultItemContent -->
					<div class='bResultItemExpandedInfo' id='bResultItemExpandedInfo{$vn_id}'>
						<hr>
						{$vs_expanded_info}{$vs_add_to_set_link}
					</div><!-- bResultItemExpandedInfo -->
				</div><!-- end bResultItem -->
			</div><!-- end col -->";
	}
	catch (Exception $e) {

		$vs_result_output = "Program error..."; 
	}
?>