<?php

namespace App\Controller;

use App\Form\LibreriaFormType;
use App\Entity\Libro;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class CreateController extends AbstractController
{
    
    #[Route('/create', name: 'app_create')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        
        $form = $this -> createForm(LibreriaFormType::Class,new Libro());
        $form -> handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid()){
            $nuevoLibro = $form->getData();
            $em= $doctrine ->getManager();
            $em ->persist($nuevoLibro);
            $em -> flush();
            return $this -> redirectToRoute('app_libro');
        }
        return $this->render('create/index.html.twig', [
            'form' => $form ->createView(),
            'tituloPagina'=>"Ingreso nuevo Libro",
        ]);
    }
}
