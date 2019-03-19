<?php


/*
 * Add primary category meta box to all post and custom post types.
 */

class SPC_Primary_Category_Meta_Data
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'spc_add_meta_box_to_posts'));
        add_action('save_post', array($this, 'spc_update_post_meta_data'));
    }

    public function spc_add_meta_box_to_posts()
    {
        /*
         * Fetch All Post Types
         */
        $post_types = get_post_types();

        /*
         * Assign MetaBox
         */
        foreach ($post_types as $post_type) {

            /*
             * Do Not Assign to Pages
             */
            if ('page' === $post_type) {
                continue;
            }
            add_meta_box(
                'smart_primary_category',
                'Primary Category',
                array($this, 'spc_meta_box_dropdown'),
                $post_type,
                'side',
                'high'
            );
        }
    }

    public function spc_meta_box_dropdown()
    {
        global $post;

        /*
         * Fetch MetaData that is stored as category id in case category name changes
         */

        $primary_category_id = get_post_meta($post->ID, 'primary_category', true);

        /*
         * If Primary Category Doens't Exist Mark None
         */

        if ('' === $primary_category_id) {
            $primary_category_id = -1;
        }

        /*
         * Fetch All Categories
         */

        $args = array(
            "hide_empty" => 0,
            "type" => "post",
            "orderby" => "name",
            "order" => "ASC"
        );

        $all_categories = get_categories($args);

        /*
         * Return Categories Picker
         */

        $picker_html = "<p>Current Primary Category ID <b>{$primary_category_id}</b>";
        $picker_html .= '<select style="width:100%;" name="primary_category">';
        $picker_html .= "<option value='-1'>None</option>";
        foreach ($all_categories as $category) {
            $active_category = selected($primary_category_id, $category->cat_ID, false);
            $picker_html .= "<option value='{$category->cat_ID}' {$active_category}>$category->name (ID: {$category->cat_ID})</option>";
        }

        $picker_html .= '</select>';
        echo $picker_html;
    }

    public function spc_update_post_meta_data()
    {
        global $post;

        /*
         * Check If Primary Category Was Set In Meta Box
         */
        if (isset($_POST['primary_category'])) {

            $primary_category = (int) sanitize_text_field($_POST['primary_category']);

            /*
             * Add Primary Category to post in case it didn't exist.
             */
            if (-1 !== $primary_category) {
                wp_set_post_categories( $post->ID, [$primary_category], true );
            }

            update_post_meta($post->ID, 'primary_category', $primary_category);
        }
    }

}