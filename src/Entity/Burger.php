<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private int $price;

    #[ORM\ManyToOne(targetEntity: Pain::class, inversedBy: 'burger')]
    #[ORM\JoinColumn(nullable: false)]
    private $pain;

    #[ORM\ManyToMany(targetEntity: Sauce::class, inversedBy: 'burger')]
    private Collection $sauce;

    #[ORM\OneToOne(targetEntity: Image::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $image = null;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burger')]
    #[ORM\JoinColumn(nullable :false)]
    private $commentaire;

    #[ORM\ManyToOne(targetEntity: Oignon::class, inversedBy: 'burger')]
    private Oignon $oignon;

    public function __construct()
    {
        $this->sauce = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPain(): ?Pain
    {
        return $this->pain;
    }

    public function setPain(?Pain $pain): static
    {
        $this->pain = $pain;

        return $this;
    }
    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSauces(): Collection
    {
        return $this->sauce;
    }

    public function addSauce(Sauce $sauce)
    {
        if (!$this->sauce->contains($sauce)) { //s'assureq ue la sauce n'est pas déjà présente, pareil pour le commentaire
            $this->sauce[] = $sauce;
        }
        return $this;
    }
    public function removeSauce(Sauce $sauce): static
    {
        $this->sauce->removeElement($sauce);

        return $this;
    }
    public function getcommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setBurger($this);
        }

        return $this;
    }
    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaire->removeElement($commentaire)) {
            if ($commentaire->getBurger() === $this) {
                $commentaire->setBurger(null);
            }
        }

        return $this;
    }

    public function getOignon(): ?Oignon
    {
        return $this->oignon;
    }

    public function setOignon(Oignon $oignon): static
    {
        $this->oignon = $oignon;
        return $this;
    }

     public function removeOignon(Oignon $oignon): static
     {
        $this->$oignon = null;

        return $this;
     }
}
