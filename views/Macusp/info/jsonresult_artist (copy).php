<?php
$vs_table = "ca_entities"; 
$vn_id = $this->getVar("entity_id"); 

$qr_res = new ca_entities($vn_id); 

$title = _t("Artist"); 

$name = $qr_res->get("ca_entities.preferred_labels.displayname");

$numObjets = $qr_res->getWithTemplate("<ifcount code='ca_objects' restrictToTypes='work'>^ca_objects._count </ifcount>"); 
$objects = "<b>"._t("Number of works avaliable online")."</b><p>$numObjets</p>";
					
$vs_data_birth_Place = $qr_res->getWithTemplate("^ca_entities.DadosBiograficos.LocalNascimento.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=2%delimiter=_➜_");
$vs_data_birth_Year = $qr_res->getWithTemplate("<ifdef code='ca_entities.DadosBiograficos.AnoNascimento'>^ca_entities.DadosBiograficos.AnoNascimento</ifdef>"); 

$vs_data_death_Place = $qr_res->getWithTemplate("^ca_entities.DadosBiograficos.LocalMorte.hierarchy.preferred_labels%hierarchyDirection=asc%maxLevelsFromBottom=2%%delimiter=_➜_");
$vs_data_death_Year = $qr_res->getWithTemplate("<ifdef code='ca_entities.DadosBiograficos.AnoMorte'>^ca_entities.DadosBiograficos.AnoMorte</ifdef>");

$groups = $qr_res->getWithTemplate("<unit relativeTo='ca_entities.related' restrictToRelationshipTypes='integrante' delimiter=' '><l>^ca_entities.preferred_labels</l></unit>");

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

$button = caDetailLink($this->request, _t('More details'), '', $vs_table, $vn_id);


$va_results = "<h6><b>$title</b></h6>
               <p> </p>  
               <H3>$name  </H3>
               $data
               $groups
               $objects 
               <div class='click'> $button </div>               
               ";



print json_encode($va_results);

?>