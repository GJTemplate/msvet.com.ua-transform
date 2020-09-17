<?php
/**
*
* Layout for the shopping cart, look in mailshopper for more details
*
* @package	VirtueMart
* @subpackage Order
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
<table width="98%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td>
    
    	<div class="logo-remeshop-p" style="padding:15px 20px;">
        <a style="border: medium none; text-decoration: none;" class="logo-link" title="На страницу магазина" href="http://msvet.com.ua">
        	<div style="width:275px;">
			<img src="<?php  echo JURI::root () . $this->vendor->images[0]->file_url ?>" style="width: <?php echo $this->vendor->vendor_letter_header_imagesize; ?>mm;" />
		
            </div>
            </a>
            
            <a style="border: medium none; text-decoration: none;" class="logo-link2" title="На страницу магазина" href="http://msvet.com.ua">
            </a>
        </div>
        
        <div style="padding:3px 20px 5px 20px; background:#f7f7f7; border-bottom:1px solid #555555;"> 
        	<h1 style="color: #202020; font-size: 1.5em; text-shadow: 1px 2px 1px #808080;"> <?php echo JText::sprintf('COM_VIRTUEMART_MAIL_SHOPPER_INFO') ?> </h1>
            <p style="color: #333333; margin: 0 0 5px; padding: 0 0 0 2px; font-family:Arial, Helvetica, sans-serif;">Интернет-магазин <span style="color: #49892D; font-size: 1.2em; font-weight: bold; text-shadow: 1px 2px 1px #656565;">«Мой СВЕТ»</span></p>
        </div> 
        
	<div style="padding:20px;">	
		<?php
    //	echo JText::_('COM_VIRTUEMART_CART_MAIL_VENDOR_TITLE').$this->vendor->vendor_name.'<br/>';
        echo JText::sprintf('COM_VIRTUEMART_MAIL_VENDOR_CONTENT',
		$this->vendor->vendor_name, 
		$this->shopperName,$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_total, 
		$this->currency), 
		$this->orderDetails['details']['BT']->order_number);
    
    if(!empty($this->orderDetails['details']['BT']->customer_note)){
        echo '<br /><br />'.JText::sprintf('COM_VIRTUEMART_CART_MAIL_VENDOR_SHOPPER_QUESTION',$this->orderDetails['details']['BT']->customer_note).'<br />';
    }
        ?>
    	</div>
    </td>
    </tr>
</table>