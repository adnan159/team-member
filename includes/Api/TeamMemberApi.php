<?php

namespace Team\Member\Api;

use Team\Member\App\Members;

class TeamMemberApi extends \WP_REST_Controller {
    public function __construct() {
        $this->namespace = 'team-member/v1';
        $this->rest_base = 'list';
    }


    /**
     * Register the routes for the objects of the controller.
     */
    public function register_routes(){
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'get_members' ),
                    'permission_callback' => array( $this, 'permissions_check' ),
                    'args'                => $this->get_collection_params()
                ),
                'schema' => array( $this, 'get_item_schema' ),
            )
        );
        
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'get_member' ),
                    'permission_callback' => array( $this, 'permissions_check' ),
                    'args'                => $this->get_collection_params()
                ),
                'schema' => array( $this, 'get_item_schema' ),
            )
        );
    }

    public function get_members( $request ) {
    }

    public function prepare_member_for_response($order, $request) {
        $data = [];
        $fields = $this->get_fields_for_response($request);
    
        if (in_array('member_id', $fields, true)) {
            $data['member_id'] = isset($order['member_id']) ? (int) $order['member_id'] : null;
        }
    
        if (in_array('member_name', $fields, true)) {
            $data['member_name'] = isset($order['member_name']) ? sanitize_text_field($order['member_name']) : null;
        }
    
        if (in_array('member_type', $fields, true)) {
            $data['member_type'] = isset($order['member_type']) ? sanitize_email($order['member_type']) : null;
        }
    
        if (in_array('member_bio', $fields, true)) {
            $data['member_bio'] = isset($order['member_bio']) ? sanitize_text_field($order['member_bio']) : null;
        }
    
        if (in_array('member_image_url', $fields, true)) {
            $data['member_image_url'] = isset($order['member_image_url']) ? sanitize_text_field($order['member_image_url']) : null;
        }
    
        $context = !empty($request['context']) ? $request['context'] : 'view';
        $data = $this->filter_response_by_context($data, $context);
    
        return $data;
    }

    public function permissions_check() {
        return true;
    }

    /**
     * Retrieves the item's schema, conforming to JSON Schema.
     *
     * @return array Item schema data.
     */
    public function get_item_schema() {
        return array(
            '$schema'    => 'http://json-schema.org/draft-04/schema#',
            'title'      => 'order',
            'type'       => 'object',
            'properties' => array(
                'member_id'       => array(
                    'description' => 'Unique identifier of member.',
                    'type'        => 'integer',
                    'context'     => array('view'),
                    'readonly'    => true,
                ),
                'member_name'  => array(
                    'description' => 'The name of the member.',
                    'type'        => 'string',
                    'context'     => array('view'),
                    'readonly'    => true,
                ),
                'member_type' => array(
                    'description' => 'The type of the member.',
                    'type'        => 'string',
                    'context'     => array('view'),
                    'readonly'    => true,
                ),
                'member_bio'    => array(
                    'description' => 'Member bio info',
                    'type'        => 'string',
                    'context'     => array('view'),
                    'readonly'    => true,
                ),
                'member_image_url'    => array(
                    'description' => 'Member image url',
                    'type'        => 'url',
                    'context'     => array('view'),
                    'readonly'    => true,
                )
            ),
        );
    }
}