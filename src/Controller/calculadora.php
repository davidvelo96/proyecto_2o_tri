<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class calculadora extends AbstractController
{

    /**
     * @Route("/suma/{num1}/{num2}" ,name="suma", requirements={"num1"="\d+","num2"="\d+"})
     */
    public function suma(int $num1 = 1, int $num2 = 1): Response
    {
        $suma = $num1 + $num2;

        return new Response(
            '<html><body><h1>La suma de ' . $num1 . '+' . $num2 . '=' . $suma . '</h1></body></html>'
        );
    }

    /**
     * @Route("/resta/{num1<\d+>}/{num2<\d+>}", name="resta")
     */
    public function resta(int $num1 = 1, int $num2 = 1): Response
    {
        $resta = $num1 - $num2;

        return $this->render('operaciones.html.twig', [
            'num1' => $num1,
            'num2' => $num2,
            'operacion' => "-",
            'fin' => $resta,
            'op' => "resta"
        ]);
    }

    /**
     * @Route("/dividir/{num1}/{num2}" ,name="dividir", requirements={"num1"="\d+","num2"="\d+"})
     */
    public function division(int $num1 = 1, int $num2 = 1): Response
    {
        $division = $num1 / $num2;

        return new Response(
            '<html><body><h1>La division de ' . $num1 . '/' . $num2 . '=' . $division . '</h1></body></html>'
        );
    }

    /**
     * @Route("/multi/{num1}/{num2}" ,name="multi", requirements={"num1"="\d+","num2"="\d+"})
     */
    public function multipli(int $num1 = 1, int $num2 = 1): Response
    {
        $multi = $num1 * $num2;

        return new Response(
            '<html><body><h1>La multiplicacion de ' . $num1 . '*' . $num2 . '=' . $multi . '</h1></body></html>'
        );
    }
}
