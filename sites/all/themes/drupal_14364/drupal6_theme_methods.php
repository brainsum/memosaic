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





function phptemplate_preprocess_page(&$vars) {
  $view = get_artx_drupal_view();
  $message = $view->get_incorrect_version_message();
  if (!empty($message)) {
	drupal_set_message($message, 'error');
  }

  $vars['tabs'] = menu_primary_local_tasks();
  $vars['tabs2'] = menu_secondary_local_tasks();
}


 
function drupal_14364_menu_local_task($link, $active = FALSE) {
  $active_class = "";
  if ($active) {
    $active_class .= "active ";
  }
  $output = preg_replace('~<a href="([^"]*)"[^>]*>([^<]*)</a>~',
    '<span class="'.$active_class.'free-templates-lt-button-wrapper">'.
    '<span class="free-templates-lt-button-l"></span>'.
    '<span class="free-templates-lt-button-r"></span>'.
    '<a href="$1" class="'.$active_class.'free-templates-lt-button">$2</a></span>', $link);
  return '<li>'.$output.'</li>';
}


function drupal_14364_feed_icon($url, $title) {
  return '<a href="'. check_url($url) .'" class="free-templates-lt-rss-tag-icon" title="' . $title . '"></a>';
}


function drupal_14364_preprocess_comment_wrapper(&$vars) {
  if (!isset($vars['content'])) return;
  
  ob_start();?>
<div class="free-templates-lt-box free-templates-lt-post">
      <div class="free-templates-lt-box-body free-templates-lt-post-body">
  <div class="free-templates-lt-post-inner free-templates-lt-article">
  
  <?php $result .= ob_get_clean();
   
  if ($vars['node']->type != 'forum') {
    $result .= '<h2 class="free-templates-lt-postheader comments">' . t('Comments') . '</h2>';
  }
  
  ob_start();?>
<div class="free-templates-lt-postcontent">
  
  <?php $result .= ob_get_clean();
  
  $result .= $vars['content'];
  ob_start();?>

  </div>
  <div class="cleared"></div>
  
  <?php $result .= ob_get_clean();
  
  ob_start();?>

  </div>
  
  		<div class="cleared"></div>
      </div>
  </div>
  
  <?php $result .= ob_get_clean();
  
  $vars['content'] = $result;
}


function drupal_14364_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb free-templates-lt-postcontent">'. implode(' | ', $breadcrumb) .'</div>';
  }
}

function drupal_14364_service_links_node_format($links) {
  return '<div class="service-links"><div class="service-label">'. t('Bookmark/Search this post with: ') .'</div>'. art_links_woker($links) .'</div>';
}


function drupal_14364_button($element) {
  
  if (isset($element['#attributes']['class'])) {
    $element['#attributes']['class'] = 'form-'.$element['#button_type'].' '.$element['#attributes']['class'].' free-templates-lt-button';
  }
  else {
    $element['#attributes']['class'] = 'form-'.$element['#button_type'].' free-templates-lt-button';
  }
   	
  return '<span class="free-templates-lt-button-wrapper">'.
    '<span class="free-templates-lt-button-l"></span>'.
    '<span class="free-templates-lt-button-r"></span>'.
    '<input type="submit" '. (empty($element['#name']) ? '' : 'name="'. $element['#name']
         .'" ')  .'id="'. $element['#id'].'" value="'. check_plain($element['#value']) .'" '. drupal_attributes($element['#attributes']).'/>'.
	'</span>';
}


function drupal_14364_img_assist_page($content, $attributes = NULL) {
  $title = drupal_get_title();
  $output = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
  $output .= '<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">'."\n";
  $output .= "<head>\n";
  $output .= '<title>'. $title ."</title>\n";
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  $output .= drupal_get_html_head();
  $output .= drupal_get_js();
  $output .= "\n<script type=\"text/javascript\"><!-- \n";
  $output .= "  if (parent.tinyMCE && parent.tinyMCEPopup && parent.tinyMCEPopup.getParam('popups_css')) {\n";
  $output .= "    document.write('<link href=\"' + parent.tinyMCEPopup.getParam('popups_css') + '\" rel=\"stylesheet\" type=\"text/css\">');\n";
  $output .= "  } else {\n";
  foreach (drupal_add_css() as $media => $type) {
    $paths = array_merge($type['module'], $type['theme']);
    foreach (array_keys($paths) as $path) {
      
      if (!strstr($path, 'img_assist.css')) {
        $output .= "  document.write('<style type=\"text/css\" media=\"{$media}\">@import \"". base_path() . $path ."\";<\/style>');\n";
      }
    }
  }
  $output .= "  }\n";
  $output .= "--></script>\n";
  
  $path = drupal_get_path('module', 'img_assist') .'/img_assist_popup.css';
  $output .= "<style type=\"text/css\" media=\"all\">@import \"". base_path() . $path ."\";</style>\n";
  
  $output .= '<link rel="stylesheet" href="'.get_full_path_to_theme().'/style.css" type="text/css" />'."\n";
  $output .= '<!--[if IE 6]><link rel="stylesheet" href="'.get_full_path_to_theme().'/style.ie6.css" type="text/css" /><![endif]-->'."\n";
  $output .= '<!--[if IE 7]><link rel="stylesheet" href="'.get_full_path_to_theme().'/style.ie7.css" type="text/css" /><![endif]-->'."\n";

  $output .= "</head>\n";
  $output .= '<body'. drupal_attributes($attributes) .">\n";
  
  $output .= theme_status_messages();
  
  $output .= "\n";
  $output .= $content;
  $output .= "\n";
  $output .= '</body>';
  $output .= '</html>';
  return $output;
}


function drupal_14364_node_preview($node) {
  $output = '<div class="preview">';

  $preview_trimmed_version = FALSE;
    if (isset($node->teaser) && isset($node->body)) {
    $teaser = trim($node->teaser);
    $body = trim(str_replace('<!--break-->', '', $node->body));

    
    
    
    if ($teaser != $body || ($body && strpos($node->body, '<!--break-->') === 0)) {
      $preview_trimmed_version = TRUE;
    }
  }

  if ($preview_trimmed_version) {
    drupal_set_message(t('The trimmed version of your post shows what your post looks like when promoted to the main page or when exported for syndication.<span class="no-js"> You can insert the delimiter "&lt;!--break--&gt;" (without the quotes) to fine-tune where your post gets split.</span>'));

	$preview_trimmed_version = t('Preview trimmed version');
	$output .= <<< EOT
<div class="free-templates-lt-box free-templates-lt-post">
        <div class="free-templates-lt-box-body free-templates-lt-post-body">
    <div class="free-templates-lt-post-inner free-templates-lt-article">
    
<div class="free-templates-lt-postcontent">
    
      <h3>
	  $preview_trimmed_version
	  </h3>

    </div>
    <div class="cleared"></div>
    

    </div>
    
    		<div class="cleared"></div>
        </div>
    </div>
    
EOT;
	$output .= node_view(drupal_clone($node), 1, FALSE, 0);
    
	$preview_full_version = t('Preview full version');
	$output .= <<< EOT
<div class="free-templates-lt-box free-templates-lt-post">
        <div class="free-templates-lt-box-body free-templates-lt-post-body">
    <div class="free-templates-lt-post-inner free-templates-lt-article">
    
<div class="free-templates-lt-postcontent">
    
      <h3>
	  $preview_full_version
	  </h3>

    </div>
    <div class="cleared"></div>
    

    </div>
    
    		<div class="cleared"></div>
        </div>
    </div>
    
EOT;

    $output .= node_view($node, 0, FALSE, 0);
  }
  else {
    $output .= node_view($node, 0, FALSE, 0);
  }
  $output .= "</div>\n";

  return $output;
}