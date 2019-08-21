<?php

/**
 * Plugin Name: Rating Post Plugin
 * Description: Rating Plugin
 * Author: Vicky Desai
 * Version:1.2
 */

if( ! defined( 'ABSPATH' ) ) {
    return;
} 

/**
 * Top Level Menu and submenu
 */
function vd_rating_options_page()
{
    // add top level menu page
    add_menu_page(
        'Ratings',
        'Ratings',
        'manage_options',
        'vd_rating',
        'vd_rating_page_html',
        'dashicons-star-empty'
    );

    add_submenu_page( 
        'vd_rating', 
        'Settings', 
        'Settings', 
        'manage_options', 
        'vd_rating_settings', 
        'vd_rating_settings_html'
     );
}
add_action('admin_menu', 'vd_rating_options_page');


/**
 * Registering Settings for Rating Settings
 */
function vd_ratings_settings_init()
{
    // Registering the setting 'vd_rating_types' for the page 'vd_rating_settings'
    register_setting( 'vd_rating_settings', 'vd_rating_types');
 
    // Registering the section 'vd_rating_section' for the page 'vd_rating_settings'
    add_settings_section(
        'vd_rating_section',
        '',
        '',
        'vd_rating_settings'
    );
 
    // Registering the field for the setting 'vd_rating_types' on the page 'vd_rating_settings' under section 'vd_rating_section'
    add_settings_field(
        'vd_rating_types', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Show Rating on Content:', 'wporg'),
        'vd_rating_types_html',
        'vd_rating_settings',
        'vd_rating_section',
        [
            'label_for'         => 'vd_rating_pages',
            'class'             => 'wporg_row',
            'wporg_custom_data' => 'custom',
        ]
    );
}
add_action('admin_init', 'vd_ratings_settings_init');



/**
 * The page to display all rated content
 * @return void 
 */
function vd_rating_page_html() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    global $wpdb;

    // SQL query to get all the content which has the meta key 'vd_rating'. Group the content by the ID and get an average rating on each
    $sql = "SELECT * FROM ( SELECT p.post_title 'title', p.guid 'link', post_id, AVG(meta_value) AS rating, count(meta_value) 'count' FROM {$wpdb->prefix}postmeta pm";
    $sql .= " LEFT JOIN wp_posts p ON p.ID = pm.post_id";
    $sql .= " where meta_key = 'vd_rating' group by post_id ) as ratingTable ORDER BY rating DESC";
    
    $result = $wpdb->get_results( $sql, 'ARRAY_A' );
    
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div id="poststuff">
            <table class="form-table widefat">
                <thead>
                    <tr>
                        <td>
                            <strong><?php _e( 'Content', 'vd' ); ?></strong>
                        </td>
                        <td>
                            <strong><?php _e( 'Rating', 'vd' ); ?></strong>
                        </td>
                        <td>
                           <strong><?php _e( 'No. of Ratings', 'vd' ); ?></strong>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ( $result as $row ) {
                            echo '<tr>';
                                echo '<td>' . $row['title'] . '<br/><a href="' . $row['link'] . '" target="_blank">' . __( 'View the Content', 'vd' ) . '</a></td>';
                                echo '<td>' . round( $row['rating'], 2 ) . '</td>';
                                echo '<td>' . $row['count'] . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

/**
 * Get all Custom Post Types that are available publicly
 * For each of those add a checkbox to choose 
 * @param  array $args 
 * @return void       
 */
function vd_rating_types_html( $args ) {   
    $post_types = get_post_types( array( 'public' => true ), 'objects' );
    
    // get the value of the setting we've registered with register_setting()
    $rating_types = get_option('vd_rating_types', array());
    
    if( ! empty( $post_types ) ) {
        foreach ( $post_types as $key => $value ) {
            $isChecked = in_array( $key, $rating_types );
            echo '<input ' . ( $isChecked ? 'checked="checked"' : '' ) . ' type="checkbox" name="vd_rating_types[]" value="' . $key . '" /> ' . $value->label . '<br/>';
        }
    }
}


/**
 * Displaying the form with our Rating settings
 * @return void 
 */
function vd_rating_settings_html() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
 
    // add error/update messages
 
    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if (isset($_GET['settings-updated'])) {
        // add settings saved message with the class of "updated"
        add_settings_error('vd_messages', 'vd_message', __('Settings Saved', 'vd'), 'updated');
    }
 
    // show error/update messages
    settings_errors('vd_messages');
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg"
            settings_fields('vd_rating_settings');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('vd_rating_settings');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

add_action( 'wp_ajax_submit_rating', 'vd_submit_rating' );
add_action( 'wp_ajax_nopriv_submit_rating', 'vd_submit_rating' );


/**
 * Submitting Rating
 * @return string  JSON encoded array
 */
function vd_submit_rating() {
    check_ajax_referer( 'vd_rating', '_wpnonce', true );
    $result = array( 'success' => 1, 'message' => '' );

    $ratingCookie = isset( $_COOKIE['vd_rating'] ) ? unserialize( base64_decode( $_COOKIE['vd_rating'] ) ) : array();
    $rate_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;
 
    if( ! $ratingCookie ) {
        $ratingCookie = array();
    }
    
    $ratingCookie = array();
    if( $rate_id > 0 ) {

        if( ! in_array( $rate_id, $ratingCookie ) ) {

            $rate_value = isset( $_POST['rating'] ) ? $_POST['rating'] : 0;
            if( $rate_value > 0 ) {
                
                $success = add_post_meta( $rate_id, 'vd_rating', $rate_value );
                
                if( $success ) {

                    $result['message'] = __( 'Thank you for rating!', 'vd' );
                    $ratingCookie[] = $rate_id;
                    $expire = time() + 30*DAY_IN_SECONDS;
                    setcookie( 'vd_rating', base64_encode(serialize( $ratingCookie )), $expire, COOKIEPATH, COOKIE_DOMAIN );
                    $_COOKIE['vd_rating'] = base64_encode(serialize( $ratingCookie ));
                }

            } else {
                $result['success'] = 0;
                $result['message'] = __( 'Something went wrong. Try to rate later', 'vd' );
            }

        } else {
            $result['success'] = 0;
            $result['message'] = __( 'You have already rated this content.', 'vd' );
        }
    } else {
        $result['success'] = 0;
        $result['message'] = __( 'Something went wrong. Try to rate later', 'vd' );
    }

    echo json_encode( $result );
    wp_die();
}

/**
 * Enqueueing Scripts
 * @return void 
 */
function vd_rating_scripts() { 
    wp_enqueue_style( 'rating-css', plugin_dir_url( __FILE__ ) . '/css/vd_rating.css', array(), '', 'screen' );
    wp_register_script( 'rating-js', plugin_dir_url( __FILE__ ) . '/js/vd_rating.js', array('jquery'), '', true );
    wp_localize_script( 'rating-js', 'vd_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'vd_rating' ),
        'text'     => array(
            'close_rating' => __( 'Close Rating', 'vd' ),
            'rate_it' => __( 'Rate It', 'vd' ),
            'choose_rate' => __( 'Choose a Rate', 'vd' ),
            'submitting' => __( 'Submitting...', 'vd' ),
            'thank_you' => __( 'Thank You for Your Rating!', 'vd' ),
            'submit' => __( 'Submit', 'vd' ),
        )
    ));
    wp_enqueue_script( 'rating-js' );
}

/**
 * Checking for Rating
 * @return void 
 */
function vd_check_for_rating() {
  
    $rating_types = get_option( 'vd_rating_types', array() );

    if( is_array( $rating_types ) && count( $rating_types ) > 0 && is_singular( $rating_types ) ) { 

        $rate_id = get_the_id();
        $ratingCookie = isset( $_COOKIE['vd_rating'] ) ? unserialize( base64_decode( $_COOKIE['vd_rating'] ) ) : array();
        if( ! in_array( $rate_id, $ratingCookie ) ) { 
            // This content has not been rated yet by that user 

            add_action( 'wp_enqueue_scripts', 'vd_rating_scripts');
            add_action( 'wp_footer', 'vd_rating_render' );
        } 
    }
    
}
add_action( 'template_redirect', 'vd_check_for_rating' );

/**
 * Render Rating
 * @return void 
 */
function vd_rating_render() {
     
    $ratingValues = 5;
    ?>
   
    <div id="contentRating" class="vd-rating">
        <button type="button" id="toggleRating" class="active">
            <span class="text_rate">
                <?php _e( 'Rate It', 'vd' ); ?>
            </span>
            <span class="arrow"></span>
        </button> 
        <div id="entryRating" class="vd-rating-content active">
            <div class="errors" id="ratingErrors"></div>
            <ul>
                <?php for( $i = 1; $i <= $ratingValues; $i++ ) {
                    echo '<li>';
                        echo '<input type="radio" name="ratingValue" value="' . $i . '" id="rating' . $i . '"/>';;
                        
                        echo '<label for="rating' . $i . '">';
                            echo $i;
                        echo '</label>';
                    echo '</li>';
                }
                ?>
                 
            </ul>
            <button type="button" data-rate="<?php echo get_the_id(); ?>"id="submitRating"><?php _e( 'Submit', 'vd' ); ?></button>
        </div>
    </div>
    <?php
}
