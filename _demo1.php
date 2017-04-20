<?php
use SporeAura\WX\Mimicry;
use SporeAura\WX\Translator;
use SporeAura\WX\Menu;

require_once './library/mimicry.class.php';
require_once './library/translator.class.php';
require_once './library/menu.class.php';

$token='1095dd011629d4875601a3b05272d141';


/* 最简单的示例 */
$ui=new Menu($token);
$ui->addMenu($ui->createView('Home Page', 'http://www.sporeaura.com'));
echo $ui->getMenus();

