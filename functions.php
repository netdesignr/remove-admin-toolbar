<?php
/**
 * @user: netdesignr
 * Wordpress Hooks
 */


if (function_exists('add_action')) {

    /**
     * Dashboard hooks
     */
    add_action('admin_enqueue_scripts', 'rat_custom_wp_admin_style');
    add_action('admin_enqueue_scripts', 'rat_custom_wp_admin_scripts');
    //add_action('admin_notices', 'rat_admin_notice_success');

    /**
     * Front-end hooks
     */
    add_action('wp', 'rat_hide_and_seek');
}
