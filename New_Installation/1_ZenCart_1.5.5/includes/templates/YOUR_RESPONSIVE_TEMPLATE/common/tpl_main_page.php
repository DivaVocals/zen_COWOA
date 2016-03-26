<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rbarbour zcadditions.com Fri Jan 8 14:09:45 2016 -0500 New in v1.5.5 $
 */

/** bof DESIGNER TESTING ONLY: */
// $messageStack->add('header', 'this is a sample error message', 'error');
// $messageStack->add('header', 'this is a sample caution message', 'caution');
// $messageStack->add('header', 'this is a sample success message', 'success');
// $messageStack->add('main', 'this is a sample error message', 'error');
// $messageStack->add('main', 'this is a sample caution message', 'caution');
// $messageStack->add('main', 'this is a sample success message', 'success');
/** eof DESIGNER TESTING ONLY */



// COWOA modificatiion - the following IF statement can be duplicated/modified as needed to set additional flags
// admin controlled setting turns off sideboxes when you enter the checkout. will help with sales conversions by eliminating customer distractions
if (COWOA_SIDEBOX_OFF == 'true') {  
if (in_array($current_page_base,explode(",",'no_account,create_account,account,account_password,account_edit,address_book,account_history_info,account_newsletters,account_notifications,account_history,login,logoff,checkout_shipping,checkout_shipping_address,checkout_payment,checkout_payment_address,checkout_confirmation,checkout_process,shopping_cart,address_book_process')) ) {
    $flag_disable_right = true;
    $flag_disable_left = true;
  }
}
// ZCAdditions.com, Responsive Template Default (BOF-addition 1 of 1)
if ($flag_disable_right or COLUMN_RIGHT_STATUS == '0') {
  $box_width_right = preg_replace('/[^0-9]/', '', '0');
  $box_width_right_new = '';
} else {
  $box_width_right = COLUMN_WIDTH_RIGHT;
  $box_width_right = preg_replace('/[^0-9]/', '', $box_width_right);
  $box_width_right_new = 'col' . $box_width_right;
}

if ($flag_disable_left or COLUMN_LEFT_STATUS == '0') {
  $box_width_left = preg_replace('/[^0-9]/', '', '0');
  $box_width_left_new = '';
} else {
  $box_width_left = COLUMN_WIDTH_LEFT;
  $box_width_left = preg_replace('/[^0-9]/', '', $box_width_left);
  $box_width_left_new = 'col' . $box_width_left;
}

$side_columns_total = $box_width_left + $box_width_right;
$center_column = '970'; // This value should not be altered
$center_column_width = $center_column - $side_columns_total;
// ZCAdditions.com, Responsive Template Default (EOF-addition 1 of 1)


$header_template = 'tpl_header.php';
$footer_template = 'tpl_footer.php';
$left_column_file = 'column_left.php';
$right_column_file = 'column_right.php';
$body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);
?>
<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?>>

<?php
 if ( $detect->isMobile() && !$detect->isTablet() || $_SESSION['layoutType'] == 'mobile' ) {
  echo '<div id="page">';
 } else if ( $detect->isTablet() || $_SESSION['layoutType'] == 'tablet' ){
  echo '<div id="page">';
  } else {
//
  }
?>

<?php
  if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<div id="mainWrapper">
<?php
 /**
  * prepares and displays header output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_header = true;
  }
  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>

<div id="contentMainWrapper">

<?php
if (COLUMN_LEFT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
  // global disable of column_left
  $flag_disable_left = true;
}
if (!isset($flag_disable_left) || !$flag_disable_left) {
?>
  <div class="<?php echo $box_width_left_new; ?>">
<?php
 /**
  * prepares and displays left column sideboxes
  *
  */
  require(DIR_WS_MODULES . zen_get_module_directory('column_left.php'));
?>
  </div>

<?php
}
?>

  <div class="<?php echo 'col' . $center_column_width; ?>">

<!-- bof  breadcrumb -->
<?php if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
    <div id="navBreadCrumb"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></div>
<?php } ?>
<!-- eof breadcrumb -->

<?php
  if (SHOW_BANNERS_GROUP_SET3 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET3)) {
    if ($banner->RecordCount() > 0) {
?>
    <div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<!-- bof upload alerts -->
<?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
<!-- eof upload alerts -->

<?php
 /**
  * prepares and displays center column
  *
  */
 require($body_code);
?>

<?php
  if (SHOW_BANNERS_GROUP_SET4 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET4)) {
    if ($banner->RecordCount() > 0) {
?>
    <div id="bannerFour" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
  </div>


<?php
//if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' && $_SESSION['customers_authorization'] != 0)) {
if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
  // global disable of column_right
  $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
?>
  <div class="<?php echo $box_width_right_new; ?>">
<?php
 /**
  * prepares and displays right column sideboxes
  *
  */
 require(DIR_WS_MODULES . zen_get_module_directory('column_right.php'));
?>
  </div>

<?php
}
?>

</div>

<?php
 /**
  * prepares and displays footer output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_footer = true;
  }
  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');
?>

</div>
<!--bof- parse time display -->
<?php
  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
?>
<div class="smallText center">Parse Time: <?php echo $parse_time; ?> - Number of Queries: <?php echo $db->queryCount(); ?> - Query Time: <?php echo $db->queryTime(); ?></div>
<?php
  }
?>
<!--eof- parse time display -->
<!--bof- banner #6 display -->
<?php
  if (SHOW_BANNERS_GROUP_SET6 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET6)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerSix" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
<!--eof- banner #6 display -->




 <?php
if  ($detect->isMobile() && !$detect->isTablet() || $_SESSION['layoutType'] == 'mobile' ) {
  echo '</div>';
} else if ( $detect->isTablet() || $_SESSION['layoutType'] == 'tablet' ){
  echo '</div>';
} else {
  //
}
?>


<?php if  ($detect->isMobile() && !$detect->isTablet() || $_SESSION['layoutType'] == 'mobile' ) {
  require($template->get_template_dir('tpl_modules_mobile_menu.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_mobile_menu.php');
} else if ( $detect->isTablet() || $_SESSION['layoutType'] == 'tablet' ){
  require($template->get_template_dir('tpl_modules_mobile_menu.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_mobile_menu.php');
} else if ( $_SESSION['layoutType'] == 'full' ) {
  //
} else {
  //
}
?>

<?php /* add any end-of-page code via an observer class */
  $zco_notifier->notify('NOTIFY_FOOTER_END', $current_page);
?>
</body>
