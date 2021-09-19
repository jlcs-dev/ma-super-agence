<?php


namespace App\Controller;


use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route(path="/",name="home")
     *
     * @param PropertyRepository $repo
     * @return Response
     */
    public function index(PropertyRepository $repo): Response
    {
        $properties = $repo->findLatest();
        return $this->render('pages/home.html.twig',[
            'properties' => $properties
        ]);
    }
}