<div class="free-templates-lt-box free-templates-lt-post">
    <div class="free-templates-lt-box-body free-templates-lt-post-body">
<div class="free-templates-lt-post-inner free-templates-lt-article">
<h2 class="free-templates-lt-postheader"<?php 
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
 print $title_attributes; ?>><?php print render($title_prefix); ?>
<?php echo art_node_title_output($title, $node_url, $page); ?>
<?php print render($title_suffix); ?>
</h2>
<?php if ($display_submitted): ?>
<div class="free-templates-lt-postheadericons free-templates-lt-metadata-icons">
<?php echo art_submitted_worker($date, $name); ?>

</div>
<?php endif; ?>
<div class="free-templates-lt-postcontent">
<?php
      
      hide($content['comments']);
      hide($content['links']);
      $terms = get_terms_D7($content);
      hide($content[$terms['#field_name']]);
      print render($content);
    ?>

</div>
<div class="cleared"></div>
<?php print $user_picture; ?>
<?php $access_links = true;
if (isset($content['links']['#access'])) {
	$access_links = $content['links']['#access'];
}
if ($access_links && (isset($content['links']) || isset($content['comments']))):
$output = art_links_woker_D7($content);
if (!empty($output)):	?>
<div class="free-templates-lt-postfootericons free-templates-lt-metadata-icons">
<?php echo $output; ?>

</div>
<?php endif; endif; ?>

</div>

		<div class="cleared"></div>
    </div>
</div>
