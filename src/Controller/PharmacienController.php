<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\Medicament;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PharmacienController extends AbstractController
{
    #[Route('/pharmacien', name: 'pharmacien')]
    public function pharmacien(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Medicament::class);
        $repos= $manager->getRepository(Inscription::class);
        $med= $repo->findAll();
        for ($j=0; $j < count($med); $j++) { 
            $liste= $repos->findBy(['id' => $med[$j]->getInscription()]);
        }
        return $this->render('pharmacien/Pharmacien.html.twig', [
            'patients' => $liste,
            'reference' => $med
        ]);
    }
}
