<?php

namespace App\Classes;

use App\Mail\NotifyService;

class Util {


    public static function sendServiceNotification($type,$pathFile){
        $params = [
            "tipo_servico" => $type,
        ];

        $destinations = [env("DESTINATION_EMAIL","emersonm32@gmail.com")];
        $email = new NotifyService("Solicitação de serviço",$destinations,'emails.solicitacao_servicos',$params,$pathFile);
        $email->sendMail();
    }

}