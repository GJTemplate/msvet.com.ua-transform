<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
//$hovereffect   = Yjsg::tplParam('hovereffect');
?>

<!-- Start K2 Tag Layout -->

<div id="k2Container" class="tagView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
  <?php if($this->params->get('show_page_title')): ?>
  <!-- Page title -->
  <div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>"> <?php echo $this->escape($this->params->get('page_title')); ?> </div>
  <?php endif; ?>
  <?php if($this->params->get('tagFeedIcon',1)): ?>
  <!-- RSS feed icon -->
  <div class="k2FeedIcon"> <a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>"> <span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span> </a>
    <div class="clr"></div>
  </div>
  <?php endif; ?>
  <?php if(count($this->items)): ?>
  <div class="tagItemList">
    <?php foreach($this->items as $item): ?>
    
    <!-- Start K2 Item Layout -->
    <div class="tagItemView">
      <div class="tagItemBody yjk2_body">
        <?php if($item->params->get('tagItemImage',1) && !empty($item->imageGeneric)): ?>
        <!-- Item Image -->
        <div class="tagItemImageBlock effect-apollo"> <span class="tagItemImage"> <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
          <?php if ($hovereffect == 1 ): ?>
          <span class="yj_hover"> <span class="yj_hover_in"> <span class="yj_hover_title"><?php echo $item->title; ?></span> </span> <img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" /> </span>
          <?php else: ?>
          <img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
          <?php endif; ?>
          </a> </span>
          <div class="clr"></div>
        </div>
        <?php endif; ?>
        <div class="tagItemHeader yjk2_header">
          <?php if($item->params->get('tagItemTitle',1)): ?>
          <!-- Item title -->
          <h3 class="tagItemTitle yjk2_title">
            <?php if ($item->params->get('tagItemTitleLinked',1)): ?>
            <a href="<?php echo $item->link; ?>"> <?php echo $item->title; ?> </a>
            <?php else: ?>
            <?php echo $item->title; ?>
            <?php endif; ?>
          </h3>
          <?php endif; ?>
          
          <?php if($item->params->get('tagItemCategory')): ?>
          <!-- Item category name -->
          <div class="tagItemCategory yjk2_cat"> <span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span> <a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a> </div>
          <?php endif; ?>

          <?php if($item->params->get('tagItemDateCreated',1)): ?>
          <!-- Date created --> 
			<span class="tagItemDateCreated yjk2_date">
				<time datetime="<?php echo JHtml::_('date', $this->item->created, JText::_(DATE_W3C)); ?>"><?php echo JHTML::_('date', $this->item->created, JText::_('l, j F Y')); ?>
				</time>
			<span>
          <?php endif; ?>          			
        </div>
        
        <?php if($item->params->get('tagItemIntroText',1)): ?>
        <!-- Item introtext -->
        <div class="tagItemIntroText yjk2_intro"> <?php echo mb_substr( $item->introtext, 0, 210); ?> ... </div>        
        <?php endif; ?>

        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <?php if($item->params->get('tagItemExtraFields',0) && count($item->extra_fields)): ?>
      <!-- Item extra fields -->
      <div class="tagItemExtraFields">
        <h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
        <ul>
          <?php foreach ($item->extra_fields as $key=>$extraField): ?>
          <?php if($extraField->value != ''): ?>
          <li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
            <?php if($extraField->type == 'header'): ?>
            <h4 class="tagItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
            <?php else: ?>
            <span class="tagItemExtraFieldsLabel"><?php echo $extraField->name; ?></span> <span class="tagItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
            <?php endif; ?>
          </li>
          <?php endif; ?>
          <?php endforeach; ?>
        </ul>
        <div class="clr"></div>
      </div>
      <?php endif; ?>
      
      <?php if ($item->params->get('tagItemReadMore')): ?>
      <!-- Item "read more..." link -->
      <div class="tagItemReadMore yjk2_readmore"> <a class="k2ReadMore button_color" href="<?php echo $item->link; ?>"> Подробнее... </a> </div>
      <?php endif; ?>
      <div class="clr"></div>
      
    </div>
    <!-- End K2 Item Layout -->
    
    <?php endforeach; ?>
  </div>
  
  <!-- Pagination -->
  <?php if($this->pagination->getPagesLinks()): ?>
  	<div class="k2Pagination"> <?php echo $this->pagination->getPagesLinks(); ?>
    <div class="clr"></div>
    <?php //echo $this->pagination->getPagesCounter(); ?> </div>
  <?php endif; ?>
   
  <?php endif; ?>
</div>
<!-- End K2 Tag Layout --> 
