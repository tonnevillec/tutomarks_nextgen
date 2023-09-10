<?php
namespace App\Controller;

use App\Entity\CodeCategories;
use App\Entity\Languages;
use App\Entity\Links;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {}

    #[Route('/links', name: 'api.links', methods: ['GET'])]
    public function links(): JsonResponse
    {
        $links = $this->em->getRepository(Links::class)->findBy(['is_publish' => true], ['published_at' => 'DESC']);

        return $this->json($links, 200, [], ['groups' => ['links.read']]);
    }

    #[Route('/categories', name: 'api.categories', methods: ['GET'])]
    public function categories(): JsonResponse
    {
        $categories = $this->em->getRepository(CodeCategories::class)->findBy(['actif' => true], ['title' => 'ASC']);

        return $this->json($categories, 200, [], ['groups' => ['categories.read']]);
    }

    #[Route('/languages', name: 'api.languages', methods: ['GET'])]
    public function languages(): JsonResponse
    {
        $languages = $this->em->getRepository(Languages::class)->findBy([], ['name' => 'ASC']);

        return $this->json($languages, 200, [], ['groups' => ['languages.read']]);
    }

//    #[Route('/brands', name: 'api.brands', methods: ['GET'])]
//    public function brands(): JsonResponse
//    {
//        $brands = $this->em->getRepository(Brands::class)->findAll();
//
//        return $this->json($brands, 200, [], ['groups' => ['brands.read']]);
//    }
}