
<?php
/* ----------------------------------------------------------------------
 * views/pageFormat/pageHeader.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014-2017 Whirl-i-Gig
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

	# flags module 
	$flag = _t("flags:pawtucket:language");

	$locales = $this->request->config->getList('ui_locales');	

	$main_flag = caGetThemeGraphic($this->request, "flags/$flag.svg");

	$allFlags = array(); 
	$otherFlags = array(); 

	foreach ($locales as $elem)
	{
		$tmp = caChangeLocaleLink($this->request, $elem, caGetThemeGraphic($this->request, "flags/$elem.svg")." "._t("flags:lang:".$elem), "",'myClass', "");
						
		$tmp = "<li>$tmp</li>"; 

		if ($elem != $flag)
			$otherFlags[] = $tmp;

		$allFlags[] = $tmp; 
	}
	
?>
