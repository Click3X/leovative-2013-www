<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_Mail
{
  protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
	}

	public function send($img_path)
	{
		// email fields: to, from, subject, and so on
		$to 		= EMAIL_TO;
		$from 		= EMAIL_FROM; 
		$subject 	= EMAIL_SUBJECT; 
		$message 	= EMAIL_MESSAGE;
		$headers 	= "From: $from";
		
		// boundary 
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		 
		// headers for attachment 
		$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
		 
		// multipart boundary 
		$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
		$message .= "--{$mime_boundary}\n";
		 
		// preparing attachments
	    $file = fopen($img_path,"rb");
	    $data = fread($file,filesize($img_path));
	    fclose($file);
	    $data = chunk_split(base64_encode($data));
	    $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$img_path\"\n" . 
	    "Content-Disposition: attachment;\n" . " filename=\"$img_path\"\n" . 
	    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
	    $message .= "--{$mime_boundary}\n";
		 
		// send		 
		$ok = @mail($to, $subject, $message, $headers); 
		if ($ok) { 
		    echo "<p>mail sent to $to!</p>"; 
		} else { 
		    echo "<p>mail could not be sent!</p>"; 
		}
	}
	
}