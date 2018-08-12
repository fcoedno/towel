<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 13:17
 */

namespace AppBundle\Http\Towel\Import;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProcessXMLAction extends Controller
{
    /**
     * @Route("/process", name="import.process_xml")
     */
    public function __invoke()
    {
        $this->addFlash('success', 'XML files were proccessed!');
        return $this->redirectToRoute('import.index');
    }
}