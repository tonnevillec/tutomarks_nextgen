<?php

namespace App\Entity;

use App\Repository\LinksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LinksRepository::class)]
#[ORM\Index(columns: ['title', 'description'], name: 'links', flags: ['fulltext'])]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'youtube' => YoutubeLinks::class,
    'simple' => SimpleLinks::class,
])]
abstract class Links
{
    final public const LINK_ENTITY = ['simple', 'youtube'];

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    #[Groups(groups: ['links.read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(groups: ['links.read'])]
    private ?string $title = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(groups: ['links.read'])]
    private \DateTimeInterface $published_at;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Url]
    #[Groups(groups: ['links.read'])]
    private ?string $url = null;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'links')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(groups: ['links.read'])]
    private ?Categories $category = null;

    #[ORM\ManyToOne(targetEntity: Authors::class, inversedBy: 'links')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(groups: ['links.read'])]
    private ?Authors $author = null;

    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'links')]
    #[Groups(groups: ['links.read'])]
    private Collection $tags;

    #[ORM\ManyToOne(targetEntity: Languages::class, inversedBy: 'links')]
    #[Groups(groups: ['links.read'])]
    private ?Languages $language = null;

    #[ORM\Column(type: 'boolean')]
    #[Groups(groups: ['links.read'])]
    private ?bool $is_publish = false;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(groups: ['links.read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'links')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(groups: ['links.read'])]
    private ?Users $published_by = null;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->published_at = new \DateTimeImmutable();
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

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeInterface $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAuthor(): ?Authors
    {
        return $this->author;
    }

    public function setAuthor(?Authors $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags ...$tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }

    public function removeTag(Tags $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function getLanguage(): ?Languages
    {
        return $this->language;
    }

    public function setLanguage(?Languages $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getIsPublish(): ?bool
    {
        return $this->is_publish;
    }

    public function setIsPublish(bool $is_publish): self
    {
        $this->is_publish = $is_publish;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishedBy(): ?Users
    {
        return $this->published_by;
    }

    public function setPublishedBy(?Users $published_by): self
    {
        $this->published_by = $published_by;

        return $this;
    }

    private array $english_days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    private array $french_days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    private array $english_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    private array $french_months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

    #[Groups(groups: ['links.read'])]
    public function getPublishedAtLocal(string $format = 'l j F Y'): string
    {
        return str_replace(
            $this->english_months,
            $this->french_months,
            str_replace(
                $this->english_days,
                $this->french_days,
                $this->published_at->format($format)
            )
        );
    }
}
