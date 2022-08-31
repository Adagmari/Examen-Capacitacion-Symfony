<?php

namespace App\Controller;

use App\Repository\LibroRepository;

use App\Entity\Libro;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LibroController extends AbstractController
{
    #[Route('/libro', name: 'app_libro')]
    #public function index(ManagerRegistry $doctrine): Response
    public function index(LibroRepository $LibroRepository): Response
    {
        $libro= new Libro();
       return $this->render('libro/index.html.twig', [
            #'controller_name' => 'LibroController',
            'libros' => $LibroRepository -> findAll(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delet(Libro $libro, ManagerRegistry $doctrine ): RedirectResponse
    {
        $em = $doctrine -> getManager();
        $em -> remove($libro);
        $em ->flush();
        return $this -> redirectToRoute('app_libro');
        
        
    }
}
