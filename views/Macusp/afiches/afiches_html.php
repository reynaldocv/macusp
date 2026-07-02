<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_refine_subview_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014-2015 Whirl-i-Gig
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
 
	$va_facets 			= $this->getVar('facets');				// array of available browse facets
	$va_criteria 		= $this->getVar('criteria');			// array of browse criteria
	$vs_key 			= $this->getVar('key');					// cache key for current browse
	$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
	$vs_view			= $this->getVar('view');
	$vs_table			= $this->getVar('table');
	$vs_pk				= $this->getVar('primaryKey');
	$vs_browse_type		= $this->getVar('browse_type');
	$va_options			= $this->getVar('options');

	$o_browse			= $this->getVar('browse');
	$o_afiche 			= $this->getVar('facet');	
	//$o_limit 			= ($this->getVar('limit')) ? int($this->getVar('limit')): 3; 	
	$o_limit 			= 5; 
	$o_visual 			= $this->getVar('visual');
	
	$qr_res 			= $this->getVar('result');
	
	$o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");
	if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
		$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";

	if ($o_visual == "image")
	{	
		$vs_image == null; 
		if ($qr_res)
		{
			while ($vs_image == null){
				$qr_res->nextHit(); 
			
				$vn_id = $qr_res->get("{$vs_table}.{$vs_pk}");
				
				$vn_ids = array(); 
				$vn_ids[] = $vn_id; 
				
				if ($vs_table !== 'ca_objects'){
					$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'small', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'objectTypes' => caGetOption('selectMediaUsingTypes', $va_options, null), 'checkAccess' => $va_access_values));
				}
				
				$vs_image = ($vs_table === 'ca_objects') ? $qr_res->get("ca_object_representations.media.small") : $va_images[$vn_id];
						
				if (!$vs_image){

				}
			}	
			
		}
		print json_encode(array("image" => "hola"));		
	}	
	
	elseif ($o_visual == "blocks")
	{
		$elements = array(); 
		if(is_array($va_facets) && sizeof($va_facets)){
			foreach($va_facets as $vs_facet_name => $va_facet_info) {	
				if ($vs_facet_name === $o_afiche)
				{
						
					//print "<H5><span>+</span>".mb_strtoupper($va_facet_info['label_singular'])."</H5>"; 
					switch($va_facet_info["group_mode"]){
						case "alphabetical":
						case "list":
						default:
							$vn_facet_size = sizeof($va_facet_info['content']);
							$vn_c = 0;
							foreach($va_facet_info['content'] as $va_item) {
								//var_dump($va_item); 
								//print "<br><br>"; 
								$vs_content_count = (isset($va_item['content_count']) && ($va_item['content_count'] > 0)) ? $va_item['content_count'] : "";
								$vs_label = "";
								if($va_facet_info["table"] == "ca_entities"){
									$vs_label = $va_item["displayname"].(($va_item["displayname"]) ? ", ".$va_item["displayname"] : "");
									if(!$vs_label){
										$vs_label = $va_item['label'];
									}
								}else{
									$vs_label = $va_item['label'];
								}

								
								$vs_image = caNavUrl($this->request, '', '*', '*', array('key' => $vs_key, 'facet' => $vs_facet_name, 'id' => $va_item['id'], 'view' => $vs_view, 'limit' => $o_limit, 'visual' => 'image'));
								$vs_link = caNavLink($this->request, $va_item['label'], '', '*', '*','*', array('key' => $vs_key, 'facet' => $vs_facet_name, 'id' => $va_item['id'], 'view' => $vs_view, 'limit' => $o_limit, 'visual' => $o_visual));
								
								$elements[] = array($vs_content_count, $vs_label, $vs_image, $vs_link); 

								$vn_c++;
							
							}// 						
						break;
						# ---------------------------------------------
					
					}
				
					rsort($elements); 
					$counter = -1; 	

					print "<div class='afiches'>";				
					foreach ($elements as $element){
						$counter += 1; 
						if ($counter == $o_limit) { break; }

						$block = "<div class='bloques'>".$element[1]."<div><span>".$element[0]."</span><h1>".$element[3]."</h1>"."</div></div>";
						print $block; 

						$url = "http://localhost/$element[2]"; 
						
												
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$json_data = curl_exec($ch);
						curl_close($ch);

						$data = json_decode($json_data, True);

						print "<div style='background-color:pink'>".$data["image"]."</div>"; 

						print $json_data["image"]; 
					}				
					print "</div><!-- end bRefineFacet -->";
				}
			}	
		}
	

	}
?>

