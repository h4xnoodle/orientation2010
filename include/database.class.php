<?php

// Database class

class Database {

	function __construct() {
		mysql_connect('localhost','orient2010','V1ct0ri@.CB');
		mysql_select('orientation2010');
	}
}
