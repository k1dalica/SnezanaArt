<?php
class Redirect {
	public static function to($loc = '/') {
		if($loc=='/') {
			header("Refresh:0");	
			echo "<script>location.reload();</script>";
		} else {
			header("Location: $loc");
			echo "<script>window.location='$loc';</script>";
		}
	}
}