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
         * Fetch MetaData
         */

        $primary_category = get_post_meta($post->ID, 'primary_category', true);

        /*
         * Fetch All Post Categories
         */

        $post_categories_ids = wp_get_post_categories($post->ID);
        $post_categories = array();

        foreach ($post_categories_ids as $category_id) {
            $category = get_category($category_id);
            $post_categories[] = $category->name;
        }

        array_unshift($post_categories, 'None');

        /*
         * If Primary Category Doens't Exist Mark None
         */

        if ('' === $primary_category) {
            $primary_category = 'None';
        }

        /*
         * Return Categories Picker
         */

        $picker_html = '<p>In order to assign a parent category to the post it must have previously been assigned to it in a prior save.</p>';
        $picker_html .= "<p>Current Parent Category <b>{$primary_category}</b>";

        $picker_html .= '<select style="width:100%;" name="primary_category">';

        foreach ($post_categories as $category) {
            $active_category = selected( $primary_category, $category, false );
            $picker_html .= "<option value='{$category}' {$active_category}>$category</option>";
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
            $primary_category = sanitize_text_field($_POST['primary_category']);
            update_post_meta($post->ID, 'primary_category', $primary_category);
        }
    }

}