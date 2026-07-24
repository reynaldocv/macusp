<?php
$item = $this->getVar("item"); 

//$title = _t("Work"); 

$artist = $item->getWithTemplate(   "<unit relativeTo='ca_entities' restrictToRelationshipTypes='creator,collective_creator,editor,produtor,organizador' delimiter=' '>
                                        ^ca_entities.preferred_labels.displayname <br>
                                    </unit>");

$vn_id = $item->getWithTemplate("^ca_objects.object_id");

$name = $item->getWithTemplate("^ca_objects.preferred_labels.name");

$imagen = $item->getWithTemplate("^ca_object_representations.media.medium");

$details = $item->getWithTemplate("<ifdef code='ca_objects.datePeriod.datePeriod'><h6>^ca_objects.datePeriod.datePeriod </h6></ifdef>
			<ifdef code='ca_objects.technicalAttribute'>
				<p style='line-height:18px'>
					^ca_objects.technicalAttribute
				</p>
			</ifdef>"); 

$button = caDetailLink($this->request, _t("More details"),'', 'ca_objects' ,$vn_id); 
?>

<h6><b><?php print $title ?></b></h6>
<p><?php print  $idno ?></p>  
<H4><?php print $artist ?></H4>
<div><?php print  $imagen ?></div>               
<h3><?php print  $name ?> </h3>
<h7><?php print $details ?></h7>
<div class='click'><?php print $button ?></div>               
