<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.<br />
 * Displays Create Account form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Integrated COWOA v2.6
 */
?>
<div class="centerColumn" id="createAcctDefault">


<h4 id="createAcctDefaultLoginLink"><?php echo sprintf(TEXT_ORIGIN_LOGIN, zen_href_link(FILENAME_LOGIN, zen_get_all_get_params(array('action')), 'SSL')); ?></h4>
<h1 id="createAcctDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<!-- bof Order Steps (tableless) -->
    <div id="order_steps">
            <div class="order_steps_text">
			
			<span id="active_step_text_COWOA"><i class="fa fa-file-text-o"></i><br /><?php echo TEXT_ORDER_STEPS_BILLING; ?></span><span class="order_steps_text1_COWOA"><i class="fa fa-truck"></i><br /><?php echo TEXT_ORDER_STEPS_1; ?></span><span class="order_steps_text2_COWOA"><i class="fa fa-credit-card"></i><br /><?php echo TEXT_ORDER_STEPS_2; ?></span><span class="order_steps_text3_COWOA"><i class="fa  fa-pencil-square"></i><br /><?php echo TEXT_ORDER_STEPS_3; ?></span><span class="order_steps_text4_COWOA"><i class="fa fa-check"></i><br /><?php echo TEXT_ORDER_STEPS_4; ?></span>
            </div>
            <div class="order_steps_line_2">
		  <span class="progressbar_active_COWOA">&nbsp;</span>
                <span class="progressbar_inactive_COWOA">&nbsp;</span><span class="progressbar_inactive_COWOA">&nbsp;</span><span class="progressbar_inactive_COWOA">&nbsp;</span><span class="progressbar_inactive_COWOA">&nbsp;</span>
            </div>
    </div>
<!-- eof Order Steps (tableless) -->

<?php echo zen_draw_form('no_account', zen_href_link(FILENAME_NO_ACCOUNT, zen_get_all_get_params(), 'SSL'), 'post', 'onsubmit="return check_form(no_account);"') . '<div>' . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>


<?php require($template->get_template_dir('tpl_modules_no_account.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_no_account.php'); ?>

<div id="checkoutButtons">
  <div id="checkoutButton" class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CONTINUE_CHECKOUT, BUTTON_CONTINUE_ALT); ?></div>
  <div class="buttonRow forward"><?php echo '<strong>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</strong><br />' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></div>
</div>


</div>
</form>
</div>
