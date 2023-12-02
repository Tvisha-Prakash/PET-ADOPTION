<?php
session_start();

// Generate a random string for the CAPTCHA
$captchaText = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// Save the CAPTCHA text in a session variable for validation
$_SESSION['captcha'] = $captchaText;

// Create an image with the CAPTCHA text
$image = imagecreate(200, 50); // Width and height
$bgColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 50, 20, $captchaText, $textColor);

// Set the content type to image
header('Content-type: image/png');

// Output the image as PNG
imagepng($image);

// Free up memory
imagedestroy($image);
?>
