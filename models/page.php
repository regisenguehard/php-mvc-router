<?php

class page extends model {

	public $urlpage = "";

	function __construct($urlpage = "") {
		if ($urlpage != "") {
			$this->urlpage = $urlpage;
			$this->is_valid = true;
		}

	}

}

