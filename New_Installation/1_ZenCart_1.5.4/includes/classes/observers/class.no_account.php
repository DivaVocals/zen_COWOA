<?php
/**
 * @package COWOA v2.7
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version: $Id: class.cowoa_obs.php 3 2015-1-27 21:03:25Z davewest $
 *
 * updated for v1.5.5
 */

/**
 * Observer class used to redirect to the COWOA page
 */

class noAccountObserver extends base {
	function __construct() {
    $this->attach($this, array('NOTIFY_HEADER_START_ACCOUNT'));
    $this->attach($this, array('NOTIFY_HEADER_START_ACCOUNT_EDIT'));
    $this->attach($this, array('NOTIFY_HEADER_START_ACCOUNT_HISTORY'));
    $this->attach($this, array('NOTIFY_HEADER_START_ACCOUNT_HISTORY_INFO'));
    $this->attach($this, array('NOTIFY_HEADER_START_ACCOUNT_NOTIFICATION'));
    $this->attach($this, array('NOTIFY_HEADER_START_ACCOUNT_PASSWORD'));
    $this->attach($this, array('NOTIFY_HEADER_START_ADDRESS_BOOK'));
    $this->attach($this, array('NOTIFY_HEADER_START_ADDRESS_BOOK_PROCESS'));
    $this->attach($this, array('NOTIFY_HEADER_REGISTERED_USERS_ONLY'));
    $this->attach($this, array('NOTIFY_HEADER_START_GV_SEND'));
    $this->attach($this, array('NOTIFIER_CART_RESTORE_CONTENTS_START'));

	}
	
	function update(&$class, $eventID, $paramsArray) {
	global $messageStack, $db;
	
	if ($eventID != 'NOTIFIER_CART_RESTORE_CONTENTS_START')  {
    if (isset($_SESSION['COWOA']) && $_SESSION['COWOA'] == true) {
      $messageStack->add_session('header', 'Only registered customers can access account features.  You are currently using our guest checkout option.  Please logout and sign-in with your registered account to access all account features.', 'caution');
      zen_redirect(zen_back_link(true));
    } elseif (!isset($_SESSION['customer_id'])) {
      $_SESSION['redirect_url'] = zen_href_link($_GET['main_page'], zen_get_all_get_params(array('main_page')), 'SSL');
    }
  }
   
if ($eventID == 'NOTIFIER_CART_RESTORE_CONTENTS_START')  {
//die('observer called');
  //if sesson is cowoa, delete any saved baskets This should not happen for guest accounts
  if (isset($_SESSION['COWOA']) && $_SESSION['COWOA'] == true) {
    if (isset($_SESSION['customer_id'])) {
      $sql = "delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
      $db->Execute($sql);

      $sql = "delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
      $db->Execute($sql);
      }
  }
}	
}
}
// eof
