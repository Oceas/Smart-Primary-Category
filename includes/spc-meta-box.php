<?php


/*
 * Add primary category meta box to all post and custom post types.
 */

class SPC_Meta_Box
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'spc_add_meta_box_to_posts'));
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
        echo 'Hello World';
    }

}