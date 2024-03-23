<?php
/**
 * Plugin Name: Team member
 * Plugin URI:
 * Description: This plugin can register team member.
 * Version: 1.0.0
 * Author: Osman Haider
 * Author URI:
 * Requires at least: 4.0
 * Tested up to: 4.0
 * Text Domain: team-member
 * Domain Path: /languages/
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Check if the Composer autoload file exists, and if not, show an error message.
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('Please run `composer install` in the main plugin directory.');
}

require_once __DIR__ . '/vendor/autoload.php';

final class Team_Member {

    /**
     * Define plugin version
     * 
     * @var string
     */
    const version = '1.0.0';

    // Private constructor to enforce singleton pattern.
    private function __construct() {
        $this->define_constants();

        // Register activation hook.
        register_activation_hook(__FILE__, [$this, 'activate']);

        // Hook into the 'plugins_loaded' action to initialize the plugin.
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Singleton instance
     *
     * @return AsCode_Woo_Calculator
     */
    public static function init(){
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define constants for the plugin.
     *
     * @return void
     */
    function define_constants(){
        define('TEAM_MEMBER_VERSION', self::version);
        define('TEAM_MEMBER_FILE', __FILE__);
        define('TEAM_MEMBER_DIR_PATH', plugin_dir_path(TEAM_MEMBER_FILE));
        define('TEAM_MEMBER_URL', plugin_dir_url(TEAM_MEMBER_FILE));
        define('TEAM_MEMBER_ASSETS', TEAM_MEMBER_URL . 'assets');
    }

     /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    function activate() {
        // Set an option to store the installation time.
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        if (is_admin()) {
            new Team\Member\Admin();
        }

        new Team\Member\Frontend();
    }
}

/**
 * Initialize the main plugin.
 *
 * @return TEAM_MEMBER
 */
function team_member() {
    return Team_Member::init();
}

// Kick-off the plugin.
team_member();