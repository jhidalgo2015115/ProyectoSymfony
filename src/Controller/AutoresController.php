<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Autores;
use App\Form\AutorType;

class AutoresController extends AbstractController
{
    /**
     * @Route("/autores", name="autores")
     */
    public function index(Request $request)
    {
        $autores = new Autores();
        $form = $this->createForm(AutorType::class, $autores);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $autores = $form->getData();
            $em->persist($autores);
            $em->flush();
            return $this->redirectToRoute('autores');

        }
        return $this->render('autores/index.html.twig',
            array('form'=>$form->createView()
            )
        );
    }
}
