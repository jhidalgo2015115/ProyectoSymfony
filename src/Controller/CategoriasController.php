<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Categorias;
use App\Form\CategoriaType;

class CategoriasController extends AbstractController
{
    /**
     * @Route("/categorias", name="categorias")
     */
    public function index(Request $request)
    {
        $categorias = new Categorias();
        $form = $this->createForm(CategoriaType::class, $categorias);
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $categorias = $form->getData();
                $em->persist($categorias);
                $em->flush();
                return $this->redirectToRoute('categorias');
            }

        return $this->render('categorias/index.html.twig',
            array('form'=>$form->createView()
            )
        );
    }
}
