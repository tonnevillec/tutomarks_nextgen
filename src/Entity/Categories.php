<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    #[Groups(groups: ['links.read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(groups: ['links.read'])]
    private ?string $title = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Links::class)]
    private ?Collection $links;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $link_entity = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(groups: ['links.read'])]
    private ?string $code = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool $is_actif = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(groups: ['links.read'])]
    private ?string $image = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    #[Groups(groups: ['links.read'])]
    private ?CodeCategories $codeCategory = null;

    public function __construct()
    {
        $this->links = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function addLink(Links $link): self
    {
        if (!$this->links->contains($link)) {
            $this->links[] = $link;
            $link->setCategory($this);
        }

        return $this;
    }

    public function removeLink(Links $link): self
    {
        if ($this->links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getCategory() === $this) {
                $link->setCategory(null);
            }
        }

        return $this;
    }

    public function getLinkEntity(): ?string
    {
        return $this->link_entity;
    }

    public function setLinkEntity(string $link_entity): self
    {
        $this->link_entity = $link_entity;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getIsActif(): bool
    {
        return $this->is_actif;
    }

    public function setIsActif(bool $is_actif): self
    {
        $this->is_actif = $is_actif;

        return $this;
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

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): Categories
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getTitle();
    }

    public function getCodeCategory(): ?CodeCategories
    {
        return $this->codeCategory;
    }

    public function setCodeCategory(?CodeCategories $codeCategory): static
    {
        $this->codeCategory = $codeCategory;

        return $this;
    }
}
