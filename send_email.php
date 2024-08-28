<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // SMTP username
        $mail->Password = 'your_email_password'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('ganeshgummalla255@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(false);
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->Body    = "You have received a new message from the user $name.\n\n".
                         "Here are the details:\n".
                         "Name: $name\n".
                         "Email: $email\n".
                         "Phone: $phone\n".
                         "Subject: $subject\n".
                         "Message:\n$message";

        $mail->send();
        echo 'Message sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
