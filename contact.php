<?php
// contact.php (backend script to handle the form submission using PHP mail())

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user input
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Recipient email (change it to your email)
    $to = "w.nh@hotmail.com";
    
    // Subject of the email
    $subject = "Contact Form Submission: $name";
    
    // Email body
    $body = "You have received a new message from $name ($email):\n\n$message";
    
    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
    
    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo 'success';
    } else {
        echo 'error';
    }
    exit;
}
?>
