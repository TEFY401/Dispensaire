<?php

namespace App\Controller;

use App\Entity\Charge;
use App\Entity\Maladie;
use App\Form\MaladieType;
use App\Entity\Medicament;
use App\Entity\Generaliste;
use App\Entity\Inscription;
use App\Form\MedicamentType;
use App\Form\GeneralisteType;
use App\Repository\MaladieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\GeneralisteRepository;
use App\Repository\InscriptionRepository;
use App\Repository\MedicamentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;

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


    #[Route('/Docteur/diagnostic/generaliste/{id<[0-9]+>}', name: 'diagnosticGeneraliste')]
    public function compte(Inscription $repo,Request $request,EntityManagerInterface $manager, int $id){
        $diagnostic= new Generaliste();
        $form = $this->createForm(GeneralisteType::class, $diagnostic);

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                    $diagnostic->setInscription($repo);
                    $diagnostic->setCreatedAt(new \DateTime());
                    $manager->persist($diagnostic);
                    $manager->flush();
                    return $this->redirectToRoute('maladie', ['id'=> $repo->getId()]);
            }
            
        return $this->render('administration/docteur/maladieGeneraliste.html.twig', [
            'diagnostic' => $form->createView(),
            'pats' => $repo,
        ]);
    }

    #[Route('/Docteur/Diagnostic/Enregistrer_maladie/{id<[0-9]+>}', name: 'maladie')]
    public function maladie(Inscription $repo,Request $request,EntityManagerInterface $manager){
        $maladie= new Maladie();
        $form1= $this->createForm(MaladieType::class, $maladie);
        $form1->handleRequest($request);
            if($form1->isSubmitted() && $form1->isValid()){
                $maladie->setInscription($repo);
                $maladie->setCreatedAt(new \DateTime());
                $manager->persist($maladie);
                $manager->flush();
                return $this->redirectToRoute('medicament', ['id'=> $repo->getId()]);
            }
        return $this->render('administration/docteur/maladie.html.twig', [
            'maladie' => $form1->createView(),
            'pats' => $repo
        ]);    
    }


    #[Route('/Docteur/diagnostic/oculiste/{id<[0-9]+>}', name: 'diagnosticOculiste')]
    public function compteOculi(Inscription $repo,Request $request,EntityManagerInterface $manager, int $id){
        $diagnostic= new Generaliste();
        $form = $this->createForm(GeneralisteType::class, $diagnostic);

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                    $diagnostic->setInscription($repo);
                    $diagnostic->setCreatedAt(new \DateTime());
                    $manager->persist($diagnostic);
                    $manager->flush();
                    return $this->redirectToRoute('maladie', ['id'=> $repo->getId()]);
            }
            
        return $this->render('administration/docteur/maladieOculiste.html.twig', [
            'diagnostic' => $form->createView(),
            'pats' => $repo,
        ]);
    }


    #[Route('/Docteur/diagnostic/chirurgien/{id<[0-9]+>}', name: 'diagnosticChirurgien')]
    public function compteChirur(Inscription $repo,Request $request,EntityManagerInterface $manager, int $id){
        $diagnostic= new Generaliste();
        $form = $this->createForm(GeneralisteType::class, $diagnostic);

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                    $diagnostic->setInscription($repo);
                    $diagnostic->setCreatedAt(new \DateTime());
                    $manager->persist($diagnostic);
                    $manager->flush();
                    return $this->redirectToRoute('maladie', ['id'=> $repo->getId()]);
            }
            
        return $this->render('administration/docteur/maladieChirurgien.html.twig', [
            'diagnostic' => $form->createView(),
            'pats' => $repo,
        ]);
    }

    
    #[Route('/Docteur/ajout_medicament//{id<[0-9]+>}', name: 'medicament')]
    public function medicament(InscriptionRepository $repos,Request $request,EntityManagerInterface $manager, int $id){
        $medicament= new Medicament();
        $form= $this->createForm(MedicamentType::class, $medicament);
        $date= new \DateTime();
        $pats= $repos->find($id);

        $repo= $manager->getRepository(Generaliste::class);
        $repos= $manager->getRepository(Charge::class);
        $rep= $manager->getRepository(Maladie::class);
        
        $mal= $rep->findBy(array('inscription' => $pats->getId()), array('createdAt' => 'DESC'), 1);
        $test= $repos->findBy(array('inscription' => $pats->getId()), array('createdAt' => 'DESC'), 1);
        $tests= $repo->findBy(array('inscription' => $pats->getId()), array('createdAt' => 'DESC'), 1);
        $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $medicament->setCreatedAt($date);
                $medicament->setInscription($pats);
                $manager->persist($medicament);
                $manager->flush();
            }
        return $this->render('administration/docteur/medicament.html.twig', [
            'medoc' => $form->createView(),
            'pats' => $pats,
            'tests' => $test,
            'test' => $tests,
            'mals' => $mal
        ]);    
    }


    #[Route('Docteur/listes_des_patients', name: 'listes')]
    public function listes(MaladieRepository $repo, InscriptionRepository $data){
        $tous= $data->findAll();
            return $this->render('administration/docteur/listesPatients.html.twig', compact('tous'));
        }
        

    #[Route('Docteur/traitement/{id<[0-9]+>}', name: 'regarder')]
    public function traitement(Inscription $repo, MaladieRepository $maladie, MedicamentRepository $medicament){
        $malaise= $maladie->findBy(array('inscription' => $repo->getId()), array('createdAt' => 'DESC'));
        $medoc= $medicament->findBy(array('inscription' => $repo->getId()), array('createdAt' => 'DESC'));
        return $this->render('administration/docteur/traitement.html.twig', compact('repo', 'malaise', 'medoc'));
    }
}

