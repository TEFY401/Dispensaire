<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecretaireController extends AbstractController
{
    
    #[Route('/Secretaire', name: 'controle_secretaire')]
    public function controlSecretaire(Request $request, EntityManagerInterface $manager){
        $inscription= new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($inscription);
                $manager->flush();
                return $this->redirectToRoute('voir');
            }
            return $this->render('administration/secretaire/controleSecretaire.html.twig', [
                'formInscription' => $form->createView()
            ]);
    }


    #[Route('/Secretaire/enregitrer_patient', name: 'enregistrer')]
    public function formulaire(){
        return $this->redirectToRoute('controle_secretaire');
    }


    #[Route('/Secretaire/liste_patient', name: 'voir')]
    public function voir(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Inscription::class);
        $reponses= $repo->findAll();
        return $this->render('administration/secretaire/voirPatient.html.twig', [
            'reponses' => $reponses
        ]);
    }
    
}
