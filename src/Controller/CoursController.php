<?php


namespace App\Controller;


use App\Entity\Cours;
use App\Entity\Semestre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{

    /**
     * @Route("/cours", name="accueilCours")
     */
    public function accueilCours(){
        $repo =$this->getDoctrine()->getRepository(Cours::class);
        $cours=$repo->findAll();
        return $this->render('accueuilcours.html.twig', ['cours'=>$cours]);
    }

    /**
     * @Route("/cours/creer", name="creer_cours")
     */
    public  function creerCours(Request $request){
        $cours = new Cours();
        $form = $this->createFormBuilder($cours)
            ->add('Nom')
            ->add('description')
            ->add('numero Semestre')
            ->getForm();
        $form->handleRequest($request);

       return $this->render("creercours.html.twig", ['formCours'=> $form->createView()]);
    }

    /**
     * @Route("/cours/{id}", name="cour_show")
     */
    public function show($id){
        $repo=$this->getDoctrine()->getRepository(Cours::class);
        $cour = $repo->find($id);

        return $this->render('cour.html.twig' , ['cour' => $cour]);
    }


}