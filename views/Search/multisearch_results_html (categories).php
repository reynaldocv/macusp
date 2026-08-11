<?php
	$va_results = $this->getVar('results');
	$va_result_count = count($va_results);
	$vs_table = $this->getVar('table');

	$o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");
	if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
		$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";
	
	//print_r($this->getVar('results'));
	//print($vs_table); 

	if ($va_result_count > 0) {
?>
		<h1> <?php print _t("Search results %1 for %2", $va_result_count, caUcFirstUTF8Safe($this->getVar('searchForDisplay'))); ?> </h1>
<?php
		// 
		// Print out block content (results for each type of search)
		//
		$vn_col_span = 4;
		$vn_col_span_sm = 4;
		$vn_col_span_xs = 12;
		$vb_refine = false;

		if ($vs_table == 'ca_entities') {
			$vn_col_span = 4;
			$vn_col_span_sm = 4;
			$vn_col_span_xs = 12;
		}
		if ($vs_table == 'ca_occurrences') {
			$vn_col_span = 6;
			$vn_col_span_sm = 6;
			$vn_col_span_xs = 12;

		}
			
		$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_results, array('version' => 'icon', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'objectTypes' => caGetOption('selectMediaUsingTypes', $va_options, null), 'checkAccess' => $va_access_values));
        

		foreach($va_results as $vn_id) {
			
			if ($vs_table == 'ca_entities') {
				$t_item = new ca_entities($vn_id); 

				$vs_surname = $t_item->get("{$vs_table}.preferred_labels.surname");
				$vs_forename = $t_item->get("{$vs_table}.preferred_labels.forename");
				//$vs_preferred_labels 	= caDetailLink($this->request, $vs_surname.(($vs_surname && $vs_forename) ? ", " : "").$vs_forename, '', $vs_table, $vn_id);
						
				
				$vn_label = $t_item->get("ca_entities.preferred_labels.displayname");
				$vs_label_link = caNavLink($this->request, $vn_label , '', "","artistsDetail","artist/".$vn_id);
					
				$vs_data_birthday = $t_item->getWithTemplate("
					^ca_entities.DadosBiograficos.LocalNascimento.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=2%delimiter=_➜_
					<ifdef code='ca_entities.DadosBiograficos.AnoNascimento'>
						(^ca_entities.DadosBiograficos.AnoNascimento)
					</ifdef>"
					);
				

				$vs_data_deathday = $t_item->getWithTemplate("
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

				$vn_icon = "<span class='glyphicon glyphicon-info-sign' onclick='getInfoArtist($vn_id)'></span>";
				
				$vs_thumbnail = "";

				if($va_images[$vn_id]){
					$vs_thumbnail = $va_images[$vn_id];
				}else{
					//$vs_thumbnail = $vs_default_placeholder_tag;
				}
					
				$vs_result_output = "
					<div class='bResultListItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
						<div class='' id='row{$vn_id}'>
							<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
							<div class='bResultListItemContent'><div class='text-center bResultListItemImg'>{$vs_rep_detail_link}</div>
								<div class='triangle'>
									$vs_label_link 	
									$vs_data $vs_thumbnail
									$vn_icon
								</div>
							</div><!-- end bResultListItemContent -->
							
						</div><!-- end bResultListItem -->
					</div><!-- end col -->";
	
			}
			elseif ($vs_table == 'ca_occurrences') {
				$t_item = new ca_occurrences($vn_id); 
				
				$vn_label = $t_item->get("ca_occurrences.preferred_labels.name");
				$vs_label_link = caNavLink($this->request, $vn_label , '', "","exhibitionsDetail","exhibition/".$vn_id);
				
				$vs_thumbnail = "";

				if($va_images[$vn_id]){
					$vs_thumbnail = $va_images[$vn_id];
				}else{
					//$vs_thumbnail = $vs_default_placeholder_tag;
				}
				
				$vs_data = $t_item->getWithTemplate("<p>
					^ca_occurrences.exhibitionBeginDate - 
					^ca_occurrences.exhibitionEndDate
					</p>
					");

				$vn_icon = "<span><span class='glyphicon glyphicon-info-sign' onclick='getInfoExhibition($vn_id)'></span></span>";                        
					
				$vs_result_output = "
					<div class='bResultListItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
						<div class='' id='row{$vn_id}'>
							<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'>
							</div>
							<div class='rectangle'>
								$vs_label_link 	
								$vs_data 
								$vs_thumbnail	
								$vn_icon									
							</div>									
						</div><!-- end bResultListItem -->
					</div><!-- end col -->";
	
			}
			else
			{
				$t_item = new ca_objects($vn_id); 

				$vs_idno_detail_link 	= caDetailLink($this->request, $t_item->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
				$vs_label_detail_link   = caNavLink($this->request, $t_item->get("{$vs_table}.preferred_labels") , '', "","worksDetail","artwork/".$vn_id);
                //$vs_label_detail_link 	= caDetailLink($this->request, $t_item->get("{$vs_table}.preferred_labels"), '', $vs_table, $vn_id);
				$vs_date_work = $t_item->getWithTemplate("<ifdef code='ca_objects.datePeriod'> ^ca_objects.datePeriod</ifdef>"); 
                $vs_date_work = substr($vs_date_work, 0,-1); 
										
				$vs_thumbnail = "";
				$vs_type_placeholder = "";
				$vs_typecode = "";
				$vs_image = ($vs_table === 'ca_objects') ? $t_item->getMediaTag("ca_object_representations.media", 'icon', array("checkAccess" => $va_access_values)) : $va_images[$vn_id];
				
				/*if(!$vs_image){
					if ($vs_table == 'ca_objects') {
						$t_list_item->load($qr_res->get("type_id"));
						$vs_typecode = $t_list_item->get("idno");
						if($vs_type_placeholder = caGetPlaceholder($vs_typecode, "placeholder_media_icon")){
							$vs_image = "<div class='bResultItemImgPlaceholder'>".$vs_type_placeholder."</div>";
						}else{
							$vs_image = $vs_default_placeholder_tag;
						}
					}else{
						$vs_image = $vs_default_placeholder_tag;
					}
				}*/

				$vs_thumbnail = "";

				if($va_images[$vn_id]){
					$vs_thumbnail = $va_images[$vn_id];
				}else{
					$vs_thumbnail = $vs_default_placeholder_tag;
				}

				$vs_image = $vs_thumbnail;
				
				//$vs_rep_detail_link 	= caDetailLink($this->request, , '', $vs_table, $vn_id);
				$vs_rep_detail_link   = caNavLink($this->request, $vs_image , '', "","worksDetail","artwork/".$vn_id);
                	
			
				$vs_add_to_set_link = "";
				if(($vs_table == 'ca_objects') && is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
					$vs_add_to_set_link = "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', $va_add_to_set_link_info["controller"], 'addItemForm', array($vs_pk => $vn_id))."\"); return false;' title='".$va_add_to_set_link_info["link_text"]."'>".$va_add_to_set_link_info["icon"]."</a>";
				}
				$vs_authors = $t_item->getWithTemplate("<unit relativeTo='ca_entities' restrictToRelationshipTypes='creator,collective_creator,editor,produtor,organizador'>
                                                                    <b>^ca_entities.preferred_labels.displayname</b><br>
                                                                </unit>"); 
                        
			
				$vs_expanded_info = $t_item->getWithTemplate($vs_extended_info_template);

				$vn_icon = "<span class='glyphicon glyphicon-info-sign' onclick='getInfoWork($vn_id)'></span>";   

				$vs_result_output = "
					<div class='bResultListItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
						<div class='bResultListItem' id='row{$vn_id}'>
							<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
							<div class='bResultListItemContent'><div class='text-center bResultListItemImg'>{$vs_rep_detail_link}</div>
								<div class='bResultListItemText'>
									    {$vs_authors}
										<br/>{$vs_label_detail_link}
										<br/>{$vs_date_work}
										{$vn_icon}
								</div><!-- end bResultListItemText -->
							</div><!-- end bResultListItemContent -->                                    
						</div><!-- end bResultListItem -->
					</div><!-- end col -->";

				/*$vs_result_output = "
					<div class='bResultListItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
						<div class='bResultListItem' id='row{$vn_id}' onmouseover='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultListItemExpandedInfo{$vn_id}\").hide();'>
							<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'></div>
							<div class='bResultListItemContent'><div class='text-center bResultListItemImg'>{$vs_rep_detail_link}</div>
								<div class='bResultListItemText'>
									<small>{$vs_idno_detail_link}</small><br/>{$vs_label_detail_link}
								</div><!-- end bResultListItemText -->
							</div><!-- end bResultListItemContent -->
							<div class='bResultListItemExpandedInfo' id='bResultListItemExpandedInfo{$vn_id}'>
								<hr>
								{$vs_expanded_info}{$vs_add_to_set_link}
							</div><!-- bResultListItemExpandedInfo -->
						</div><!-- end bResultListItem -->
					</div><!-- end col -->";*/
			}

			$vs_result_output = "<div class='bResultList'>{$vs_result_output}</div><!-- end col -->";					
			print $vs_result_output;
				
				
			

			//$vs_result_output = "<div class='bResultList'>{$t_item->get('ca_entities.preferred_labels.displayname')}</div><!-- end col -->";					
			//print $vs_result_output;
		
		
		} 
	} else {
		print "<H4>"._t("Your search for %1 returned no results", caUcFirstUTF8Safe($this->getVar('search')))."</H4>";
		
		$o_search = caGetSearchInstance('ca_objects');
		if (sizeof($va_suggestions = $o_search->suggest($this->getVar('search'), array('returnAsLink' => true, 'request' => $this->request)))) {
			if (sizeof($va_suggestions) > 1) {
				print "<p>"._t("Did you mean one of these: %1?", join(', ', $va_suggestions))."</p>";
			} else {
				print "<p>"._t("Did you mean %1?", join(', ', $va_suggestions))."</p>";
			}
		}
	}
?>
<?php
	TooltipManager::add('#Block', 'Type of record');
?>