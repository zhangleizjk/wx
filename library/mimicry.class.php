<?php
// declare(strict_types = 1);
namespace SporeAura\WX;

class Mimicry {
	
	/**
	 * public void function __construct(void)
	 */
	public function __construct() {
		//
	}
	
	/**
	 * public void function __destruct(void) 
	 */
	function __destruct() {
		//
	}
	
	/**
	 * public string function get(string $url, ?array $qryStrings = null)
	 */
	public function get(string $url, array $qryStrings = null): string {
		if(is_array($qryStrings)){
			foreach($qryStrings as $key => &$qry){
				$qry = $key . '=' . rawurlencode($qry);
			}
		}
		$qryString = '?' . implode('&', $qryStrings);
		$url .= $qryString;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_HTTPGET, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
	}
	
	/**
	 * public string function post(string url, ?array $fields = null)
	 */
	public function post(string $url, array $fields = null): string {
		if(is_null($fields)) $fields = array();
		$curl = curl_init();
		curl_setopt($curl, CUROPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
	}
	//
}

