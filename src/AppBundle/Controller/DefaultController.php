<?php

namespace AppBundle\Controller;

use AppBundle\Document\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\LoggableCursor;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        /* @var $dm DocumentManager */
        $dm = $this->get('doctrine_mongodb')->getManager();

        $book = new Book();
        $book->setName('First Book');

        $dm->persist($book);
        $dm->flush();

        $repository = $dm->getRepository('AppBundle:Book');

        /* @var $books LoggableCursor */
        $books = $repository->findAll();

        return $this->render('default/index.html.twig');
    }
}
