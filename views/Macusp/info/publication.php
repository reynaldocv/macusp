<?php
$item = $this->getVar("item"); 

$idno = $item->get("ca_occurrences.occurrence_id");
$name = $item->get("ca_occurrences.preferred_labels.name");

//$date = $publication->get("ca_occurrences.exhibitionBeginDate");

$curator = $item->getWithTemplate("
            <unit relativeTo='ca_entities' delimiter='<br>' restrictToRelationshipTypes='autor,Organizador,coordenador,editor'>
                ^ca_entities.preferred_labels (<span>^relationship_type_code</span>)		
			</unit>");

            


$local = $item->getWithTemplate("<unit relativeTo='ca_entities' restrictToRelationshipTypes='local_exposicao'>
						^ca_entities.preferred_labels
					</unit>");

$obrasMACUSP = ""; 


$List_obrasMACUSP = $item->getWithTemplate("<unit relativeTo='ca_objects' delimiter='#' >
												^ca_objects.preferred_labels $ ^ca_entities.preferred_labels $ ^ca_objects.idno													
											</unit>");

$works = "";
                                     
if (trim($List_obrasMACUSP) !== "")                                           
{

    $obras_MACUSP = explode('#', $List_obrasMACUSP);

    foreach ($obras_MACUSP as $obra_MACUSP)
    {
        $obra = explode('$', $obra_MACUSP);

        if (strpos(strtoupper($obra_MACUSP), $search) !== False)        
        {
            $tmp = "<li style='color:var(--macusp-color4);'>".$obra[0]."<br>".$obra[1].$obra[2]."</li><br>";
            $obrasMACUSP = $tmp.$obrasMACUSP; 
        }
        else
        {
            $tmp = "<li>".$obra[0]."<br>".$obra[1]."</li><br>";
            $obrasMACUSP .= $tmp; 
        }
    }


    #Verifying if there are other works those do not belong to MACUSP collection. 

    if ($obrasMACUSP){   
        $works = "<div class = 'scrollContainer'><ol> $obrasMACUSP </ol></div>";
        $works = "<h6></span> "._t("Works from MAC USP reproduced").":</h6><br>".$works;
    }
}

$button = caDetailLink($this->request, _t("More details"),"","ca_occurrences", $idno); 
?> 


<h6><b><?php print _t("publication")?></b></h6>
<p><?php print $idno ?></p>  
<H1><?php print $name ?></H1>
<?php print trim($curator) ? "<h6>"._t("curator")."</h6><p> $curator </p>": "" ?>
<?php print trim($local)   ? "<h6>"._t("local")."</h6><p> $local   </p>": "" ?>
<?php print $works ?>
<div class='click'><?php print $button ?></div>               
