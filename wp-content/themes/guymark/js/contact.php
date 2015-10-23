<?php
define('WP_USE_THEMES', false);
require($_SERVER['DOCUMENT_ROOT']  . '/wp-load.php');


$form_name = base64_decode($_POST["form_name"]);
$form_organisation = base64_decode($_POST["form_organisation"]);
$form_telephone_get = trim(base64_decode($_POST["form_telephone"]));
$form_telephone = str_replace(' ', '', $form_telephone_get);
$form_address = base64_decode($_POST["form_address"]);
$form_email = base64_decode($_POST["form_email"]);
$form_enquiry = base64_decode($_POST["form_enquiry"]);
$form_offers = base64_decode($_POST["form_offers"]);



// Check if fields are filled in
if(strlen($form_name) == 0){exit("rPlease enter your full name.");}
if(strlen($form_telephone) == 0){exit("rPlease enter your telephone number.");}
if(strlen($form_email) == 0){exit("rPlease enter an email address.");}
if(!filter_var($form_email, FILTER_VALIDATE_EMAIL)){exit("rPlease enter a valid email address.");}
if(strlen($form_enquiry) == 0){exit("rPlease enter a message.");}


$message = "Name: \n";
$message .= $form_name . "\n\n";

$message .= "Organisation: \n";
$message .= $form_organisation . "\n\n";

$message .= "Telephone: \n";
$message .= $form_telephone . "\n\n";

$message .= "Address: \n";
$message .= $form_address . "\n\n";

$message .= "Email: \n";
$message .= $form_email . "\n\n";

$message .= "Enquiry: \n";
$message .= $form_enquiry . "\n\n";

$message .= "Offers: \n";
$message .= $form_offers . "\n\n";



$subject = 'Guymark Contact Form';
$headers = 'From: website@designbppreview.co.uk' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// $result = mail("phil@designbp.ltd.uk", $subject, $message, $headers);
// $result = mail("sales@guymark.com", $subject, $message, $headers);
$result = wp_mail("sales@guymark.com", $subject, $message);
if($result){
	echo "OK";
} else {
	echo "rSorry, your message could not be sent. Try again later.";
}

?>