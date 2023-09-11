<?php

namespace App\Controller;

use App\Entity\Authors;
use App\Entity\Events;
use App\Entity\Links;
use App\Entity\QuoiDeNeufLesDevs;
use App\Entity\Tags;
use App\Entity\YoutubeLinks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $vidz = $this->em->getRepository(YoutubeLinks::class)->findBy([], ['published_at' => 'desc'], 8);
        $ressources = $this->em->getRepository(Links::class)->findLatestRessources(['articles', 'podcasts'], 8);
        $formations = $this->em->getRepository(Links::class)->findLatestRessources(['formations'], 4);
        $tools = $this->em->getRepository(Links::class)->findLatestRessources(['ressources'], 3);
        $events = $this->em->getRepository(Events::class)->findEventsByDate(6);
        $authors = $this->em->getRepository(Authors::class)->findTop(6);
        $tags = $this->em->getRepository(Tags::class)->findTop(20);
        $newsletters = $this->em->getRepository(QuoiDeNeufLesDevs::class)->findBy(['published' => true], ['id' => 'desc'], 4);

        return $this->render('home/index.html.twig', [
            'videos' => $vidz,
            'authors' => $authors,
            'ressources' => $ressources,
            'formations' => $formations,
            'tags' => $tags,
            'tools' => $tools,
            'events' => $events,
            'newsletters' => $newsletters,
        ]);
    }

    #[Route('/search', name: 'app_search', methods: ['GET', 'POST'])]
    public function search(Request $request): Response
    {
        $search = ($request->getMethod() === Request::METHOD_POST) ? $request->get('search', '') : '';
        return $this->render('search/index.html.twig', [
            'search' => $search
        ]);
    }
}
