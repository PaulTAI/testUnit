<?php

namespace App\Tests\Validation;

use App\Entity\User;
use App\validations\UserValidation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class UserValidationTest extends TestCase
{
    public function testIsValid()
    {
        $user = new User();
        $user->setFirstname("polo");
        $user->setLastname("Faure");
        $user->setEmail("mamamia@hotmail.fr");
        $user->setPassword("azertyuiop");
        $user->setAge(17);
        $user->setToDoList(null);

        $userRepository = $this->createMock(ObjectRepository::class);

        $userRepository->expects($this->any())
            ->method('find')
            ->willReturn($user);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($userRepository);

        $userValide = new UserValidation($objectManager);
        $this->assertEquals(true, $userValide->isValid("mamamia@hotmail.fr", "polo", "Faure", "azertyuiop", 17));
    }
}