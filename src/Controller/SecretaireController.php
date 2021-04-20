<?php

namespace App\Controller;

use App\Entity\Charge;
use App\Form\ChargeType;
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
        $date= new \DateTime();

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $inscription->setCreatedAt($date);
                $manager->persist($inscription);
                $manager->flush();
                return $this->redirectToRoute('priseEnCharge', ['id'=> $inscription->getId()]);
            }
            return $this->render('administration/secretaire/controleSecretaire.html.twig', [
                'formInscription' => $form->createView()
            ]);
    }


    #[Route('/Secretaire/prise_en_charge/{id<[0-9]+>}', name: 'priseEnCharge')]
    public function charge(Inscription $repo,Request $request,EntityManagerInterface $manager){
        $charge= new Charge();
        $form = $this->createForm(ChargeType::class, $charge);

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                    $charge->setInscription($repo);
                    $charge->setCreatedAt(new \DateTime());
                    $manager->persist($charge);
                    $manager->flush();
                    return $this->redirectToRoute('voir');
            }
            
        return $this->render('administration/secretaire/PriseEnCharge.html.twig', [
            'charge' => $form->createView(),
            'pats' => $repo,
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
