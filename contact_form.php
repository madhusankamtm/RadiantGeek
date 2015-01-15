<?php

if (!isset($_POST['submit'])|| $_POST["submit"] != "contact") {
   echo "<h1>Error</h1>\n
      <p>Accessing this page directly is not allowed.</p>";
   exit;
}

/*
$email = preg_replace("([\r\n])", "", $email);

$find = "/(content-type|bcc:|cc:)/i";
if (preg_match($find, $name) || preg_match($find, $email) || preg_match($find, $url) || preg_match($find, $comments)) {
   echo "<h1>Error</h1>\n
      <p>No meta/header injections, please.</p>";
   exit;
}*/

// get the posted data
$name = $_POST["nameInput"];
$email_address = $_POST["emailInput"];
$message = $_POST["messageInput"];

// validate data input
// check that a name was entered
if (empty($name))
    $error = "You must enter your name.";
// check that an email address was entered
elseif (empty($email_address))
    $error = "You must enter your email address.";
// check for a valid email address
elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email_address))
    $error = "You must enter a valid email address.";
// check that a message was entered
elseif (empty($message))
    $error = "You must enter a message.";

//if there is an error, send the user back to the form
if (isset($error)) {
    header("Location: index.html?e=".urlencode($error)); exit;
}

// write the email content
$email_content = "Name: $name\n";
$email_content .= "Email Address: $email_address\n";
$email_content .= "Message:\n\n$message";
$headers = 'From: webmaster@yourdot.com' . "\r\n" .
   			'Reply-To: webmaster@yourdot.com' . "\r\n" .
   			'X-Mailer: PHP/' . phpversion();

// send the email
mail ("katereading@radiantgeek.com", "New Contact Message", $email_content, $headers);


// send the user back to the form
header("Location: index.html?s=".urlencode("Thank you for your message.")); exit;
?>