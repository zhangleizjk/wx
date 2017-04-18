<?php
// declare(strict_types = 1);
namespace SporeAura\WX;

class Translator {
	
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
	 * public string function createJSON(array $datas)
	 */
	public function createJSON(array $datas):string {
		$end=json_encode($datas);
		return is_bool($end)? 'JSON Encode Error: '.$this->getJSONErrCode(json_last_error()): $end;
	}
	
	/**
	 * public array function parseJSON(string $json)
	 */
	public function parseJSON(string $json): array {
		//
	}
	
	/**
	 * public string function createXML(array $datas)
	 */
	public function createXML(array $datas):string {
		//
	}
	
	/**
	 * public array function parseXML(string $xml)
	 */
	public function parseXML(string $xml):array {
		//
	}
	
	/**
	 * 
	 */
	protected function getJSONErrCode(int $errNo):string {
		switch($errNo){
			case JSON_ERROR_NONE:
				return 'JSON_ERROR_NONE';
				break;
			default:
				return 'UNKNOW ERROR';
				break;
		}
	}
	//
}

