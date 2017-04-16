<?php
// declare(strict_types = 1);
namespace SporeAura\WX;

class Menu {
	
	/**
	 */
	protected $domain;
	protected $accessToken;
	
	/**
	 * public void function __construct(string $token, ?string $domain = null)
	 */
	public function __construct(string $token, string $domain = null) {
		$this->domain = is_null($domain) ? 'api.weixin.qq.com' : $domain;
		$this->accessToken = $token;
	}
	
	/**
	 * public void function __destruct(void)
	 */
	function __destruct() {
		//
	}
	
	/**
	 * public boolean function delete(void)
	 */
	public function delete(): bool {
		$url='https://'.$this->domain.'/cgi-bin/menu/delete';
		$qryStrings=array('access_token'=>$this->accessToken);
		$mm=new Mimicry();
		$json=$mm->get($url, $qryStrings);
		$ends=json_decode($json);
		return 'ok'==$ends['errmsg'] ? true : false;
	}
	//
}

