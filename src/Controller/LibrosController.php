<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use App\Entity\Libros;
use App\Entity\Autores;
use App\Form\LibroType;

class LibrosController extends AbstractController
{
    /**
     * @Route("/libros", name="libros")
     */
    public function index(Request $request)
    {
        $libros = new Libros();
        $form = $this->createForm(LibroType::class, $libros);
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $libros = $form->getData();
                $em->persist($libros);
                $em->flush();
                return $this->redirectToRoute('libros');
    
            }
        return $this->render('libros/index.html.twig',
            array('form'=>$form->createView(),
            )
        );
    }


    /**
     * @Route("/libros/PorAutor/{autor}", name="PorAutor")
     */
    public function porAutor($autor)
    {
        $em = $this->getDoctrine()->getManager();
        $librosRepositorio = $em->getRepository(Libros::class)->BuscarLibroPorAutor($autor);

        return $this->render('libros/PorAutor.html.twig',
            array('BuscarLibroPorAutor'=>$librosRepositorio
            )
        );
    }

     /**
     * @Route("/libros/PorCategoria/{categoria}", name="PorCategoria")
     */
    public function PorCategoria($categoria)
    {
        $em = $this->getDoctrine()->getManager();
        $librosRepositorio = $em->getRepository(Libros::class)->BuscarLibroPorCategoria($categoria);

        return $this->render('libros/PorCategoria.html.twig',
            array('BuscarLibroPorCategoria'=>$librosRepositorio
            )
        );
    }


}
