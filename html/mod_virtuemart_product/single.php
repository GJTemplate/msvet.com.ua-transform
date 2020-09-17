<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
vmJsApi::jPrice();
$col = 1;

if ($products_per_row == 4) { $pwidth = 'span3'; }
elseif ($products_per_row == 3) { $pwidth = 'span4'; }
elseif ($products_per_row == 2) { $pwidth = 'span6'; }
elseif ($products_per_row == 1) { $pwidth = 'span12'; }
elseif ($products_per_row == 5) { $pwidth = 'span2 sp20'; }
elseif ($products_per_row == 6) { $pwidth = 'span2'; }

if ($products_per_row > 1) {
	$float = "floatleft";
} else {
	$float = "center";
}
?>
<?php JHTML::_('behavior.modal'); ?>
<div class="vmgroup<?php echo $params->get ('moduleclass_sfx') ?> product-sl-handler">

	<?php if ($headerText) { ?>
	<div class="vmheader"><?php echo $headerText ?></div>
	<?php
}
	if ($display_style == "div") {
		?>
		<div class="vmproduct browse-view  row-fluid">
			<?php foreach ($products as $product) { 
			   //   echo '<pre>'; print_r ( $product ); echo '</pre>'.__FILE__.'Строка '.__LINE__ ;
			?>
				<div class="product productdetails floatleft span3 vertical-separator">
                <div class="spacer">   
					<div class="DefWrap">
                 		
                        <div class="bonus_product_wrap">
						<?php
								if (@$product->new == 1) {
								echo '<div class="ribbon-new_cat" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO_NEW').'"></div>';
								}
								if (@$product->hit == 1) {
								echo '<div class="ribbon-hot_cat" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO_HIT').'"></div>';
								}
								if (@$product->action == 1) {
								echo '<div class="ribbon-special_cat" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO1').'"></div>';
								}
								if (@$product->action2 == 1) {
								echo '<div class="ribbon-special_cat2" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO2').'"></div>';
								} 
								if (@$product->action3 == 1) {
								echo '<div class="ribbon-special_cat3" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO3').'"></div>';
								}																 
						 ?> 
        				</div> <!-- .bonus_product_wrap--> 
                 		
                        <!-- Картинка товара -->
                        <div class="spacer-handler pr-img-handler">
                            <?php
                            if (!empty($product->images[0])) {
                                $image = $product->images[0]->displayMediaThumb ('class="featuredProductImage"', FALSE);
                            } else {
                                $image = '';
                            }
                            echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name));
                            ?>
						</div><!-- .pr-img-handler -->
                 		
			            <!-- Название товара --> 
                        <h2 class="h-pr-title">
							<a href="<?php echo $url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .
					$product->virtuemart_category_id); ?>"><?php echo $product->product_name ?></a>
                        </h2>
                 		
                        
                        <!-- Код товара -->
                        <div class="partnomer">
                    		<span class="product_sku_label">
                    			Код товара:</span><br>
                    		<span class="product_sku"><?=$product->product_mpn?></span>
                		</div><!-- .partnomer -->
        
                        
                        <!-- Цена товара -->
                        <div class="product-price-1" id="productPrice<?=$product->virtuemart_product_id?>">
							<?php 
								// $product->prices is not set when show_prices in config is unchecked
								if ($show_price and  isset($product->prices)) {
									echo '<div class="product-price">'.$currency->createPriceDiv ('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
									if ($product->prices['salesPriceWithDiscount'] > 0) {
										echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
									}
									echo '</div>';
								}?>			
                       	</div> <!-- .product-price-1 -->
               
                        
    	                <!-- Кнопка купить. -->               	
	                    <div class="h-pr-details">
                    	<?php
						if (!VmConfig::get ('use_as_catalog', 0)) {
								$stockhandle = VmConfig::get ('stockhandle', 'none');
								if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($product->product_in_stock - $product->product_ordered) < 1) {
									$button_lbl = JText::_ ('COM_VIRTUEMART_CART_NOTIFY');
									$button_cls = 'notify-button';
									$button_name = 'notifycustomer';
									?>
									<div style="display:inline-block;">
								<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>" class="notify"><?php echo JText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a>
									</div>
								<?php
								} else {
									?>
								<div class="addtocart-area">

									<form method="post" class="product" action="index.php" id="addtocartproduct<?=$product->virtuemart_product_id;?>">
										<div class="addtocart-bar">
											<?php
											// Display the quantity box
											?>
											<!-- <label for="quantity<?php echo $product->virtuemart_product_id;?>" class="quantity_box"><?php echo JText::_ ('COM_VIRTUEMART_CART_QUANTITY'); ?>: </label> -->



											<?php
											// Add the button
											$button_lbl = JText::_ ('COM_VIRTUEMART_CART_ADD_TO'); 
											$button_cls = ''; //$button_cls = 'addtocart_button';


											?>
											<?php // Display the add to cart button ?>
											<span class="addtocart-button"> 
												<?php echo shopFunctionsF::getAddToCartButton($product->orderable); ?>
											</span>
											<span class="quantity-box">
											<input type="text" class="quantity-input" name="quantity[]" value="1" step="1"/>
											</span>
											<span class="quantity-controls">
												<input type="button" class="quantity-controls quantity-plus"/>
												<input type="button" class="quantity-controls quantity-minus"/>
											</span>
											<div class="clear"></div>
										

										<input type="hidden" class="pname" value="<?php echo $product->product_name ?>"/>
										<input type="hidden" name="option" value="com_virtuemart"/>
										<input type="hidden" name="view" value="cart"/>
										<noscript><input type="hidden" name="task" value="add"/></noscript>
										<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
										<input type="hidden" name="virtuemart_category_id[]" value="<?php echo $product->virtuemart_category_id ?>"/>
                                        </div>
									</form>
									<div class="clear"></div>
								</div>
								<?php
								}
							}
						?> 
                   		</div> <!-- .h-pr-details -->
             			
                        <!-- Описание товара -->
                   		<p class="product_s_desc">
				   	<?=$product->product_s_desc?>
                   </p> <!-- .product_s_desc-->
					
                    </div> <!-- .DefWrap -->
            	</div><!-- .spacer-->
            	</div>
      	
            
            
            
           <!-- <div class="<?php echo $pwidth ?> <?php echo $float ?>"   >
				 
			</div>-->
			<?php
			if ($col == $products_per_row && $products_per_row && $col < $totalProd) {
				echo "</div><div class=\"vmproduct productdetails row-fluid\">";
				$col = 1;
			} else {
				$col++;
			}
		}  //foreach ?>
		
        
        
        
        </div>
		<br style='clear:both;'/>

		<?php
	} else {
		$last = count ($products) - 1;
		?>
		
		<?php 
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		$temps = $doc->baseurl.'/templates/'.$doc->template;
		
		$templateparams = $app->getTemplate(true)->params;
		?>

		<?php 
			if ($templateparams->get('vmtsl_numeric')) : $vmtsl_var_numeric = "true"; else : $vmtsl_var_numeric = "false"; endif;
			if ($templateparams->get('vmtsl_nextprev')) : $vmtsl_var_nextprev = "true"; else : $vmtsl_var_nextprev = "false"; endif;
			if ($templateparams->get('vmtsl_auto')) : $vmtsl_var_auto = "true"; else : $vmtsl_var_auto = "false"; endif;
			if ($templateparams->get('vmtsl_loop')) : $vmtsl_var_loop = "true"; else : $vmtsl_var_loop = "false"; endif;
			if ($templateparams->get('vmtsl_clickstop')) : $vmtsl_var_clickstop = "true"; else : $vmtsl_var_clickstop = "false"; endif;
		
			$doc->addScript($temps.'/js/easypaginate.js'); 
			$doc->addCustomTag('
		<script type="text/javascript">
			jQuery(function($){
				$(\'ul#slider'.$module->id.'\').easyPaginate({
					delay: '.$templateparams->get('vmtsl_delay').',
					numeric: '.$vmtsl_var_numeric.',
					nextprev: '.$vmtsl_var_nextprev.',
					auto:'.$vmtsl_var_auto.',
					loop:'.$vmtsl_var_loop.',
					pause:'.$templateparams->get('vmtsl_pause').',
					clickstop:'.$vmtsl_var_clickstop.',
					controls: \'pagination-'.$module->id.'\',
					step: '.$products_per_row.'
				});
			}); 
		</script>
		');		
		
		$resVal = $templateparams->get('vmtsl_arrowsposition') - 50;
		
		?>
		<ul class="sl-products vmproduct productdetails row-fluid" id="slider<?php echo($module->id); ?>">
			<?php 
			$a = 0;
			foreach ($products as $product) : ?>
			<li class="<?php echo $pwidth ?> <?php echo $float ?> <?php echo "sl-item-".$a++%$products_per_row; ?>">
				<div class="spacer">
				<div class="pr-img-handler">
				<?php
				if (!empty($product->images[0])) {
					$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage"', FALSE);
				} else {
					$image = '';
				}
				echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name));
				?>

					<div class="popout-price">
					
					</div>
				<?php $url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .
					$product->virtuemart_category_id); ?>
					<div class="popout-price">
						<div class="popout-price-buttons-handler">
							<?php 
							if ($product->images) {
								echo '<div class="show-pop-up-image">'.$product->images[0]->displayMediaThumb( 'class="featuredProductImage"',true,'class="modal"' ).'</div>';
							}
							?><a href="<?php echo $url ?>" class="product-details"><?php echo vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ); ?></a>
						</div>
					</div>

					
				</div>
					<div class="action-handler">

							<h3 class="h-pr-title">
								<a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>
							</h3>
							<span class="product-price">
							<?php 
								// $product->prices is not set when show_prices in config is unchecked
								if ($show_price and  isset($product->prices)) {
									echo '<div class="product-price">'.$currency->createPriceDiv ('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
									if ($product->prices['salesPriceWithDiscount'] > 0) {
										echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
									}
									echo '</div>';
								}?>
							</span>

							<?php
							if (!VmConfig::get ('use_as_catalog', 0)) {
								$stockhandle = VmConfig::get ('stockhandle', 'none');
								if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($product->product_in_stock - $product->product_ordered) < 1) {
									$button_lbl = JText::_ ('COM_VIRTUEMART_CART_NOTIFY');
									$button_cls = 'notify-button';
									$button_name = 'notifycustomer';
									?>
									<div style="display:inline-block;">
								<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>" class="notify"><?php echo JText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a>
									</div>
								<?php
								} else {
									?>
								<div class="addtocart-area">

									<form method="post" class="product" action="index.php">
										<?php
										/* / Product custom_fields
										if (!empty($product->customfieldsCart)) {
											? >
											<div class="product-fields">
												<?php foreach ($product->customfieldsCart as $field) { ?>

												<div style="display:inline-block;" class="product-field product-field-type-<?php echo $field->field_type ?>">
													<?php if($field->show_title == 1) { ?>
														<span class="product-fields-title"><b><?php echo $field->custom_title ?></b></span>
														<?php echo JHTML::tooltip ($field->custom_tip, $field->custom_title, 'tooltip.png'); ?>
													<?php } ?>
													<span class="product-field-display"><?php echo $field->display ?></span>
													<span class="product-field-desc"><?php echo $field->custom_field_desc ?></span>
												</div>

												<?php } ?>
											</div>
											<?php } */ ?>

										<div class="addtocart-bar">

											<?php
											// Display the quantity box
											?>
											<!-- <label for="quantity<?php echo $product->virtuemart_product_id;?>" class="quantity_box"><?php echo JText::_ ('COM_VIRTUEMART_CART_QUANTITY'); ?>: </label> -->



											<?php
											// Add the button
											$button_lbl = JText::_ ('COM_VIRTUEMART_CART_ADD_TO');
											$button_cls = ''; //$button_cls = 'addtocart_button';


											?>
											<?php // Display the add to cart button ?>
											<span class="addtocart-button">
												<?php echo shopFunctionsF::getAddToCartButton($product->orderable); ?>
											</span>
											<span class="quantity-box">
											<input type="text" class="quantity-input" name="quantity[]" value="1"/>
											</span>
											<span class="quantity-controls">
											<input type="button" class="quantity-controls quantity-plus"/>
											<input type="button" class="quantity-controls quantity-minus"/>
											</span>
											<div class="clear"></div>
										</div>

										<input type="hidden" class="pname" value="<?php echo $product->product_name ?>"/>
										<input type="hidden" name="option" value="com_virtuemart"/>
										<input type="hidden" name="view" value="cart"/>
										<noscript><input type="hidden" name="task" value="add"/></noscript>
										<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
										<input type="hidden" name="virtuemart_category_id[]" value="<?php echo $product->virtuemart_category_id ?>"/>
									</form>
									<div class="clear"></div>
								</div>
								<?php
								}
							}
							
							?>

						<div class="clear"></div>
						<div class="gr-cover"></div>
					</div>
						
				</div>
			</li>
			<?php
		endforeach; ?>
		</ul>
		<div class="clear"></div>

		<?php
	}
	if ($footerText) : ?>
		<div class="vmfooter<?php echo $params->get ('moduleclass_sfx') ?>">
			<?php echo $footerText ?>
		</div>
		<?php endif; ?>
</div>