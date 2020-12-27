<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_cuaca extends CI_Model {


	public function __construct() {
		parent::__construct();
	}

	public function get_cuaca(){
		$query=$this->db->select('*')
				->from('cuaca')
				->order_by('id','ASC')
				->get();
		
		return $query;
	}
	
	public function get_settings(){
		return $this->db->get('cuaca', 1);
	}
	
	function current_weather($city)
    {
		 //get JSON
	    	 //you can get param appid from your account in openweathermap.org
			 //http://api.openweathermap.org/data/2.5/weather?appid=[YOUR_APP_ID]&units=metric&q=$city
		
		if($sock = @fsockopen('www.google.com', 80)) {	 
		 $json = file_get_contents("http://api.openweathermap.org/data/2.5/weather?appid=770a17f9520e41124656aa601bc34b3c&units=metric&q=$city", false);
		} else {
			$json = "";
		}

		 //decode JSON to array
		 $data = json_decode($json,true);
		 
		 //return data array()
		 return $data;
    }

    function forecast_weather($city)
    {
		 //get JSON
	    	 //you can get param appid from your account in openweathermap.org
	    	 //http://api.openweathermap.org/data/2.5/forecast/daily?appid=[YOUR_APP_ID]&units=metric&q=$city&cnt=7
		if($sock = @fsockopen('www.google.com', 80)) {	 
		$json = file_get_contents("http://api.openweathermap.org/data/2.5/forecast/daily?appid=770a17f9520e41124656aa601bc34b3c&units=metric&q=$city&cnt=7", false);
		} else {
			$json = "";
		}
		 //decode JSON to array
		 $data = json_decode($json,true);
		 
		 //return data array()
		 return $data;
    }

	
	
}