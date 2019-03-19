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

        if (isset($attributes['id'])) {
            $desired_category_posts = $this->get_posts_by_id($attributes['id']);
            return $this->display_posts($desired_category_posts);
        } else if (isset($attributes['name'])) {
            $desired_category_posts = $this->get_posts_by_category_name($attributes['name']);
            return $this->display_posts($desired_category_posts);
        } else {
            return "Please use a supported attribute";
        }

    }

    //[spc-posts-by-category id="1"]
    function get_posts_by_id($id)
    {
        $args = array(
            'meta_key' => 'primary_category',
            'meta_value' => $id,
            'post_type' => 'post',
            'post_status' => 'published',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'asc',
        );
        return new WP_Query($args);
    }

    //[spc-posts-by-category name="Worship"]
    function get_posts_by_category_name($category_name)
    {
        return $this->get_posts_by_id(get_cat_ID($category_name));
    }

    function display_posts($desired_category_posts){
        ob_start();
        include dirname( __FILE__ ) . '/templates/spc-post-list.php';
        return ob_get_clean();
    }

}