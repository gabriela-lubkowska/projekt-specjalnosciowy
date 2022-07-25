<?php

namespace App\Entity;

use App\Repository\KategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KategoriaRepository::class)]
class Kategoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nazwaKategoria;

    #[ORM\OneToMany(mappedBy: 'kategoria', targetEntity: Product::class, orphanRemoval: true)]
    private $Produkty;

    public function __construct()
    {
        $this->Produkty = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nazwaKategoria;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwaKategoria(): ?string
    {
        return $this->nazwaKategoria;
    }

    public function setNazwaKategoria(string $nazwaKategoria): self
    {
        $this->nazwaKategoria = $nazwaKategoria;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProdukty(): Collection
    {
        return $this->Produkty;
    }

    public function addProdukty(Product $produkty): self
    {
        if (!$this->Produkty->contains($produkty)) {
            $this->Produkty[] = $produkty;
            $produkty->setKategoria($this);
        }

        return $this;
    }

    public function removeProdukty(Product $produkty): self
    {
        if ($this->Produkty->removeElement($produkty)) {
            // set the owning side to null (unless already changed)
            if ($produkty->getKategoria() === $this) {
                $produkty->setKategoria(null);
            }
        }

        return $this;
    }
}
