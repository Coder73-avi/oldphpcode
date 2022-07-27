<?php
include_once "nav.php";

$template_file = './mailTemplate/template_mail.php';

// create the swap variable array
$swap_var = array(
    "{SITE_NAME}"=>"SAMAL REAL ESTATE PVT.",
    "{RESET_LINK}"=>"https://www.samalgrouprealestate.com/index.php"
);

$to_email = "aavishek60@gmail.com";
$subject = "Simple Email Test via PHP";

$headers = "From: SAMAL REAL ESTATE PVT. <abi17magar@gmail.com> \r\n";
$headers .="MIME-Version: 1.0 \r\n";
$headers .="Content-Type: text/html; cherset-ISO-8859-1 \r\n";

if(file_exists($template_file))
        $message = file_get_contents($template_file);
    else    
        die("unabl to locate the template file.");
foreach(array_keys($swap_var) as $key){
    if(strlen($key) > 2 && trim($key) !=="")
        $message = str_replace($key, $swap_var[$key], $message);
}

echo $message;
die("invaild");

if (mail($to_email, $subject, $message, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}


?>