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
        try {
            $files = $request->files->get('xml_files', []);
            $this->processFiles($files);
            $this->addFlash('success', 'XML files were proccessed!');
        } catch (\Throwable $exception) {
            $this->addFlash('danger', 'It was not possible to process this xml, sorry :(');
        } finally {
            return $this->redirectToRoute('import.index');
        }
    }

    /**
     * Process the xml files
     *
     * @param array $files
     */
    private function processFiles(array $files)
    {
        $factory = $this->get('service.file_importer.factory');
        $factory->make()->import($files);
    }
}