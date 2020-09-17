<?php
defined('_JEXEC') or die('');
	
	use Joomla\CMS\Factory;

$u =  JFactory::getURI();
$url =$u->toString();

// echo '<pre>'; print_r (  $url.'?pag=order_done' ); echo '</pre>'.__FILE__.' in line:  '.__LINE__ ;
 //  header('Location: '.$url.'?pag=order_done' );
/*echo '<pre>'; print_r (   '/index.php?option=com_virtuemart&view=cart&pag=order_done' ); echo '</pre>'.__FILE__.' in line:  '.__LINE__ ;
  
  */
/**
*
* Template for the shopping cart
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/


//require_once(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'orders.php');
//$order = VirtueMartModelOrders::getOrder($this->cart->virtuemart_order_id);
	
	

	
	
	
/*
$doc = JFactory::getDocument();
$doc->addScriptDeclaration('var view_cart_donne = "cart_donne";');


$doc->addScriptDeclaration( "
window.dataLayer = window.dataLayer || []
dataLayer.push({
    'transactionId': 'TYTYTYTY',
	'transactionId2': '55555',
    'transactionAffiliation': '88888',
    'transactionTotal': '11.99',
    'transactionTax': '1.29',
    'transactionShipping': '5',
    'transactionProducts': [{
        'sku': 'DD44',
        'name': 'T-Shirt',
        'category': 'Apparel',
        'price': '11.99',
        'quantity': '1'
    }] 
});

" );*/



if ($this->display_title) {
	echo "<h3>".vmText::_('COM_VIRTUEMART_CART_ORDERDONE_THANK_YOU')."</h3>";
}

	
	$app = Factory::getApplication() ;
	$doc = JFactory::getDocument();
	$session = JFactory::getSession();
	
	$MessageArr = $app->getMessageQueue( true );
	foreach($MessageArr as $i =>  $Message  ) {
		 switch($Message){
			 case 'Необходимо указать хотя бы одного получателя электронной почты.' :
			    unset( $MessageArr [$i]) ;
			    unset( $MessageArr [($i+1)]) ;
			 break ;
			 default :
        }
	}
	
	
	
	$sessionData = $session->get( 'orderSessionVar',  false ) ;
	$session->clear('orderSessionVar');
	
	$Js = json_decode( $sessionData , true ) ;
	// $doc->addScriptDeclaration( $Js ) ;
	echo '<script>' . $Js  . '</script>' ;
	
	echo $this->html;
	
$cuser = JFactory::getUser();
if(!$cuser->guest) echo shopFunctionsF::getLoginForm ();

?>


