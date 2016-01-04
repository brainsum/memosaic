<div class="<?php 
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
 if (isset($classes)) print $classes; ?>" id="<?php print $block_html_id; ?>"<?php print $attributes; ?>>
  <?php if (!empty($block->subject)): ?>
    <h2><?php print $block->subject ?></h2>
  <?php endif;?>	
  <div class="content">
    <?php print $content ?>
  </div>
</div>
