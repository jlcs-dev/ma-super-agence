<?php


namespace App\Controller;


use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PropertyController extends AbstractController
{
    private $repo;
    private $em;

    public function __construct(PropertyRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        $property = $this->repo->findAllVisible();
        dump($property);
        $this->em->flush();
        return $this->render('property/index.html.twig' ,[
            'current_menu' => 'properties'
    ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug" : "[a-z0-9\-]*"})
     * @param Property $property
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show',[
                'id' =>$property->getId(), 'slug' => $property->getSlug()
            ],301);
        }
        return $this->render( 'property/show.html.twig',[
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }

}