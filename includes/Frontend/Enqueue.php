<?php

namespace Team\Member\Frontend;

/**
 * The frontend enqueue class
 */
class Enqueue {

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
    }

    public function enqueue_frontend_scripts() {
        // Enqueue the frontend CSS file.
        wp_enqueue_style('team-member-frontend', TEAM_MEMBER_ASSETS . '/frontend/css/member-view.css');
    }
}
