<?php

namespace App\Controller;

use App\Entity\Generaliste;
use App\Entity\Inscription;
use App\Entity\Maladie;
use App\Form\GeneralisteType;
use App\Form\MaladieType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InscriptionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DocteurController extends AbstractController
{
    
    #[Route('/Docteur/controle_docteur', name: 'controle_docteur')]
    public function controlPatient(){
        return $this->render('administration/docteur/controleDocteur.html.twig');
    }


    #[Route('/docteur/generaliste', name: 'generaliste')]
    public function generaliste(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Inscription::class);
        $reponse= $repo->findBy(array('orienter' => 'generaliste'));
        return $this->render('administration/docteur/generaliste.html.twig', compact('reponse'));
    }


    #[Route('/docteur/oculiste', name: 'oculiste')]
    public function oculiste(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Inscription::class);
        $reponse= $repo->findBy(array('orienter' => 'oculiste'));
        return $this->render('administration/docteur/oculiste.html.twig', compact('reponse'));
    }


    #[Route('/docteur/chirurgien', name: 'chirurgien')]
    public function chirurgien(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Inscription::class);
        $reponse= $repo->findBy(array('orienter' => 'chirurgien'));
        return $this->render('administration/docteur/chirurgien.html.twig', compact('reponse'));
    }


    #[Route('/Docteur/diagnostic/{id<[0-9]+>}', name: 'diagnosticGeneraliste')]
    public function compte(InscriptionRepository $repo,Request $request,EntityManagerInterface $manager, int $id){
        $diagnostic= new Generaliste();
        $maladie= new Maladie();
        $form1= $this->createForm(MaladieType::class, $maladie);
        $form = $this->createForm(GeneralisteType::class, $diagnostic);
        $date= new \DateTime();

        $form->handleRequest($request);
        $form1->handleRequest($request);
        $pats= $repo->find($id);
            if($form->isSubmitted() && $form1->isSubmitted() && $form1->isValid()){
                    $diagnostic->setCreatedAt($date);
                    $diagnostic->setInscription($pats);
                    $maladie->setInscription($pats);
                    $manager->persist($maladie);
                    $manager->persist($diagnostic);
                    $manager->flush();
                    return $this->redirectToRoute('generaliste');
            }
            
        return $this->render('administration/docteur/maladieGeneraliste.html.twig', [
            'diagnostic' => $form->createView(),
            'maladie' => $form1->createView(),
            'pats' => $pats
        ]);
    }


    #[Route('/Docteur/diagnostic/{id<[0-9]+>}', name: 'diagnosticOculiste')]
    public function compteOculi(InscriptionRepository $repo,Request $request,EntityManagerInterface $manager, int $id){
        $diagnostic= new Generaliste();
        $form = $this->createForm(GeneralisteType::class, $diagnostic);
        $date= new \DateTime();

        $form->handleRequest($request);
        $pats= $repo->find($id);
            if($form->isSubmitted() && $form->isValid()){
                $diagnostic->setCreatedAt($date);
                $diagnostic->setInscription($pats);
                $manager->persist($diagnostic);
                $manager->flush();
                return $this->redirectToRoute('Oculiste');
            }
        
        return $this->render('administration/docteur/maladieOculiste.html.twig', [
            'diagnostic' => $form->createView(),
            'pats' => $pats
        ]);
    }


    #[Route('/Docteur/diagnostic/{id<[0-9]+>}', name: 'diagnosticChirurgien')]
    public function compteChirur(InscriptionRepository $repo,Request $request,EntityManagerInterface $manager, int $id){
        $diagnostic= new Generaliste();
        $form = $this->createForm(GeneralisteType::class, $diagnostic);
        $date= new \DateTime();

        $form->handleRequest($request);
        $pats= $repo->find($id);
            if($form->isSubmitted() && $form->isValid()){
                $diagnostic->setCreatedAt($date);
                $diagnostic->setInscription($pats);
                $manager->persist($diagnostic);
                $manager->flush();
                return $this->redirectToRoute('chirurgien');
            }
        
        return $this->render('administration/docteur/maladieChirurgien.html.twig', [
            'diagnostic' => $form->createView(),
            'pats' => $pats
        ]);
    }


}
