<?php

/**
 * Enqueue header styles
 */
function rat_custom_wp_admin_style()
{

    if (isset($_GET['page']) && ($_GET['page'] == 'rat_toolbar')) {
        if (function_exists('wp_enqueue_style') && function_exists('plugins_url')) {
            wp_enqueue_style('rat_toolbar_wp_admin_css', plugins_url('../rat-toolbar-style.css', __FILE__));
        }
    }
    return;
}

/**
 * Enqueue footer scripts
 */

function rat_custom_wp_admin_scripts()
{

    if (isset($_GET['page']) && ($_GET['page'] == 'rat_toolbar')) {
        if (function_exists('wp_enqueue_script') && function_exists('plugins_url')) {
            wp_enqueue_script('rat_toolbar_wp_admin_js', plugins_url('../js/rat_scripts-toolbar.js', __FILE__), 1.0, true);
        }
    }
    return;
}

/**
 * Save settings message
 */

function rat_admin_notice_success()
{
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e('Please, do not forget to feedback me. Thank you!', 'rat-text-domain'); ?></p>
    </div>
    <?php
}
