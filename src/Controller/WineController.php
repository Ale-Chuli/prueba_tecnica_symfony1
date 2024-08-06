<?php

namespace App\Controller;

use App\Entity\WineMeditions;
use App\Entity\Wines;
use App\Entity\Sensors;
use App\Repository\WineMeditionsRepository;
use App\Repository\WinesRepository;
use App\Repository\SensorsRepository;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

use Nelmio\ApiDocBundle\Annotation as Nelmio;
use OpenApi\Attributes as OA;

use Doctrine\ORM\EntityManagerInterface;



#[Route('/wine', name: 'wine')]
#[Nelmio\Areas(['wines_project'])]
#[OA\Tag('Wines')]
class WineController extends AbstractController
{
    #[Route('/get', name: 'wine_get', methods: ['GET'])]
    public function GetWinesInfo(WineMeditionsRepository $wineMeditionsrep): Response
    {
        $wineMeditions = $wineMeditionsrep->findAllWithWineName();

        $winesInfoByName = [];
        foreach ($wineMeditions as $wineMedition) {
        
            $medition = $wineMedition[0];
            $wine = $wineMedition['wineName'];
        
        $winesInfoByName[] = [
            'WineName' => $wine, 
            'Year' => $medition->getYear(), 
            'Color' => $medition->getColour(), 
            //'Temperature' => $medition->getTemperature(), 
            'Graduation' => $medition->getAlcoholPercentage(), 
            'Ph' => $medition->getPh() 
        ];
    }
        return $this->json(['wines' => $winesInfoByName]);
    }

    #[Route('/newmedition', name: 'new_medition', methods: ['POST'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref:'#/components/schemas/MeditionRegister'))]
    public function NewMedition(Request $request, SensorsRepository $sensorsrep,
    WinesRepository $winesrep, EntityManagerInterface $em): JsonResponse
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        if($sensorsrep->findBy(["id"=> $data["id_sensor"]]) && $winesrep->findBy(["id"=> $data["id_wine"]])){
            $medition = new WineMeditions();

            $medition->setYear($data["year"]);
            $medition->setIdsensor($data["id_sensor"]);
            $medition->setIdwine($data["id_wine"]);
            $medition->setColour($data["colour"]);
            $medition->setAlcoholPercentage($data["alcohol_percentage"]);
            $medition->setPh($data["ph"]);

            $em-> persist($medition);
            $em->flush();

            return $this->json("New medition has been created");

        }else if($sensorsrep->findBy(["id"=> $data["id_sensor"]]) && !$winesrep->findBy(["id"=> $data["id_wine"]])){
            return $this->json("Can't create the new medition, error on inputed ID_wine");
        }else if(!$sensorsrep->findBy(["id"=> $data["id_sensor"]]) && $winesrep->findBy(["id"=> $data["id_wine"]])){
        return $this->json("Can't create the new medition, error on inputed ID_sensor");
        }else{
            return $this->json("Can't create the new medition, error on inputed IDs");
        }
    }

}
