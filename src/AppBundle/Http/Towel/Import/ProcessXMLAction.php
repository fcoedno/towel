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
use Symfony\Component\HttpFoundation\Request;

class ProcessXMLAction extends Controller
{
    /**
     * @Route("/process", name="import.process_xml")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $factory = $this->get('service.file_importer.factory');
        $files = $request->files->get('xml_files', []);
        $factory->make()->import($files);
        $this->addFlash('success', 'XML files were proccessed!');
        return $this->redirectToRoute('import.index');
    }
}