<?php 
/*


#########################################
www.free-templates.lt - get Your Free template for Your site!
#########################################
Free Joomla, Drupal, Wordpress, Blogger themes and templates!
Free Joomla, Drupal, Wordpress, Blogger themes and templates!
#########################################
www.free-templates.lt - get Your Free template for Your site!
#########################################



*/
 $region = $block->region;
$enabled_blockRegion = $region != 'content' && $region != 'Menu' && $region != 'vnavigation_left' && $region != 'vnavigation_right'
					&& $region != "banner1" && $region != "banner2" && $region != "banner3"
					&& $region != "banner4" && $region != "banner5" && $region != "banner6"
					&& $region != "extra1" && $region != "extra2" && $region != "footer_message";  ?>
<div class="<?php if (isset($classes)) print $classes; ?>" id="<?php print $block_html_id; ?>"<?php print $attributes; ?>>
<?php if ($enabled_blockRegion) :?>
<div class="free-templates-lt-box free-templates-lt-block">
      <div class="free-templates-lt-box-body free-templates-lt-block-body">
  
<?php endif;?>
    
<?php print render($title_prefix); ?>
	    <?php if (!empty($block->subject)): ?>
			
			<?php if ($enabled_blockRegion) :?>
<div class="free-templates-lt-bar free-templates-lt-blockheader">
				    <h3 class="t subject"<?php print $title_attributes; ?>>
			<?php endif;?>
			
			<?php echo $block->subject; ?>
			
			<?php if ($enabled_blockRegion) :?>
</h3>
				</div>
				
			<?php endif;?>

	    <?php endif; ?>
<?php print render($title_suffix); ?>

	<?php if ($enabled_blockRegion) :?>
<div class="free-templates-lt-box free-templates-lt-blockcontent">
		    <div class="free-templates-lt-box-body free-templates-lt-blockcontent-body">
		<div class="content"<?php print $content_attributes; ?>>
		
	<?php endif;?>
		
<?php echo $content; ?>

	<?php if($enabled_blockRegion) :?>

		</div>
				<div class="cleared"></div>
		    </div>
		</div>
		

				<div class="cleared"></div>
		    </div>
		</div>
		
	<?php endif;?>
</div>