<?php 

    require_once '../database/config.php';
    require_once '../helpers/functions.php';

    $phone_number  = $_POST['phone_number'];

    //generate a random 6 digit pin 
    $randomSixDigitInt = random_int(100000, 999999);
    // $pin = $randomSixDigitInt;

    $pin = '123456';

    $message = "{$pin} is your verification code.";
    
    $smsarray = array();
    
    //sendSms($phone_number, $message);
    
    array_push($smsarray,array(
	"status" => "200", //success
	"pin" => "{$pin}",
    ));
    
    echo json_encode(array("Server response" => $smsarray));
?>
