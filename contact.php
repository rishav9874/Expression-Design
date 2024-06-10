<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'eric.jonson99@gmail.com';  // SMTP username
        $mail->Password = 'drnlvpaalnfvrieq';  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('eric.jonson99@gmail.com', 'Rishav Jha');
        $mail->addAddress('rishav@rishfotechsolutions.com', 'Expression Design');  // Add a recipient

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "<p>You have received a new message from the contact form on your website.</p>
                          <p><strong>Name:</strong> $name</p>
                          <p><strong>Email:</strong> $email</p>
                          <p><strong>Message:</strong><br>$message</p>";
        $mail->AltBody = "You have received a new message from the contact form on your website.\n\n
                          Name: $name\n
                          Email: $email\n
                          Message:\n$message";

        $mail->send();
        echo "Thank you for contacting us. We will get back to you shortly.";
    } catch (Exception $e) {
        echo "There was an error sending your message. Please try again later. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
