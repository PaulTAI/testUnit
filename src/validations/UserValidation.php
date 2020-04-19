<?php

namespace App\validations;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserValidation
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function isValid()
    {
        $userRepo = $this->objectManager
            ->getRepository(User::class);
        $user = $userRepo->find($id);

        return ;
    }
}