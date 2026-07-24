<?php
    $search = strtoupper($this->getVar("search")); 
    $item = $this->getVar("item"); 

    $id = $item->get("ca_occurrences.occurrence_id");
    $idno = $item->get("ca_occurrences.idno");
    $name = $item->get("ca_occurrences.preferred_labels.name");
    $date = $item->get("ca_occurrences.exhibitionBeginDate");

    $date  = $date.$item->getWithTemplate("<ifcode='ca_occurrences.exhibitionBeginDate'> - ^ca_occurrences.exhibitionBeginDate  </ifcode>");

    $local = $item->getWithTemplate("<unit relativeTo='ca_entities' restrictToRelationshipTypes='local_exposicao'>
                            ^ca_entities.preferred_labels
                        </unit>");
    
    /*$obrasMACUSP = ""; 

    $List_obrasMACUSP = $item->getWithTemplate("<unit relativeTo='ca_objects' delimiter='#' >
                                                    ^ca_objects.preferred_labels $ ^ca_entities.preferred_labels													
                                                </unit>");

    $obras_MACUSP = explode('#', $List_obrasMACUSP);

    foreach ($obras_MACUSP as $obra_MACUSP)
    {
        $obra = explode('$', $obra_MACUSP);

        if (strpos(strtoupper($obra_MACUSP), $search) !== False)        
        {
            $tmp = "<li style='color:var(--macusp-color4);'>".$obra[0]."<br>".$obra[1]."</li><br>";
            $obrasMACUSP = $tmp.$obrasMACUSP; 
        }
        else
        {
            $tmp = "<li>".$obra[0]."<br>".$obra[1]."</li><br>";
            $obrasMACUSP .= $tmp; 
        }
    }
    //print_r($obras_MACUSP);

    #Verifying if there are other works those do not belong to MACUSP collection. 

    $vs_template = '<unit relativeTo="ca_occurrences.related" restrictToTypes="item_Lista_nao_MAC" delimiter="#">
                                ^ca_occurrences.occurrence_id+
                            </unit>';
            
    $occurrences_ids  = $item->getWithTemplate($vs_template); 

    //print $occurrences_ids;

    $occurrences_ids = str_replace(" ", "", $occurrences_ids);

    $va_artworks_nao_mac_ids = explode('#', $occurrences_ids);

    array_pop($va_artworks_nao_mac_ids);

    $extra = ""; 

    foreach ($va_artworks_nao_mac_ids as $occurrence_id)
    {
        //Os códigos estão vindo com espaço
        // Lê a publicação do banco
        $t_occurrence = new ca_occurrences($occurrence_id);
        
        $label_artist = $t_occurrence->getWithTemplate('^ca_occurrences.nome_artista');
        $label_artwork = $t_occurrence->getWithTemplate('^ca_occurrences.preferred_labels.name');
        
        $extra .= "<li style='background-color:lightpink'>[*]<i><b> $label_artwork </b></i><br> <i>$label_artist</i><br><br></li>";
    }

    if (!$extra)
        $works = "<div class = 'scrollContainer'><ol> $obrasMACUSP </ol></div>"; 

    else
    {
        $works = "<div class = 'scrollContainer'><ol> $obrasMACUSP $extra </ol></div>";
        $works .= "<p>[*]: Obras que não pertence ao acervo do MACUSP. </p>";
    }

    if ($works)
        $works = "<h6></span> "._t("List of Works").":</h6><br>".$works;*/

    $button = caDetailLink($this->request, _t("More details"),"","ca_occurrences", $id); 


?>








<h6><b><?php print _t("exhibition") ?></b></h6>
<p> <?php print $idno ?></p>  
<H3><?php print $name ?></H3>
<?php print trim($date)?  "<h6>"._t("date") ."</h6><p>$date </p>": ""  ?>
<?php print trim($local)? "<h6>"._t("local")."</h6><p>$local</p>": ""  ?>
<?php print $_works ?>
<div class='click'><?php print $button ?></div>               
