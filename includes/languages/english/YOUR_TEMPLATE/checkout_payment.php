<?php
/**
 * @package languageDefines
 * @copyright Copyright 2012-2015 Vinos de Frutas Tropicales (lat9): Minimum Customer Account Information / All Virtual Products -- No Shipping
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_payment.php drbyte  New in v1.5.5 $
 */

define('NAVBAR_TITLE_1', 'Checkout - Step 1');
//-bof--avpns  *** 1 of 2 ***
define('NAVBAR_TITLE_2', 'Checkout - Payment Method');

define('HEADING_TITLE', 'Step 1 of 2 - Payment Information');

define('TABLE_HEADING_BILLING_ADDRESS', 'Contact/Billing Information');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Your contact/billing information is shown to the left. You can change this information by clicking the <em>Update</em> button.');
define('TITLE_BILLING_ADDRESS', 'Contact/Billing Information:');
//-eof--avpns   *** 1 of 2 ***

define('TABLE_HEADING_PAYMENT_METHOD', 'Payment Method');
define('TEXT_SELECT_PAYMENT_METHOD', 'Please select a payment method for this order.');
define('TITLE_PLEASE_SELECT', 'Please Select');
define('TEXT_ENTER_PAYMENT_INFORMATION', '');
define('TABLE_HEADING_COMMENTS', 'Special Instructions or Order Comments');

define('TITLE_NO_PAYMENT_OPTIONS_AVAILABLE', 'Not Available At This Time');
define('TEXT_NO_PAYMENT_OPTIONS_AVAILABLE','<span class="alert">Sorry, we are not accepting payments from your region at this time.</span><br />Please contact us for alternate arrangements.');

//-bof-minacct-avpns  *** 2 of 2 ***
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Continue to Step 2</strong>');
//-eof-minacct-avpns  *** 2 of 2 ***
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- to confirm your order.');

define('TABLE_HEADING_CONDITIONS', '<span class="termsconditions">Terms and Conditions</span>');
define('TEXT_CONDITIONS_DESCRIPTION', '<span class="termsdescription">Please acknowledge the terms and conditions bound to this order by ticking the following box. The terms and conditions can be read <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '" target="_blank"><span class="pseudolink">here</span></a>.');
define('TEXT_CONDITIONS_CONFIRM', '<span class="termsiagree">I have read and agreed to the terms and conditions bound to this order.</span>');

define('TEXT_CHECKOUT_AMOUNT_DUE', 'Total Amount Due: ');
define('TEXT_YOUR_TOTAL','Your Total');
