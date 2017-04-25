<?php
// declare(strict_types = 1);
namespace SporeAura\WX;

use DOMDocument;
use DOMElement;
use DOMException;

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
		$end = json_encode($datas, JSON_UNESCAPED_UNICODE);
		return is_bool($end) ? '{"error":"' . (string)json_last_error_msg() . '"}' : $end;
	}
	
	/**
	 * public array function parseJSON(string $json)
	 */
	public function parseJSON(string $json): array {
		$end = json_decode($json, true);
		return is_null($end) ? ['error'=>(string)json_last_error_msg()] : $end;
	}
	
	/**
	 * public string function createXML(array $datas DOMDocument $doc = null, DOMElement $node = null, boolean $cdata = true)
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
			if(is_array($data)) $this->createXML($data, $doc, $childNode, $cdata);
			else $leaf = $cdata ? $doc->createCDATASection($data) : $doc->createTextNode($data);
			$childNode->appendChild($leaf);
		}
		try{
			$end=$doc->saveXML();
		}catch(DOMException $err){
			$end='';
		}
		return $end;
	}
	
	/**
	 * public array function parseXML(string $xml)
	 */
	public function parseXML(string $xml): array {
		$datas=[];
		$doc = new DOMDocument('1.0', 'utf-8');
		$doc->loadXML($xml);
		$nodes=$doc->getElementsByTagName('xml');
		$node=$nodes->length ? $nodes->item(0) : $doc->documentElement ;
		$node->normalize();
		$name=$node->tagName;
		foreach($node->childNodes as $childNode){
			switch($childNode->nodeType){
				case XML_TEXT_NODE:
					$data=$childNode->wholeText;
					in_array($name, ['xml','node'], true) ? $datas[]=$data : $datas[$name]=$data;
					break 2;
				case XML_CDATA_SECTION_NODE:
					$data=$childNode->wholeText;
					in_array($name, ['xml','node'], true) ? $datas[]=$data : $datas[$name]=$data;
					break 2;
				case XML_ELEMENT_NODE:
					$childXml=$doc->saveXML($childNode);
					in_array($name, ['xml','node'], true) ? $datas[]=$this->parseXML($childXml) : $datas[$name]=$this->parseXML($childXml);
					break 2;
				default: 
					break 2;
			}
		}
		return $datas;
	}
	//
}

