<?php

namespace App\Controller;

use App\Entity\Generaliste;
use App\Entity\Inscription;
use App\Entity\Personel;
use App\Form\GeneralisteType;
use App\Form\IdentificationType;
use App\Form\InscriptionType;
use App\Form\PersonelType;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffichageController extends AbstractController
{
    #[Route('/affichage', name: 'affichage')]
    public function index(): Response
    {
        return $this->render('affichage/index.html.twig', [
            'controller_name' => 'AffichageController',
        ]);
    }

    #[Route('/', name: 'accueil')]
    public function accueil(){
        return $this->render('base.html.twig');
    }

    #[Route('/Administration', name: 'personel')]
    public function personel(Request $request, EntityManagerInterface $manager){
        $personel= new Personel();
        $form = $this->createForm(PersonelType::class, $personel);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($personel);
                $manager->flush();
                return $this->redirectToRoute('liste_personel');
            }
        return $this->render('administration/controleAdministration.html.twig', [
            'personel' => $form->createView()
        ]);
    }


    #[Route('/Identifier', name: 'identifier')]
    public function formIndentification(){
        return $this->redirectToRoute('identification');
    }


    #[Route('/Identification', name: 'identification')]
    public function identifier(Request $request, EntityManagerInterface $manager){
        $identification= new Personel();
        $form = $this->createForm(IdentificationType::class, $identification);

        $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $repo= $manager->getRepository(Personel::class);
                $reponse= $repo->findOneBy(array('adresseMail' => $form->getData()->getAdresseMail(), 
                        'password'=> $form->getData()->getPassword()
                ));

                    if($reponse->getRole() === 'Docteur'){
                        if($reponse->getSpeciality() === 'Generaliste'){
                            return $this->redirectToRoute('generaliste');
                        }
                        if($reponse->getSpeciality() === 'Oculiste'){
                            return $this->redirectToRoute('oculiste');
                        }
                        if($reponse->getSpeciality() === 'Dentiste'){
                            return $this->redirectToRoute('dentiste');
                        }
                        if($reponse->getSpeciality() === 'Chirurgien'){
                            return $this->redirectToRoute('chirurgien');
                        }
                    }

                    if($reponse->getRole() === 'Secretaire'){
                        return $this->redirectToRoute('controle_secretaire');
                    }

                    if($reponse->getRole() === 'Administrateur'){
                        return $this->redirectToRoute('personel');
                    }
                
            }
        return $this->render('administration/identification.html.twig', [
            'identification' => $form->createView()
        ]);
    }


    #[Route('/Docteur/controle_docteur', name: 'controle_docteur')]
    public function controlPatient(){
        return $this->render('administration/docteur/controleDocteur.html.twig');
    }


    #[Route('/Secretaire', name: 'controle_secretaire')]
    public function controlSecretaire(Request $request, EntityManagerInterface $manager){
        $inscription= new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($inscription);
                $manager->flush();
            }
            return $this->render('administration/secretaire/controleSecretaire.html.twig', [
                'formInscription' => $form->createView()
            ]);
    }

    #[Route('/docteur/generaliste', name: 'generaliste')]
    public function generaliste(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Inscription::class);
        $reponse= $repo->findBy(array('orienter' => 'generaliste'));
        return $this->render('administration/docteur/generaliste.html.twig', compact('reponse'));
    }

    #[Route('/docteur/dentiste', name: 'dentiste')]
    public function dentist(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Inscription::class);
        $reponse= $repo->findBy(array('orienter' => 'dentiste'));
        return $this->render('administration/docteur/dentiste.html.twig', compact('reponse'));
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


    #[Route('/Secretaire/enregitrer_patient', name: 'enregistrer')]
    public function formulaire(){
        return $this->redirectToRoute('controle_secretaire');
    }


    #[Route('/administration/ajouter_personel', name: 'ajoutpersonel')]
    public function formPers(){
        return $this->redirectToRoute('personel');
    }

    #[Route('/Secretaire/liste_patient', name: 'voir')]
    public function voir(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Inscription::class);
        $reponses= $repo->findAll();
        return $this->render('administration/secretaire/voirPatient.html.twig', [
            'reponses' => $reponses
        ]);
    }


    #[Route('/Docteur/diagnostic/{id<[0-9]+>}', name: 'diagnosticGeneraliste')]
    public function compte(InscriptionRepository $repo,Request $request,EntityManagerInterface $manager, int $id){
        $diagnostic= new Generaliste();
        $form = $this->createForm(GeneralisteType::class, $diagnostic);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($diagnostic);
                $manager->flush();
                return $this->redirectToRoute('generaliste');
            }
        $pats= $repo->find($id);
        return $this->render('administration/docteur/maladieGeneraliste.html.twig', [
            'diagnostic' => $form->createView(),
            'pats' => $pats
        ]);
    }


    #[Route('/Docteur/diagnostic/{id<[0-9]+>}', name: 'diagnosticChirurgien')]
    public function compteChirur(InscriptionRepository $repo,Request $request,EntityManagerInterface $manager, int $id){
        $diagnostic= new Generaliste();
        $form = $this->createForm(GeneralisteType::class, $diagnostic);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($diagnostic);
                $manager->flush();
                return $this->redirectToRoute('chirurgien');
            }
        $pats= $repo->find($id);
        return $this->render('administration/docteur/maladieChirurgien.html.twig', [
            'diagnostic' => $form->createView(),
            'pats' => $pats
        ]);
    }


    #[Route('/Docteur/patient_hospitaliser', name: 'hospitaliser')]
    public function filtre(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Inscription::class);
        $reponse= $repo->findBy(array('profession' => 'Etudiant'));
        return $this->render('administration/docteur/hospitaliser.html.twig', [
            'reponse' => $reponse
        ]);
    }


    #[Route('/administration/liste_personel', name: 'liste_personel')]
    public function listePersonel(EntityManagerInterface $manager){
        $repo= $manager->getRepository(Personel::class);
        $liste= $repo->findAll();
        return $this->render('administration/listePersonels.html.twig', [
            'liste' => $liste
        ]);
    }
}
