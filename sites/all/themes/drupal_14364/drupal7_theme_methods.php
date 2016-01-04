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




function drupal_14364_process_html(&$variables) {
	$view = get_artx_drupal_view();
	$message = $view->get_incorrect_version_message();
	if (!empty($message)) {
		drupal_set_message($message, 'error');
	}
}

function drupal_14364_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    
    
    $output = '<h2 class="element-invisible free-templates-lt-postheader">' . t('You are here') . '</h2>';

    $output .= '<div class="breadcrumb free-templates-lt-postcontent">' . implode(' » ', $breadcrumb) . '</div>';
    return $output;
  }
}


function drupal_14364_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));

  $element['#attributes']['class'][] = 'form-' . $element['#button_type'] . ' free-templates-lt-button';
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }

  return '<span class="free-templates-lt-button-wrapper">'.
    '<span class="free-templates-lt-button-l"></span>'.
    '<span class="free-templates-lt-button-r"></span>'.
	'<input' . drupal_attributes($element['#attributes']) . ' />'.
	'</span>';
}


function drupal_14364_preprocess_page(&$vars) {
  $vars['tabs'] = menu_primary_local_tasks();
  $vars['tabs2'] = menu_secondary_local_tasks();
}


function drupal_14364_menu_local_task($variables) {
  $link = $variables['element']['#link'];
  $link_text = $link['title'];
  
  $active_class = '';
  if (!empty($variables['element']['#active'])) {
    
    $active = '<span class="element-invisible">' . t('(active tab)') . '</span>';
    $active_class = ' active';

    
    
    if (empty($link['localized_options']['html'])) {
      $link['title'] = check_plain($link['title']);
    }
    $link['localized_options']['html'] = TRUE;
    $link_text = t('!local-task-title!active', array('!local-task-title' => $link['title'], '!active' => $active));
  }

  
  $link['localized_options']['attributes']['class'] = array('free-templates-lt-button');

  return '<li>' .
	  '<span class="free-templates-lt-button-wrapper' . $active_class. '">'.
	  '<span class="free-templates-lt-button-l"></span>'.
      '<span class="free-templates-lt-button-r"></span>'.
	  l($link_text, $link['href'], $link['localized_options']) .
	  "</span></li>\n";
}


function drupal_14364_feed_icon($variables) {
  $text = t('Subscribe to @feed-title', array('@feed-title' => $variables['title']));
  return l(NULL, $variables['url'], array('html' => TRUE, 'attributes' => array('class' => array('feed-icon', 'free-templates-lt-rss-tag-icon'), 'title' => $text)));
}


function drupal_14364_node_preview($variables) {
  $node = $variables['node'];

  $output = '<div class="preview">';

  $preview_trimmed_version = FALSE;

  $elements = node_view(clone $node, 'teaser');
  $trimmed = drupal_render($elements);
  $elements = node_view($node, 'full');
  $full = drupal_render($elements);

    if ($trimmed != $full) {
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
	$output .= $trimmed;
    
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

    $output .= $full;
  }
  else {
    $output .= $full;
  }
  $output .= "</div>\n";

  return $output;
}


function art_links_woker_D7($content) {
  $result = '';
  if (!isset($content['links'])) return $result;
  foreach (array_keys($content['links']) as $name) {
	$$name = & $content['links'][$name];
	if (isset($content['links'][$name]['#links'])) {
	  $links = $content['links'][$name]['#links'];
	  if (is_array($links)) {
		$output = get_links_html_output_D7($links);
		if (!empty($output)) {
			$result .= (empty($result)) ? $output : '&nbsp;|&nbsp;' . $output;
		}
	  }
    }
  }

$terms = get_terms_D7($content);
  if (!empty($terms)) {
  ob_start();?>
  <span class="free-templates-lt-posttagicon"><?php
  $result .= ($result == '') ? ob_get_clean() : '&nbsp;|&nbsp;' . ob_get_clean();
  $result .= '<div class="free-templates-lt-tags">' . render($terms) . '</div>';
  ob_start();?>
  </span><?php
  $result .= ob_get_clean();
  }
  

  return $result;  
}

function get_terms_D7($content) {
	$result = NULL;
	foreach (array_keys($content) as $name)	{
		$$name = & $content[$name];
		$field_type = NULL;
		if (is_array($content[$name])) {
			if (isset($content[$name]['#field_type']))
				$field_type = $content[$name]['#field_type'];
		} else if (is_object($content[$name])) {
			if (isset($content[$name]->field_type))
				$field_type = $content[$name]->field_type;
		}
	    if ($field_type == NULL || $field_type != "taxonomy_term_reference") continue;
	    $result = $content[$name];
	}
	return $result;
}

function get_links_html_output_D7($links) {
	$output = '';
	$num_links = count($links);
    $index = 0;

	foreach ($links as $key => $link) {
	  $class = array($key);

      
      if ($index == 0) {
        $class[] = 'first';
      }
      if ($index == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      
	  $link_output = '';

      if (isset($link['href'])) {
        
        $link_output = l($link['title'], $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $link_output = '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }
		
if (strpos ($key, "comment") !== FALSE) {
		
		  if ($index > 0 && !empty($link_output) && !empty($output)) {
		  $output .= '&nbsp;|&nbsp;';
		}
		ob_start();?>
		<span class="free-templates-lt-postcommentsicon"><?php
		$output .= ob_get_clean();
		$output .= $link_output;
		$index++;
		ob_start();?>
		</span><?php
		$output .= ob_get_clean();
		continue;
		}
		
if ($index > 0 && !empty($link_output) && !empty($output)) {
          $output .= '&nbsp|&nbsp';
        }
        ob_start();?>
        <span class="free-templates-lt-postcategoryicon"><?php
        $output .= ob_get_clean();
        $output .= $link_output;
        $index++;
        ob_start();?>
        </span><?php
        $output .= ob_get_clean();
        

	}
	return $output;
}