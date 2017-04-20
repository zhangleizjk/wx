<?php
// declare(strict_types = 1);
namespace SporeAura\WX;

use DOMDocument;
use DOMElement;

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
	public function createJSON(array $datas): string {
		$end = json_encode($datas);
		return is_bool($end) ? 'JSON Encode Error: ' . $this->getJSONErrCode(json_last_error()) : $end;
	}
	
	/**
	 * public array function parseJSON(string $json)
	 */
	public function parseJSON(string $json): array {
		return json_decode($json);
	}
	
	/**
	 * public string function createXML(array $datas)
	 */
	public function createXML(array $datas, DOMDocument $doc = null, DOMElement $node = null, bool $cdata = true): string {
		if(is_null($doc)) $doc = new DOMDocument('1.0', 'utf-8');
		if(is_null($node)){
			$node = $doc->createElement('xml');
			$doc->appendChild($node);
		}
		foreach($datas as $key => $data){
			$childNode = $doc->createElement(is_string($key) ? $key : 'node');
			$node->appendChild($childNode);
			if(is_array($data)){
				$this->createXML($data, $doc, $childNode, $cdata);
			}else
				$inner = $cdata ? $doc->createCDATASection($data) : $doc->createTextNode($data);
			$childNode->appendChild($inner);
		}
		$end = $doc->saveXML();
		return is_string($end) ? $end : '';
	}
	
	/**
	 * public array function parseXML(string $xml)
	 */
	public function parseXML(string $xml): array {
		libxml_disable_entity_loader(true);
		
		$xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		
		$val = json_decode(json_encode($xmlstring),true);
	}
	
	/**
	 */
	protected function getJSONErrCode(int $errNo): string {
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

