<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_shipping.<br />
 * Displays allowed shipping modules for selection by customer.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_shipping_default.php 14807 2009-11-13 17:22:47Z drbyte $
 * @version $Id: Integrated COWOA v2.4  - 2007 - 2013
 */
?>
<div class="centerColumn" id="checkoutShipping">

<?php echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) . zen_draw_hidden_field('action', 'process'); ?>

<h1 id="checkoutShippingHeading"><?php echo HEADING_TITLE; ?></h1>
<?php if ($messageStack->size('checkout_shipping') > 0) echo $messageStack->output('checkout_shipping'); ?>
<!-- bof Order Steps (tableless) -->
<?php if($COWOA) {?>
    <div id="order_steps">
            <div class="order_steps_text">
			<span class="order_steps_text1_COWOA"><?php echo TEXT_ORDER_STEPS_BILLING; ?></span><span id="active_step_text_COWOA"><?php echo zen_image($template->get_template_dir(ORDER_STEPS_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . ORDER_STEPS_IMAGE, ORDER_STEPS_IMAGE_ALT); ?><br /><?php echo TEXT_ORDER_STEPS_1; ?></span><span class="order_steps_text2_COWOA"><?php echo TEXT_ORDER_STEPS_2; ?></span><span class="order_steps_text3_COWOA"><?php echo TEXT_ORDER_STEPS_3; ?></span><span class="order_steps_text4_COWOA"><?php echo TEXT_ORDER_STEPS_4; ?></span>
            </div>
            <div class="order_steps_line_2">
		  <span class="progressbar_active_COWOA">&nbsp;</span><span class="progressbar_active_COWOA">&nbsp;</span><span class="progressbar_inactive_COWOA">&nbsp;</span><span class="progressbar_inactive_COWOA">&nbsp;</span><span class="progressbar_inactive_COWOA">&nbsp;</span>
            </div>
    </div>
<?php } else {?>
    <div id="order_steps">
            <div class="order_steps_text">
			<span id="active_step_text"><?php echo zen_image($template->get_template_dir(ORDER_STEPS_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . ORDER_STEPS_IMAGE, ORDER_STEPS_IMAGE_ALT); ?><br /><?php echo TEXT_ORDER_STEPS_1; ?></span><span class="order_steps_text2"><?php echo TEXT_ORDER_STEPS_2; ?></span><span class="order_steps_text3"><?php echo TEXT_ORDER_STEPS_3; ?></span><span class="order_steps_text4"><?php echo TEXT_ORDER_STEPS_4; ?></span>
            </div>
            <div class="order_steps_line_2">
                <span class="progressbar_active">&nbsp;</span><span class="progressbar_inactive">&nbsp;</span><span class="progressbar_inactive">&nbsp;</span><span class="progressbar_inactive">&nbsp;</span>
            </div>
    </div>
<?php } ?>
<!-- eof Order Steps (tableless) -->

<h2 id="checkoutShippingHeadingAddress"><?php echo TITLE_SHIPPING_ADDRESS; ?></h2>

<div id="checkoutShipto" class="floatingBox back">
<?php if ($displayAddressEdit) { ?>
<div class="buttonRow forward"><?php echo '<a href="' . $editShippingButtonLink . '">' . zen_image_button(BUTTON_IMAGE_CHANGE_ADDRESS, BUTTON_CHANGE_ADDRESS_ALT) . '</a>'; ?></div>
<?php } ?>
<address class=""><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br />'); ?></address>
</div>
<div class="floatingBox important forward"><?php echo TEXT_CHOOSE_SHIPPING_DESTINATION; ?></div>
<br class="clearBoth" />

<?php
  if (zen_count_shipping_modules() > 0) {
?>

<h2 id="checkoutShippingHeadingMethod"><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></h2>

<?php
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>

<div id="checkoutShippingContentChoose" class="important"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></div>

<?php
    } elseif ($free_shipping == false) {
?>
<div id="checkoutShippingContentChoose" class="important"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></div>

<?php
    }
?>
<?php
    if ($free_shipping == true) {
?>
<div id="freeShip" class="important" ><?php echo FREE_SHIPPING_TITLE; ?>&nbsp;<?php echo $quotes[$i]['icon']; ?></div>
<div id="defaultSelected"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . zen_draw_hidden_field('shipping', 'free_free'); ?></div>

<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
      // bof: field set
// allows FedEx to work comment comment out Standard and Uncomment FedEx
//      if ($quotes[$i]['id'] != '' || $quotes[$i]['module'] != '') { // FedEx
      if ($quotes[$i]['module'] != '') { // Standard
?>
<fieldset>
<legend><?php echo $quotes[$i]['module']; ?>&nbsp;<?php if (isset($quotes[$i]['icon']) && zen_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?></legend>

<?php
        if (isset($quotes[$i]['error'])) {
?>
      <div><?php echo $quotes[$i]['error']; ?></div>
<?php
        } else {
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $_SESSION['shipping']['id']) ? true : false);

            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              //echo '      <div id="defaultSelected" class="moduleRowSelected">' . "\n";
            //} else {
              //echo '      <div class="moduleRow">' . "\n";
            }
?>
<?php
            if ( ($n > 1) || ($n2 > 1) ) {
?>
<div class="important forward"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></div>
<?php
            } else {
?>
<div class="important forward"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . zen_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></div>
<?php
            }
?>

<?php echo zen_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="ship-'.$quotes[$i]['id'] . '-' . str_replace(' ', '-', $quotes[$i]['methods'][$j]['id']) .'"'); ?>
<label for="ship-<?php echo $quotes[$i]['id'] . '-' . str_replace(' ', '-', $quotes[$i]['methods'][$j]['id']); ?>" class="checkboxLabel" ><?php echo $quotes[$i]['methods'][$j]['title']; ?></label>
<!--</div>-->
<br class="clearBoth" />
<?php
            $radio_buttons++;
          }
        }
?>

</fieldset>
<?php
    }
// eof: field set
      }
    }
?>

<?php
  } else {
?>
<h2 id="checkoutShippingHeadingMethod"><?php echo TITLE_NO_SHIPPING_AVAILABLE; ?></h2>
<div id="checkoutShippingContentChoose" class="important"><?php echo TEXT_NO_SHIPPING_AVAILABLE; ?></div>
<?php
  }
?>
<fieldset class="shipping" id="comments">
<legend><?php echo TABLE_HEADING_COMMENTS; ?></legend>
<?php echo zen_draw_textarea_field('comments', '45', '3'); ?>
</fieldset>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CONTINUE_CHECKOUT, BUTTON_CONTINUE_ALT); ?></div>
<div class="buttonRow forward"><?php echo '<strong>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</strong><br />' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></div>

</form>
</div>