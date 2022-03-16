<?php

namespace App\Entity;

use App\Repository\ImageCMRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageCMRepository::class)]
class ImageCM
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: MessageCM::class, inversedBy: 'contenu_image')]
    private $messageCM;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getMessageCM(): ?MessageCM
    {
        return $this->messageCM;
    }

    public function setMessageCM(?MessageCM $messageCM): self
    {
        $this->messageCM = $messageCM;

        return $this;
    }
}
