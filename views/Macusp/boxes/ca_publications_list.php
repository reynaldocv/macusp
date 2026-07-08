<?php 
	try{
		if ($qr_res)
		{
			$vn_label = $qr_res->get("ca_occurrences.preferred_labels.name");

			$vs_data = $qr_res->getWithTemplate('^ca_occurrences.datePeriod.datePeriod');								
								
			$preDetails = ""; 
			$postDetails = $vs_data; 
			
			$infoClick = ""; 

			if ($info == True)
			{
				$infoClick = "<span class='glyphicon glyphicon-info-sign' onclick='getInfoPublication($vn_id,2,$idno)'></span>"; 
			}
			$vs_result_output = "
				<div class='bResultListItemCol bResultListItemCol-publication col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
					<div class='bResultListItem bResultListItem-publication' id='row{$vn_id}' onmouseover='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").hide();'>
						<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
						<div class='bResultListItemContent bResultListItemContent-publication'><div class='text-center bResultListItemImg'>{$vs_rep_detail_link}</div>
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
	}
	catch (Exception $e) {

		$vs_result_output = "Program error..."; 
	}

?>