<?php
/**
*
* Layout for the shopper mail, when he confirmed an ordner
*
* The addresses are reachable with $this->BTaddress['fields'], take a look for an exampel at shopper_adresses.php
*
* With $this->cartData->paymentName or shipmentName, you get the name of the used paymentmethod/shippmentmethod
*
* In the array order you have details and items ($this->orderDetails['details']), the items gather the products, but that is done directly from the cart data
*
* $this->orderDetails['details'] contains the raw address data (use the formatted ones, like BTaddress['fields']). Interesting informatin here is,
* order_number ($this->orderDetails['details']['BT']->order_number), order_pass, coupon_code, order_status, order_status_name,
* user_currency_rate, created_on, customer_note, ip_address
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers, Valerie Isaksen
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td>
    
    <div style="padding:0 20px 0 20px;">
    <!-- Номер заказа: -->
    <p>
		<?php echo JText::_('COM_VIRTUEMART_MAIL_SHOPPER_YOUR_ORDER'); ?>
		<strong><?php echo $this->orderDetails['details']['BT']->order_number ?></strong>
	<br/>

    <!-- Пароль заказа: -->
	<?php echo JText::_('COM_VIRTUEMART_MAIL_SHOPPER_YOUR_PASSWORD'); ?>
		<strong><?php echo $this->orderDetails['details']['BT']->order_pass ?></strong> 
    </p>       
        
    </div>    

	</td>
    </tr>
    

    
    <tr>
    <td>
    <div style="padding:10px 20px;">
    <!-- Отследить статус заявки вы можете в личном кабинете: -->
    <p><?php echo JText::_('COM_VIRTUEMART_PRODUCT_STATUSINFO'); ?></p>	
    
    <p>
 			<a style="color:#FFFFFF;line-height:25px;background: none repeat scroll 0 0 #b70000;margin: 10px 10px 10px 2px ;padding: 5px 13px 5px 13px;border-radius: 20px;-webkit-border-radius: 20px;-moz-border-radius: 20px;font-size: 14px; display: inline-block;text-decoration: none;" class="zakaz-inline" title="<?php echo $this->vendor->vendor_store_name ?>" href="<?php echo JURI::root().'index.php?option=com_virtuemart&view=orders&layout=details&order_number='.$this->orderDetails['details']['BT']->order_number.'&order_pass='.$this->orderDetails['details']['BT']->order_pass; ?>">
			<?php echo JText::_('COM_VIRTUEMART_MAIL_SHOPPER_YOUR_ORDER_LINK'); ?></a>
		</p>
     </div>   
	</td>
  </tr>
  
  <tr>
    <td style="border-bottom:10px solid #f7f7f7;">
    
    <div style="padding:10px 20px 20px; border-bottom: 1px solid #e6e6e6;">
    
    <div style="padding:0 0 10px;">
    <p>
    <!-- Итого по заказу: -->
	<?php echo JText::sprintf('COM_VIRTUEMART_MAIL_SHOPPER_TOTAL_ORDER',$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_total,$this->currency) ); ?></p>
    <!-- -->
    </div>
  	 

    
        
    <?php $nb=count($this->orderDetails['history']);
  if($this->orderDetails['history'][$nb-1]->customer_notified && !(empty($this->orderDetails['history'][$nb-1]->comments))) { ?>
  
  
	<?php echo  nl2br($this->orderDetails['history'][$nb-1]->comments); ?>
    <?php } ?>
    
    <?php if(!empty($this->orderDetails['details']['BT']->customer_note)){ ?>
    <!-- Ваш комментарий: -->
		<?php echo JText::sprintf('COM_VIRTUEMART_MAIL_SHOPPER_QUESTION',nl2br($this->orderDetails['details']['BT']->customer_note)) ?>
        
    <?php } ?>

    
    </div> 
    </td>
  </tr>

  
</table>
