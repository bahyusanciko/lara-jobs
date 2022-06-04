<?php
namespace App\Repositories;

use App\Repositories\MailRepository as MailInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailRepository 
{
    public static function sendMail($data)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = env('MAIL_HOST');                    // Set the SMTP server to send through
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->SMTPAuth   = true;    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
            $mail->Username   = env('MAIL_USERNAME');                          // SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                                // SMTP password
            $mail->Port       = env('MAIL_PORT');                                     // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), 'MAXI-OPS NOREPLY');

            $mail->AddAddress($data['email']);
            $mail->addReplyTo($data['email']);
            
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $data['subject'];
            $mail->Body    = view($data['view'],$data);
            $mail->send();
            return 'Check your mail '.$data['email'].' '.date('Y-m-d H:i:s');
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}".$data['email'];
        }
    }

}
