
		
	<ul class="macuspItems">
		<li <?php print ($this->request->getAction() == "works") ? 'class="macuspActivedItem"' : ''; ?>><?php print caNavLink($this->request, _t("Works"), "", "", "Intro", "works"); ?></li>
		<li <?php print ($this->request->getAction() == "artists") ? 'class="macuspActivedItem"' : ''; ?>><?php print caNavLink($this->request, _t("Artists"), "", "", "Intro", "artists"); ?></li>
		<li <?php print ($this->request->getAction() == "exhibitions") ? 'class="macuspActivedItem"' : ''; ?>><?php print caNavLink($this->request, _t("Exhibitions"), "", "", "Intro", "exhibitions"); ?></li>
		<li class="dropdown <?php print ($this->request->getController() == "Sca1n") ? 'macuspActivedItem' : ''; ?>" style="position:relative;">
			<a href="#" class="dropdown-toggle mainhead top" data-toggle="dropdown">
				<?php print _t("Advanced Search"); ?> 
			</a>
			
			<ul class="dropdown-menu macuspDrop">
				<li><?php print caNavLink($this->request, _t("Works"), "", "Scan", "advanced", "works"); ?></li>
				
				<li><?php print caNavLink($this->request, _t("Artists"), "", "Scan", "advanced", "artists"); ?></li>
				<li><?php print caNavLink($this->request, _t("Exhibitions"), "", "Scan", "advanced", "exhibitions"); ?></li>
			</ul>	
		</li>
		<!--<li> <?php print $this->request->getAction() ?> </li>-->
	</ul>		


