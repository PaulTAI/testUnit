<?php

namespace App\Tests\Validation;

use App\Entity\Items;
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

    public function testIsValidMail()
    {
        $userValide = new UserValidation();
        $this->assertEquals(false, $userValide->isValid("", "polo", "Faure", "azertyuiop", 17));
        $this->assertEquals(false, $userValide->isValid("uuuuu", "polo", "Faure", "azertyuiop", 17));
    }

    public function testIsValidFirstnameLastname()
    {
        $userValide = new UserValidation();
        $this->assertEquals(false, $userValide->isValid("mamamia@hotmail.fr", "", "Faure", "azertyuiop", 17));
        $this->assertEquals(false, $userValide->isValid("mamamia@hotmail.fr", "po", "Faure", "azertyuiop", 17));
    }

    public function testIsValidPassword()
    {
        $userValide = new UserValidation();
        $this->assertEquals(false, $userValide->isValid("mamamia@hotmail.fr", "polo", "Faure", "azerty", 17));
        $this->assertEquals(false, $userValide->isValid("mamamia@hotmail.fr", "polo", "Faure", "", 17));
    }

    public function testIsValidAge()
    {
        $userValide = new UserValidation();
        $this->assertEquals(false, $userValide->isValid("mamamia@hotmail.fr", "polo", "Faure", "azerty", 8));
        $this->assertEquals(false, $userValide->isValid("mamamia@hotmail.fr", "polo", "Faure", "", "17"));
    }

    public function testCanAddItem()
    {
        $item = new Items();
        $item->setNameItem("item1");
        $item->setContent("Gros contenue bien long");
        $item->setCreateDate(new \DateTime());

        $itemRepository = $this->createMock(ObjectRepository::class);

        $itemRepository->expects($this->any())
            ->method('find')
            ->willReturn($item);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($itemRepository);

        $addItem = new UserValidation($objectManager);
        $this->assertEquals(true, $addItem->canAddItem($item));
    }

    public function testCanAddItemNameItem()
    {
        $item = new Items();
        $item->setNameItem("ie");
        $item->setContent("Gros contenue bien long");
        $item->setCreateDate(new \DateTime());

        $itemRepository = $this->createMock(ObjectRepository::class);

        $itemRepository->expects($this->any())
            ->method('find')
            ->willReturn($item);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($itemRepository);

        $addItem = new UserValidation($objectManager);
        $this->assertEquals(false, $addItem->canAddItem($item));
    }

    public function testCanAddItemContent()
    {
        $item = new Items();
        $item->setNameItem("item2");
        $item->setContent("");
        $item->setCreateDate(new \DateTime());

        $itemRepository = $this->createMock(ObjectRepository::class);

        $itemRepository->expects($this->any())
            ->method('find')
            ->willReturn($item);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($itemRepository);

        $addItem = new UserValidation($objectManager);
        $this->assertEquals(false, $addItem->canAddItem($item));
    }

    public function testCanAddItemDate()
    {
        $item = new Items();
        $item->setNameItem("item3");
        $item->setContent("Gros contenue bien long");
        $item->setCreateDate(new \DateTime());

        $itemRepository = $this->createMock(ObjectRepository::class);

        $itemRepository->expects($this->any())
            ->method('find')
            ->willReturn($item);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($itemRepository);

        $addItem = new UserValidation($objectManager);
        $this->assertEquals(true, $addItem->canAddItem($item));
    }

    public function testSendMail()
    {
        $user = new User();
        $user->setAge(18);

        $userRepository = $this->createMock(ObjectRepository::class);

        $userRepository->expects($this->any())
            ->method('find')
            ->willReturn($user);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($userRepository);

        $sendMail = new UserValidation($objectManager);
        $this->assertEquals(false, $sendMail->sendMail($user));
    }
}