<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Nelmio\ApiDocBundle\Annotation as Nelmio;
use OpenApi\Attributes as OA;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SensorsRepository;



use App\Entity\Sensors;
use Doctrine\ORM\EntityManager;

#[Route('/sensors', name: 'sensor')]
#[Nelmio\Areas(['wines_project'])]
#[OA\Tag('Sensors')]
class SensorController extends AbstractController
{
    #[Route('/register', name: 'sensor_register', methods: ['POST'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref:'#/components/schemas/SensorRegister'))]
    public function SensorRegister(Request $request, EntityManagerInterface $em): Response
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        $sensor = new Sensors();

        $sensor->setName($data['name']);

        $em-> persist($sensor);
        $em->flush();
    
        return $this->json("Sensor has been registered correctly", Response::HTTP_CREATED);
        
    }

    #[Route('/get', name: 'sensors_get',methods: ['GET'])]
    public function SensorInfo(SensorsRepository $sensorsrep):Response
    {
        $sensors = $sensorsrep->findAllOrderedByName();
        
        $sensorsInfo = [];
    foreach ($sensors as $sensor) {
        $sensorsInfo[] = [
            'ID' => $sensor->getId(),
            'Name' => $sensor->getName()
        ];
    }
        return $this->json(['All Sensors Ordered by Name'=>$sensorsInfo]);
    }
}
