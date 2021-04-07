<?php

namespace App\Controller;

use App\Entity\Personel;
use App\Form\PersonelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrateurController extends AbstractController
{
    
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


    #[Route('/administration/ajouter_personel', name: 'ajoutpersonel')]
    public function formPers(){
        return $this->redirectToRoute('personel');
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
