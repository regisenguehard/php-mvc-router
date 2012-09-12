<?php

class page extends model {

	public $urlpage = "";

	function __construct($urlpage = "") {

		spdo::query("SELECT * FROM page WHERE urlpage='".($urlpage)."'");

		if ($urlpage != "") {
			$this->urlpage = $urlpage;
			$this->is_valid = true;
		}

	}

}

