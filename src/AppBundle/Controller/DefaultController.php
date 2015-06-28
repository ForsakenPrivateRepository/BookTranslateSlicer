<?php

namespace AppBundle\Controller;

use AppBundle\Document\Book;
use AppBundle\Type\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\LoggableCursor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
        $form = $this->createForm(new BookType(), null, ['action' => $this->generateUrl('submit')]);

        return $this->render('default/form.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/submit", name="submit")
     */
    public function submitAction(Request $request)
    {
        $book = new Book();

        $form = $this->createForm(new BookType(), $book);

        $form->submit($request);

        /* @var $dm DocumentManager */
        $dm = $this->get('doctrine_mongodb')->getManager();

        $dm->persist($book);
        $dm->flush();

        // db.Book.count();
        $count = $dm->getConnection()->selectDatabase('test')->selectCollection('Book')->count();

        return $this->render('default/index.html.twig', ['count' => $count]);
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

    /**
     * @Route("/translate/{word}", name="translate")
     */
    public function translateAction($word)
    {
        return new JsonResponse([
            'translate' => $word
        ]);
    }
}