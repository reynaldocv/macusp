<?php 
    $qr_ids             = $this->getVar('featured_set_ids'); 
    $vs_table           = $this->getVar('table');
    $vn_limit           = $this->getVar('limit');
    $vn_file            = $this->getVar('file');
    $vn_view            = $this->getVar('view');    
    $va_access_values 	= $this->getVar('access_values');	

    $o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");

	if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
		$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";

    $language = _t("flags:pawtucket:language");

    if ($vs_table === "ca_entities"){
        $vn_col_span = 4;
        $vn_col_span_sm = 6;
        $vn_col_span_xs = 12;
    }
    elseif ($vs_table === "ca_occurrences")
    {
        $vn_col_span = 4;
        $vn_col_span_sm = 6;
        $vn_col_span_xs = 12;
    }
    else{
        $vn_col_span = 3;
        $vn_col_span_sm = 4;
        $vn_col_span_xs = 6;
    }
    $vb_refine = false; 
    
?>
<br>
<div class="row">
    <div class="row" style="text-align:justify">
		<div class="col-sm-1">
		</div> <!--end col-sm-4-->	
		<div class="col-sm-10">
            <div class="row">
                <?php echo "<h1>".$vn_file["intro"]["title"]."</h1>" ?> 
                <hr>
            </div>

            <div class="row" style='text-align:justify'>        
                <?php include($vn_file["intro"][$language]); ?>
            </div>
        </div> <!--end col-sm-4-->	
        <div class="col-sm-1">
		</div> <!--end col-sm-4-->	
	</div>
</div>



<div class="row ">
    <div class="row" style="text-align:justify">
		<div class="col-sm-1">
		</div> <!--end col-sm-4-->	
		<div class="col-sm-10">
            <div class="row">
                <?php echo "<h1>".$vn_file["examples"]["title"]."</h1>" ?> 
                <hr>
            </div>
   
            <div class="row">
                
                <h4></h4><h4></h4>
                <?php 
                
                if ($vs_table != 'ca_objects'){
                    $va_images = caGetDisplayImagesForAuthorityItems($vs_table, $qr_ids , array('version' => 'icon', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'objectTypes' => caGetOption('selectMediaUsingTypes', $va_options, null), 'checkAccess' => $va_access_values));
                } 
                
                $counter = 0; 
                $t_list_item = new ca_list_items();

                foreach ($qr_ids as $vn_id)
                {
                    if ($counter === $vn_limit) { 
                        break; 
                    }

                    if ($vs_table === "ca_entities"){
                        $qr_res = new ca_entities($vn_id);
                    }
                    elseif ($vs_table === "ca_occurrences")
                    {
                        $qr_res = new ca_occurrences($vn_id);
                    }
                    else{
                        $qr_res = new ca_objects($vn_id);   
                    }

                    $vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
                    $vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels"), '', $vs_table, $vn_id);
                    $vs_type_placeholder = "";
                    $vs_typecode = "";
                    $vs_thumbnail = True;     
                    
                    $vs_image = ($vs_table === 'ca_objects') ? $qr_res->get("ca_object_representations.media", 'medium', array("checkAccess" => $va_access_values)) : $va_images[$vn_id];

                    if(!$vs_image){
                        $vs_thumbnail = False;  
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

                    if ($vs_thumbnail === True)
                    {
                        $counter += 1; 

                        $vs_rep_detail_link = caDetailLink($this->request, $vs_image, '', $vs_table, $vn_id);                        
                    
                        $vs_add_to_set_link = "";
                        if(($vs_table == 'ca_objects') && is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
                            $vs_add_to_set_link = "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', $va_add_to_set_link_info["controller"], 'addItemForm', array($vs_pk => $vn_id))."\"); return false;' title='".$va_add_to_set_link_info["link_text"]."'>".$va_add_to_set_link_info["icon"]."</a>";
                        }
                    
                        $info = False; 
                        include("boxes/$vs_table"."_"."$vn_view.php"); 

                        print $vs_result_output; 
                    }
                } ?>



                
            </div>
        <div class="col-sm-1">
		</div> <!--end col-sm-4-->	
	</div>     
</div>   
       
    <div class="click">
        
            <?php 
            $button = $vn_file["examples"]["button"]; 
            $linkButton = caNavLink($this->request, $button["label"] ,'macuspButton' ,'', $button["controller"], $button["action"]);
            
            
            print $linkButton; 
            ?>
        
    </div>
        
        
    





<?php 
    $counter = 0; 
    foreach ($afiches as $afiche) {
        $counter += 1; 

        $browser = $afiche["browser"]; 
        $facet = $afiche["facet"]; 
        $limit = $afiche["limit"]; 
        $visual = $afiche["visual"]; 
        $title = $afiche["title"]; 
        //print var_dump($afiche);
    

    ?>
        <!--<div class="row hpExplore">
        <div class="col-md-12 col-lg-10 col-lg-offset-1">
            <?php echo "<h1>".$title."</h1>" ?> 
        </div>

        <div class="row">
            <div id="afiche-<?php print $counter?>" class="col-md-12 col-lg-10 col-lg-offset-1">
                
            </div>
        </div>

        <script type="text/javascript">
            
            jQuery("#afiche-<?php print $counter?>").load("<?php print caNavUrl($this->request, '', 'afiches', $browser, array('facet' => $facet, 'visual' => $visual, 'limit' => $limit), array('dontURLEncodeParameters' => true)); ?>", function() {
                jQuery('#afiche-<?php print $counter?>').jscroll({
                    autoTrigger: true,
                    loadingHtml: '<?php print "hola" ?>',
                    padding: 20,
                    nextSelector: 'a.jscroll-next'
                });
            });
        </script>
        </div>-->





    <?php 
    }
?>




  