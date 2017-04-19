<?php
// declare(strict_types = 1);
namespace SporeAura\WX;

class Menu {
	
	/**
	 */
	const media_all = 'media_id';
	const media_text = 'view_limited';
	const click_custom = 'click';
	const click_scan_push = 'scancode_push';
	const click_scan_waiting = 'scancode_waiting';
	const click_camera = 'pic_sysphoto';
	const click_camera_photo = 'pic_photo_or_album';
	const click_wx_photo = 'pic_weixin';
	const click_location = 'location_select';
	
	/**
	 */
	protected $domain;
	protected $accessToken;
	protected $menus=array();
	
	/**
	 *
	 * @param string $token        	
	 * @param ?string $domain = null
	 * @return void
	 */
	public function __construct(string $token, string $domain = null) {
		$this->domain = is_null($domain) ? 'api.weixin.qq.com' : $domain;
		$this->accessToken = $token;
	}
	
	/**
	 * @reutrn void
	 */
	function __destruct() {
		//
	}
	
	/**
	 *
	 * @param string $name        	
	 * @param string $url        	
	 * @return array
	 */
	public function createView(string $name, string $url): array {
		return array(
			'type'=>'view', 
			'name'=>$name, 
			'url'=>$url
		);
	}
	
	/**
	 * public array function createClick(string $name, string $key, string $type = self::click_custom)
	 */
	public function createClick(string $name, string $key, string $type = self::click_custom): array {
		return array(
			'type'=>$type, 
			'name'=>$name, 
			'key'=>$key
		);
	}
	
	/**
	 *
	 * @param string $name        	
	 * @param string $id        	
	 * @param string $type        	
	 * @return array
	 */
	public function createMedia(string $name, string $id, string $type = self::media_all): array {
		return array(
			'type'=>$type, 
			'name'=>$name, 
			'media_id'=>$id
		);
	}
	
	/**
	 *
	 * @param string $name        	
	 * @param string $url        	
	 * @param string $appId        	
	 * @param string $pagePath        	
	 * @return array
	 */
	public function createMiniProgram(string $name, string $url, string $appId, string $pagePath): array {
		return array(
			'type'=>'miniprogram', 
			'name'=>$name, 
			'url'=>$url, 
			'appid'=>$appId, 
			'pagepath'=>$pagePath
		);
	}
	
	/**
	 * 
	 * @param array $menu
	 * @param array $button
	 * @return array
	 */
	public function addSubMenu(array $menu,array $button):array {
		if(!isset($menu['sub_button'])) $menu['sub_button']=array();
		$menu['sub_button'][]=$button;
		return $menu;
	}
	
	/**
	 * 
	 * @param array $button
	 * @return array
	 */
	public function addMenu(array $button):array{
		if(!isset($this->menus['button'])) $this->menus['button']=array();
		$this->menus['button'][]=$button;
		return $button;
	}
	
	/**
	 * 
	 */
	public function create():bool{
		$translator=new Translator();
		$json=$translator->createJSON($this->menus);
		$mimicry=new Mimicry();
		$end=$mimicry->post($url, array('body'=>$json));
	}
	
	/**
	 * @return boolean
	 */
	public function delete(): bool {
		$url = 'https://' . $this->domain . '/cgi-bin/menu/delete';
		$qryStrings = array(
			'access_token'=>$this->accessToken
		);
		$mm = new Mimicry();
		$json = $mm->get($url, $qryStrings);
		$ends = json_decode($json);
		return 'ok' == $ends['errmsg'] ? true : false;
	}
	
	//
}

