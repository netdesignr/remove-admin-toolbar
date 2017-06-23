<?php
/**
 * Admin settings page
 * @user: netdesignr
 */


/**
 * ----------------------------------------------------------------------
 * Plugin settings page & custom meta box
 * ----------------------------------------------------------------------
 */


function rat_toolbar_settings()
{
    if (function_exists('add_settings_section') && function_exists('add_settings_field') && function_exists('register_setting')) {

        add_settings_section("section", null, null, "rat_toolbar");
        add_settings_field("rat-toolbar-radio", "Make your selection", "rat_toolbar_radio_group", "rat_toolbar", "section");
        register_setting("section", "rat-toolbar-radio");
    }
}

function rat_toolbar_radio_group()
{
    if (function_exists('get_option') && function_exists('checked')) : ?>

        <fieldset>
            <label for="1">Hide from all</label>
            <input type="radio" id="1" name="rat-toolbar-radio"
                   value="1" <?php checked(1, get_option('rat-toolbar-radio'), true); ?>>
        </fieldset>
        <fieldset>
            <label for="2">Hide from all except Administrators</label>
            <input type="radio" id="2" name="rat-toolbar-radio"
                   value="2" <?php checked(2, get_option('rat-toolbar-radio'), true); ?>>
        </fieldset>
        <fieldset>
            <label for="3">Hide from Administrators except other users</label>
            <input type="radio" id="3" name="rat-toolbar-radio"
                   value="3" <?php checked(3, get_option('rat-toolbar-radio'), true); ?>>
        </fieldset>

    <?php endif;
}

function rat_hide_and_seek()
{

    if (function_exists('current_user_can') && function_exists('is_admin') && function_exists('get_option') && function_exists('add_filter')) {

        if (get_option('rat-toolbar-radio') == 1) {
            add_filter('show_admin_bar', '__return_false');
        }

        if (get_option('rat-toolbar-radio') == 2 && !current_user_can('administrator') && !is_admin()) {
            add_filter('show_admin_bar', '__return_false');
        }
        if (get_option('rat-toolbar-radio') == 3 && current_user_can('administrator')) {
            add_filter('show_admin_bar', '__return_false');
        }
    }
}


function rat_toolbar_page()
{
    if (function_exists('plugin_dir_url') && function_exists('settings_fields') && function_exists('do_settings_sections') && function_exists('submit_button') && function_exists('submit_button')) : ?>

        <div id="welcome-panel" class="welcome-panel">
            <div class="wallpaper">

                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'img/RemoveAdminToolbar.jpg' ?>"
                     alt="Remove Admin Toolbar plugin"/>
            </div>
            <div class="welcome-panel-content">
                <div class="rat-toolbar">
                    <h1>Remove Admin Toolbar</h1>
                    <a href="http://netdesignr.com" target="_blank"><img
                                src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'img/netdesignr-blog-dark.png'; ?>"
                                alt="Crafted by NetDesignr"/></a>
                    <form method="post" action="options.php">
                        <?php
                        settings_fields("section");

                        do_settings_sections("rat_toolbar");

                        submit_button();
                        submit_button('Reset Settings', 'secondary');
                        ?>
                    </form>
                </div>
            </div>
        </div>
    <?php endif;
}

function rat_menu_item()
{
    if (function_exists('add_submenu_page')) {
        add_submenu_page("options-general.php", "RA Toolbar", "RA Toolbar", "manage_options", "rat_toolbar", "rat_toolbar_page");
    }
}


function rat_load_if_admin()
{
    if (function_exists('add_action') && function_exists('is_admin')) {
        if (is_admin()) {

            add_action("admin_menu", "rat_menu_item");
            add_action("admin_init", "rat_toolbar_settings");
        }
    }
}

rat_load_if_admin();