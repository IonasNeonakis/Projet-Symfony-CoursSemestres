<?php


namespace App\Controller;


use App\Entity\Cours;
use App\Entity\Semestre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SemestreController extends AbstractController
{
    /**
     * @Route("/Semestre",name="accueilSemestres")
     */
    public function accueilSemestres(){
        $repo = $this->getDoctrine()->getRepository(Semestre::class);
        $semestres=$repo->findAll();
        return $this->render('accueuilsemestres.html.twig',['semestres'=>$semestres]);
    }

}