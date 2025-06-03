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


require_once(__CA_MODELS_DIR__."/ca_objects.php");
require_once(__CA_MODELS_DIR__."/ca_entities.php");
require_once(__CA_MODELS_DIR__."/ca_occurrences.php");
require_once(__CA_LIB_DIR__.'/ca/Browse/OccurrenceBrowse.php');
Class FrontpageController extends ActionController {
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
		$pa_view_paths[] = __CA_APP_DIR__."/plugins/macusp/themes/views/";

		// Load plugin configuration file
		$this->opo_config = Configuration::load(__CA_APP_DIR__.'/plugins/macusp/conf/config.conf');

		parent::__construct($po_request, $po_response, $pa_view_paths);

		MetaTagManager::addLink('stylesheet', __CA_URL_ROOT__."/app/plugins/macusp/themes/css/macusp.css",'text/css');
		MetaTagManager::addLink('stylesheet', __CA_URL_ROOT__."/app/plugins/macusp/themes/css/colors.css",'text/css');
		MetaTagManager::addLink('stylesheet', __CA_URL_ROOT__."/app/plugins/macusp/themes/css/foto.css",'text/css');
	}
	# -------------------------------------------------------
	/**
	 *
	 */
	public function index(){
		$va_access_values = caGetUserAccessValues($this->request);
		// A list of works is generated randomly

		$t_object = new ca_objects();

		$tmp = $t_object->getRandomItems(12, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));		
		$va_featured_ids = array_keys($tmp);
		$this->view->setVar('featured_set_works_ids', $va_featured_ids);
		$this->view->setVar('featured_set_works_as_search_result', caMakeSearchResult('ca_objects', $va_featured_ids));

		// A list of artists is generated randomly
		
		$t_entity = new ca_entities();
		
		$tmp = $t_entity->getRandomItems(15, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1, 'restrictByIntrinsic'=> array('type_id'=> '488')));		
		//$tmp = $t_entity->getRandomItems(30, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));
		
		$va_featured_ids = array_keys($tmp);

		$this->view->setVar('featured_set_entities_ids', $va_featured_ids);		
		$this->view->setVar('featured_set_entities_as_search_result', caMakeSearchResult('ca_entities', $va_featured_ids));

		// A list of exhibitions is generated randomly

		//$o_browse = new ca_occurrences();

		//$tmp = $o_browse->getRandomItems(15, array('checkAccess' => $va_access_values, 'restrictByIntrinsic'=> array('type_id'=> '133')));		
		//$tmp = $t_entity->getRandomItems(30, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));
		
		$va_featured_ids = new ca_occurrences(1782);

		$this->view->setVar('featured_set_exhibitions_ids', $va_featured_ids);		
		$this->view->setVar('featured_set_exhibitions_as_search_result', caMakeSearchResult('ca_occurrences', $va_featured_ids));

		//$this->view->setVar('featured_set_exhibitions_as_search_result', $o_browse);

 		$this->render("index.php");
	}

	public function index2(){
		$va_access_values = caGetUserAccessValues($this->request);
		// A list of works is generated randomly

		$t_object = new ca_objects();

		$tmp = $t_object->getRandomItems(12, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));		
		$va_featured_ids = array_keys($tmp);
		$this->view->setVar('featured_set_works_ids', $va_featured_ids);
		$this->view->setVar('featured_set_works_as_search_result', caMakeSearchResult('ca_objects', $va_featured_ids));

		// A list of artists is generated randomly
		
		$t_entity = new ca_entities();
		
		$tmp = $t_entity->getRandomItems(15, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1, 'restrictByIntrinsic'=> array('type_id'=> '488')));		
		//$tmp = $t_entity->getRandomItems(30, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));
		
		$va_featured_ids = array_keys($tmp);

		$this->view->setVar('featured_set_entities_ids', $va_featured_ids);		
		$this->view->setVar('featured_set_entities_as_search_result', caMakeSearchResult('ca_entities', $va_featured_ids));

		// A list of exhibitions is generated randomly

		//$o_browse = new ca_occurrences();

		//$tmp = $o_browse->getRandomItems(15, array('checkAccess' => $va_access_values, 'restrictByIntrinsic'=> array('type_id'=> '133')));		
		//$tmp = $t_entity->getRandomItems(30, array('checkAccess' => $va_access_values, 'hasRepresentations' => 1));
		
		$va_featured_ids = new ca_occurrences(1782);

		$this->view->setVar('featured_set_exhibitions_ids', $va_featured_ids);		
		$this->view->setVar('featured_set_exhibitions_as_search_result', caMakeSearchResult('ca_occurrences', $va_featured_ids));

		//$this->view->setVar('featured_set_exhibitions_as_search_result', $o_browse);

 		$this->render("index2.php");
	}

	public function test() {
		$this->render("test.php");
	}
}
