<?php
/*
 * @package admin
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Integrated COWOA v2.6 2014-07-26 10:38:40Z davewest $
 */

/*
 * configure COWOA  
*/

// do not run installer on log in page or if already at current version
 if (!(basename($PHP_SELF) == FILENAME_LOGIN . ".php")) {
if (CW_VERSION != '2.4.1') {  


    // set version
        $version = '2.4.1';
    
    // Get db prefix if any only for none ZC tables or with table names ONLY
 	$db_prefix = DB_PREFIX;
      

// set the words holder
$isit_installed = '';

    /*    */ 
    // Screen activity
 	echo 'COWOA v' . $version . ' for ZenCart Installing...<br/>';
  
     // Configuration Values to create or preserve
    $menu_items_image = array(
            array('COWOA','COWOA_STATUS','true','Activate COWOA Checkout? <br />Set to True to allow a customer to checkout without an account.',10,array('true','false')),
            array('Turn Off Sideboxes During Checkout','COWOA_SIDEBOX_OFF','false','Turn off sideboxes during checkout? <br /><br />Customers should be focused on completing the sale once they start the checkout process. It is a recommended practice that sideboxes should be turned off to help minimize customer distractions during checkout. Many of the larger e-commerce retailers turn off "distractions" during their checkout processes for the same reason - i.e. Amazon. By reducing customer distractions during checkout you can help to decrease cart abandonment, and to increase sales conversions.<br /><br />Set to True to turn off the following sideboxes during checkout:<br /><ul><li>account_history_info (Order Information)</li><li>account_newsletters (Newsletter Subscriptions)</li><li>account_notifications (Product Notifications)</li><li>account_password (My Password)</li><li>address_book (My Personal Address Book)</li><li>address_book_process (New Address Book Entry)</li><li>checkout_confirmation (Confirmation/Order Review)</li><li>checkout_payment (Payment Method/Payment Information)</li><li>checkout_payment_address (Change Billing Address/Change the Billing Information)</li><li>checkout_process (submits the order)</li><li>checkout_shipping (Shipping Method/Shipping Information)</li><li>checkout_shipping_address (Change Shipping Address/Change the Shipping Address)</li><li>create_account (Create Account/My Account Information)</li><li>login (Login)</li><li>logoff Logoff)</li><li>no_account (COWOA Billing Information)</li><li>shopping_cart (Shopping Cart)</li></ul>',11,array('true','false')),
            array('Enable Order Status','COWOA_ORDER_STATUS','false','Enable The Order Status Function of COWOA?<br />Set to True so that a Customer that uses COWOA will receive an E-Mail with instructions on how to view the status of their order.',12,array('true','false')),
            array('Enable E-Mail Only','COWOA_EMAIL_ONLY','false','Enable The E-Mail Order Function of COWOA?<br />Set to True so that a Customer that uses COWOA will only need to enter their E-Mail Address upon checkout if their Cart Balance is 0 (Free).',13,array('true','false')),
            array('Enable Forced Logoff','COWOA_LOGOFF','false','Enable The Forced LogOff Function of COWOA?<br />Set to True so that a Customer that uses COWOA will be logged off automatically after a sucessfull checkout. If they are getting a file download, then they will have to wait for the Status E-Mail to arrive in order to download the file.',14,array('true','false')),
            array('Enable Shop with Confidence Checkout Page Box','COWOA_SWC_BOX','true','Enable <strong>Shop with Confidence</strong> Checkout Page Box?<br />Set to True so that the <strong>Shop with Confidence</strong> checkout page box will display. The content of this checkout box is managed using the banner manager. Create a banner for this box (only one) and the system will use the banner title for the box title (suggest using <strong>Shop with Confidence</strong>) and the content will appear in the box.',15,array('true','false')),
            array('Enable Customer Service Checkout Page Box','COWOA_CS_BOX','true','Enable <strong>Customer Service</strong> Checkout Page Box?<br />Set to True so that the <strong>Customer Service</strong> checkout page box will display. The content of this checkout box is managed using the banner manager. Create a banner for this box (only one) and the system will use the banner title for the box title (suggest using <strong>Customer Service</strong>) and the content will appear in the box.',16,array('true','false')),
            array('Banner Display Groups Customer Service','SHOW_BANNERS_GROUP_CUSTOMER_SERVICE','cust-service','For "Customer Service" box content on Login page',17,false),
            array('Banner Display Groups Shop with Confidence','SHOW_BANNERS_GROUP_CHECKOUT_CONFIDENCE','shop-confidence','For "Shop with Confidence" box on Login page',18,false),
            array('COWOA Version','CW_VERSION',$version,'COWOA version',19,false)
            );

$overwrite_item = array(
      array('COWOA Version', 'CW_VERSION', $version, 'COWOA version',19,false),
      array('Use split-login page','USE_SPLIT_LOGIN_MODE','True','The login page can be displayed in two modes: Split or Vertical.<br />In Split mode, the create-account options are accessed by clicking a button to get to the create-account page. In Vertical mode, the create-account input fields are all displayed inline, below the login field, making one less click for the customer to create their account.<br />Default: False','19',array('True', 'False'))
    );
              
  
// Create new Configuration Category
	$check_result = $db->Execute("SELECT 'configuration_group_id' FROM ".$db_prefix."configuration_group WHERE configuration_group_title = 'COWOA' LIMIT 0, 300 ");
	if ($check_result->RecordCount() > 1) die('To Many Groups - Run remove and Clean your database then try again!');
	if ($check_result->RecordCount() < 1) {
	
	  $insert_result1 = $db->Execute("INSERT INTO ".$db_prefix."configuration_group VALUES ('', 'COWOA', 'Set Checkout Without an Account', '1', '1')");
	  $db->Execute("UPDATE ".$db_prefix."configuration_group SET `sort_order` = LAST_INSERT_ID() WHERE configuration_group_id = LAST_INSERT_ID()");
          $categoryid = $db->Execute("SELECT 'configuration_group_id' FROM `configuration_group` WHERE `configuration_group_title` = 'Links Manager'");
	if ($insert_result1 === false) exit ('Error in Createing New Configuration Group - COWOA<br/> ');
	if ($insert_result1) $isit_installed .= 'Created New Configuration Group - COWOA<br/>';			 
	} else {
		$isit_installed .= 'Configuration Group COWOA already exists SKIPPED<br/>';
	}
	
// Get the id of the new configuration category
    $categoryid = array();
	$id_result = $db->Execute("SELECT configuration_group_id FROM ".$db_prefix."configuration_group WHERE configuration_group_title = 'COWOA'");
	if (!$id_result->EOF) {
			$categoryid = $id_result->fields;
			$isit_installed .= 'COWOA Configuration_Group ID = ' . $categoryid['configuration_group_id']. '<br>';
			$cw_config_id = $categoryid['configuration_group_id'];
    } else {
    	    exit ('Failed Finding COWOA Configuration_Group ID<br/>Exit');
    }
    
    
    foreach($menu_items_image as $menu_item)
    {
    cw_create_menu_item($menu_item[0],$menu_item[1],$menu_item[2],$menu_item[3],$cw_config_id,$menu_item[4],$menu_item[5]);
    }
     
    foreach($overwrite_item as $over_item)
    {
    cw_overwrite_menu_item($over_item[0],$over_item[1],$over_item[2],$over_item[3],$cw_config_id,$over_item[4],$over_item[5]);
    }
  
$db->Execute("INSERT IGNORE INTO " . TABLE_QUERY_BUILDER . " ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '', 'email,newsletters', 'Permanent Account Holders Only', 'Send email only to permanent account holders ', 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS where COWOA_account != 1 order by customers_lastname, customers_firstname, customers_email_address')");

$check_result = $db->Execute("SELECT 'banners_title' FROM ".TABLE_BANNERS." WHERE banners_title = 'Shop with Confidence' LIMIT 0, 300 ");

if ($check_result->RecordCount() < 1) {
$db->Execute("INSERT INTO " . TABLE_BANNERS . " (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES
(NULL, 'Shop with Confidence', '', '', 'shop-confidence', 'Shop with Confidence banner content shows here', NULL, NULL, NULL, NOW(), NOW(), 1, 0, 1, 5),
(NULL, 'Customer Service', '', '', 'cust-service', 'Customer Service banner content shows here', NULL, NULL, NULL, NOW(), NOW(), 1, 0, 1, 5)");
}
    
/********* register COWOA admin pages for Zen 1.5.x *****************/

    if (function_exists('zen_register_admin_page')) {
    
    zen_deregister_admin_pages('configCOWOA');
    zen_register_admin_page('configCOWOA', 'BOX_CONFIGURATION_COWOA', 'FILENAME_CONFIGURATION', 'gID='. $cw_config_id . '', 'configuration', 'Y', 200);

    }  

/************** COWOA Columns checks ***********************/

$cowoa1 = (cw_field_exists(TABLE_CUSTOMERS,'COWOA_account')) ? true : -1;
$cowoa2 = (cw_field_exists(TABLE_ORDERS,'COWOA_order')) ? true : -1;

if ($cowoa1 !== true) {
  $db->Execute("ALTER TABLE " . TABLE_CUSTOMERS . " ADD COLUMN COWOA_account tinyint(1) NOT NULL default 0");
} 


if ($cowoa2 !== true) {
  $db->Execute("ALTER TABLE " . TABLE_ORDERS . " ADD COLUMN COWOA_order tinyint(1) NOT NULL default 0");
} 

/******************* look for and fix emails **************/

$check_result = $db->Execute("SELECT * FROM " . TABLE_CUSTOMERS . " WHERE customers_id NOT IN (SELECT MIN(customers_id) _ FROM " . TABLE_CUSTOMERS . " GROUP BY customers_email_address)");

if ($check_result->RecordCount() > 1) {
                    
while (!$check_result->EOF) {
  $sql = "delete from " . TABLE_CUSTOMERS . " where customers_id = " . $check_result->fields['customers_id'] ;
  //echo $sql . '<br />';
$db->Execute($sql);

$check_result->MoveNext();
 }

}
	          
/************** done kill the auto loader ***********/	  

     if(file_exists(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'auto_loaders/config.cowoa.php'))
    {
        if(!unlink(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'auto_loaders/config.cowoa.php'))
	{
		$messageStack->add('' . 'Autoloader not deleted' . '','error');
		
	};
    }	   


/***************************************************************/
  }
}
// create config menu item function

    function cw_create_menu_item($c_title,$c_key,$default,$discrip,$config_id,$sort,$values)
    {
            global $db;
            $sql = "SELECT configuration_value FROM ".TABLE_CONFIGURATION." WHERE configuration_key = '".$c_key."' LIMIT 1";
            
            $results = $db->Execute($sql);
            
            $config_value = ($results->fields['configuration_value'] !='')?$results->fields['configuration_value']: $default;

            $sql ="DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = '".$c_key."'";
            $db->Execute($sql);


            if($values)
            {
                foreach($values as $v)
                {
                $v_string .= "''".$v."'',";
                }
                $v_arr = substr($v_string,0,-1);
                $sql = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '".$c_title."', '".$c_key."', '".$default."', '".$discrip."', ".$config_id.", ".$sort.", now(), now(), NULL, 'zen_cfg_select_option(array(".$v_arr."),')";
            }else{
                // text input type
                $sql = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '".$c_title."', '".$c_key."', '".$default."', '".$discrip."', ".$config_id.", ".$sort.", now(), now(), NULL, NULL)";
            }
    
           // echo $sql . '<br />'; 
            $db->Execute($sql);  



            return true;

    }

// overwrite config menu item function

    function cw_overwrite_menu_item($c_title,$c_key,$default,$discrip,$config_id,$sort,$values)
    {
            global $db;
            $sql ="DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = '".$c_key."'";
            $db->Execute($sql);

            if($values)
            {
                foreach($values as $v)
                {
                $v_string .= "''".$v."'',";
                }
                $v_arr = substr($v_string,0,-1);
                $sql = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '".$c_title."', '".$c_key."', '".$default."', '".$discrip."', ".$config_id.", ".$sort.", now(), now(), NULL, 'zen_cfg_select_option(array(".$v_arr."),')";
            }else{
                // text input type
                $sql = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '".$c_title."', '".$c_key."', '".$default."', '".$discrip."', ".$config_id.", ".$sort.", now(), now(), NULL, NULL)";
            }
    
            $db->Execute($sql);  



            return true;

    }

  function cw_field_exists($table,$field) {
   global $db;
    $sql = "show fields from " . $table;
    $result = $db->Execute($sql);
    while (!$result->EOF) {
    // echo 'fields found='.$result->fields['Field'].'<br />';
      if  ($result->fields['Field'] == $field) {
        return true; // exists, so return with no error
      }
      $result->MoveNext();
    }
    return false;
  }