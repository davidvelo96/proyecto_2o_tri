<?php

namespace App\Controller;

use App\Entity\Alumnos;
use App\Entity\AsigAlum;
use App\Entity\Asignaturas;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\AsignaturasRepository;
use App\Repository\AlumnosRepository;
use Symfony\Component\HttpFoundation\Response;

class AlumnosController extends AbstractController
{
    /**
     * @Route("/alumnos", name="alumnos")
     */
    public function index(): Response
    {
        return $this->render('alumnos/index.html.twig', [
            'controller_name' => 'AlumnosController',
        ]);
    }

    /**
     * @Route("/creaAsig/{asig}", name="creaAsig")
     */
    public function creaAsig(ManagerRegistry $doctrine, String $asig): Response
    {
        $asignatura = new Asignaturas();
        $asignatura->setNombre($asig);


        $entityManager = $doctrine->getManager();
        $entityManager->persist($asignatura);
        $entityManager->flush();

        return new Response(
            'Asignatura añadida '
        );
    }

    /**
     * @Route("/creaAlum/{alum}", name="creaAlum")
     */
    public function creaAlum(ManagerRegistry $doctrine, String $alum): Response
    {
        $alumno = new Alumnos();
        $alumno->setNombre($alum);


        $entityManager = $doctrine->getManager();
        $entityManager->persist($alumno);
        $entityManager->flush();

        return new Response(
            'Alumno añadido '
        );
    }


    /**
     * @Route("/creaAlumAsig", name="creaAlumAsig")
     */
    public function creaCatPro(ManagerRegistry $doctrine): Response
    {
        $asignatura = new Asignaturas();
        $asignatura->setNombre('Matematicas');

        $alumno = new Alumnos();
        $alumno->setNombre('David');

        $asigalum = new AsigAlum();
        $asigalum->setAlumno($alumno->getId());
        $asigalum->setAsignaturas($asignatura->getId());

        $alumno->addAsigAlum($asigalum);
        $asignatura->addAsigAlum($asigalum);


        $entityManager = $doctrine->getManager();
        $entityManager->persist($asignatura);
        $entityManager->persist($alumno);
        $entityManager->persist($asigalum);
        $entityManager->flush();

        return new Response(
            'Saved new alumno with id: ' . $alumno->getNombre()
                . ' and new asignatura with id: ' . $asignatura->getNombre()
        );
    }
}
