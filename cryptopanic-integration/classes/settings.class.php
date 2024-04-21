<?php
// Add a menu item to the admin menu
function custom_settings_menu() {
    add_menu_page(
        'Cryptopanic',
        'Cryptopanic',
        'manage_options',
        'custom-settings',
        'custom_settings_page',
        'dashicons-admin-generic', // You can change the icon if needed
        30
    );
}
add_action('admin_menu', 'custom_settings_menu');

// Create the settings page
function custom_settings_page() {
    ?>
    <div class="wrap">
        <h1>Cryptopanic</h1>
        <form method="post" action="options.php">
            <?php settings_fields('custom-settings-group'); ?>
            <?php do_settings_sections('custom-settings'); ?>
            <?php submit_button(); ?>
        </form>

    </div>
    <?php
}

// Register and initialize settings
function custom_settings_init() {

    register_setting(
        'custom-settings-group',
        'cryptopanic_api_key'
    );

    add_settings_section(
        'custom-settings-section',
        '',
        'custom_settings_section_callback',
        'custom-settings'
    );

    add_settings_field(
        'cryptopanic_api_key',
        'API Key',
        'cryptopanic_api_key_callback',
        'custom-settings',
        'custom-settings-section'
    );

}
add_action('admin_init', 'custom_settings_init');

// Callback functions for the fields
function custom_settings_section_callback() {
    echo '';
}


function cryptopanic_api_key_callback() {
    $api_key = esc_attr(get_option('cryptopanic_api_key'));
    echo '<input type="text" name="cryptopanic_api_key" value="' . $api_key . '" style="width: 500px;" />';
}
