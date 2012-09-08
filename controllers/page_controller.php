<?php


class page_controller extends controller {

	// GET /page
	function index() {
		require_once(SITE_PATH."/views/page/index.php");
		exit;
	}

	// GET /page/la_jolie_url
	function voir($page) {
		require_once(SITE_PATH."/views/page/voir.php");
		exit;
	}

}
