<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basejson {
	private $dataJson; 
	private $zipJson; 
	
	function __construct()
	{
		$this->dataJson = 'data.json';
		//$this->zipJson =  FCPATH.'tmp/'. str_replace('.','', uniqid(rand(), true)) .'.zip'; 
		
		$this->zipJson =  FCPATH.'tmp/'.date('YmdHis').rand().'.zip'; 
	}	    

	function setJson($data){	
		$zip = new ZipArchive;
		$zip->open($this->zipJson, ZipArchive::CREATE);
		$zip->addFromString($this->dataJson, json_encode($data, JSON_UNESCAPED_SLASHES));
		$zip->close();
		$result = base64_encode(file_get_contents($this->zipJson));	
        return $result;
        
	}
	
	
	function getJson($zipStr){
		file_put_contents($this->zipJson, base64_decode($zipStr));
		$result = '{}';
		$zip = new ZipArchive;
		if ($zip->open($this->zipJson) === TRUE) {
			$result =  $zip->getFromName($this->dataJson);
			$zip->close();
		}
		return json_decode($result);
        
	}

	function getJsonString($zipStr){
		file_put_contents($this->zipJson, base64_decode($zipStr));
		$result = '{}';
		$zip = new ZipArchive;
		if ($zip->open($this->zipJson) === TRUE) {
			$result =  $zip->getFromName($this->dataJson);
			$zip->close();
		}        
		return $result;
        
	}
	
	function setZIP($backup){	
		write_file($this->zipJson, $backup); 
		$result = base64_encode(file_get_contents($this->zipJson));	
		return $result;
	
	}
	
	function setPDF($filePDF){
		$result = base64_encode(file_get_contents($filePDF));	
		return $result;
	
	}
	
}
