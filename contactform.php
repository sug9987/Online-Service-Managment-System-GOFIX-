<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer

$msg = "";

if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['email']) || empty($_POST['message'])) {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        $name = htmlspecialchars($_POST['name']);
        $subject = htmlspecialchars($_POST['subject']);
        $email = htmlspecialchars($_POST['email']);
        $message = nl2br(htmlspecialchars($_POST['message']));

        $mail = new PHPMailer(true);
        
        try {
            // SMTP Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sumitgupta2436@gmail.com';  // Your Gmail address
            $mail->Password   = 'grzr nqqt euoh ikjw';  // Your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Email Headers
            $mail->setFrom('yourgmail@gmail.com', 'Website Contact Form');
            $mail->addReplyTo($email, $name);
            $mail->addAddress('yourgmail@gmail.com'); // Receiving Email

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = "You have received an email from <b>$name</b> (<i>$email</i>):<br><br>$message";

            $mail->send();
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Sent Successfully </div>';
        } catch (Exception $e) {
            // Fallback to PHP mail() function if SMTP fails
            $mailTo = "yourgmail@gmail.com";
            $headers = "From: " . $email;
            $txt = "You have received an email from " . $name . "\n\n" . $message;
            if (mail($mailTo, $subject, $txt, $headers)) {
                $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Sent Successfully (Fallback) </div>';
            } else {
                $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Mail not sent. Error: ' . $mail->ErrorInfo . '</div>';
            }
        }
    }
}
?>

<!-- Start Contact Form -->
<div class="col-md-8">
    <form action="" method="post">
        <input type="text" class="form-control" name="name" placeholder="Name"><br>
        <input type="text" class="form-control" name="subject" placeholder="Subject"><br>
        <input type="email" class="form-control" name="email" placeholder="E-mail"><br>
        <textarea class="form-control" name="message" placeholder="How can we help you?" style="height:150px;"></textarea><br>
        <input class="btn btn-primary" type="submit" value="Send" name="submit"><br><br>
        <?php if (!empty($msg)) { echo $msg; } ?>
    </form>
</div> 
<!-- End Contact Form -->
