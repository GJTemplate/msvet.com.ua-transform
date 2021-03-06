<?php
/**
*
* Order items view
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$colspan=8;

if ($this->doctype != 'invoice') {
    $colspan -= 4;
} elseif ( ! VmConfig::get('show_tax')) {
    $colspan -= 1;
}
 ?>
 
<div style="padding:20px 20px; border: 1px solid #DAD8D8;"> 
<table class="html-email" width="96%" cellspacing="0" cellpadding="3" border="0" style="font-size:14px;"> 
	<tr align="left" class="sectiontableheader">
        
		<th align="left" colspan="2" style="background-color:#F7F7F7">
        	<strong><?php echo JText::_('COM_VIRTUEMART_PRODUCT_NAME_TITLE') ?></strong></th>
            
		
		<?php if ($this->doctype == 'invoice') { ?>
		<th align="right" width="13%" style="background-color:#F7F7F7;">
        	<strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_PRICE') ?></strong>
        </th>
		<?php } ?>
        
		<th align="right" width="11%" style="background-color:#F7F7F7;">
        	<strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_QTY') ?></strong>
        </th>
        
		<?php if ($this->doctype == 'invoice') { ?>
		<?php if ( VmConfig::get('show_tax')) { ?>
		<!-- th align="right" width="11%" >
        	<strong>111<?php //echo JText::_('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_TAX') ?></strong>
        </th-->
		  <?php } ?>
		<th align="right" width="11%" style="background-color:#F7F7F7;"><strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_SUBTOTAL_DISCOUNT_AMOUNT') ?></strong>
        </th>
        
		<th align="right" width="15%" style="background-color:#F7F7F7;">
        <strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') ?></strong>
        </th>
		<?php } ?>
	</tr>

<?php
	$menuItemID = shopFunctionsF::getMenuItemId($this->orderDetails['details']['BT']->order_language);

	foreach($this->orderDetails['items'] as $item) {
		$qtt = $item->product_quantity ;
		$product_link = JURI::root().'index.php?option=com_virtuemart&view=productdetails&virtuemart_category_id=' . $item->virtuemart_category_id .
			'&virtuemart_product_id=' . $item->virtuemart_product_id . '&Itemid=' . $menuItemID;

		?>
		<tr valign="top">

			<td align="left" colspan="2" >
				<div float="right" ><a href="<?php echo $product_link; ?>"><?php echo $item->order_item_name; ?></a></div>
                <?php echo $item->order_item_sku; ?>
                
                
				<?php
					if (!empty($item->product_attribute)) {
							if(!class_exists('VirtueMartModelCustomfields'))require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'customfields.php');
							$product_attribute = VirtueMartModelCustomfields::CustomsFieldOrderDisplay($item,'FE');
						echo $product_attribute;
					}
				?>
			</td>
			
		<?php if ($this->doctype == 'invoice') { ?>
			<td align="right"   class="priceCol" >
				<?php
				$item->product_discountedPriceWithoutTax = (float) $item->product_discountedPriceWithoutTax;
				if (!empty($item->product_priceWithoutTax) && $item->product_discountedPriceWithoutTax != $item->product_priceWithoutTax) {
					echo '<span class="line-through">'.$this->currency->priceDisplay($item->product_item_price, $this->currency) .'</span><br />';
					echo '<span >'.$this->currency->priceDisplay($item->product_discountedPriceWithoutTax, $this->currency) .'</span><br />';
				} else {
					echo '<span >'.$this->currency->priceDisplay($item->product_item_price, $this->currency) .'</span><br />'; 
				}
				?>
			</td>
		<?php } ?>
			<td align="right" ><?php echo $qtt; ?></td>
		<?php if ($this->doctype == 'invoice') { ?>
			<?php if ( VmConfig::get('show_tax')) { ?>
				<!-- td align="right" class="priceCol">111<?php //echo "<span  class='priceColor2'>".$this->currency->priceDisplay($item->product_tax ,$this->currency, $qtt)."</span>" ?></td-->
                                <?php } ?>
			<td align="right" class="priceCol" >
				<?php echo  $this->currency->priceDisplay( $item->product_subtotal_discount, $this->currency );  //No quantity is already stored with it ?>
			</td>
			<td align="right"  class="priceCol">
				<?php
				$item->product_basePriceWithTax = (float) $item->product_basePriceWithTax;
				$class = '';
				if(!empty($item->product_basePriceWithTax) && $item->product_basePriceWithTax != $item->product_final_price ) {
					echo '<span class="line-through" >'.$this->currency->priceDisplay($item->product_basePriceWithTax,$this->currency,$qtt) .'</span><br />' ;
				}
				elseif (empty($item->product_basePriceWithTax) && $item->product_item_price != $item->product_final_price) {
					echo '<span class="line-through">' . $this->currency->priceDisplay($item->product_item_price,$this->currency,$qtt) . '</span><br />';
				}

				echo $this->currency->priceDisplay(  $item->product_subtotal_with_tax ,$this->currency); //No quantity or you must use product_final_price ?>
			</td>
		<?php } ?>
		</tr>

<?php
	}
?>
<?php if ($this->doctype == 'invoice') { ?>
<tr><td style="border-bottom: 1px solid #DAD8D8;" colspan="<?php echo $colspan ?>"></td></tr>
 <tr class="sectiontableentry1">
			<td style="color:#49892D;" colspan="4" align="right">
            <?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></td>

                        <?php if ( VmConfig::get('show_tax')) { ?>
			<!-- td align="right">111<?php //echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_tax, $this->currency)."</span>" ?></td-->
                        <?php } ?>
			<td align="right"><?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_discountAmount, $this->currency)."</span>" ?></td>
			<td align="right"><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_salesPrice, $this->currency) ?></td>
		  </tr>
<?php
if ($this->orderDetails['details']['BT']->coupon_discount <> 0.00) {
    $coupon_code=$this->orderDetails['details']['BT']->coupon_code?' ('.$this->orderDetails['details']['BT']->coupon_code.')':'';
	?>
	<tr>
		<td style="color:#49892D;" align="right" class="pricePad" colspan="4">
        <?php echo JText::_('COM_VIRTUEMART_COUPON_DISCOUNT').$coupon_code ?></td>
		<?php if ( VmConfig::get('show_tax')) { ?>
			<!-- td align="right"> </td-->
		<?php } ?>
		<td align="right"></td>
		<td align="right"><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->coupon_discount, $this->currency); ?></td>
	</tr>
<?php  } ?>


	<?php
		foreach($this->orderDetails['calc_rules'] as $rule){
			if ($rule->calc_kind== 'DBTaxRulesBill') { ?>
			<tr >
				<td style="color:#49892D;" colspan="4"  align="right" class="pricePad">
                <?php echo $rule->calc_rule_name ?> </td>

                                   <?php if ( VmConfig::get('show_tax')) { ?>
				<!-- td align="right">111</td -->
                                <?php } ?>
				<td align="right"> <?php echo  $this->currency->priceDisplay($rule->calc_amount, $this->currency);  ?></td>
				<td align="right"><?php echo  $this->currency->priceDisplay($rule->calc_amount, $this->currency);  ?> </td>
			</tr>
			<?php
			} elseif ($rule->calc_kind == 'taxRulesBill') { ?>
			<tr >
				<td style="color:#49892D;" colspan="4"  align="right" class="pricePad">
                <?php echo $rule->calc_rule_name ?> </td>
				<?php if ( VmConfig::get('show_tax')) { ?>
				<!-- td align="right">111<?php //echo $this->currency->priceDisplay($rule->calc_amount, $this->currency); ?> </td-->
				 <?php } ?>
				<td align="right"><?php    ?> </td>
				<td align="right"><?php echo $this->currency->priceDisplay($rule->calc_amount, $this->currency);   ?> </td>
			</tr>
			<?php
			 } elseif ($rule->calc_kind == 'DATaxRulesBill') { ?>
			<tr >
				<td style="color:#49892D;" colspan="4"   align="right" class="pricePad">
                <?php echo $rule->calc_rule_name ?> </td>
				<?php if ( VmConfig::get('show_tax')) { ?>
				<!-- td align="right">111</td -->
				 <?php } ?>
				<td align="right"><?php  echo   $this->currency->priceDisplay($rule->calc_amount, $this->currency);  ?> </td>
				<td align="right"><?php echo $this->currency->priceDisplay($rule->calc_amount, $this->currency);  ?> </td>
			</tr>

			<?php
			 }

		}
		?>


	<tr>
		<td style="color:#49892D;" align="right" class="pricePad" colspan="4">
        <?php echo $this->orderDetails['shipmentName'] ?></td>

		<?php if ( VmConfig::get('show_tax')) { ?>
		<!-- td align="right"><span class='priceColor2'>111<?php //echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_shipment_tax, $this->currency) ?></span> </td-->
		<?php } ?>
		<td align="right">&nbsp;</td>
		<td align="right"><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_shipment + $this->orderDetails['details']['BT']->order_shipment_tax, $this->currency); ?></td>
	</tr>

	<!-- Наличными при получение
    <tr>
		<td style="color:#49892D;" align="right" class="pricePad" colspan="5">
		<?php echo $this->orderDetails['paymentName'] ?></td>

		<?php if ( VmConfig::get('show_tax')) { ?>
		<td align="right"><span class='priceColor2'><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_payment_tax, $this->currency) ?></span> </td>
		<?php } ?>
		<td align="right"></td>
		<td align="right"><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_payment + $this->orderDetails['details']['BT']->order_payment_tax, $this->currency); ?></td>
	</tr>
-->
	<tr>
		<td align="right" class="pricePad" colspan="4"><strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') ?></strong></td>

		<?php if ( VmConfig::get('show_tax')) { ?>
		<!-- td align="right"><span class='priceColor2'>111<?php //echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_billTaxAmount, $this->currency); ?></span></td-->
		<?php } ?>
		<td align="right"><span class='priceColor2'><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_billDiscountAmount, $this->currency); ?></span></td>
		<td align="right"><strong><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_total, $this->currency); ?></strong></td>
	</tr>

<?php } ?>
</table>
</div>

