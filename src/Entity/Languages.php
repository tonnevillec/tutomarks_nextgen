<?php

namespace App\Entity;

use App\Repository\LanguagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LanguagesRepository::class)]
class Languages
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    #[Groups(groups: ['links.read', 'languages.read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(groups: ['links.read', 'languages.read'])]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 3, nullable: true)]
    #[Groups(groups: ['links.read', 'languages.read'])]
    private ?string $shortname = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(groups: ['links.read', 'languages.read'])]
    private ?string $logo = null;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: Links::class)]
    private ?Collection $links;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->links = new ArrayCollection();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(?string $shortname): self
    {
        $this->shortname = $shortname;

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

    public function getLinks(): ?ArrayCollection
    {
        return $this->links;
    }

    public function setLinks(ArrayCollection $links): void
    {
        $this->links = $links;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    #[Groups(groups: ['languages.read'])]
    public function getTitle(): string
    {
        return $this->name;
    }

    #[Groups(groups: ['languages.read'])]
    public function getValue(): string
    {
        return $this->shortname;
    }
}
