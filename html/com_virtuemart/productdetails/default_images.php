<?php defined('_JEXEC') or die('Restricted access');

if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
$config = VmConfig::loadConfig();
$app = JFactory::getApplication();
$document = JFactory::getDocument();
$tempURL = $this->baseurl.'/templates/'.$template;

$document->addScript($tempURL.'/js/jquery.elevateZoom-3.0.8.min.js'); 


$templateparams = $app->getTemplate(true)->params;

if ($templateparams->get('useZoom')) {

// ** Images Zoom

	if (!empty($this->product->images)) {
		$image = $this->product->images[0];
		
		$path_products_IMG = VmConfig::get('media_product_path');
			$zoomimg1 = $this->baseurl.'/'.$path_products_IMG.$image->file_name.'.'.$image->file_extension;
		
	?>
	<img id="zoom_01" src="<?php echo $zoomimg1; ?>" data-zoom-image="<?php echo $zoomimg1; ?>">
	<?php
		$count_images = count ($this->product->images);
		if ($count_images > 1) {
			?>
		<div id="gallery_jZ">
			<?php for ($i = 0; $i < $count_images; $i++) {
			$image = $this->product->images[$i]; 
			$titleImg = $image->file_description;
			$altImg = $image->file_meta;
			?>
			<div class="floatleft zoomimg_floating">
				<?php
					$path_products_IMG = VmConfig::get('media_product_path');
					$zoomimg = $this->baseurl.'/'.$path_products_IMG.$image->file_name.'.'.$image->file_extension;
				?>
				<a href="#" data-image="<?php echo $zoomimg; ?>" data-zoom-image="<?php echo $zoomimg; ?>" itemprop="image">
					<img id="img_01" alt="<?php echo $altImg;?>" title="<?=$titleImg;?>"  src="<?php echo $zoomimg; ?>" />
				</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<?php } ?>

<style type="text/css">
.zoomContainer{overflow:hidden;z-index:999;bottom:0px;}
.zoomimg_floating{width:23%;padding:10px 2% 10px 0;}
.main-image img{max-width:100%;}
</style>
<script type="text/javascript">
<?php if ($templateparams->get('responsive')) : $use_responsive = "true"; else : $use_responsive = "false"; endif; ?>
jQuery("#zoom_01").elevateZoom({
	constrainType:"height", 
	zoomType:"<?php echo $templateparams->get('zoomType'); ?>", 
	lensShape: "<?php echo $templateparams->get('lensShape'); ?>",
	lensSize: <?php echo $templateparams->get('lensSize'); ?>,
	cursor:'<?php echo $templateparams->get('cursor'); ?>',
	responsive:<?php echo $use_responsive; ?>,
	zoomLens:true,
	containLensZoom: true,
	gallery:'gallery_jZ', 
	galleryActiveClass:"active"
	}); 
	
jQuery("#zoom_01").bind("click", function(e) {  
  var ez =   jQuery('#zoom_01').data('elevateZoom');	
	jQuery.fancybox(ez.getGalleryList());
	jQuery('.zoomContainer').height(jQuery('img#zoom_01').height());
  return false;
});


</script>
		<?php
	}

} else {

// ** Default VirtueMart Images


if(VmConfig::get('usefancy',0)){
	vmJsApi::js( 'fancybox/jquery.fancybox-1.3.4.pack');
	vmJsApi::css('jquery.fancybox-1.3.4');
	$document = JFactory::getDocument ();
	$imageJS = '
	jQuery(document).ready(function() {
		jQuery("a[rel=vm-additional-images]").fancybox({
			"titlePosition" 	: "inside",
			"transitionIn"	:	"elastic",
			"transitionOut"	:	"elastic"
		});
		jQuery(".additional-images a.product-image.image-0").removeAttr("rel");
		jQuery(".additional-images img.product-image").click(function() {
			jQuery(".additional-images a.product-image").attr("rel","vm-additional-images" );
			jQuery(this).parent().children("a.product-image").removeAttr("rel");
			var src = jQuery(this).parent().children("a.product-image").attr("href");
			jQuery(".main-image img").attr("src",src);
			jQuery(".main-image img").attr("alt",this.alt );
			jQuery(".main-image a").attr("href",src );
			jQuery(".main-image a").attr("title",this.alt );
			jQuery(".main-image .vm-img-desc").html(this.alt);
		}); 
	});
	';
	
} else {
	vmJsApi::js( 'facebox' );
	vmJsApi::css( 'facebox' );
	$document = JFactory::getDocument ();
	$imageJS = '
	jQuery(document).ready(function() {
		Virtuemart.updateImageEventListeners()
	});
	Virtuemart.updateImageEventListeners = function() {
		jQuery("a[rel=vm-additional-images]").facebox();
		var imgtitle = jQuery("span.vm-img-desc").text();
		jQuery("#facebox span").html(imgtitle);
	}
	';
}
$document->addScriptDeclaration ($imageJS);

if (!empty($this->product->images)) {
	$image = $this->product->images[0];
	?>
	<div class="main-image">
		<?php echo $image->displayMediaFull("",true,"rel='vm-additional-images' itemprop='image'"); ?>
		<div class="clear"></div>
	</div>
	<?php
}
	
	

}
 ?>
 
 