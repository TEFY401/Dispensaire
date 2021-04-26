<?php

namespace App\Controller;

use Dompdf\Dompdf;

// Include Dompdf required namespaces
use Dompdf\Options;
use App\Repository\InscriptionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrdonanceController extends AbstractController
{

    #[Route('/Docteur/ordonance', name: 'ordonance')]
    public function ordonance(InscriptionRepository $data)
    {
        $tous= $data->findAll();
        return $this->render('default/mypdf.html.twig', compact('tous'));
    }


    #[Route('/Docteur/imprimer', name: 'imprimer')]
    public function imprimer(InscriptionRepository $data)
    { 
        $tous= $data->findAll();
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('default/mypdf.html.twig', compact('tous'));
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
          ]);
    }
}

