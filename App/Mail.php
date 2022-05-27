<?php

namespace App;

use App\Config;
//use Mailgun\Mailgun;
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';


/**
 * Mail
 *
 * PHP version 7.0
 */
class Mail
{

    /**
     * Send a message
     *
     * @param string $to Recipient
     * @param string $subject Subject
     * @param string $text Text-only content of the message
     * @param string $html HTML content of the message
     *
     * @return mixed
     
    public static function send($to, $subject, $text, $html)
    {
        //$mg = new Mailgun(Config::MAILGUN_API_KEY);
		
		$client = new \GuzzleHttp\Client([
            'verify' => false,
        ]);
$adapter = new \Http\Adapter\Guzzle6\Client($client);
$mg = new Mailgun(Config::MAILGUN_API_KEY, $adapter);
		
        $domain = Config::MAILGUN_DOMAIN;

        $mg->sendMessage($domain, ['from'    => 'karol.jeczmionka@o2.pl',
                                   'to'      => $to,
                                   'subject' => $subject,
                                   'text'    => $text,
                                   'html'    => $html]);
    }
	*/
	
	
	public static function send($to, $subject, $text, $html)
	{
	/*
			$phpmailer = new PHPMailer();
			$phpmailer->isSMTP();
			$phpmailer->Host = 'smtp.mailtrap.io';
			$phpmailer->SMTPAuth = true;
			$phpmailer->Port = 2525;
			$phpmailer->Username = '5e10b5c9e1478e';
			$phpmailer->Password = '5718848a174325';
	*/
	
	//require_once('vendor/phpmailer/phpmailer/PHPMailerAutoload.php'); # patch where is PHPMailer / ścieżka do PHPMailera
//require_once('phpmailer/PHPMailerAutoload.php');



						$mail = new PHPMailer;
						//$mail->CharSet = "UTF-8";
						
						$mail->SMTPOptions = [
									'ssl' => [
										'verify_peer' => false,
										'verify_peer_name' => false,
										'allow_self_signed' => true,
									]
								];

						$mail->IsSMTP();
						$mail->SMTPAutoTLS = false;
						//$mail->Host = 'smtp.mailtrap.io';
						$mail->Host = 'budget.karol-jeczmionka.pl'; # Gmail SMTP host
						$mail->Port = 587; # Gmail SMTP port
						//$mail->Port = 2525; 
						$mail->SMTPAuth = true; # Enable SMTP authentication / Autoryzacja SMTP
						//$mail->SMTPDebug = 4;
						
						$mail->SMTPSecure = 'tls';
						$mail->Username = "budget@karol-jeczmionka.pl"; # Gmail username (e-mail) / Nazwa użytkownika
						$mail->Password = "..."; # Gmail password / Hasło użytkownika
						
						
						$mail->From = 'budget@karol-jeczmionka.pl'; # REM: Gmail put Your e-mail here
						//$mail->setFrom ('info@mailtrap.io', 'Mailtrap'); # REM: Gmail put Your e-mail here
						$mail->FromName = 'karol'; # Sender name
						$mail->AddAddress($to, 'Karol Jeczmionka'); # # Recipient (e-mail address + name) / Odbiorca (adres e-mail i nazwa)

						$mail->IsHTML(true); # Email @ HTML

						$mail->Subject =$subject ;
						$mail->Body = $html;
						$mail->AltBody = $text;

						if(!$mail->Send()) {
						echo 'Some error... ';
						//echo 'Mailer Error: ' . $mail->ErrorInfo;
						exit;
						}

						echo 'Message has been sent (OK) / Wiadomość wysłana (OK)';		
	}		
}
