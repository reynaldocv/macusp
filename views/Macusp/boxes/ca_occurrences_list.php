<?php 

	$vn_label = $qr_res->get("ca_occurrences.preferred_labels.name");
						
	$preDetails = ""; 
	$postDetails = $qr_res->getWithTemplate("<h7>
		^ca_occurrences.exhibitionBeginDate - 
		^ca_occurrences.exhibitionEndDate
		</h7>
		");
	
	$infoClick = ""; 

	if ($info == True)
	{
		$infoClick = "<span class='glyphicon glyphicon-info-sign' onclick='getInfoExhibition($vn_id,2,$idno)'></span>"; 
	}

	#reynaldocv - comment the following code line to show the images...
	$vs_rep_detail_link = ""; 

	$vs_result_output = "
		<div class='bResultListItemCol bResultListItemCol-exhibition col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
			<div class='bResultListItem bResultListItem-exhibition' id='row{$vn_id}' onmouseover='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").hide();'>
				<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
				<div class='bResultListItemContent bResultListItemContent-exhibition '><div class='text-center bResultListItemImg'>{$vs_rep_detail_link}</div>
					<div class='bResultListItemText'>
						$preDetails 
						<small></small>{$vs_label_detail_link}
						<div class='box-contains'>{$postDetails}</div>
						$infoClick
					</div><!-- end bResultListItemText -->
				</div><!-- end bResultListItemContent -->								
			</div><!-- end bResultListItem -->
		</div><!-- end col -->"; 

?>