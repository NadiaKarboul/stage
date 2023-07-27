<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FormationFormType ;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Formation;
use App\Repository\FormationRepository ;
use App\Repository\UserRepository ;
use App\Entity\Participation ;
use App\Entity\User ;
use App\Repository\ParticipationRepository ;
use App\Entity\Produit;
use App\Repository\ProduitRepository ;
use App\Form\ProduitFormType ;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

//ajouterformation
      #[Route('/ajoutforma', name: 'ajoutforma')]
        public function ajoutforma(ManagerRegistry $doctrine,Request $request)
                {
                $Formation= new Formation();
                $form=$this->createForm(FormationFormType::class,$Formation);
                    $form->handleRequest($request);
                    if($form->isSubmitted()){
                        $em =$doctrine->getManager() ;
                        $imageFile = $form->get('image')->getData();
                        
                        if ($imageFile) {
                            $imagesDirectory = 'C:/xampp/htdocs/images';
                            $originalFilename = $imageFile->getClientOriginalName();
                            $filenameWithoutSpaces = str_replace(' ', '_', $originalFilename);
            
                            try {
                                
                                $imageFile->move($imagesDirectory,$filenameWithoutSpaces);
                                
                            } catch (FileException $e) {
                                // Handle exception
                            }
                            $Formation->setImage($filenameWithoutSpaces);
                        }
                        
                        $em->persist($Formation);
                        $em->flush();
                        return $this->redirectToRoute("app_main");}
                return $this->renderForm("addformation.html.twig",
                        array("f"=>$form));
                    }
                    
    //Afficher formation
  #[Route('/afficheforma', name: 'afficheforma')]
        public function afficheforma(FormationRepository $Rep): Response
        { $Formation=$Rep->orderById();
           
        
            return $this->render('afficheformation.html.twig', [
            'f'=>$Formation  ,
            

            ]);
        }
      
      //Supprimer formation
   #[Route('/suppforma/{id}', name: 'suppforma')]
   public function suppforma($id,FormationRepository $r, ManagerRegistry $doctrine): Response
   {   //recuperer le produit a supprimer
       $Formation=$r->find($id);
       //action supprimer
       $em=$doctrine->getManager();
       $em->remove($Formation);
       $em->flush();
       return $this->redirectToRoute('afficheforma',); 
   }              
//modifier formation
#[Route('/modifforma/{id}', name: 'modifforma')]
   public function modifforma(ManagerRegistry $doctrine,Request $request,$id,FormationRepository $r)
                          {
         { //récupérer la formation a modifier
           $Formation=$r->find($id);
       $form=$this->createForm(FormationFormType::class,$Formation);
        $form->handleRequest($request);
        if($form->isSubmitted() ){
       $em =$doctrine->getManager() ;
       $imageFile = $form->get('image')->getData();
          
       if ($imageFile) {
           $imagesDirectory = 'C:/xampp/htdocs/images';
           $originalFilename = $imageFile->getClientOriginalName();
           $filenameWithoutSpaces = str_replace(' ', '_', $originalFilename);

           try {
               
               $imageFile->move($imagesDirectory,$filenameWithoutSpaces);
               
           } catch (FileException $e) {
               // Handle exception
           }
           $Formation->setImage($filenameWithoutSpaces);
       }
       

    
       $em->persist($Formation);
       $em->flush();
       return $this->redirectToRoute('afficheforma');}

      return $this->renderForm("updateformation.html.twig",
       array("f"=>$form));
   }}


   /////participation
   //ajouter particicpation
  
  
    #[Route('/ajoutpartici/{user_id}/{formation_id}', name: 'ajoutpartici')]
public function ajoutpartici(int $user_id, int $formation_id, UserRepository $userRepository, FormationRepository $formationRepository, ManagerRegistry $doctrine, Request $request): Response
{
    $formation = $formationRepository->find($formation_id);
    $user = $userRepository->find($user_id);

    if ($formation && $user) {
        $entityManager = $doctrine->getManager();
        $participation = new Participation();
        $participation->setUser($user);
        $participation->setFormation($formation);
        $entityManager->persist($participation);
        $entityManager->flush();
    }
    return $this->redirectToRoute('app_main');
    return $this->render('base.html.twig', [
        'f' => $formation,
    ]);}

    //afficherAllparticipation
    
  /*#[Route('/afficheparti', name: 'afficheparti')]
  public function afficheparti(ParticipationRepository $Rep): Response
  { $participation=$Rep->orderById();
     
  
      return $this->render('afficheparticipant.html.twig', [
      'f'=>$participation  ,
      

      ]);}*/


      #[Route('/afficheparti/{id_formation}', name: 'afficheparti')]
      public function afficheparti(int $id_formation): Response
      {
          $participation = $this->getDoctrine()->getRepository(Participation::class)->findBy(['formation' => $id_formation]);
      
          return $this->render('afficheparticipant.html.twig', [
              'f' => $participation,
          ]);
      }

      //ajouterproduit
      #[Route('/ajoutprod', name: 'ajoutprod')]
      public function ajoutprod(ManagerRegistry $doctrine,Request $request)
              {
              $Produit= new Produit();
              $form=$this->createForm(ProduitFormType::class,$Produit);
                  $form->handleRequest($request);
                  if($form->isSubmitted()){
                      $em =$doctrine->getManager() ;
                      $imageFile = $form->get('image')->getData();
                      
                      if ($imageFile) {
                          $imagesDirectory = 'C:/xampp/htdocs/images';
                          $originalFilename = $imageFile->getClientOriginalName();
                          $filenameWithoutSpaces = str_replace(' ', '_', $originalFilename);
          
                          try {
                              
                              $imageFile->move($imagesDirectory,$filenameWithoutSpaces);
                              
                          } catch (FileException $e) {
                              // Handle exception
                          }
                          $Produit->setImage($filenameWithoutSpaces);
                      }
                      
                      $em->persist($Produit);
                      $em->flush();
                      return $this->redirectToRoute("ajoutprod");}
              return $this->renderForm("addproduit.html.twig",
                      array("f"=>$form));
                  }

                   //Afficher Produit
  #[Route('/afficheprod', name: 'afficheprod')]
  public function afficheprod(ProduitRepository $Rep): Response
  { $Produit=$Rep->orderById();
     
  
      return $this->render('afficheproduit.html.twig', [
      'p'=>$Produit  ,
      

      ]);
  }

   //Supprimer Produit
   #[Route('/suppprod/{id}', name: 'suppprod')]
   public function suppprod($id,ProduitRepository $r, ManagerRegistry $doctrine): Response
   {   //recuperer le produit a supprimer
       $Produit=$r->find($id);
       //action supprimer
       $em=$doctrine->getManager();
       $em->remove($Produit);
       $em->flush();
       return $this->redirectToRoute('afficheprod',); 
   }  
   
   //modifier produit
#[Route('/modifprod/{id}', name: 'modifprod')]
public function modifprod(ManagerRegistry $doctrine,Request $request,$id,ProduitRepository $r)
                       {
      { //récupérer le produit a modifier
        $Produit=$r->find($id);
    $form=$this->createForm(ProduitFormType::class,$Produit);
     $form->handleRequest($request);
     if($form->isSubmitted() ){
    $em =$doctrine->getManager() ;
    $imageFile = $form->get('image')->getData();
       
    if ($imageFile) {
        $imagesDirectory = 'C:/xampp/htdocs/images';
        $originalFilename = $imageFile->getClientOriginalName();
        $filenameWithoutSpaces = str_replace(' ', '_', $originalFilename);

        try {
            
            $imageFile->move($imagesDirectory,$filenameWithoutSpaces);
            
        } catch (FileException $e) {
            // Handle exception
        }
        $Produit->setImage($filenameWithoutSpaces);
    }
    

 
    $em->persist($Produit);
    $em->flush();
    return $this->redirectToRoute('afficheprod');}

   return $this->renderForm("addproduit.html.twig",
    array("f"=>$form));
}}


}





