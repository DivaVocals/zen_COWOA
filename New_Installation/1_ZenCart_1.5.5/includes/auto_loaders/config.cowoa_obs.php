<?php
/**
 *
 * @package COWOA v2.7
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version: $Id: class.cowoa_obs.php 3 2015-1-27 21:03:25Z davewest $
 */
/**
 * Designed for v1.5.1
 */

/**
 * Observer class used to redirect to the COWOA page
 */

if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}
  $autoLoadConfig[291][] = array('autoType'=>'class',
                              'loadFile'=>'observers/class.no_account.php');
  $autoLoadConfig[291][] = array('autoType'=>'classInstantiate',
                              'className'=>'noAccountObserver',
                              'objectName'=>'noAccountObserver');
