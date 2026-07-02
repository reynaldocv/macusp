

<?php
    $qr_res = $this->getVar('result');				// browse results (subclass of SearchResult)
    
    

    if ($qr_res)
    {
        $vn_result_size = $qr_res->numHits();
        
        if ($vn_result_size <= 0){
            print "<h4>"._t("No results").":</h4>"; 
        
        }elseif ($vn_result_size <= 1){
            print "<h4>"._t("One result").":</h4>"; 
        }

        else{
            print "<h4>"._t("%1 results", $vn_result_size).":</h4>";
        }
        print "<HR>";

        if ($vn_result_size > 0)
        {
            
            $va_facets 			= $this->getVar('facets');				// array of available browse facets
            $va_criteria 		= $this->getVar('criteria');			// array of browse criteria
            $vs_browse_key 		= $this->getVar('key');					// cache key for current browse
            $va_access_values 	= $this->getVar('access_values');		// list of access values for this user
            $vn_hits_per_block 	= (int)$this->getVar('hits_per_block');	// number of hits to display per block
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
            $vn_col_span_xs = 12;
            $vb_refine = false;

            if ($vs_table == 'ca_entities') {
                $vn_col_span = 4;
                $vn_col_span_sm = 6;
                $vn_col_span_xs = 12;
            }
            if ($vs_table == 'ca_occurrences') {
                $vn_col_span = 6;
                $vn_col_span_sm = 12;
                $vn_col_span_xs = 12;


                
            }
            if ($vs_table != 'ca_objects') {
				$va_ids = array();
				while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
					$va_ids[] = $qr_res->get($vs_pk);
					$vn_c++;
				}
				$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'icon', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'objectTypes' => caGetOption('selectMediaUsingTypes', $va_options, null), 'checkAccess' => $va_access_values));
			
				$vn_c = 0;	
				$qr_res->seek(0);
			}
			
            
            $t_list_item = new ca_list_items();
            
            while($qr_res->nextHit()) {

                $vn_id 	= $qr_res->get("{$vs_table}.{$vs_pk}");

                $vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
                $vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels"), '', $vs_table, $vn_id);

                $vs_image = ($vs_table === 'ca_objects') ? $qr_res->getMediaTag("ca_object_representations.media", 'icon', array("checkAccess" => $va_access_values)) : $va_images[$vn_id];
				
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
                if ($vs_table === 'ca_objects') {					
                    $vs_rep_detail_link 	= caDetailLink($this->request, $vs_image, '', $vs_table, $vn_id);	
                }

                $vs_thumbnail = "";
                $vs_type_placeholder = "";
                $vs_typecode = "";
                
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
                
                $vs_rep_detail_link 	= caDetailLink($this->request, $vs_image, '', $vs_table, $vn_id);	
                
            
                $vs_expanded_info = $qr_res->getWithTemplate($vs_extended_info_template);
               
                $info =  True;                                       
                include("boxes/$vs_table"."_"."list.php"); 

                $vs_result_output = "<div class='bResultList'>{$vs_result_output}</div><!-- end col -->";					
                print $vs_result_output;

            }


           
        }                

    }
    else
    {
        
    }
    ?>