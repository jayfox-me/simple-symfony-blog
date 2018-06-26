<?php

namespace PageBundle\Controller;

use CommentBundle\Forms\CommentForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function listAction()
    {
        $pageRepo = $this->getDoctrine()->getRepository('PageBundle:Page');
        $pages = $pageRepo->findAll();

        return $this->render('@Page/Page/list.html.twig', [
            'pages' => $pages
        ]);
    }

    public function viewAction($id, Request $request)
    {
        $pageRepo = $this->getDoctrine()->getRepository('PageBundle:Page');
        $page = $pageRepo->find($id);

        $commentForm = $this->createForm(CommentForm::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted()) {
            $comment = $commentForm->getData();
            $comment->setPage($page);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute('page_view', ['id' => $id]);
        }

        return $this->render('@Page/Page/item.html.twig', [
            'page' => $page,
            'comment_form' => $commentForm->createView()
        ]);
    }
}