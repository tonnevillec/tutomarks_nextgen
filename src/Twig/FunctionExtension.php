<?php
namespace App\Twig;

use App\Entity\Authors;
use App\Entity\Categories;
use App\Entity\CodeCategories;
use App\Entity\Links;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FunctionExtension extends AbstractExtension
{

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UrlGeneratorInterface $generator,
    ){}

    public function getFunctions(): array
    {
        $default = ['is_safe' => ['html']];

        return [
            new TwigFunction('headerStyle2', [$this, 'getHeaderStyle2'], $default),
            new TwigFunction('countForCategory', [$this, 'getCountForCategory'], $default),
            new TwigFunction('countForAuthors', [$this, 'getCountForAuthors'], $default),
            new TwigFunction('categoryIcon', [$this, 'getCategoryIcon'], $default),
            new TwigFunction('menuAuthors', [$this, 'getMenuAuthors'], $default),
            new TwigFunction('codeCategories', [$this, 'getCodeCategories'], $default),
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

    public function getMenuAuthors(): string
    {
        $authors = $this->em
            ->getRepository(Authors::class)
            ->findTop(5)
        ;

        if (!$authors) {
            return '';
        }

        $return = '';
        foreach ($authors as $author) {
            if ($author[0]->getLogo()) {
                $logo = '<div class="w-8 rounded-full"><img alt="Avatar de la chaine '.$author[0]->getTitle().'" src="'.$author[0]->getLogo().'" /></div>';
            } else {
                $logo = '<div class="w-8 rounded-full"><i class="fa-solid fa-user"></i></div>';
            }
//            $r = $this->generator->generate('authors.show', [
//                'slug' => $author[0]->getSlug(),
//                'id' => $author[0]->getId(),
//            ]);
            $r = '#';
            $return .= '<li class="group">
                <div class="avatar flex flex-row items-center gap-2 group-hover:bg-secondary group-hover:text-white">
                '.$logo.'<a href="'.$r.'" class="group-hover:text-white text-neutral-500">'.$author[0]->getTitle().'</a>
                </div>
            </li>
            ';
        }

        return $return;
    }

    public function getCodeCategories(): array
    {
        return $this->em
            ->getRepository(CodeCategories::class)
            ->findBy(['actif' => true], ['id' => 'ASC'])
        ;
    }
}