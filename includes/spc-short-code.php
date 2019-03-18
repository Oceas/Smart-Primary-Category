<?php

class SPC_Primary_Category_Shortcode
{
    public function __construct()
    {
        add_shortcode('spc-posts-by-category', array($this, 'spc_posts_by_category'));

    }

    function spc_posts_by_category($attributes)
    {
        /*
         * Get Desired Primary Category from Shortcode Attribute
         */
        $primary_category = shortcode_atts(array(
            'category' => 'Uncategorized'
        ), $attributes);

        /*
         * Get All Posts with That Primary Category
         */

        $args = array(
            'meta_key' => 'primary_category',
            'meta_value' => $primary_category["category"],
            'post_type' => 'post',
            'post_status' => 'published',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'asc',
        );

        $desired_category_posts = new WP_Query($args);

        /*
         * Return Display of All Categories In List
         */
        include dirname( __FILE__ ) . '/templates/spc-post-list.php';
    }

}