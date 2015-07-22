<?php
	function createSalt($email){
		return substr(md5($email), -5);
	}
?>