<?php

namespace Innova\SelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Innova\SelfBundle\Entity\Test;

/**
 * @ParamConverter("test", isOptional="true", class="InnovaSelfBundle:Test",  options={"id" = "testId"})
 */
class ExportTestController extends Controller
{
    /**
     * Export CSV basic infos for a given test.
     *
     * @Route("admin/export/csv/test/{testId}", name = "test-export-csv")
     * @Method("GET")
     */
    public function exportCsvAction(Test $test)
    {
        $this->get('innova_voter')->isAllowed('right.exportCSV');

        $response = $this->get('self.testexport.manager')->generateCsv($test);

        return $response;
    }

    /**
     * Export Livret PDF for a given test.
     *
     * @Route("admin/export/pdf/test/{testId}", name = "pdf-export")
     * @Method({"GET", "PUT"})
     * @Template("InnovaSelfBundle:Export:exportPdf.html.twig")
     */
    public function exportPdfAction(Test $test)
    {
        $this->get('innova_voter')->isAllowed('right.exportPDF');

        $pdfName = $this->get('self.testexport.manager')->exportPdf($test);
        $fileList = $this->get('self.export.manager')->getFileList($test, 'pdf');

        return array(
            'pdfName' => $pdfName,
            'test' => $test,
            'fileList' => $fileList,
        );
    }

    /**
     * List PDF export files for a given test.
     *
     * @Route("admin/export/pdf/filelist/test/{testId}",name = "pdf-export-show")
     * @Method("GET")
     * @Template("InnovaSelfBundle:Export:exportPdf.html.twig")
     */
    public function showPdfAction(Test $test)
    {
        $this->get('innova_voter')->isAllowed('right.exportPDF');

        $fileList = $this->get('self.export.manager')->getFileList($test, 'pdf');

        return array(
            'test' => $test,
            'fileList' => $fileList,
        );
    }
}
