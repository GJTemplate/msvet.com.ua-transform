<?php
/**
 *
 * Layout for the shopper mail, when he confirmed an ordner
 *
 * The addresses are reachable with $this->BTaddress, take a look for an exampel at shopper_adresses.php
 *
 * With $this->orderDetails['shipmentName'] or paymentName, you get the name of the used paymentmethod/shippmentmethod
 *
 * In the array order you have details and items ($this->orderDetails['details']), the items gather the products, but that is done directly from the cart data
 *
 * $this->orderDetails['details'] contains the raw address data (use the formatted ones, like BTaddress). Interesting informatin here is,
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

<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
		body {font-family:Arial, Helvetica, sans-serif !important;}
        body, td, span, p, th {  }
	    table.html-email {margin: 5px auto; background:#fff; border-top:solid #dad8d8 1px; border-right:solid #dad8d8 1px; border-left:solid #dad8d8 1px; font-size:14px;}
	    .html-email tr{border-bottom : 1px solid #f7f7f7;}
	    span.grey {color:#666;}
	    span.date {color:#666; }
	    a.zakaz-inline, a.zakaz-inline:hover, a.zakaz-inline:visited {color:#FFFFFF;line-height:25px;background: none repeat scroll 0 0 #B0B058;margin: 10px 10px 10px 2px ;padding: 5px 13px 5px 13px;border: solid #B0B038 1px;border-radius: 20px;-webkit-border-radius: 20px;-moz-border-radius: 20px;font-size: 14px; display: inline-block;text-decoration: none;}
	    a.zakaz-inline:hover {color:#707001;background: #f8f8f8; text-decoration:underline; border:1px solid #CAC9C9;}
	    .cart-summary{ }
	    .html-email th {margin: 0px;padding: 10px; border-bottom:1px solid #DAD8D8;}
	    .sectiontableentry2, .html-email th, .cart-summary th{ background: none repeat scroll 0 0 #E6E6E6; margin: 0px;padding: 10px;}
		
		.html-email td { border-bottom: 1px solid #e6e6e6;}
	    .sectiontableentry1, .html-email td, .cart-summary td {background: #fff;margin: 0px;padding: 10px;}
	    .line-through{text-decoration:line-through}
	     
	    /* Firefox has a hard-coded font-size style for tables, so it won't by default inherit the surrounding div's font-size! */
	    #vmdoc-footer table, #vmdoc-header table, .vmdoc-footer table, .vmdoc-header table { font-size: inherit; }
	    #vmdoc-header h1, #vmdoc-footer h1, #vmdoc-header p, #vmdoc-footer p { margin-top: 0; margin-bottom: 0; }
	    .vmdoc-header-image { padding: 0; vertical-align: top; }
	    .vmdoc-header-vendor { width: 100%; }
	    td.vmdoc-header-separator, td.vmdoc-header-separator hr { padding: 0; margin-top: 0; margin-bottom: 0; }
	    td.vmdoc-header-separator { padding: 0; }

		
			a.logo-link, a.logo-link2 { border: medium none; text-decoration: none;}
			a.logo-link:hover { text-decoration: none;}
			a.logo-link2:hover { text-decoration:underline;}		
			div.logo-remeshop-p div { margin:0; padding:0; height:auto;}

		
	</style>

    </head>

    <body style="background: #F7F7F7; word-wrap: break-word; font-family:Arial, Helvetica, sans-serif;">
	<div style="background-color: #FFFFFF; padding:10px;" align="center" width="98%">
	    <table width="98%" border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; text-align:left;">
        <tr>
        	<td> 
			<?php
// Shop desc for shopper and vendor
			if ($this->recipient == 'shopper') {
			    echo $this->loadTemplate('header');
			}   
// Message for shopper or vendor
			echo $this->loadTemplate($this->recipient);
// render shipto billto adresses
			echo $this->loadTemplate('shopperaddresses');
// render price list
			if ($this->recipient == 'shopper') {
				echo $this->loadTemplate('pricelist');
				}
				else { 
			   	echo $this->loadTemplate('pricelist-adm');
				}
// more infos
			echo $this->loadTemplate($this->recipient . '_more');
// end of mail
			if ($this->recipient == 'shopper') {
			   echo $this->loadTemplate('footer');
			   }
				else { 
			   echo $this->loadTemplate('footer_adm');
			} 			
			?>
            
            
		    </td>
        </tr>
	    </table>
	</div>
    </body>
</html>