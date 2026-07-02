<?php
/* ----------------------------------------------------------------------
 * app/plugins/ULAN/controllers/ImportController.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2015 Whirl-i-Gig
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

require_once(__CA_MODELS_DIR__.'/ca_entities.php');
require_once(__CA_MODELS_DIR__.'/ca_objects.php');
require_once(__CA_MODELS_DIR__.'/ca_occurrences.php');

class InfoController extends ActionController {
	# -------------------------------------------------------
	/**
	 *
	 */
	protected $opo_config;		// plugin configuration file

	# -------------------------------------------------------
	# Constructor
	# -------------------------------------------------------
	/**
	 *
	 */
	public function __construct(&$po_request, &$po_response, $pa_view_paths=null) {
		// Set view path for plugin views directory
		if (!is_array($pa_view_paths)) { $pa_view_paths = array(); }
		$pa_view_paths[] = __CA_THEME_DIR__."/views/Macusp/info/";

		// Load plugin configuration file
		$this->opo_config = Configuration::load(__CA_THEME_DIR__.'/conf/macusp_info.conf');

		parent::__construct($po_request, $po_response, $pa_view_paths);

		/*if (!$this->request->user->canDoAction('can_import_ulan')) {
			$this->response->setRedirect($this->request->config->get('error_display_url').'/n/3000?r='.urlencode($this->request->getFullUrlPath()));
			return;
		}

		// Load plugin stylesheet*/
		//MetaTagManager::addLink('stylesheet', __CA_URL_ROOT__."/app/plugins/consulthor/themes/themes/css/consulthor.css",'text/css');
		
	}
	# -------------------------------------------------------
	/**
	 *
	 */
	
	/*public function ShowAll() {
		$o_search = new EntitySearch();
		$o_items = $o_search->search('*'); 

		$this->view->setVar('results', $o_items);
		$this->view->setVar('items', $o_items);
		
		$this->render("all.php");
	}*/

	public function Artist() {
		$idno = $this->request->getParameter('idno', pString);

		$item = new ca_entities($idno); 

		$this->view->setVar("item", $item); 

		$data = $this->render("artist.php", ['item']); 
		
		print json_encode($data);
	}

	public function Exhibition() {	
		$idno = $this->request->getParameter('idno', pString);
		$option = $this->request->getParameter('option', pString);
		$id = $this->request->getParameter('idSearch', pString);

		$item = new ca_occurrences($idno); 
				
		$this->view->setVar('item', $item);				

		$data = $this->render("exhibition.php", ['item']); 
		
		print json_encode($data);
	}

	public function Publication() {	
		$idno = $this->request->getParameter('idno', pString);
		$option = $this->request->getParameter('option', pString);
		$id = $this->request->getParameter('idSearch', pString);
		
		$item = new ca_occurrences($idno); 
				
		$this->view->setVar('item', $item);				

		$data = $this->render("publication.php", ['item']); 
		
		print json_encode($data);
	}
		
	public function Work() {
		$idno = $this->request->getParameter('idno', pString);
		$item = new ca_objects($idno); 

		$this->view->setVar("item", $item); 
			
		$data = $this->render("work_mac.php", ['item']); 
		
		print json_encode($data);
	}

	public function NoWork() {
		$idno = $this->request->getParameter('idno', pString);
		$item = new ca_occurrences($idno); 
		
		$this->view->setVar("item", $item); 
			
		$data = $this->render("work_no_mac.php", ['item']); 
		
		print json_encode($data);
	}

	public function test() {
		
		$this->render("test.php");
		
		
	}
}

