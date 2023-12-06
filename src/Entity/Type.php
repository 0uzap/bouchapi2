<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\MetaData\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\MetaData\Post;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;

#[ApiResource(paginationItemsPerPage:20,
operations:[new Get(normalizationContext: ['groups' => 'type:item']),
            new GetCollection(normalizationContext: ['groups' => 'type:list']),
            new Post(security: "is_granted('ROLE_ADMIN') or object == user"),
])]
#[ApiFilter(SearchFilter::class, properties:['description'=>'partial'])]
#[ApiFilter(OrderFilter::class, properties:['description'=>'ASC'])]

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["type:list", "type:item"])]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'idType', targetEntity: Produit::class, orphanRemoval: true)]
    #[Groups(["type:list", "type:item", "produit:list", "produit:item"])]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setIdType($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getIdType() === $this) {
                $produit->setIdType(null);
            }
        }

        return $this;
    }
}
