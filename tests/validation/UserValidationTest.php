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
        $user->setPassword("azerty");
        $user->setAge(17);

        $employeeRepository = $this->createMock(ObjectRepository::class);

        $employeeRepository->expects($this->any())
            ->method('find')
            ->willReturn($user);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($employeeRepository);

        $salaryCalculator = new SalaryCalculator($objectManager);
        $this->assertEquals(2100, $salaryCalculator->calculateTotalSalary(1));
    }
}