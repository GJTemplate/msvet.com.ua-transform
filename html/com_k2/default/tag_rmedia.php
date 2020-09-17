<?php

/**
 * @package		K2
 * @author		GavickPro http://gavick.com
 */

// no direct access
defined('_JEXEC') or die;

?>

<section id="k2Container" class="itemListView genericViewTag<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
		
        

		<?php if($this->params->get('show_page_title')): ?>
		<header>
				<h1><?php echo $this->escape($this->params->get('page_title')); ?></h1>
		</header>
		<?php endif; ?>
		<h2><?php echo JText::_('K2_TITLE_TAG'); ?></h2>
        
		<?php if(count($this->items)): ?>
		<section>
			<div id="itemListLeading">
            
            
            
            
				<?php foreach($this->items as $key => $item): ?>
				
				<?php if($key % 2 == 0) : ?>
				<div class="itemListRow gkListCols2">
				
				<?php endif; ?>
					<article class="itemView itemContainer ContainerTag">
						<div class="itemsContainerWrap">	
							<?php if($item->params->get('genericItemImage') && !empty($item->imageGeneric)): ?>
							<div class="itemImageBlock"> <a class="itemImage" href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo $item->image_caption; else echo $item->title; ?>"> <img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo $item->image_caption; else echo $item->title; ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" /> </a> </div>
							<?php endif; ?>
							
							<div class="itemBlock">
								<header>
										<?php if($item->params->get('genericItemTitle')): ?>
										<h2>
												<?php if ($item->params->get('genericItemTitleLinked')): ?>
												<a href="<?php echo $item->link; ?>"> <?php echo $item->title; ?> </a>
												<?php else: ?>
												<?php echo $item->title; ?>
												<?php endif; ?>
										</h2>
										<?php endif; ?>
								</header>
								
								<div class="itemBody<?php if(!$item->params->get('genericItemDateCreated')): ?> nodate<?php endif; ?>">
										<?php if($item->params->get('genericItemIntroText')): ?>
										<div class="itemIntroText"> <?php echo mb_substr( $item->introtext, 0, 145); ?> ... </div>
										<?php endif; ?>
                                        
										<?php if($item->params->get('genericItemExtraFields') && count($item->extra_fields)): ?>
										<div class="itemExtraFields">
												<h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
												<ul>
																<?php foreach ($item->extra_fields as $key=>$extraField): ?>
																<?php if($extraField->value != ''): ?>
																<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
																	<?php if($extraField->type == 'header'): ?>
																	<h4 class="tagItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
																	<?php else: ?>
																	<span class="tagItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
																	<span class="tagItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
																	<?php endif; ?>		
																</li>
																<?php endif; ?>
																<?php endforeach; ?>
																</ul>
										</div>
										<?php endif; ?>
								</div>
								
								<?php if($item->params->get('genericItemCategory')): ?>
								<ul>
	
										<?php if($item->params->get('genericItemCategory')) : ?>
										<li><span class="cat_video"><?php echo JText::_('K2_PUBLISHED_IN_VIDEO'); ?></span>: <a class="link_cat_video" href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a></li>
										<?php endif; ?>
								</ul>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php if(($key + 1) % 2 == 0) : ?>
				</div>
				<?php endif; ?>
                
				<?php endforeach; ?>
			</div>
            
		</section>
		<?php if($this->params->get('tagFeedIcon',1)): ?>
		<a class="k2FeedIcon" href="<?php echo $this->feed; ?>"><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></a>
		<?php endif; ?>
		<?php if($this->pagination->getPagesLinks()): ?>
		<?php echo str_replace('</ul>', '<li class="counter">'.$this->pagination->getPagesCounter().'</li></ul>', $this->pagination->getPagesLinks()); ?>
		<?php endif; ?>
		<?php endif; ?>
</section>
