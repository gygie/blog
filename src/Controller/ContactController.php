<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }



    /**
     * @Route("/contact/", name="contact")
     */
    public function index(): Response
    {

        return $this->render('contact/index.html.twig', [
            'name' => 'moi',
            'articles' => $this->articleRepository->findAll(),

        ]);
    }
    /**
     * @Route("/contact/new", name="contact_show")
     */

    public function create(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entity=$this->getDoctrine()->getManager();
            $article= $form->getData();
            $entity->persist($article);
            $entity->flush();
        }
        return $this->renderForm('contact/blog.html.twig',[
            'formArticle'=>$form
        ]);
    }
    /**
     * @Route("/contact/{id}", name="article")
     */
    public function articleById($id) :Response
    {
        return $this->render('contact/index.html.twig', [
            'article'=>$this->articleRepository->find($id)
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
            'contact' => $this->contactRepository->findAll()
        ]);
    }
}
