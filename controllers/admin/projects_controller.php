<?php

/*
An example of a simple controller using views
*/

class projects_controller extends controller {

	// GET /projects
	function index() {
		require_once(SITE_PATH."/views/admin/projects/index.php");
		exit;
	}

}
