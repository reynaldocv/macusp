<?php
    
    $item = $this->getVar("item"); 
    
    $title = _t("Artist"); 

    $name = $item->get("ca_entities.preferred_labels.displayname");
    
    $numObjets = $item->getWithTemplate("<ifcount code='ca_objects' restrictToTypes='work'>^ca_objects._count </ifcount>"); 
    $objects = "<b>"._t("Number of works avaliable online")."</b><p>$numObjets</p>";
    
    $vn_id = $item->getWithTemplate("^ca_entities.entity_id");
    
    $vs_data_birth_Place = $item->getWithTemplate("^ca_entities.DadosBiograficos.LocalNascimento.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=2%delimiter=_➜_");
    $vs_data_birth_Year = $item->getWithTemplate("<ifdef code='ca_entities.DadosBiograficos.AnoNascimento'>^ca_entities.DadosBiograficos.AnoNascimento</ifdef>"); 

    $vs_data_death_Place = $item->getWithTemplate("^ca_entities.DadosBiograficos.LocalMorte.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=2%%delimiter=_➜_");
    $vs_data_death_Year = $item->getWithTemplate("<ifdef code='ca_entities.DadosBiograficos.AnoMorte'>^ca_entities.DadosBiograficos.AnoMorte</ifdef>");

    $groups = $item->getWithTemplate("<unit relativeTo='ca_entities.related' restrictToRelationshipTypes='integrante' delimiter=' '><l>^ca_entities.preferred_labels</l></unit>");

    //recovering the country and year of the birth. 

    if (trim($vs_data_birth_Place)){
        $idx = strpos($vs_data_birth_Place, "➜");
        
        if ($idx != false)
            $vs_data_birth_Place = "".substr($vs_data_birth_Place, $idx + 3)."";

        $vs_data_birth_Place = "☼ $vs_data_birth_Place"; 
    }
    $vs_data_birthday = $vs_data_birth_Place; 

    if (trim($vs_data_birth_Year)){
        if ($vs_data_birth_Place)
        {
            $vs_data_birthday .= ", ".$vs_data_birth_Year; 
        }
        else
        {
            $vs_data_birthday = $vs_data_birth_Year; 
        }
    }
    if (trim($vs_data_birthday))
        $vs_data_birthday = "<p>$vs_data_birthday</p>"; 

    //revovering the country and year of the death 

    if (trim($vs_data_death_Place)){
        $idx = strpos($vs_data_death_Place, "➜");
        
        if ($idx != false)
            $vs_data_death_Place = "".substr($vs_data_death_Place, $idx + 3)."";

        $vs_data_death_Place = "† $vs_data_death_Place"; 
    }
    $vs_data_deathday = $vs_data_death_Place; 

    if (trim($vs_data_death_Year)){
        if ($vs_data_deathday)
        {
            $vs_data_deathday .= ", ".$vs_data_death_Year; 
        }
        else
        {
            $vs_data_deathday = $vs_data_death_Year; 
        }
    }
    if (trim($vs_data_deathday))
        $vs_data_deathday = "<p>$vs_data_deathday</p>"; 

    $data = "$vs_data_birthday $vs_data_deathday";

    $button = caDetailLink($this->request, _t('More details'), '', "ca_entities", $vn_id);
?>


<h6><b> <?php print $title ?> </b></h6>
<p> </p>  
<H3><?php print$name ?></H3>
<?php print $data ?>
<?php print $groups ?>
<?php print $objects ?>
<div class='click'> <?php print $button ?></div>               
               