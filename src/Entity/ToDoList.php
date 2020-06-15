<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ToDoListRepository")
 */
class ToDoList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="ToDoList")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Items", mappedBy="name")
     */
    private $items;

    public function __construct()
    {
        $this->name = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|user[]
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(user $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
            $name->setToDoList($this);
        }

        return $this;
    }

    public function removeName(user $name): self
    {
        if ($this->name->contains($name)) {
            $this->name->removeElement($name);
            // set the owning side to null (unless already changed)
            if ($name->getToDoList() === $this) {
                $name->setToDoList(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Items[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Items $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->addName($this);
        }

        return $this;
    }

    public function removeItem(Items $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            $item->removeName($this);
        }

        return $this;
    }
}
