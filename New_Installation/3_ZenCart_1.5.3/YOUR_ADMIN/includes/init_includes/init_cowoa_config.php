<?php
//$messageStack->add('COWOA v2.6 install started','success');

/*Updated for COWOA 2.6 on 02/03/2015*/
    //check if COWOA_account column exists and if it does not exist, then add it
    $sql ="SHOW COLUMNS FROM ".TABLE_CUSTOMERS." LIKE '%COWOA_account%'";
    $result = $db->Execute($sql);
    if(!$result->RecordCount())
    {
        $sql = "ALTER TABLE ".TABLE_CUSTOMERS." ADD COWOA_account tinyint(1) NOT NULL default 0";
        $db->Execute($sql);
    }

    //check if COWOA_order column exists and if it does not exist, then add it
    $sql ="SHOW COLUMNS FROM ".TABLE_CUSTOMERS." LIKE '%COWOA_order%'";
    $result = $db->Execute($sql);
    if(!$result->RecordCount())
    {
        $sql = "ALTER TABLE ".TABLE_CUSTOMERS." ADD COWOA_order tinyint(1) NOT NULL default 0";
        $db->Execute($sql);
    }

    $cowoa_menu_title = 'COWOA';
    $cowoa_menu_text = 'Set Checkout Without an Account';

/* find if COWOA Configuration Group Exists */
    $sql = "SELECT * FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title = '".$cowoa_menu_title."'";
    $original_config = $db->Execute($sql);

    if($original_config->RecordCount())
    {
        // if exists updating the existing COWOA configuration group entry
        $sql = "UPDATE ".TABLE_CONFIGURATION_GROUP." SET 
                configuration_group_description = '".$cowoa_menu_text."' 
                WHERE configuration_group_title = '".cowoa_menu_title."'";
        $db->Execute($sql);
        $sort = $original_config->fields['sort_order'];

    }else{
        /* Find max sort order in the configuation group table -- add 2 to this value to create the COWOA configuration group ID */
        $sql = "SELECT (MAX(sort_order)+2) as sort FROM ".TABLE_CONFIGURATION_GROUP;
        $result = $db->Execute($sql);
        $sort = $result->fields['sort'];

        /* Create COWOA configuration group */
        $sql = "INSERT IGNORE INTO ".TABLE_CONFIGURATION_GROUP." (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (NULL, '".$cowoa_menu_title."', '".$cowoa_menu_text."', ".$sort.", '1')";
        $db->Execute($sql);
   }

$cowoa_config_title_old = 'COWOA';
$cowoa_config_desc_old = 'Activate COWOA Checkout? <br />Set to True to allow a customer to checkout without an account.';
$cowoa_config_title_new = 'Activate COWOA?';
$cowoa_config_desc_new = 'Activate COWOA module? <br />Set to True to allow a customer to checkout without an account.';

/* find if COWOA activation setting exists */
    $sql = "SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_title = '".$cowoa_config_title_old."'";
    $original_config = $db->Execute($sql);

    if($original_config->RecordCount())
    {
        // if exists updating the existing COWOA activation setting entry
        $sql = "UPDATE ".TABLE_CONFIGURATION." SET 
                configuration_title = '".$cowoa_config_title_new."' 
                WHERE configuration_title = '".cowoa_config_title_old."'";
        $db->Execute($sql);
        $sort = $original_config->fields['sort_order'];

/* find if COWOA description setting exists */
    $sql = "SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_description = '".$cowoa_config_desc_old."'";
    $original_config = $db->Execute($sql);

    if($original_config->RecordCount())
    {
        // if exists updating the existing COWOA description setting entry
        $sql = "UPDATE ".TABLE_CONFIGURATION." SET 
                configuration_description = '".$cowoa_config_desc_new."' 
                WHERE configuration_description = '".cowoa_config_desc_old."'";
        $db->Execute($sql);
        $sort = $original_config->fields['sort_order'];

/* Find configuation group ID of COWOA */
    $sql = "SELECT configuration_group_id FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title='".$cowoa_menu_title."' LIMIT 1";
    $result = $db->Execute($sql);
    $cowoa_configuration_id = $result->fields['configuration_group_id'];

//-- ADD VALUES TO COWOA CONFIGURATION GROUP (Admin > Configuration > COWOA) --
    $sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'COWOA Version', 'COWOA_VERSION', '2.6', 'Indicates the currently installed version of COWOA.', '".$cowoa_configuration_id."', 1, NOW(), NULL, 'zen_cfg_select_option(array('2.6'),')";
    $db->Execute($sql);

    $sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Activate COWOA?', 'COWOA_STATUS', 'false', 'Activate COWOA module? <br />Set to True to allow a customer to checkout without an account.', '".$cowoa_configuration_id."', 10, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')";
    $db->Execute($sql);

    $sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Turn Off Sideboxes During Checkout', 'COWOA_SIDEBOX_OFF', 'false', 'Turn off sideboxes during checkout? <br /><br />Customers should be focused on completing the sale once they start the checkout process. It is a recommended practice that sideboxes should be turned off to help minimize customer distractions during checkout. Many of the larger e-commerce retailers turn off "distractions" during their checkout processes for the same reason - i.e. Amazon. By reducing customer distractions during checkout you can help to decrease cart abandonment, and to increase sales conversions.<br /><br />Set to True to turn off the following sideboxes during checkout:<br /><ul><li>account_history_info (Order Information)</li><li>account_newsletters (Newsletter Subscriptions)</li><li>account_notifications (Product Notifications)</li><li>account_password (My Password)</li><li>address_book (My Personal Address Book)</li><li>address_book_process (New Address Book Entry)</li><li>checkout_confirmation (Confirmation/Order Review)</li><li>checkout_payment (Payment Method/Payment Information)</li><li>checkout_payment_address (Change Billing Address/Change the Billing Information)</li><li>checkout_process (submits the order)</li><li>checkout_shipping (Shipping Method/Shipping Information)</li><li>checkout_shipping_address (Change Shipping Address/Change the Shipping Address)</li><li>create_account (Create Account/My Account Information)</li><li>login (Login)</li><li>logoff Logoff)</li><li>no_account (COWOA Billing Information)</li><li>shopping_cart (Shopping Cart)</li></ul>', '".$cowoa_configuration_id."', 12, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')";
    $db->Execute($sql);

	$sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Enable Order Status', 'COWOA_ORDER_STATUS', 'false', 'Enable The Order Status Function of COWOA?<br />Set to True so that a Customer that uses COWOA will receive an E-Mail with instructions on how to view the status of their order.', '".$cowoa_configuration_id."', 14, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')";
    $db->Execute($sql);

	$sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Enable E-Mail Only', 'COWOA_EMAIL_ONLY', 'false', 'Enable The E-Mail Order Function of COWOA?<br />Set to True so that a Customer that uses COWOA will only need to enter their E-Mail Address upon checkout if their Cart Balance is 0 (Free).', '".$cowoa_configuration_id."', 16, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')";
    $db->Execute($sql);

	$sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Enable Forced Logoff', 'COWOA_LOGOFF', 'false', 'Enable The Forced LogOff Function of COWOA?<br />Set to True so that a Customer that uses COWOA will be logged off automatically after a sucessfull checkout. If they are getting a file download, then they will have to wait for the Status E-Mail to arrive in order to download the file.', '".$cowoa_configuration_id."', 18, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')";
    $db->Execute($sql);

	$sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Enable Shop with Confidence Checkout Page Box', 'COWOA_SWC_BOX', 'true', 'Enable <strong>Shop with Confidence</strong> Checkout Page Box?<br />Set to True so that the <strong>Shop with Confidence</strong> checkout page box will display. The content of this checkout box is managed using the banner manager. Create a banner for this box (only one) and the system will use the banner title for the box title (suggest using <strong>Shop with Confidence</strong>) and the content will appear in the box.', '".$cowoa_configuration_id."', 20, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')";
    $db->Execute($sql);

	$sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Enable Customer Service Checkout Page Box', 'COWOA_CS_BOX', 'true', 'Enable <strong>Customer Service</strong> Checkout Page Box?<br />Set to True so that the <strong>Customer Service</strong> checkout page box will display. The content of this checkout box is managed using the banner manager. Create a banner for this box (only one) and the system will use the banner title for the box title (suggest using <strong>Customer Service</strong>) and the content will appear in the box.', '".$cowoa_configuration_id."', 22, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),')";
    $db->Execute($sql);

	$sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Banner Display Groups Customer Service', 'SHOW_BANNERS_GROUP_CUSTOMER_SERVICE', 'cust-service', 'For "Customer Service" box content on Login page', '".$cowoa_configuration_id."', 14, NOW(), NULL, NULL)";
    $db->Execute($sql);

	$sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'Banner Display Groups Shop with Confidence', 'SHOW_BANNERS_GROUP_CHECKOUT_CONFIDENCE', 'shop-confidence', 'For \"Shop with Confidence\" box on Login page', '".$cowoa_configuration_id."', 14, NOW(), NULL, NULL)";
    $db->Execute($sql);

//-- SET SPLIT-LOGIN PAGE (Admin > Configuration > Layout Settings) --
	$sql ="UPDATE ".TABLE_CONFIGURATION." WHERE configuration_title = 'Use split-login page'";
	$db->Execute($sql);

	/*Register the configuration page for Admin Access Control*/
	$sql = "INSERT IGNORE INTO " . TABLE_ADMIN_PAGES . " (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES ('configCOWOA','BOX_CONFIGURATION_COWOA','FILENAME_CONFIGURATION',CONCAT('gID=','".$cowoa_configuration_id."'),'configuration','Y','".$cowoa_configuration_id."')";
    $db->Execute($sql);

	/*CREATE PERMANENT ACCOUNT QUERY*/
	$sql = "INSERT IGNORE INTO " . TABLE_QUERY_BUILDER . " (query_id , query_category , query_name , query_description , query_string ) VALUES ( '', 'email,newsletters', 'Permanent Account Holders Only', 'Send email only to permanent account holders ', 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS where COWOA_account != 1 order by customers_lastname, customers_firstname, customers_email_address')";
    $db->Execute($sql);

	$sql = "INSERT IGNORE INTO " . TABLE_BANNERS . " (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES (NULL, 'Shop with Confidence', '', '', 'shop-confidence', 'Shop with Confidence banner content shows here', NULL, NULL, NULL, NOW(), NOW(), 1, 0, 1, 5)";
    $db->Execute($sql);
	$sql = "INSERT IGNORE INTO " . TABLE_BANNERS . " (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES (NULL, 'Customer Service', '', '', 'cust-service', 'Customer Service banner content shows here', NULL, NULL, NULL, NOW(), NOW(), 1, 0, 1, 5)";
    $db->Execute($sql);

   if(file_exists(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'auto_loaders/config.cowoa.php'))
    {
        if(!unlink(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'auto_loaders/config.cowoa.php'))
	{
		$messageStack->add('The auto-loader file '.DIR_FS_ADMIN.'includes/auto_loaders/config.cowoa.php has not been deleted. For this module to work you must delete the '.DIR_FS_ADMIN.'includes/auto_loaders/config.cowoa.php file manually.  Before you post on the Zen Cart forum to ask, YES you are REALLY supposed to follow these instructions and delete the '.DIR_FS_ADMIN.'includes/auto_loaders/config.cowoa.php file.','error');
	};
    }

       $messageStack->add('COWOA v2.6 install completed!','success');