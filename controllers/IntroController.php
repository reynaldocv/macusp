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

 
require_once(__CA_LIB_DIR__."/core/ApplicationError.php");
require_once(__CA_APP_DIR__.'/helpers/accessHelpers.php');
require_once(__CA_MODELS_DIR__."/ca_sets.php");
require_once(__CA_MODELS_DIR__."/ca_objects.php");
require_once(__CA_MODELS_DIR__."/ca_entities.php");
require_once(__CA_MODELS_DIR__."/ca_occurrences.php");
require_once(__CA_LIB_DIR__.'/pawtucket/BasePawtucketController.php');


Class IntroController extends ActionController {
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
		parent::__construct($po_request, $po_response, $pa_view_paths);
		
		$this->opo_config = Configuration::load("__CA_THEME_DIR__"."/conf/macusp_frontpage.conf"); 
		
		MetaTagManager::setWindowTitle($this->request->config->get("app_display_name"));
	}
	# -------------------------------------------------------
	/**
	 *
	 */
	public function artists(){
		$table = "ca_entities";

		$va_access_values = caGetUserAccessValues($this->request);
				// A list of works is generated randomly
		$options = $this->opo_config->get('artists');
		
		$limit = intval($options["examples"]["limit"]); 
		$format = $options["format"]; 
		
		$t_entity = new ca_entities();
		
		$tmp = $t_entity->getRandomItems(10*$limit, array('searh' => "type:Artista", 'checkAccess' => $va_access_values, 'hasRepresentations' => 1));		
		//$tmp = $t_entity->getRandomItems(30, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));
		
		$va_featured_ids = array_keys($tmp);
	
		// A list of exhibitions is generated randomly
		//$this->view->setVar('featured_set_exhibitions_as_search_result', $o_browse);
		$this->view->setVar('featured_set_ids', $va_featured_ids);	
		$this->view->setVar("table", $table);	
		$this->view->setVar("limit", $limit);	
		$this->view->setVar("file", $options);
		$this->view->setVar("access_values", $va_access_values);
		
		$vs_path = "Macusp/frontpage_$format.php"; 

		$this->render($vs_path);
	}	
	public function exhibitions(){
		$table = "ca_occurrences";

		$va_access_values = caGetUserAccessValues($this->request);

		$o_browse = caGetBrowseInstance($table);
		$o_browse->addCriteria("tipo_exposicao_facet", 1064);
		$o_browse->execute(array('checkAccess' => $va_access_values, 'hasRepresentations' => 1, 'restrictByIntrinsic'=> array('type_id'=> '113')));

		$qr_res = $o_browse->getResults(); 

		$options = $this->opo_config->get('exhibitions');

		$all = $qr_res->numHits(); 
		$limit = intval($options["examples"]["limit"]); 
		$format = $options["format"]; 

		for ($i = 1; $i <= 3*$limit; $i++) {
			$id = rand(0, $all); 

			$qr_res->seek($id);                        
			
			$access = $qr_res->get("ca_occurrences.access");
			$rank = $qr_res->get("ca_occurrences.rank"); 

			if (trim($access) === "1" && trim($rank)){
				$ids[] = $qr_res->get("ca_occurrences.rank");                        
			}
		}

		$this->view->setVar("featured_set_ids", $ids);
		$this->view->setVar("table", $table);	
		$this->view->setVar("file", $options);
		$this->view->setVar("limit", $limit);
		$this->view->setVar("access_values", $va_access_values);
		
 		$vs_path = "Macusp/frontpage_$format.php";  

		$this->render($vs_path);
	}

	public function works() {
			
		$table = "ca_objects";

		$va_access_values = caGetUserAccessValues($this->request);
				// A list of works is generated randomly
		$options = $this->opo_config->get('works');
		
		$limit = intval($options["examples"]["limit"]); 
		$format = $options["format"]; 
		
		$t_entity = new ca_objects();
		
		$tmp = $t_entity->getRandomItems(3*$limit, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));		
		//$tmp = $t_entity->getRandomItems(30, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));
		
		$va_featured_ids = array_keys($tmp);

		//$this->view->setVar('template_artist', $this->opo_config->get('template_artist'));
		
		$this->view->setVar('featured_set_ids', $va_featured_ids);		
		
		// A list of exhibitions is generated randomly
		//$this->view->setVar('featured_set_exhibitions_as_search_result', $o_browse);
		$this->view->setVar("table", $table);	
		$this->view->setVar("limit", $limit);	
		$this->view->setVar("file", $options);
		$this->view->setVar("access_values", $va_access_values);
		
		$vs_path = "Macusp/frontpage_$format.php"; 

		$this->render($vs_path);
		
	}
	public function test(){
		
		$t_entity = new ca_entities();

		// Force check for public visibility status (Critical for Pawtucket front-ends)
		$search_options = [
			'checkAccess' => [1] // 1 usually denotes 'public' in app.conf
		];

		// Execute the secure search query pool
		$o_random_individuals = $t_entity->searchRandom("type:artista", $search_options, 10);

		// Bind the result handle to the Pawtucket view engine
		$this->view->setVar('items', $o_random_individuals);


		$vs_path = "Macusp/test.php"; 

		$this->render($vs_path);
	}
}
