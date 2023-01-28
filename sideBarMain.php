<?php

/*
Plugin Name: SliderNews(sigma)
Plugin URI: www.pejmanAlaee.ir/
Description: .
Author: pejman
Author URI: /
Text Domain: wordpress-auth
Domain Path: /languages/
Version: 5.6.1
*/

define('WF_sl_DIR', plugin_dir_path(__FILE__));
define('WF_sl_URL', plugin_dir_url(__FILE__));
define('WF_sl_INC', WF_sl_DIR . '/inc/');
define('WF_sl_tpl', WF_sl_DIR . '/tpl/');

add_action('init', function () {

    $args = array(
        'show_ui'   => true,
        'has_archive' =>true ,
        'public'    => true,

        'labels'    => array(
            'name'              => 'اخبار',
            'singular_name'     => 'اخبار',
            'name_admin_bar'    => 'اخبار',
            'add_new'           => 'اخبار جدید',
            'not_found'         => 'اخبار یافت نشد',
            'search'            => 'جستجوی اخبار',
            'add_new_item'      => 'افزودن اخبار جدید',
            'featured_image'    => 'کاور اخبار',
            'set_featured_image' => 'مشخص کردن جلد اخبار',
            'remove_featured_image' => 'حذف جلد اخبار',
            'use_featured_image'    => 'استفاده از کاور',
            'edit_item' => 'ویرایش اخبار'

        ),

        'menu_position'     => 5,
        'hierarchical'      => true,
        'query_var'     => 'news',
        'taxonomies'    => array(),
        'supports' => array('thumbnail', 'title', 'comments', 'editor', 'page-attributes'),
        'menu_icon' => '',
        'register_meta_box_cb' => 'hm_add_metaboxxx',

        'rewrite' => array(
            'slug' => 'newsInfo'
        ),

    );
    register_post_type('neeews', $args);
}, 999);

function hm_add_metaboxxx(){
    add_meta_box('test', 'discriptionNews', function ($post) {

        $w = $post;

        include WF_sl_tpl . "admin/discriptionNews.php";
    });

}
add_action('save_post', 'save_data_info_news');
add_action('edit_post', 'save_data_info_news');

function save_data_info_news($post_id)
{

    if (isset($_POST['discriptionInputNews'])){
        global $wpdb;
        update_post_meta($post_id, '_hmci_news_discription', sanitize_text_field($_POST['discriptionInputNews']));
    }
    if (isset($_POST['linkShow'])) {
        global $wpdb;
        update_post_meta($post_id, '_hmci_news_Link', sanitize_text_field($_POST['linkShow']));
    }
    if (isset($_POST['linkUrl'])) {
        global $wpdb;
        update_post_meta($post_id, '_hmci_news_Link_url', sanitize_text_field($_POST['linkUrl']));
    }
    return;
}




add_action('init', 'hmpt_register_taxonomy40');
function hmpt_register_taxonomy40()
{

    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'نوع اخبار',
            'singular_name'              => 'نوع اخبار',
            'search_items'               => __('Search Writers'),
            'popular_items'              => __('Popular Writers'),
            'all_items'                  => __('All Writers'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش نوع اخبار',
            'update_item'                => __('Update Writer'),
            'add_new_item'               => 'افزودن نوع اخبار جدید',
            'new_item_name'              => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items'        => __('Add or remove writers'),
            'choose_from_most_used'      => 'از نوع اخبار هایی که بیشتر استفاده شده',
            'not_found'                  => __('No writers found.'),
            'menu_name'                  => 'نوع اخبار',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        'meta_box_cb'       => 'hmps_taxonomy_metabox_newss'
    );

    register_taxonomy('w', array('neeews'), $args);
}
function hmps_taxonomy_metabox_newss($post, $box){

    $taxonomy = $box['args']['taxonomy'];

    $tax = get_taxonomy($taxonomy);

    $selected = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));

    if (!isset($selected[0])) {
        $selected_term_id = 0;
        $q = 0;
    } else {
        $selected_term_id =  $selected;
        $q = count($selected);
    }
    $b = 0;

    ?>
    <div id="taxonomy-<?php echo $taxonomy; ?>">
        <?php if (current_user_can($tax->cap->edit_terms)) : ?>

            <?php foreach (get_terms($taxonomy, array('hide_empty' => 0)) as $term) :   $counter = 0; ?>

                <?php for ($i = 0; $i < $q; $i++) { ?>

                    <?php
                    if ($selected_term_id[$i] == $term->term_id) {
                        $b = $i;
                        $counter = 1;
                        ?>
                        <div>
                            <input type="checkbox" id="book_author_<?php echo esc_attr($term->slug); ?>" name="tax_input[<?php echo $taxonomy; ?>][]" value="<?php echo esc_attr($term->slug); ?>" <?php checked($term->term_id, $selected_term_id[$i]); ?> />
                            <label for="book_author_<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php if ($counter == 0) { ?>
                    <div>
                        <input type="checkbox" id="book_author_<?php echo esc_attr($term->slug); ?>" name="tax_input[<?php echo $taxonomy; ?>][]" value="<?php echo esc_attr($term->slug); ?>" ?>
                        <label for="book_author_<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                    </div>
                <?php    }
            endforeach; ?>

        <?php endif; ?>
    </div>
    <?php




}
include WF_sl_INC . 'setCssAndJsFileDir.php';
if(!is_admin()){


}
include WF_sl_INC . "sliderShortCode.php";
