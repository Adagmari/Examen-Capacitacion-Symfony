<?php

namespace App\Controller;

use App\Form\LibreriaFormType;
use App\Entity\Libro;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class EditController extends AbstractController
{
    
    #[Route('/edit/{id}', name: 'app_edit')]
    public function index(Libro $libro,Request $request, ManagerRegistry $doctrine): Response
    {
        
        $form = $this -> createForm(LibreriaFormType::Class,$libro);
        $form -> handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid()){
            $nuevolibro = $form->getData();
            $em= $doctrine ->getManager();
            $em ->persist($nuevolibro);
            $em -> flush();
            return $this -> redirectToRoute('app_libro');
        }
        return $this->render('create/index.html.twig', [
            'form' => $form ->createView(),
            'tituloPagina'=>"Actualizar datos",
        ]);
    }
}
