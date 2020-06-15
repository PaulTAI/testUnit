<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Security\RedirectService;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/getUserList/", name="api_getUserList", methods={"GET"})
     */
    public function getUsersList(): Response{
        $user = new User;

        return new Response(
            json_encode(
                [
                    "Utilisateur" => $user
                ]
            )
        );

/*          return new Response(
             json_encode(
                 [
                     "user" => [
                         [
                             "name" => "zd",
                             "lastname" => "zd",
                             "skills" => "zjdiz",
                             "id" => 4,
                             "is_ban" => false,
                             "creation_date" => "2020-01-02 00:00:00"
                         ]
                     ]
                 ]
             )
         );*/
    }

    /**
     * @Route("/getUserListById/{id}", name="api_getUserListById", methods={"GET"})
     */
    public function getUsersById(User $user): Response{

        return new Response(
            json_encode(
                [
                    "ID" => $user->getId(),
                    "name" => $user->getFirstname(),
                    "lastname" => $user->getLastname()
                ]
            )
        );
    }
}
