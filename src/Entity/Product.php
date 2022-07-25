<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nazwa;

    #[ORM\Column(type: 'string', length: 20)]
    private $cena;

    #[ORM\Column(type: 'boolean')]
    private $czyDostepne;

    #[ORM\ManyToOne(targetEntity: Kategoria::class, inversedBy: 'Produkty')]
    #[ORM\JoinColumn(nullable: false)]
    private $kategoria;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photoFilename;

    public function __toString(): string
    {
        return $this->nazwa;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getCena(): ?string
    {
        return $this->cena;
    }

    public function setCena(string $cena): self
    {
        $this->cena = $cena;

        return $this;
    }

    public function isCzyDostepne(): ?bool
    {
        return $this->czyDostepne;
    }

    public function setCzyDostepne(bool $czyDostepne): self
    {
        $this->czyDostepne = $czyDostepne;

        return $this;
    }

    public function getKategoria(): ?Kategoria
    {
        return $this->kategoria;
    }

    public function setKategoria(?Kategoria $kategoria): self
    {
        $this->kategoria = $kategoria;

        return $this;
    }

    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    public function setPhotoFilename(?string $photoFilename): self
    {
        $this->photoFilename = $photoFilename;

        return $this;
    }
}
