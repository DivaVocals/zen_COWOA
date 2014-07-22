/*Updated for COWOA 2.4 on 02/03/2013*/
# these next lines can be skipped if it already exists in the database from a previous install of COWOA or FEC/FEAC
ALTER TABLE customers ADD COWOA_account tinyint(1) NOT NULL default 0;
ALTER TABLE orders ADD COWOA_order tinyint(1) NOT NULL default 0;

SELECT @t4:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'COWOA';
DELETE FROM configuration WHERE configuration_group_id = @t4;
DELETE FROM configuration_group WHERE configuration_group_id = @t4;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;

INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) 
VALUES ('', 'COWOA', 'Set Checkout Without an Account', '1', '1');
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

SELECT @t4:=configuration_group_id 
FROM configuration_group
WHERE configuration_group_title= 'COWOA';

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
(NULL, 'COWOA', 'COWOA_STATUS', 'false', 'Activate COWOA Checkout? <br />Set to True to allow a customer to checkout without an account.', @t4, 10, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Turn Off Sideboxes During Checkout', 'COWOA_SIDEBOX_OFF', 'false', 'Turn off sideboxes during checkout? <br /><br />Customers should be focused on completing the sale once they start the checkout process. It is a recommended practice that sideboxes should be turned off to help minimize customer distractions during checkout. Many of the larger e-commerce retailers turn off "distractions" during their checkout processes for the same reason - i.e. Amazon. By reducing customer distractions during checkout you can help to decrease cart abandonment, and to increase sales conversions.<br /><br />Set to True to turn off the following sideboxes during checkout:<br /><ul><li>account_history_info (Order Information)</li><li>account_newsletters (Newsletter Subscriptions)</li><li>account_notifications (Product Notifications)</li><li>account_password (My Password)</li><li>address_book (My Personal Address Book)</li><li>address_book_process (New Address Book Entry)</li><li>checkout_confirmation (Confirmation/Order Review)</li><li>checkout_payment (Payment Method/Payment Information)</li><li>checkout_payment_address (Change Billing Address/Change the Billing Information)</li><li>checkout_process (submits the order)</li><li>checkout_shipping (Shipping Method/Shipping Information)</li><li>checkout_shipping_address (Change Shipping Address/Change the Shipping Address)</li><li>create_account (Create Account/My Account Information)</li><li>login (Login)</li><li>logoff Logoff)</li><li>no_account (COWOA Billing Information)</li><li>shopping_cart (Shopping Cart)</li></ul>', @t4, 12, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Enable Order Status', 'COWOA_ORDER_STATUS', 'false', 'Enable The Order Status Function of COWOA?<br />Set to True so that a Customer that uses COWOA will receive an E-Mail with instructions on how to view the status of their order.', @t4, 14, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Enable E-Mail Only', 'COWOA_EMAIL_ONLY', 'false', 'Enable The E-Mail Order Function of COWOA?<br />Set to True so that a Customer that uses COWOA will only need to enter their E-Mail Address upon checkout if their Cart Balance is 0 (Free).', @t4, 16, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Enable Forced Logoff', 'COWOA_LOGOFF', 'false', 'Enable The Forced LogOff Function of COWOA?<br />Set to True so that a Customer that uses COWOA will be logged off automatically after a sucessfull checkout. If they are getting a file download, then they will have to wait for the Status E-Mail to arrive in order to download the file.', @t4, 18, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Enable Shop with Confidence Checkout Page Box', 'COWOA_SWC_BOX', 'true', 'Enable <strong>Shop with Confidence</strong> Checkout Page Box?<br />Set to True so that the <strong>Shop with Confidence</strong> checkout page box will display. The content of this checkout box is managed using the banner manager. Create a banner for this box (only one) and the system will use the banner title for the box title (suggest using <strong>Shop with Confidence</strong>) and the content will appear in the box.', @t4, 20, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Enable Customer Service Checkout Page Box', 'COWOA_CS_BOX', 'true', 'Enable <strong>Customer Service</strong> Checkout Page Box?<br />Set to True so that the <strong>Customer Service</strong> checkout page box will display. The content of this checkout box is managed using the banner manager. Create a banner for this box (only one) and the system will use the banner title for the box title (suggest using <strong>Customer Service</strong>) and the content will appear in the box.', @t4, 22, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Banner Display Groups Customer Service', 'SHOW_BANNERS_GROUP_CUSTOMER_SERVICE', 'cust-service', 'For "Customer Service" box content on Login page', @t4, 14, NOW(), NULL, NULL),
(NULL, 'Banner Display Groups Shop with Confidence', 'SHOW_BANNERS_GROUP_CHECKOUT_CONFIDENCE', 'shop-confidence', 'For "Shop with Confidence" box on Login page', @t4, 14, NOW(), NULL, NULL);

UPDATE configuration SET configuration_value = 'True' WHERE configuration_title = 'Use split-login page';

/*Register the configuration page for Admin Access Control*/
INSERT IGNORE INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES ('configCOWOA','BOX_CONFIGURATION_COWOA','FILENAME_CONFIGURATION',CONCAT('gID=',@t4),'configuration','Y',@t4);

/*this next line can be skipped if it already exists in the database from a previous install of COWOA or FEC/FEAC*/
INSERT IGNORE INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '', 'email,newsletters', 'Permanent Account Holders Only', 'Send email only to permanent account holders ', 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS where COWOA_account != 1 order by customers_lastname, customers_firstname, customers_email_address');

INSERT INTO banners (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES
(NULL, 'Shop with Confidence', '', '', 'shop-confidence', 'Shop with Confidence banner content shows here', NULL, NULL, NULL, NOW(), NOW(), 1, 0, 1, 5),
(NULL, 'Customer Service', '', '', 'cust-service', 'Customer Service banner content shows here', NULL, NULL, NULL, NOW(), NOW(), 1, 0, 1, 5);