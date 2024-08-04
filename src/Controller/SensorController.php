<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;


use App\Entity\Sensors;
use Doctrine\ORM\EntityManager;

#[Route('/sensor', name: 'sensor')]
class SensorController extends AbstractController
{
    #[Route('/register', name: 'sensor_register')]
    public function SensorRegister(Request $request): JsonResponse
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        $sensor = new Sensors();

        $sensor->setName($data['name']);
    
        return $this->json("Sensor has been registered correctly", Response::HTTP_CREATED);
        
    }
}
