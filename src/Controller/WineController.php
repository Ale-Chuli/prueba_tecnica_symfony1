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

use Doctrine\ORM\EntityManagerInterface;



#[Route('/wine', name: 'wine')]
class WineController extends AbstractController
{
    #[Route('/get', name: 'wine_get')]
    public function GetWinesInfo(WineMeditionsRepository $wineMeditionsrep, WinesRepository $winesrep): JsonResponse
    {
        $getWinesInfo = $wineMeditionsrep -> findAllWithWineName();
        return $this->json($getWinesInfo);
    }

    #[Route('/newmedition', name: 'new_medition')]
    public function NewMedition(Request $request, SensorsRepository $sensorsrep,
    WinesRepository $winesrep, EntityManagerInterface $em): JsonResponse
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        if($sensorsrep->findBy(["id"=> $data["idsensor"]]) && $winesrep->findBy(["id"=> $data["idwine"]])){
            $medition = new WineMeditions();
            $medition->setYear($data["year"]);
            $medition->setIdsensor($data["idsensor"]);
            $medition->setIdwine($data["idwine"]);
            $medition->setColour($data["colour"]);
            $medition->setAlcoholPercentage($data["alcohol_percentage"]);
            $medition->setPh($data["ph"]);

            $em-> persist($medition);
            $em->flush();

            return $this->json("New medition has been created");

        }
        return $this->json("Can't create the new medition, error on inputed IDs");
    }

}
