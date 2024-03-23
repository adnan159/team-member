<?php

namespace Team\Member\Admin;

/**
 * Menu handler class for registering 'Team Member' post type and 'Member Type' taxonomy.
 */
class TeamMemberRegistration {
    /**
     * Constructor.
     * Adds hooks to register custom post type and taxonomy.
     */
    public function __construct() {
        add_action( 'init', [$this, 'custom_post_type_team_member'] );
        add_action( 'init', [$this, 'custom_taxonomy_member_type'] );
    }

    /**
     * Registers the custom post type 'Team Member'.
     * 
     * @return void.
     */
    public function custom_post_type_team_member() {
        $labels = array(
            'name'               => __( 'Team Members', 'textdomain' ),
            'singular_name'      => __( 'Team Member', 'textdomain' ),
            'menu_name'          => __( 'Team Members', 'textdomain' ),
            'add_new'            => __( 'Add New', 'textdomain' ),
            'add_new_item'       => __( 'Add New Team Member', 'textdomain' ),
            'edit_item'          => __( 'Edit Team Member', 'textdomain' ),
            'new_item'           => __( 'New Team Member', 'textdomain' ),
            'view_item'          => __( 'View Team Member', 'textdomain' ),
            'search_items'       => __( 'Search Team Members', 'textdomain' ),
            'not_found'          => __( 'No team members found', 'textdomain' ),
            'not_found_in_trash' => __( 'No team members found in Trash', 'textdomain' ),
            'parent_item_colon'  => __( 'Parent Team Member:', 'textdomain' ),
        );
    
        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'query_var'           => true,
            'rewrite'             => array( 'slug' => 'team-member' ),
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => false,
            'menu_position'       => null,
            'supports'            => array( 'title', 'editor', 'thumbnail' ),
        );
    
        register_post_type( 'team_member', $args );
    }
    
    /**
     * Registers the custom taxonomy 'Member Type' for the 'Team Member' post type.
     * 
     * @return void.
     */
    public function custom_taxonomy_member_type() {
        $labels = array(
            'name'              => __( 'Member Types', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => __( 'Member Type', 'taxonomy singular name', 'textdomain' ),
            'search_items'      => __( 'Search Member Types', 'textdomain' ),
            'all_items'         => __( 'All Member Types', 'textdomain' ),
            'parent_item'       => __( 'Parent Member Type', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Member Type:', 'textdomain' ),
            'edit_item'         => __( 'Edit Member Type', 'textdomain' ),
            'update_item'       => __( 'Update Member Type', 'textdomain' ),
            'add_new_item'      => __( 'Add New Member Type', 'textdomain' ),
            'new_item_name'     => __( 'New Member Type Name', 'textdomain' ),
            'menu_name'         => __( 'Member Types', 'textdomain' ),
        );
    
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'member-type' ),
        );
    
        register_taxonomy( 'member_type', array( 'team_member' ), $args );
    }
}
