<?php
/**
 *
 * Define here the Header for order mail success !
 *
 * @package    VirtueMart
 * @subpackage Cart
 * @author Kohl Patrick
 * @author Valérie Isaksen
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
defined ('_JEXEC') or die('Restricted access');


?>

 


<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
        <td valign="top" bgcolor="#ffffff" style="border-bottom:1px solid #555555;" width="20%" >
        
        <div class="logo-remeshop-p" style="padding:15px 20px;">
        <a style="border: medium none; text-decoration: none;" class="logo-link" title="На страницу магазина" href="http://www.e-marker.com.ua">
        	<div style="width:275px;">
			<img src="<?php  echo JURI::root () . $this->vendor->images[0]->file_url ?>" style="width: <?php echo $this->vendor->vendor_letter_header_imagesize; ?>mm;" />
		
            </div>
            </a>
            
            <a style="border: medium none; text-decoration: none;" class="logo-link2" title="На страницу магазина" href="http://www.e-marker.com.ua">
            </a>
        </div>
        
        </td>
        <td valign="top" bgcolor="#ffffff" style="border-bottom:1px solid #555555;" width="79%" >
      	<div class="wrapper_tel-header" style="padding: 20px 0 0 10px; font-family:Arial, Helvetica, sans-serif; text-align:left;"> 
        <div style="width:200px; float:left;">
        <p style="color: #333; font-size: 14px;margin: 0;">Интернет-магазин<br/> 
          <span style="color: #49892D; font-size: 1.5em; font-weight: bold; text-shadow: 1px 2px 1px #656565;">«Мой СВЕТ»</span></p>
            <p style="color: #333333; font-size: 14px; margin: 0; ">&nbsp;</p>
        </div>
        <div style="width: auto; float: right; padding:0 20px 0 0;">
        <p style="color: #333333; font-size: 14px;margin: 0;padding:0 0 10px 0;">+38 (067)<span style="color: #202020;	font-size: 1.3em; font-weight: bold; text-shadow: 1px 2px 1px #656565;">&nbsp;613 45 44</span>
        </p> 
        </div>
            
            
            
        </div>  
        
      </td>
      </tr>
            <tr>
        <td colspan="2">
        <div style="padding:20px 20px 20px 20px;">
        <p>111<?php echo JText::sprintf ('COM_VIRTUEMART_MAIL_SHOPPER_NAME', $this->orderDetails['details']['BT']->title . ' ' . $this->orderDetails['details']['BT']->first_name . ' ' . $this->orderDetails['details']['BT']->last_name); ?></p>
        <p>222<?php echo JText::sprintf('COM_VIRTUEMART_MAIL_SHOPPER_NAMEWELCOM') ?></p>
        
        
        <h3 style="color:#202020; line-height:1.2em;">
        333<?php echo JText::sprintf('COM_VIRTUEMART_MAIL_SHOPPER_INFOCLIENT') ?></h3>
        </div>
        </td>
      </tr

></table> 