<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('number.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/number100")
     */
    public function number100(): Response
    {
        $number = random_int(100, 200);

        return new Response(
            '<html><body><h1>Tu numero aleatorio es: ' . $number . '</h1></body></html>'
        );
    }
}
