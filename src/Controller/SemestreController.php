<?php


namespace App\Controller;


use App\Entity\Cours;
use App\Entity\Semestre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SemestreController extends AbstractController
{
    /**
     * @Route("/Semestre",name="accueilSemestres")
     */
    public function accueilSemestres()
    {
        $repo = $this->getDoctrine()->getRepository(Semestre::class);
        $semestres = $repo->findAll();
        return $this->render('accueuilsemestres.html.twig', ['semestres' => $semestres]);
    }

    /**
     * @Route("Semestre/creer_semestre", name="creer_semestre")
     * @Route("Semestre/{id}/edit_semestre", name="edit_semestre")
     */
    public function creerSemestre(Semestre $semestre = null, Request $request, EntityManagerInterface $manager)
    {
        $creer=false;
        if (!$semestre) {
            $creer=true;
            $semestre = new Semestre();
        }

        $form = $this->createFormBuilder($semestre)
            ->add('numeroSemestre', NumberType::class,['required'=>true])
            ->add('nomFormation', TextType::class,['required'=>true])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($semestre);
            $manager->flush();

            return $this->redirectToRoute('semestre_show', ['id' => $semestre->getId()]);
        }

        return $this->render("creersemestre.html.twig", ['formSemestre' => $form->createView(),'creer'=>$creer]);
    }

    /**
     * @Route("Semestre/{id}", name="semestre_show")
     */
    public function show($id){
        $repo=$this->getDoctrine()->getRepository(Semestre::class);
        $semestre = $repo->find($id);

        return $this->render('semestre.html.twig' , ['semestre' => $semestre]);
    }

}