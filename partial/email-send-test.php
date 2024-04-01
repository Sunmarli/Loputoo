<?php
$to = 'mjum473@gmail.com';
$subject = 'Test Email';
$message = 'This is a test email.';
$headers = 'From: fortestingp93@gmail.com';

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} else {
    echo 'Failed to send email.';
    // Log any errors
    error_log('Failed to send email to ' . $to, 0);
}
?>