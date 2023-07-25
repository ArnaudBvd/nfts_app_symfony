<?php

namespace App\Entity;

use App\Repository\NftRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: NftRepository::class)]
class Nft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez saisir le nom")]
    private ?string $nom = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Veuillez saisir la quantité disponible")]
    #[Assert\Type(
        type: 'float',
        message: 'La quantité {{value}} n\'est pas un {{float}}'
    )]
    private ?float $valeur = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Veuillez saisir la quantité disponible")]
    #[Assert\Type(
        type: 'integer',
        message: 'La quantité {{value}} n\'est pas un {{type}}'
    )]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $userAdd = null;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUserAdd(): ?User
    {
        return $this->userAdd;
    }

    public function setUserAdd(?User $userAdd): static
    {
        $this->userAdd = $userAdd;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
