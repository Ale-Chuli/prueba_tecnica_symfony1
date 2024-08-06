<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

use Nelmio\ApiDocBundle\Annotation as Nelmio;
use OpenApi\Attributes as OA;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\UserRepository;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/user', name: 'user')]
#[Nelmio\Areas(['public'])]
#[OA\Tag('Users')]
class UserController extends AbstractController
{
    #[Route('/register', name: 'user_register', methods: ['POST'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref:'#/components/schemas/UsersInfo'))]
    public function userRegister(EntityManagerInterface $em, Request $request,
     UserPasswordHasherInterface $passwordHasher): Response
    {
        $body = $request-> getContent();
        $data = json_decode($body, true);

        $user = new Users();
        $user->setEmail($data['email']);
        $password = $data['password'];

        //https://symfony.com/doc/current/security/passwords.html
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);
        
        $em-> persist($user);
        $em->flush();

        return $this->json("User has been created", Response::HTTP_CREATED);
    }

    #[Route("/login", name:"user_login", methods: ['POST'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref:'#/components/schemas/UsersInfo'))]
    public function userLogin(UsersRepository $userrep, Request $request,
    UserPasswordHasherInterface $passwordHasher):Response
    {
        $body = $request-> getContent();
        $data = json_decode($body, true);

        $user = $userrep->findOneBy(["email"=> $data["email"]]);

        if($user){
            $password = $data['password'];
            if($passwordHasher->isPasswordValid($user,$password)){
                return $this -> json("User has been founded", Response::HTTP_CREATED);
            }else{
                return $this -> json("Invalid Password", Response::HTTP_CREATED);
            }
            
        }
        return $this -> json("User doesn't exists", Response::HTTP_CREATED);
    }

}
