<?php
use SporeAura\WX\Mimicry;
use SporeAura\WX\Translator;
use SporeAura\WX\Menu;

require_once './library/mimicry.class.php';
require_once './library/translator.class.php';
require_once './library/menu.class.php';

$token='uEd5G62VYfQ1A9VRCFvB6gT7Fi-l6B_LiXjzUjBhjGBCBrVaA6JJI64zMlmBbTk3iIR2AcTpkdBnVA-ci5EGuOdxvA0sv4uYPEoUNWFlmbxexI0MSYRfaEZpwjCvbc0mJODhAFAOTI';


/* 最简单的示例 */
$ui=new Menu($token);
$ui->addMenu($ui->createView('Home Page', 'http://www.sporeaura.com'));
//echo $ui->getMenus();
var_dump($ui->create());

