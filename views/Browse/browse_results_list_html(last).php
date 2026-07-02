<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_results_images_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
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
 
	$qr_res 			= $this->getVar('result');				// browse results (subclass of SearchResult)
	$va_facets 			= $this->getVar('facets');				// array of available browse facets
	$va_criteria 		= $this->getVar('criteria');			// array of browse criteria
	$vs_browse_key 		= $this->getVar('key');					// cache key for current browse
	$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
	$vn_hits_per_block 	= (int)$this->getVar('hits_per_block');	// number of hits to display per block
	$vn_start		 	= (int)$this->getVar('start');			// offset to seek to before outputting results
	$vn_row_id		 	= (int)$this->getVar('row_id');			// id of last visited detail item so can load to and jump to that result - passed in back button
	$vb_row_id_loaded 	= false;
	if(!$vn_row_id){
		$vb_row_id_loaded = true;
	}
	
	$va_views			= $this->getVar('views');
	$vs_current_view	= $this->getVar('view');
	$va_view_icons		= $this->getVar('viewIcons');
	$vs_current_sort	= $this->getVar('sort');
	
	$t_instance			= $this->getVar('t_instance');
	$vs_table 			= $this->getVar('table');
	$vs_pk				= $this->getVar('primaryKey');
	$o_config = $this->getVar("config");	
	
	$va_options			= $this->getVar('options');
	$vs_extended_info_template = caGetOption('extendedInformationTemplate', $va_options, null);

	$vb_ajax			= (bool)$this->request->isAjax();

	$o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");
	if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
		$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";

	$va_add_to_set_link_info = caGetAddToSetInfo($this->request);
	
		$vn_col_span = 4;
		$vn_col_span_sm = 6;
		$vn_col_span_xs = 11;
		$vb_refine = false;

		if ($vs_table == 'ca_entities') {
			$vn_col_span = 3;
			$vn_col_span_sm = 6;
			$vn_col_span_xs = 11;
		}
		if ($vs_table == 'ca_occurrences') {
			$vn_col_span = 6;
			$vn_col_span_sm = 11;
			$vn_col_span_xs = 11;

		}

		if(is_array($va_facets) && sizeof($va_facets)){
			$vb_refine = true;
		}
		if ($vn_start < $qr_res->numHits()) {
			$vn_c = 0;
			$vn_results_output = 0;
			$qr_res->seek($vn_start);
			
			if ($vs_table != 'ca_objects') {
				$va_ids = array();
				while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
					$va_ids[] = $qr_res->get("{$vs_table}.{$vs_pk}");
				}
			
				$qr_res->seek($vn_start);
				$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'icon', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'objectTypes' => caGetOption('selectMediaUsingTypes', $va_options, null), 'checkAccess' => $va_access_values));
			} else {
				$va_images = null;
			}
			//print_r($va_images)
			
			$t_list_item = new ca_list_items();
			while($qr_res->nextHit()) {
				if($vn_c == $vn_hits_per_block){
					$var = ($vn_start + $cnt)/($qr_res->numHits())*100; 

					echo "<script type='text/javascript'> 
							progessbar('$var');
					  	</script>";
						
					if($vb_row_id_loaded){
						break;
					}else{
						$vn_c = 0;
					}
				}
				$vn_id 					= $qr_res->get("{$vs_table}.{$vs_pk}");

				if($vn_id == $vn_row_id){
					$vb_row_id_loaded = true;
				}
				# --- check if this result has been cached
				# --- key is MD5 of table, id, view, refine(vb_refine)
				$vs_cache_key = md5($vs_table.$vn_id."list".$vb_refine);
				if(($o_config->get("cache_timeout") > 0) && ExternalCache::contains($vs_cache_key,'browse_result')){
					print ExternalCache::fetch($vs_cache_key, 'browse_result');
				}else{
					if ($vs_table == 'ca_entities') {
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
											$vs_data
											$vs_thumbnail											
										</div>
									</div><!-- end bResultListItemContent -->
									
								</div><!-- end bResultListItem -->
							</div><!-- end col -->";
			
					}
					elseif ($vs_table == 'ca_occurrences') {
						$vn_label = $qr_res->get("ca_occurrences.preferred_labels.name");
						$vs_label_link = caNavLink($this->request, $vn_label , '', "","exhibitionsDetail","exhibition/".$vn_id);
						
						$vs_thumbnail = "";

						if($va_images[$vn_id]){
							$vs_thumbnail = $va_images[$vn_id];
						}else{
							//$vs_thumbnail = $vs_default_placeholder_tag;
						}
						
						$vs_data = $qr_res->getWithTemplate("<p>
							^ca_occurrences.exhibitionBeginDate - 
							^ca_occurrences.exhibitionEndDate
							</p>
							");
							
						$vs_result_output = "
							<div class='bResultListItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
								<div class='' id='row{$vn_id}'>
									<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids[]' value='{$vn_id}'>
									</div>
									<div class='rectangle'>
										$vs_label_link 	
										$vs_data 
										$vs_thumbnail										
									</div>									
								</div><!-- end bResultListItem -->
							</div><!-- end col -->";
			
					}
					else
					{
						$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
						$vs_label_detail_link 	= caNavLink($this->request, $qr_res->get("{$vs_table}.preferred_labels"), '', '', 'WorksDetail', "artwork/$vn_id");
						$vs_date_work = $qr_res->getWithTemplate("<ifdef code='ca_objects.datePeriod'><br>^ca_objects.datePeriod</ifdef>"); 

                        $vs_authors = $qr_res->getWithTemplate("<unit relativeTo='ca_entities' excludeRelationshipTypes='doador' restrictToTypes='Artista' delimiter=' '>
                                                                    <b>^ca_entities.preferred_labels.displayname</b>
                                                                </unit><br>"); 
												
						$vs_thumbnail = "";
						$vs_type_placeholder = "";
						$vs_typecode = "";
						$vs_image = ($vs_table === 'ca_objects') ? $qr_res->getMediaTag("ca_object_representations.media", 'small', array("checkAccess" => $va_access_values)) : $va_images[$vn_id];
					
						if(!$vs_image){
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
						}
						$vs_rep_detail_link 	= caNavLink($this->request, $vs_image, '', '', 'WorksDetails', 'artwork/'.$vn_id);	
					
						$vs_add_to_set_link = "";
						if(($vs_table == 'ca_objects') && is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
							$vs_add_to_set_link = "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', $va_add_to_set_link_info["controller"], 'addItemForm', array($vs_pk => $vn_id))."\"); return false;' title='".$va_add_to_set_link_info["link_text"]."'>".$va_add_to_set_link_info["icon"]."</a>";
						}
					
						$vs_expanded_info = $qr_res->getWithTemplate($vs_extended_info_template);

						$vs_result_output = "
							<div class='bResultListItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
								<div class='bResultListItem' id='row{$vn_id}'>
									<div class='bResultListItemContent'><div class='text-center bResultListItemImg'>{$vs_rep_detail_link}</div>
										<div class='bResultListItemText'>
											<small></small><br/>{$vs_authors}{$vs_label_detail_link}{$vs_date_work}
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
										
					ExternalCache::save($vs_cache_key, 'browse_result');
					print $vs_result_output;
				}				
				$vn_c++;
				$vn_results_output++;
			}
			print caNavLink($this->request, _t('Next %1', $vn_hits_per_block), 'jscroll-next', '*', '*', '*', array('s' => $vn_start + $vn_results_output, 'key' => $vs_browse_key, 'view' => $vs_current_view, 'sort' => $vs_current_sort, '_advanced' => $this->getVar('is_advanced') ? 1 : 0));
		
			//print "<div style='clear:both'></div>".caNavLink($this->request, _t('Next %1', $vn_hits_per_block), 'jscroll-next', '*', '*', '*', array('s' => $vn_start + $vn_results_output, 'key' => $vs_browse_key, 'view' => $vs_current_view, 'sort' => $vs_current_sort, '_advanced' => $this->getVar('is_advanced') ? 1  : 0));
		}
		else{
			echo "<script type='text/javascript'> 
					fullprogessbar();
				 </script>";
		}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		if($("#bSetsSelectMultipleButton").is(":visible")){
			$(".bSetsSelectMultiple").show();
		}
	});
</script>