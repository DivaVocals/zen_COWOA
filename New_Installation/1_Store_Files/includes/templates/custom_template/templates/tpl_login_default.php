<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_login_default.php 18695 2011-05-04 05:24:19Z drbyte $
 * @version $Id: Integrated COWOA v2.6
 */
?>
<div class="centerColumn" id="loginDefault">

<h1 id="loginDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<?php if ($messageStack->size('login') > 0) echo $messageStack->output('login'); ?>


<?php if ( USE_SPLIT_LOGIN_MODE == 'True' || $ec_button_enabled) { ?>
<!--BOF PPEC split login- DO NOT REMOVE-->
<!-- BOF COWOA 1 of 1 -->
<?php if (COWOA_STATUS == 'true') { ?>  
<h3 class="cowoaGuestHeading"><?php echo TEXT_COWOA_HEADING; ?></h3>
    <fieldset>
    <legend><?php echo COWOA_HEADING; ?></legend>
    <?php echo TEXT_RATHER_COWOA; ?>
    <div class="buttonRow forward">
    <?php echo "<a href=\"" . zen_href_link(FILENAME_NO_ACCOUNT, '', 'SSL') . "\">"; ?>
    <?php echo zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT); ?></a></div>
    <br class="clearBoth" />
    </fieldset>
  <?php } ?>
<br class="clearBoth" />

<h3 class="cowoaStandardHeading"><?php echo TEXT_STANDARD_ACCOUNT_HEADING; ?></h3>
<!-- EOF COWOA 1 of 1 -->

<fieldset class="floatingBoxLt back">
<legend><?php echo HEADING_NEW_CUSTOMER; ?></legend>
<div class="information"><?php echo TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT; ?></div>

<?php echo zen_draw_form('create_account', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(create_account);" id="createAccountForm"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
<!-- <fieldset> -->
<!-- <legend><?php echo HEADING_NEW_CUSTOMER; ?></legend> -->

<!-- <div class="information"><?php echo TEXT_NEW_CUSTOMER_INTRODUCTION; ?></div> -->

<?php require($template->get_template_dir('tpl_modules_create_account.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_create_account.php'); ?>

<!-- </fieldset> -->

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
</form>
</fieldset>

<fieldset class="floatingBoxRt forward">
<legend><?php echo HEADING_RETURNING_CUSTOMER_SPLIT; ?></legend>
<div class="information"><?php echo TEXT_RETURNING_CUSTOMER_SPLIT; ?></div>

<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', 'id="loginForm"'); ?>
<label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', '', 'size="18" id="login-email-address"'); ?>
<br class="clearBoth" />

<label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
<?php echo zen_draw_password_field('password', '', 'size="18" id="login-password"'); ?>
<br class="clearBoth" />

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT); ?></div>
<div class="buttonRow back important"><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
</form>
</fieldset>

<?php // ** BEGIN PAYPAL EXPRESS CHECKOUT ** ?>
<?php if ($ec_button_enabled) { ?>
<fieldset class="floatingBoxRt forward">
<legend><?php echo HEADING_PAYPAL; ?></legend>
<div class="information"><?php echo TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT; ?></div>

  <div class="center"><?php require(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php'); ?></div>
<!-- <hr /> -->
<?php //echo TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER; ?>
</fieldset>
<?php } ?>
<?php // ** END PAYPAL EXPRESS CHECKOUT ** ?>

<?php
  if ($_SESSION['cart']->count_contents() > 0) { ?>
<?php } ?>
<!--EOF PPEC split login- DO NOT REMOVE-->

<?php if (COWOA_SWC_BOX == 'true') { ?> 
<fieldset class="floatingBoxRt forward">
<legend>
<?php
//You will have to change 'SHOW_BANNERS_GROUP_XXXX' for each different group you added to display the proper banners
if (SHOW_BANNERS_GROUP_CHECKOUT_CONFIDENCE != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_CHECKOUT_CONFIDENCE)) 
    {
    if ($banner->RecordCount() > 0) 
        {
           echo $banner->fields['banners_title'];
        }
}?> 
</legend>
<?php
//You will have to change 'SHOW_BANNERS_GROUP_XXXX' for each different group you added to display the proper banners
if (SHOW_BANNERS_GROUP_CHECKOUT_CONFIDENCE != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_CHECKOUT_CONFIDENCE)) 
    {
    if ($banner->RecordCount() > 0) 
        {
           echo zen_display_banner('static', $banner);
        }
}?> 
</fieldset>
<?php } ?>

<?php if (COWOA_CS_BOX == 'true') { ?> 
<fieldset class="floatingBoxRt forward">
<legend>
<?php
//You will have to change 'SHOW_BANNERS_GROUP_XXXX' for each different group you added to display the proper banners
if (SHOW_BANNERS_GROUP_CUSTOMER_SERVICE != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_CUSTOMER_SERVICE)) 
    {
    if ($banner->RecordCount() > 0) 
        {
           echo $banner->fields['banners_title'];
        }
}?> 
</legend>
<?php
//You will have to change 'SHOW_BANNERS_GROUP_XXXX' for each different group you added to display the proper banners
if (SHOW_BANNERS_GROUP_CUSTOMER_SERVICE != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_CUSTOMER_SERVICE)) 
    {
    if ($banner->RecordCount() > 0) 
        {
           echo zen_display_banner('static', $banner);
        }
}?> 
</fieldset>
<?php } ?>

<br class="clearBoth" />
<?php } else { ?>
<!--BOF normal login-->
<?php
  if ($_SESSION['cart']->count_contents() > 0) {
?>
<div class="advisory"><?php echo TEXT_VISITORS_CART; ?></div>
<?php
  }
?>
<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', 'id="loginForm"'); ?>
<fieldset>
<legend><?php echo HEADING_RETURNING_CUSTOMER; ?></legend>

<label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address"'); ?>
<br class="clearBoth" />

<label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password') . ' id="login-password"'); ?>
<br class="clearBoth" />
<?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
</fieldset>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT); ?></div>
<div class="buttonRow back important"><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
</form>

<br class="clearBoth" />

<!--EOF normal login-->
<?php } ?>


</div>