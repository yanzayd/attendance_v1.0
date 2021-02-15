<?php
require '../core/phpmailer/src/PHPMailer.php';
require '../core/phpmailer/src/SMTP.php';
require '../core/phpmailer/src/Exception.php';
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;
/**
 *
 */

class mailerController
{


  function sendmail($subject, $email , $message)
  {

    $mail = new PHPMailer(TRUE);

    try {

       $mail->setFrom('acountfortraining@gmail.com', 'Nelson bedel Messages');
       $mail->addAddress($email, '');
       $mail->Subject =  $subject;

       $mail->msgHTML($message);
       /* SMTP parameters. */
       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPAuth = TRUE;
       $mail->SMTPSecure = 'tls';
       $mail->Username = 'acountfortraining@gmail.com';
       $mail->Password = 'acountfortraining123';
       $mail->Port = 587;

       /* Disable some SSL checks. */
       $mail->SMTPOptions = array(
          'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
          )
       );

       /* Finally send the mail. */
       $mail->send();
    }
    catch (Exception $e)
    {
       echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
       echo $e->getMessage();
    }

  }
}
