<?php
namespace StatusTest\V1\Rpc\Ping;

use Laminas\ApiTools\ContentNegotiation\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;

class PingController extends AbstractActionController
{
    public function pingAction()
    {
        //ok sur postman a l'adresse http://localhost:8080/ping en get 
        return new ViewModel([
            'ack' => time()
        ]);
    }
}
