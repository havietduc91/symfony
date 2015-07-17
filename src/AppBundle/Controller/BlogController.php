<?php
// src/AppBundle/Controller/BlogController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Model\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends DefaultController
{
    public function slugAction($slug)
    {
        echo 'Hello ' . $slug;

        return $this->render(
            'article/show.html.twig',
            array('slug' => $slug)
        );
    }

    /**
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function showAction($id)
    {

        $news = $this->getDoctrine()
            ->getRepository('AppBundle:Model:News')
            ->find($id);

        if (!$news) {
            throw $this->createNotFoundException(
                'No news found for id '.$id
            );
        }

        var_dump($news);
        die();
    }

    public function createAction()
    {
        $news = new News();
        $news->setName('news 2');
        $news->setContent('Best news on this day');
        $news->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();

        $em->persist($news);
        $em->flush();

        return new Response('Created new id '.$news->getId());
    }
}