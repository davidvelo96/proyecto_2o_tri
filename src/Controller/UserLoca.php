<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Location;
use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class UserLoca extends AbstractController
{

    /**
     * @Route("/inico", name="inicio")
     */
    public function inicio(): Response
    {
        return new Response(
            'Bienvenido a mi app'
        );
    }

    /**
     * @Route("/creaLocation", name="creauser")
     */
    public function crealoca(ManagerRegistry $doctrine): Response
    {
        $User = new User();
        $User->setUsername('david');

        $loca = new Location();
        $loca->setLocationName('jaen');

        $User->addLocation($loca);
        $loca->addUser($User);


        $entityManager = $doctrine->getManager();
        $entityManager->persist($User);
        $entityManager->persist($loca);
        // $entityManager->persist($asigalum);
        $entityManager->flush();

        return new Response(
            'User location guardado'
        );
    }

    /**
     * @Route("/creaUser", name="creause")
     */
    public function creaUser(ManagerRegistry $doctrine): Response
    {
        $User = new User();
        $User->setUsername('julia');

        $locat = $doctrine->getRepository(Location::class)->find(1);


        $User->addLocation($locat);
        $locat->addUser($User);


        $entityManager = $doctrine->getManager();
        $entityManager->persist($User);
        $entityManager->flush();

        return new Response(
            'User guardado'
        );
    }

    /**
     * @Route("/muestraLoca/{id}", name="mLoca")
     */
    public function showCcc(LocationRepository $location, int $id): Response
    {

        $user = $location->find($id);

        $locat = $user->getUser();
        // $fin = var_dump($locat);
        // $arr = $locat->toArray();
        // var_dump ($arr[0]);
        foreach ($locat as $a) {
            echo "<h2><a href='../muestrau/" . $a->getId() . "'>" . $a->getUsername() . "</a></h2> <br />";
        }

        // foreach($arr as $key => $val){
        //   echo  $val->id; // Aceite, Caja
        // }

        return new Response(
            ''
        );
    }

    /**
     * @Route("/muestrau/{id}", name="muestrau")
     */
    public function muestrau(User $user): Response
    {

        $locat = $user->getLocations();
        // $fin = var_dump($locat);
        // $arr = $locat->toArray();
        // var_dump ($arr[0]);

        // foreach ($locat as $a) {
        //     echo '<h2><a href="../muestraLoca/'.$a->getId().'">'. $user->getUsername() . '----' . $a->getLocationName().'</a></h2><br>';
        // }

        return $this->render('usuarios.html.twig', [
            'usuario' => $user,
            'location' => $locat
        ]);
    }
}
