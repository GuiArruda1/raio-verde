<?php
/**
 * Contact Form & Mailer Diagnostic Test Utility
 * 
 * Access this script in your browser to test if WordPress is sending emails:
 * e.g., http://yourdomain.com/wp-content/themes/raio-verde-theme/test-contact-form.php
 */

// Define header for visual clarity in browser
header('Content-Type: text/plain; charset=utf-8');

echo "=========================================================\n";
echo "       RAIO VERDE - MAILER DIAGNOSTIC & TEST UTILITY     \n";
echo "=========================================================\n\n";

// 1. Locate and load wp-load.php dynamically
echo "[1] Loading WordPress core...\n";
$wp_load_path = '';

// Check standard relative paths first
$relative_paths = array(
    '../../../wp-load.php',
    '../../../../wp-load.php',
    '../../../../../wp-load.php',
);

foreach ($relative_paths as $rel_path) {
    if (file_exists($rel_path)) {
        $wp_load_path = $rel_path;
        break;
    }
}

// Fallback: search parent directories recursively
if (empty($wp_load_path)) {
    $dir = dirname(__FILE__);
    while ($dir && $dir !== '/' && $dir !== '\\') {
        if (file_exists($dir . '/wp-load.php')) {
            $wp_load_path = $dir . '/wp-load.php';
            break;
        }
        $parent = dirname($dir);
        if ($parent === $dir) {
            break;
        }
        $dir = $parent;
    }
}

if (!empty($wp_load_path)) {
    echo "Found wp-load.php at: " . realpath($wp_load_path) . "\n";
    require_once($wp_load_path);
    echo "WordPress loaded successfully!\n\n";
} else {
    die("ERROR: Could not locate wp-load.php automatically.\nPlease make sure this script is running inside a standard WordPress theme structure.\n");
}

// 2. Perform diagnostics checks
echo "[2] Running environment diagnostics...\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Server Software: " . (isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'Unknown') . "\n";
echo "WordPress Version: " . $wp_version . "\n";

$admin_email = get_option('admin_email');
echo "WordPress Admin Email (Default Recipient): " . $admin_email . "\n";

// Check if PHP's native mail function is enabled
if (function_exists('mail')) {
    echo "PHP mail() function: AVAILABLE\n";
} else {
    echo "PHP mail() function: NOT AVAILABLE (Disabled in php.ini)\n";
}

// 3. Bind to wp_mail_failed filter to intercept delivery errors
$mail_error = null;
add_action('wp_mail_failed', function($error) use (&$mail_error) {
    $mail_error = $error;
});

// 4. Send the test email
echo "\n[3] Triggering wp_mail() test...\n";
$test_recipient = isset($_GET['email']) ? sanitize_email($_GET['email']) : 'guilherme.ca@outlook.com';

if (empty($test_recipient) || !is_email($test_recipient)) {
    echo "WARNING: Invalid target recipient email. Defaulting to: guilherme.ca@outlook.com\n";
    $test_recipient = 'guilherme.ca@outlook.com';
}

echo "Sending to: " . $test_recipient . "\n";
$subject = "Raio Verde - Mailer Diagnostic Test System";
$body    = "This is a test email sent from the Raio Verde Contact Form Diagnostic Utility.\n\n";
$body   .= "If you received this message, the WordPress wp_mail() function is working correctly on your hosting server.\n\n";
$body   .= "Timestamp: " . date('Y-m-d H:i:s') . "\n";
$headers = array(
    'Content-Type: text/plain; charset=UTF-8',
    'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>',
    'Reply-To: Test Sender <test@example.com>'
);

$sent = wp_mail($test_recipient, $subject, $body, $headers);

// 5. Output results
echo "\n[4] Test Results:\n";
if ($sent) {
    echo "=========================================================\n";
    echo "SUCCESS: Email accepted for delivery by the server!\n";
    echo "Please check the inbox (and spam folder) of: " . $test_recipient . "\n";
    echo "=========================================================\n";
} else {
    echo "=========================================================\n";
    echo "FAILURE: wp_mail() returned false (email was rejected).\n";
    echo "=========================================================\n\n";
    
    if ($mail_error && is_wp_error($mail_error)) {
        echo "WordPress Mailer Error Details:\n";
        echo "Code: " . $mail_error->get_error_code() . "\n";
        echo "Message: " . $mail_error->get_error_message() . "\n";
        $data = $mail_error->get_error_data();
        if ($data) {
            echo "Data: " . print_r($data, true) . "\n";
        }
    } else {
        echo "No detailed WP_Error was thrown. This usually means the PHP mail() function failed or returned false directly.\n";
    }
    
    echo "\nRECOMMENDATION:\n";
    echo "- Install and configure a standard SMTP plugin (e.g. WP Mail SMTP, Easy WP SMTP) with your mail provider credentials.\n";
    echo "- Check if PHP's native mail() is disabled on your hosting provider server settings.\n";
}
