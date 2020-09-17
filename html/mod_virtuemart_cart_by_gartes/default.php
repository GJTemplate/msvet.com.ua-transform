<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$doc = JFactory::getDocument();



?>


<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#cartpanel').on('click', function() {
			jQuery('div.panel2').animate({
				'height': 'show'
			}, 300, function() {
				jQuery('div.cartpanel').fadeIn(200);
			});
		});
		jQuery('span.closecart').on('click', function() {
			jQuery('div.cartpanel').fadeOut(200, function() {
				jQuery('div.panel2').animate({
					'height': 'hide'
				}, 300);
			});
		});
	});
	</script>
<div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?>" id="vmCartModule">
		<div class="show-cart">
        	<a id="cartpanel" class="cart-button" href="javascript:void(0);">
				<?php echo JText::_('COM_VIRTUEMART_CART_SHOW'); ?>
            </a>
        </div>
        
        <div class="panel2">
			<div class="cartpanel">
                <span class="closecart">&times;</span>
                <div class="arrow"></div>
                <span class="show-cart-link">
                	<?php 
					if(  $data->totalProduct>0)echo $data->cart_show;
					if($data->totalProduct==0)echo '<a style="float:right;" href="#" rel="nofollow">Корзина пуста</a>';
					  ?>
               	</span>
    
                <div id="hiddencontainer" style="display: none; ">
                    <div class="cart-container">
                        <?php if ($show_price) { ?>
                          <div class="subtotal_with_tax" style="float: right;"></div>
                        <?php } ?>
                        <div class="product_row">
                            <span class="quantity"></span>&nbsp;x&nbsp;<span class="product_name"></span>
                        </div>
    
                        <div class="product_attributes"></div>
                    </div>
                </div>
                
                
                
                <div class="vm_cart_products">
                    <div class="cart-container">
    
                    <?php
                        foreach ($data->products as $product)
                        { ?> <div class="product-cart-row"> <?php
                            if ($show_price) { ?>
                                  <div class="subtotal_with_tax" style="float: right;">
								  	<?php echo  $product['subtotal_with_tax'] ?>
                                  </div>
                                <?php } ?>
                            <div class="product_row">
                                <span class="quantity"><?php echo  $product['quantity'] ?></span>&nbsp;x&nbsp;<span class="product_name"><?php echo  $product['product_name'] ?></span>
                            </div>
                            <?php if ( !empty($product['product_attributes']) ) { ?>
                                <div class="product_attributes"><?php echo $product['product_attributes'] ?></div>
        
                            <?php } ?>
                            </div>
                            <?php
                        }
                    ?>
                    </div>
                </div>
                
                <div class="total"><?php if ($data->totalProduct and $show_price) echo  $data->billTotal; ?></div>
			
		</div>
	</div>
        
  
        
        
        
        
        
        <div class="show-both">
        	<div class="total_products">
                <div class="total-items">
                    <strong><?php echo vmText::_('TPL_VMT_SHOPPING_CART_LABEL'); ?></strong>
                    <br>
                    <span>
						<?php
						if($data->totalProduct==0)echo vmText::_('COM_VIRTUEMART_EMPTY_CART');
						if($data->totalProduct==1)echo 'Товар: '. $data->totalProduct;
						if($data->totalProduct>1)echo 'Товаров: '. $data->totalProduct;
						
						 	?>
                    </span>
                </div>
        	</div>
        </div>
        
        
        
	<?php if ($data->totalProduct and $show_price) { ?>
		
		
        
        
        
        
        
		<?php if ($show_product_list) { ?>

	
	
	

	<?php } ?>
<?php } ?>
<?php if ($data->totalProduct and $show_price) { ?>
	
<?php } ?> 

<!--<div class="total_products">
	<?php if ($data->totalProduct>1) 
		/*$data->totalProductTxt2 = '
		<div class="total-items">
			<strong>'.vmText::_('TPL_VMT_SHOPPING_CART_LABEL').'</strong>
			<br>
			<span>'.vmText::sprintf('TPL_VMT_ITEM_S', $data->totalProduct).'</span>
		</div>'; */
		
		/*else if ($data->totalProduct == 1) 
		$data->totalProductTxt2 = '';*/
				
		/*else $data->totalProductTxt2 = '
		<a href="#" class="cart-button">
			<div class="popover bottom">
				<div class="arrow"></div>
				<div class="popover-content">
					<p>'..'</p>
				</div>
			</div>
		</a>
		<div class="is-empty">'.vmText::_('COM_VIRTUEMART_EMPTY_CART').'</div>';
	
		echo $data->totalProductTxt2;*/ ?>

</div>	-->




<?php if ($data->totalProduct and $show_price) { ?><?php } ?>

<noscript>
<?php echo JText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
</noscript>
</div>

