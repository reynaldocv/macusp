<?php

$item = $this->getVar("item"); 
//$title = _t("work"); 

$name = $item->get("ca_occurrences.preferred_labels.name");
$artists = $item->get("ca_occurrences.nome_artista");
$category = $item->getWithTemplate("^ca_occurrences.categoria");
$tecnique = $item->getWithTemplate("^ca_occurrences.technicalAttribute");

$note = _t("This work does not belong to MACUSP collection.");
?>


<h6><b><?php print $title ?></b></h6>
<h3><?php print $name ?></h3>
<h4><?php print $artists ?></h4>  
<H7><?php print $category ?></H7>
<H7><?php print $tecnique ?></H7>
<div class='alert alert-danger' style='font-size:small'> <?php print $note ?></div>

