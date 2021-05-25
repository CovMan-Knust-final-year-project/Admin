<?php
    include('sms.php');

    function sendSms($phone_number, $message){
        $send = new SendSms();
        $send->key = 'txTZ1jJdWREgUqJSrdCIVu2IO';
        $send->message = strip_tags(str_replace(array("\r", "\n"), ' ', str_replace(array("&"), ' n ', $message)));
        // $send->message = $message;

        $send->numbers = $phone_number;

        $sender_id    = 'CovMan';
        $send->sender = $sender_id;
        $send->sendMessage();
}

?>