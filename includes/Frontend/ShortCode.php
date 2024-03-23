<?php

namespace Team\Member\Frontend;

class ShortCode {
    
    public function __construct() {
        add_shortcode( 'team_members', [ $this, 'custom_taxonomy_shortcode' ] );
    }

    // Register shortcode for displaying taxonomy terms
    function custom_taxonomy_shortcode($atts) {
        $template = __DIR__ . '/templates/team-members-view.php';

        // Check if the PHP file exists
        if ( ! file_exists( $template ) ) {
            return ''; // Return empty if the file doesn't exist
        }

        // Get the contents of the PHP file
        ob_start(); // Start output buffering
        include $template; // Include the PHP file
        $template = ob_get_clean(); 

        return $template;
    }
}
