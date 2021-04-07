<?php

namespace App\Controller;

use App\Entity\Personel;
use App\Form\IdentificationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffichageController extends AbstractController
{

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

}
