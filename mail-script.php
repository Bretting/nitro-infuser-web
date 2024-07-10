<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $myAwardSpaceEmail = "subscribe@cocktail-tap.nl";
    $myAwardSpaceEmailPassword = "Janx10bla-!!";
    $myPersonalEmail = "info@cocktail-tap.nl";

    require './src/Exception.php';
    require './src/PHPMailer.php';
    require './src/SMTP.php';

    if(isset($_POST['submit'])) {

        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0;

        $mail->Host = 'mail.mijndomein.nl';
        $mail->SMTPAuth = true;
        $mail->Username = $myAwardSpaceEmail;
        $mail->Password = $myAwardSpaceEmailPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; ;
        $mail->Port = 587;

        $mail->setFrom($myAwardSpaceEmail, 'Subscriber');
        $mail->addAddress($myPersonalEmail);
        $mail->addReplyTo($_POST['email'], $_POST['name']);

        $mail->isHTML(true);    
        $mail->Subject = $_POST['email'];
        $mail->Body = $_POST['name'] . " has subscribed with: " . $_POST["email"];

        try {
            $mail->send();
            header("Location:index.html");
        } catch (Exception $e) {
            echo "Your message could not be sent! PHPMailer Error: {$mail->ErrorInfo}";
        }
        
    } else {
        echo "There is a problem with the contact.html document!";
    }
    
?>