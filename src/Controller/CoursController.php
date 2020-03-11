<?php


namespace App\Controller;


use App\Entity\Cours;
use App\Entity\Semestre;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/cours/{id}/edit", name="edit_cours")
     */
    public  function creerCours(Cours $cours = null ,Request $request, EntityManagerInterface $manager){
        $creer=false;
        if(!$cours){
            $creer=true;
            $cours = new Cours();
        }

        $form = $this->createFormBuilder($cours)
            ->add('nom', TextType::class,['required'=>true])
            ->add('description', TextareaType::class, ['required'=>true])
            ->add('semestre', EntityType::class, [
                'class'=>Semestre::class,
                'choice_label'=> 'numeroSemestre'])
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($cours);
            $manager->flush();

            return $this->redirectToRoute('cour_show',['id'=>$cours->getId()]);
        }

       return $this->render("creercours.html.twig", ['formCours'=> $form->createView(),'creer'=>$creer]);
    }

    /**
     * @Route("/cours/{id}", name="cour_show")
     */
    public function show($id){
        $repo=$this->getDoctrine()->getRepository(Cours::class);
        $cour = $repo->find($id);

        return $this->render('cour.html.twig' , ['cour' => $cour]);
    }

    /**
     * @Route("/cours/{id}/delete", name="delete_cours")
     */
    public function deleteCours($id,  EntityManagerInterface $manager){
        $repo =  $this->getDoctrine()->getRepository(Cours::class);
        $cours = $repo->find($id);


        $manager->remove($cours);
        $manager->flush();

        return $this->accueilCours();

    }


}