<?php

//Global Fields for Social Theme Settings
function theme_add_settings_page() {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'theme-settings',
        'theme_settings_page_html',
        'dashicons-admin-generic',
        20
    );
}
add_action('admin_menu', 'theme_add_settings_page');

function theme_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['theme_settings_submit'])) {
        update_option('email_address', sanitize_email($_POST['email_address']));
        update_option('linkedin_url', esc_url_raw($_POST['linkedin_url']));
        update_option('github_url', esc_url_raw($_POST['github_url']));
        update_option('twitter_url', esc_url_raw($_POST['twitter_url']));
        update_option('facebook_url', esc_url_raw($_POST['facebook_url']));
    }

    $email_address = get_option('email_address');
    $linkedin_url = get_option('linkedin_url');
    $github_url = get_option('github_url');
    $twitter_url = get_option('twitter_url');
    $facebook_url = get_option('facebook_url');
    ?>

    <div class="wrap">
        <h1>Theme Settings</h1>
        <form method="POST">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="email_address">Email Address</label></th>
                    <td><input type="email" name="email_address" id="email_address" value="<?php echo esc_attr($email_address); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="linkedin_url">LinkedIn URL</label></th>
                    <td><input type="url" name="linkedin_url" id="linkedin_url" value="<?php echo esc_url($linkedin_url); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="github_url">GitHub URL</label></th>
                    <td><input type="url" name="github_url" id="github_url" value="<?php echo esc_url($github_url); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="twitter_url">Twitter URL</label></th>
                    <td><input type="url" name="twitter_url" id="twitter_url" value="<?php echo esc_url($twitter_url); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="facebook_url">Facebook URL</label></th>
                    <td><input type="url" name="facebook_url" id="facebook_url" value="<?php echo esc_url($facebook_url); ?>" class="regular-text"></td>
                </tr>
            </table>
            <p class="submit">
                <button type="submit" name="theme_settings_submit" class="button button-primary">Save Changes</button>
            </p>
        </form>
    </div>

    <?php
}