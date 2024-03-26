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


        global $wpdb;

        $query = $wpdb->prepare("
            SELECT t.*
            FROM {$wpdb->terms} AS t
            INNER JOIN {$wpdb->term_taxonomy} AS tt ON t.term_id = tt.term_id
            INNER JOIN {$wpdb->term_relationships} AS tr ON tt.term_taxonomy_id = tr.term_taxonomy_id
            WHERE tr.object_id = %d
            AND tt.taxonomy = 'member_type'
        ", 184);

        // Execute the query
        $terms = $wpdb->get_results($query);
        error_log(print_r($terms, true));
    }

    /**
     * Registers the custom post type 'Team Member'.
     * 
     * @return void.
     */
    public function custom_post_type_team_member() {
        $labels = array(
            'name'               => __( 'Team Members', 'team-member' ),
            'singular_name'      => __( 'Team Member', 'team-member' ),
            'menu_name'          => __( 'Team Members', 'team-member' ),
            'add_new'            => __( 'Add New', 'team-member' ),
            'add_new_item'       => __( 'Add New Team Member', 'team-member' ),
            'edit_item'          => __( 'Edit Team Member', 'team-member' ),
            'new_item'           => __( 'New Team Member', 'team-member' ),
            'view_item'          => __( 'View Team Member', 'team-member' ),
            'search_items'       => __( 'Search Team Members', 'team-member' ),
            'not_found'          => __( 'No team members found', 'team-member' ),
            'not_found_in_trash' => __( 'No team members found in Trash', 'team-member' ),
            'parent_item_colon'  => __( 'Parent Team Member:', 'team-member' ),
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
            'name'              => __( 'Member Types', 'taxonomy general name', 'team-member' ),
            'singular_name'     => __( 'Member Type', 'taxonomy singular name', 'team-member' ),
            'search_items'      => __( 'Search Member Types', 'team-member' ),
            'all_items'         => __( 'All Member Types', 'team-member' ),
            'parent_item'       => __( 'Parent Member Type', 'team-member' ),
            'parent_item_colon' => __( 'Parent Member Type:', 'team-member' ),
            'edit_item'         => __( 'Edit Member Type', 'team-member' ),
            'update_item'       => __( 'Update Member Type', 'team-member' ),
            'add_new_item'      => __( 'Add New Member Type', 'team-member' ),
            'new_item_name'     => __( 'New Member Type Name', 'team-member' ),
            'menu_name'         => __( 'Member Types', 'team-member' ),
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
