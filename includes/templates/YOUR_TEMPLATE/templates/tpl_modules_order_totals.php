<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2012-2015 Vinos de Frutas Tropicales (lat9): Minimum Customer Account Information / All Virtual Products -- No Shipping
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_order_totals.php 2993 2006-02-08 07:14:52Z birdbrain $
 */
 ?>
<?php 
/**
 * Displays order-totals modules' output
 */
  for ($i=0; $i<$size; $i++) {
//-bof-minacct-avpns  *** 1 of 1 ***
    if ($GLOBALS[$class]->code == 'ot_shipping') continue;  // Don't display "Free Shipping"
//-eof-minacct-avpns  *** 1 of 1 ***
?>
<div id="<?php echo str_replace('_', '', $GLOBALS[$class]->code); ?>">
    <div class="totalBox larger forward"><?php echo $GLOBALS[$class]->output[$i]['text']; ?></div>
    <div class="lineTitle larger forward"><?php echo $GLOBALS[$class]->output[$i]['title']; ?></div>
</div>
<br class="clearBoth" />
<?php } ?>
