<?php
require_once('./application/third_party/ultramsg.class.php');
class Whatsapp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function send()
    {
        $ultramsg_token = "l7bk78ecyktcnvv7";
        $instance_id = "instance5511";
        $client = new UltraMsg\WhatsAppApi($ultramsg_token, $instance_id);

        $to = "+62818715568";
        $body = "Test ";
        $api = $client->sendChatMessage($to, $body);
        print_r($api);
    }
}
