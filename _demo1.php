<?php
use SporeAura\WX\Mimicry;
use SporeAura\WX\Translator;
use SporeAura\WX\Menu;

require_once './library/mimicry.class.php';
require_once './library/translator.class.php';
require_once './library/menu.class.php';

$token='0kEpp6cNjXux1EnXIj3hluqFKOsExhhd-7LgL_wKJTNi_s-c8kSRjtFW8FxPrGpsvuQPDsm_9PapTjMcVKT7VV841Vo9dnPISYQEwOlBhRV9iJPFQmCm5uFX14P7gO3LNSEfABAXCO';

/* 最简单的示例 */
$ui=new Menu($token);
$ui->addMenu($ui->createView('公司官网', 'http://www.sporeaura.com'));
//echo $ui->getMenus();
var_dump($ui->create());

