<?php

/*
Plugin Name: VSS Social Share
Description: Social Share Plugin
Version: 1.2
Author: VipulDeep Singh
*/

function vss_scripts_social(){
    wp_enqueue_style('Social', plugins_url( '/css/style.css' , __FILE__ ), false, '2.2', 'all' );
}
add_action("wp_enqueue_scripts","vss_scripts_social");


function vss_social_share_menu_item()
{
  add_submenu_page("options-general.php", "VSS Social Share", "VSS Social Share", "manage_options", "social-share", "vss_social_share_page"); 
}

add_action("admin_menu", "vss_social_share_menu_item");


function vss_social_share_page()
{
   ?>
      <div class="wrap">
         <h1>Social Sharing Options</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("social_share_config_section");
 
               do_settings_sections("social-share");
                
               submit_button(); 
            ?>
         </form>
      </div>
   <?php
}

function vss_social_share_settings()
{
    add_settings_section("social_share_config_section", "", null, "social-share");
 
    add_settings_field("social-share-facebook", "Do you want to display Facebook share button?", "social_share_facebook_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-twitter", "Do you want to display Twitter share button?", "social_share_twitter_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-linkedin", "Do you want to display LinkedIn share button?", "social_share_linkedin_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-googleplus", "Do you want to display googleplus share button?", "social_share_googleplus_checkbox", "social-share", "social_share_config_section");
    
    register_setting("social_share_config_section", "social-share-facebook");
    register_setting("social_share_config_section", "social-share-twitter");
    register_setting("social_share_config_section", "social-share-linkedin");
    register_setting("social_share_config_section", "social-share-googleplus");
}
 
function social_share_facebook_checkbox()
		{  
		   ?>
		        <input type="checkbox" name="social-share-facebook" value="1" <?php checked(1, get_option('social-share-facebook'), true); ?> /> Check for Yes
		   <?php
		}

function social_share_twitter_checkbox()
		{  
		   ?>
		        <input type="checkbox" name="social-share-twitter" value="1" <?php checked(1, get_option('social-share-twitter'), true); ?> /> Check for Yes
		   <?php
		}

function social_share_linkedin_checkbox()
		{  
		   ?>
		        <input type="checkbox" name="social-share-linkedin" value="1" <?php checked(1, get_option('social-share-linkedin'), true); ?> /> Check for Yes
		   <?php
		}

function social_share_googleplus_checkbox()
		{  
		   ?>
		        <input type="checkbox" name="social-share-googleplus" value="1" <?php checked(1, get_option('social-share-googleplus'), true); ?> /> Check for Yes
		   <?php
		}
 
add_action("admin_init", "vss_social_share_settings");



function add_vss_social_share_icons($content)
		{
		    $html = "<div class='social-share-wrapper'><ul class='dshare'>";

		    global $post;

		    $url = get_permalink($post->ID);
		    $url = esc_url($url);

		    if(get_option("social-share-facebook") == 1)
			    {
			        $html = $html . "<li class='facebook'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'>
			        Facebook</a></li>";
			    }

		    if(get_option("social-share-twitter") == 1)
			    {
			        $html = $html . "<li class='twitter'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'>Twitter</a></li>";
			    }

		    if(get_option("social-share-linkedin") == 1)
			    {
			        $html = $html . "<li class='linkedin'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'>LinkedIn</a></li>";
			    }

			 if(get_option("social-share-googleplus") == 1)
			    {
			        $html = $html . "<li class='googleplus'><a target='_blank' href='https://plus.google.com/share?url=" . $url . "'>googleplus</a></li>";
			    }   

		   

		    $html = $html . "<div class='clear'></div></ul></div>";

		    return $content = $content . $html;
		}

add_shortcode("vss_social", "add_vss_social_share_icons");


?>