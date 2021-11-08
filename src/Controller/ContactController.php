<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'THERE',
        ]);
    }
    /**
     * @Route("/contacter/{city}", name="contactCity")
     */


    public function contactCity(Request $request, string $city): Response
    {
        $name = $request->Query->get('name');
        return $this->render('contact/index.html.twig', [
            'city' => $city,
            'name' => $name,
        ]);
    }
}
