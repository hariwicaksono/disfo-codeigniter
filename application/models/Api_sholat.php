<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_sholat extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	function fOpenRequest($url) {
		$file = fopen($url, 'r');
		$data = stream_get_contents($file);
		fclose($file);
		return $data;
	 }

	function curlRequest($url) {
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($c);
		curl_close($c);
		return $data;
	 }

	function get_prayzone($city,$tanggal)
    {
		 //get JSON
		if($sock = @fsockopen('www.google.com', 80)) {	 
		 //$json = file_get_contents("https://api.pray.zone/v2/times/day.json?city=$city&date=$tanggal", false);
		 //$json = $this->fOpenRequest("https://api.pray.zone/v2/times/day.json?city=$city&date=$tanggal", false);
		 $json = $this->curlRequest("https://api.pray.zone/v2/times/day.json?city=$city&date=$tanggal", false);
		} else {
			$json = "";
		}

		 //decode JSON to array
		 $data = json_decode($json,true);
		 
		 //return data array()
		 return $data;
    }

	
}