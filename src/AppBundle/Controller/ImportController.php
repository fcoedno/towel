<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 11:04
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ImportController extends Controller
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('index.twig');
    }

    /**
     * @Route("/proccess", methods={"POST"}, name="proccess_xml")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function proccessXmlAction(Request $request)
    {
        $this->addFlash('success', 'XML files were proccessed!');
        return $this->redirectToRoute('index');
    }
}