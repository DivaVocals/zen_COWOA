<?php
/**
 * @package Admin
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Integrated COWOA v2.6 2014-07-26 10:38:40Z davewest $
 *
 * autoloader for init_cowoa.php to install sql only
 *
**/

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
} 


$autoLoadConfig[299][] = array(
    'autoType' => 'init_script',
    'loadFile' => 'init_cowoa.php'
    );  