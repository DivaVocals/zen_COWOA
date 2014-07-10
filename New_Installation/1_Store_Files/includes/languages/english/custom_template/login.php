<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: login.php 14280 2009-08-29 01:33:18Z drbyte $
 * @version $Id: login.php $ Integrated COWOA v2.6
 */

define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Login');

define('HEADING_NEW_CUSTOMER', 'New? Please Provide Your Billing Information');
define('HEADING_NEW_CUSTOMER_SPLIT', 'New? Please Provide Your Billing Information');
define('HEADING_PAYPAL', 'Faster Checkout?');

//define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Create a customer profile with <strong>' . STORE_NAME . '</strong> which allows you to shop faster, track the status of your current orders and review your previous orders.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Enter your billing information as it appears on your Credit Card Statement.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT', 'Have a PayPal account? Want to pay quickly with a credit card? Use the PayPal button below to use the Express Checkout option. No PayPal account is required to use your credit card.');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER', '<span class="larger">Or</span><br />');
//define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT', 'Create a billing Profile with <strong>' . STORE_NAME . '</strong> which allows you to shop faster, track the status of your current orders, review your previous orders and take advantage of our other customer benefits.');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT', 'Enter your billing information as it appears on your Credit Card Statement.');
define('HEADING_RETURNING_CUSTOMER', 'Returning Customer? Please Log In');
define('HEADING_RETURNING_CUSTOMER_SPLIT', 'Returning Customer? Please Log In');

define('TEXT_STANDARD_ACCOUNT_HEADING', 'New or Returning Customer?');
define('TEXT_COWOA_HEADING', 'Prefer to Shop Without Creating A Customer Profile?');
define('TEXT_RATHER_COWOA', 'You do not need to create a customer profile to make a purchase with <strong>' . STORE_NAME . '</strong>. Simply click the <strong>"Continue"</strong> button to checkout without creating a customer profile. Upon completion of your order, you will receive an e-mail order confirmation with a link to track your order status.<br />');
define('COWOA_HEADING', 'Guest Checkout');
//define('TEXT_RETURNING_CUSTOMER_SPLIT', 'In order to continue, please login to your <strong>' . STORE_NAME . '</strong> account.');
define('TEXT_RETURNING_CUSTOMER_SPLIT', 'Returning Customer? Enter your information for faster checkout.');

define('TEXT_HEADING_CHECKOUT_CONFIDENCE', 'Shop With Confidence');
define('TEXT_HEADING_CHECKOUT_CUST_SERVICE', 'Customer Service');

define('TEXT_PASSWORD_FORGOTTEN', 'Forgot your password?');

define('TEXT_LOGIN_ERROR', 'Error: Sorry, there is no match for that email address and/or password.');
define('TEXT_VISITORS_CART', '<strong>Note:</strong> If you have shopped with us before and left something in your cart, for your convenience, the contents will be merged if you log back in. <a href="javascript:session_win();">[More Info]</a>');

define('TABLE_HEADING_PRIVACY_CONDITIONS', '<span class="privacyconditions">Privacy Statement</span>');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', '<span class="privacydescription">Please acknowledge you agree with our privacy statement by ticking the following box. The privacy statement can be read</span> <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">here</span></a>.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '<span class="privacyagree">I have read and agreed to your privacy statement.</span>');

define('ERROR_SECURITY_ERROR', 'There was a security error when trying to login.');

define('TEXT_LOGIN_BANNED', 'Error: Access denied.');