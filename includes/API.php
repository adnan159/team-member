<?php

namespace Team\Member;

class API {

    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_api' ] );
    }

    public function register_api() {
        $order = new Api\TeamMemberApi();
        $order->register_routes();
    }
}