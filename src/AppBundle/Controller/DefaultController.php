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
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        /* @var $dm DocumentManager */
        $dm = $this->get('doctrine_mongodb')->getManager();

        // db.Book.count();
        $count = $dm->getConnection()->selectDatabase('test')->selectCollection('Book')->count();

        return $this->render('default/index.html.twig', ['count' => $count]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function addAction()
    {
        /* @var $dm DocumentManager */
        $dm = $this->get('doctrine_mongodb')->getManager();

        $book = new Book();
        $book->setName('First Book');

        $dm->persist($book);
        $dm->flush();

        // db.Book.count();
        $count = $dm->getConnection()->selectDatabase('test')->selectCollection('Book')->count();

        return $this->render('default/index.html.twig', ['count' => $count]);
    }

    /**
     * @Route("/form", name="form")
     */
    public function formAction()
    {
        return $this->redirect('/');
    }

    /**
     * @Route("/all", name="all")
     */
    public function allAction()
    {
        /* @var $dm DocumentManager */
        $dm = $this->get('doctrine_mongodb')->getManager();

        $repository = $dm->getRepository('AppBundle:Book');

        /* @var $books LoggableCursor */
        $books = $repository->findAll();

        // db.Book.find();
        $count = $books->count();

        return $this->render('default/index.html.twig', ['count' => $count]);
    }
}