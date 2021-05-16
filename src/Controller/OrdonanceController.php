<?php

namespace App\Controller;

use Dompdf\Dompdf;

// Include Dompdf required namespaces
use Dompdf\Options;
use App\Repository\MedicamentRepository;
use App\Repository\InscriptionRepository;
use App\Repository\MaladieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrdonanceController extends AbstractController
{

    #[Route('/Docteur/ordonance/{id<[0-9]+>}', name: 'ordonance')]
    public function ordonance(MedicamentRepository $data,InscriptionRepository $patient, MaladieRepository $maladie, int $id)
    {
        $pats= $data->find($id);
        $pato= $patient->findOneBy(['id' => $pats->getInscription()]);
        $malo= $maladie->findOneBy(['id' => $pats->getMaladie()]);
        return $this->render('default/mypdf.html.twig', [
            'medicament'=>$pats,
            'patient'=> $pato,
            'maladie'=> $malo
        ]);
    }


    #[Route('/Docteur/imprimer/{id<[0-9]+>}', name: 'imprimer')]
    public function imprimer(MedicamentRepository $data,InscriptionRepository $patient, MaladieRepository $maladie, int $id)
    { 
        $pats= $data->find($id);
        $pato= $patient->findOneBy(['id' => $pats->getInscription()]);
        $malo= $maladie->findOneBy(['id' => $pats->getMaladie()]);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('default/ImprimerPDF.html.twig',  [
            'medicament'=>$pats,
            'patient'=> $pato,
            'maladie'=> $malo
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
          ]);
    }
}

