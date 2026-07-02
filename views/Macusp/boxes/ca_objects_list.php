<?php 
	try{
		if ($qr_res)
		{
			/*if (strlen($vs_label_detail_link) > 70) 
			{
				$vs_label_detail_link = substr($vs_label_detail_link, 0, 70); 
			}*/

			$vs_authors = $qr_res->getWithTemplate("<unit relativeTo='ca_entities' excludeRelationshipTypes='doador' restrictToTypes='Artista' delimiter='<br>'>
																			<b>^ca_entities.preferred_labels.displayname</b>
																		</unit>"); 

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
					
			$vs_label_detail_link = "<a href='#'>"._("Título")."</a>"; 
			$preDetails = "<h5>"._("Autoria")."</h5>"; 
			$postDetails = "<h7>"._("Data")."</h7>"; 
			
		}
		$vs_result_output = "
				<div class='bResultListItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
					<div class='bResultListItem' id='row{$vn_id}' onmouseover='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").hide();'>
						<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
						<div class='bResultListItemContent'><div class='text-center bResultListItemImg'>{$vs_rep_detail_link}</div>
							<div class='bResultListItemText'>
								$preDetails 
								<small></small>{$vs_label_detail_link}
								<div style='margin-top:5px; margin-left:10px'>{$postDetails}</div>
								$infoClick
							</div><!-- end bResultListItemText -->
						</div><!-- end bResultListItemContent -->								
					</div><!-- end bResultListItem -->
				</div><!-- end col -->"; 

	}
	catch (Exception $e) {

		$vs_result_output = "Program error..."; 
	}
?>
			
