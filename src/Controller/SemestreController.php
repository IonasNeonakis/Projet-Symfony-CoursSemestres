<?php


namespace App\Controller;


use App\Entity\Semestre;
use App\Repository\SemestreRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SemestreController extends AbstractController
{
    /**
     * @Route("/Semestre",name="accueilSemestres")
     */
    public function accueilSemestres(SemestreRepository $repo)
    {
        if(!$semestres = $repo->findAll()){
            $semestres=[];
        }
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
    public function show($id, SemestreRepository $repo){
        if(!$semestre = $repo->find($id)){
            return $this->accueilSemestres($repo);
        };

        return $this->render('semestre.html.twig' , ['semestre' => $semestre]);
    }

    /**
     * @Route("/Semestre/{id}/delete", name="delete_semestre")
     */
    public function deleteSemestre($id,SemestreRepository $repo,  EntityManagerInterface $manager){
        if(!$sem = $repo->find($id)){
            return $this->accueilSemestres($repo);
        }

        foreach ($sem->getCours() as $cour){
           $manager->remove($cour);
        }

        $manager->remove($sem);
        $manager->flush();

        return $this->accueilSemestres($repo);

    }

}