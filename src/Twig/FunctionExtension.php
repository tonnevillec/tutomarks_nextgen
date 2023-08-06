<?php
namespace App\Twig;

use App\Entity\Authors;
use App\Entity\Categories;
use App\Entity\Links;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FunctionExtension extends AbstractExtension
{

    public function __construct(private readonly EntityManagerInterface $em)
    {}

    public function getFunctions(): array
    {
        $default = ['is_safe' => ['html']];

        return [
            new TwigFunction('headerStyle2', [$this, 'getHeaderStyle2'], $default),
            new TwigFunction('countForCategory', [$this, 'getCountForCategory'], $default),
            new TwigFunction('countForAuthors', [$this, 'getCountForAuthors'], $default),
            new TwigFunction('categoryIcon', [$this, 'getCategoryIcon'], $default),
        ];
    }

    public function getHeaderStyle2(string $title, string $icon): string
    {
        return '<div class="section-heading style-2 mb-7 w-full mt-10">
            <h2 class="text-3xl mb-2">
                <i class="fa-solid fa-'.$icon.' text-indigo"></i>'.$title.'
            </h2>
            <div class="line"></div>
        </div>';
    }

    public function getCountForCategory(string $code): string
    {
        $c = $this->em
            ->getRepository(Links::class)
            ->findBy([
                'category' => $this->em->getRepository(Categories::class)->findOneBy(['code' => $code]),
            ]);

        return count($c);
    }

    public function getCountForAuthors(): string
    {
        $c = $this->em
            ->getRepository(Authors::class)
            ->findAll();

        return count($c);
    }

    public function getCategoryIcon(string $code): string
    {
        $category = $this->em
            ->getRepository(Categories::class)
            ->findOneBy([
                'code' => $code,
            ]);

        if (!$category) {
            return 'fa-solid fa-box';
        }

        return !is_null($category->getLogo()) && '' !== $category->getLogo() ? $category->getLogo() : 'fa-solid fa-box';
    }
}