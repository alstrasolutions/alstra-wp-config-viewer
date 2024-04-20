<?php
/*
 * Plugin Name: Alstra Config
 * Description: View PHP and WordPress configuration settings.
 * Version: 1.0
 * Author: Alstra Solutions
 * Author URI: https://alstra.ca
 * Plugin URI: https://github.com/alstrasolutions/alstra-wp-config-viewer
 * License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class AlstraConfigViewer {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_plugin_pages'));
    }

    public function add_plugin_pages() {
        add_menu_page(
            'Alstra Config',
            'Alstra Config',
            'manage_options',
            'alstra-config-viewer',
            array($this, 'create_plugin_page'),
            'dashicons-admin-tools'
        );
    }

    public function create_plugin_page() {
        ?>
        <div class="wrap">
            <h2>Alstra Config Viewer</h2>
            <h3>PHP Configuration</h3>
            <table class="alstra-system-status">
                <tbody>
                    <tr>
                        <td>Install Location:</td>
                        <td><code class="status-good"><?php echo ABSPATH; ?></code></td>
                    </tr>
                    <tr>
                        <td>PHP Version:</td>
                        <td><code class="status-good"><?php echo phpversion(); ?></code></td>
                    </tr>
                    <tr>
                        <td>Max Execution Time:</td>
                        <td><code class="status-good"><?php echo ini_get('max_execution_time'); ?></code></td>
                    </tr>
                    <tr>
                        <td>Memory Limit:</td>
                        <td><code class="status-good"><?php echo ini_get('memory_limit'); ?></code></td>
                    </tr>
                    <tr>
                        <td>Post Max Size:</td>
                        <td><code class="status-good"><?php echo ini_get('post_max_size'); ?></code></td>
                    </tr>
                    <tr>
                        <td>Upload Max Filesize:</td>
                        <td><code class="status-good"><?php echo ini_get('upload_max_filesize'); ?></code></td>
                    </tr>
                    <tr>
                        <td>Max Input Time:</td>
                        <td><code class="status-good"><?php echo ini_get('max_input_time'); ?></code></td>
                    </tr>
                    <tr>
                        <td>Max Input Vars:</td>
                        <td><code class="status-good"><?php echo ini_get('max_input_vars'); ?></code></td>
                    </tr>
                </tbody>
            </table>

            <h3>WordPress Optimization</h3>
            <table class="alstra-system-status">
                <tbody>
                    <?php $this->display_wp_config(); ?>
                </tbody>
            </table>

            <h3>Recommended Settings</h3>
            <textarea rows="10" cols="70">
/* Auto update WP core */
define('WP_AUTO_UPDATE_CORE', true);

/* WP behavior optimization */
define('WP_POST_REVISIONS', 3);
define('AUTOSAVE_INTERVAL', 160);
define('IMAGE_EDIT_OVERWRITE', true);
define('FORCE_SSL_ADMIN', true);

/* Memory optimization */
define('WP_MEMORY_LIMIT', '1024M');
define('WP_MAX_MEMORY_LIMIT', '1024M');

/* Repair and optimize the WordPress database */
define('WP_ALLOW_REPAIR', true);

/* WP-Cron performance, remember to schedule a daily cron job */
define('DISABLE_WP_CRON', true); 
define('WP_CRON_LOCK_TIMEOUT', 120);

/* Compression */
define('COMPRESS_CSS', true);
define('COMPRESS_SCRIPTS', true);
define('CONCATENATE_SCRIPTS', true);
define('ENFORCE_GZIP', true);

/* Disallow file edit */
define('DISALLOW_FILE_EDIT', true);
            </textarea>
        </div>
        <?php
    }

    private function display_wp_config() {
        $wp_configs = array(
            'WP_AUTO_UPDATE_CORE' => defined('WP_AUTO_UPDATE_CORE') ? WP_AUTO_UPDATE_CORE : 'Not set',
            'WP_POST_REVISIONS' => defined('WP_POST_REVISIONS') ? WP_POST_REVISIONS : 'Not set',
            'AUTOSAVE_INTERVAL' => defined('AUTOSAVE_INTERVAL') ? AUTOSAVE_INTERVAL : 'Not set',
            'IMAGE_EDIT_OVERWRITE' => defined('IMAGE_EDIT_OVERWRITE') ? IMAGE_EDIT_OVERWRITE : 'Not set',
            'FORCE_SSL_ADMIN' => defined('FORCE_SSL_ADMIN') ? FORCE_SSL_ADMIN : 'Not set',
            'WP_MEMORY_LIMIT' => defined('WP_MEMORY_LIMIT') ? WP_MEMORY_LIMIT : 'Not set',
            'WP_MAX_MEMORY_LIMIT' => defined('WP_MAX_MEMORY_LIMIT') ? WP_MAX_MEMORY_LIMIT : 'Not set',
            'WP_ALLOW_REPAIR' => defined('WP_ALLOW_REPAIR') ? WP_ALLOW_REPAIR : 'Not set',
            'DISABLE_WP_CRON' => defined('DISABLE_WP_CRON') ? DISABLE_WP_CRON : 'Not set',
            'WP_CRON_LOCK_TIMEOUT' => defined('WP_CRON_LOCK_TIMEOUT') ? WP_CRON_LOCK_TIMEOUT : 'Not set',
            'COMPRESS_CSS' => defined('COMPRESS_CSS') ? COMPRESS_CSS : 'Not set',
            'COMPRESS_SCRIPTS' => defined('COMPRESS_SCRIPTS') ? COMPRESS_SCRIPTS : 'Not set',
            'CONCATENATE_SCRIPTS' => defined('CONCATENATE_SCRIPTS') ? CONCATENATE_SCRIPTS : 'Not set',
            'ENFORCE_GZIP' => defined('ENFORCE_GZIP') ? ENFORCE_GZIP : 'Not set',
            'DISALLOW_FILE_EDIT' => defined('DISALLOW_FILE_EDIT') ? DISALLOW_FILE_EDIT : 'Not set'
        );

        foreach ($wp_configs as $key => $value) {
            echo "<tr><td>{$key}:</td><td><code class='status-good'>{$value}</code></td></tr>";
        }
    }
}

new AlstraConfigViewer();
