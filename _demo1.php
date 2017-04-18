<?php
use SporeAura\WX\Mimicry;
use SporeAura\WX\Translator;

require_once './library/mimicry.class.php';
require_once './library/translator.class.php';

$menu=array(
		'type'=>'b"utton',
		'name'=>'官方网站',
		'key_value'=>'2354387987897897453453453453453'
		
);
$translator=new Translator();
$json=$translator->createJSON($menu);
echo $json;
