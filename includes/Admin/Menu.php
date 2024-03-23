<?php

namespace Team\Member\Admin;

/**
* Menu handler class
 */
class Menu {
    /**
     * Class constructor
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'register_admin_menu' ] );
        // add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function register_admin_menu() {
        $capability = 'manage_options';
        $parent_slug = 'team-member';

        $hook = add_menu_page(
            __( 'Team Member', 'team-member' ),
            __( 'Team Member', 'team-member' ),
            $capability,
            $parent_slug,
            [ $this, 'render_plugin_page' ],
            'dashicons-groups'
        );

        // add_action( 'admin-head' . $hook, [ $this, 'enqueue_assets' ] );
    }

    
    

    public function render_plugin_page() {
        $args = array(
            'post_type' => 'team_member', // Your custom post type slug
            'posts_per_page' => -1, // Retrieve all posts
        );
        
        $team_members = get_posts($args);

        print_r($team_members);
    }

}