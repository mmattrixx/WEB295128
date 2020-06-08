<?php

namespace App\Controller;

use App\Entity\Papier;

use App\Form\PapierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


/**
 * @Route("/papier", name="papier")
 */
class PapierController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    /**
     * PapierController constructor.
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="lista")
     */
    public function index()
    {
        if($this->security->isGranted('ROLE_MODERATOR')) {
        $products = $this->getDoctrine()
            ->getRepository(Papier::class)
            ->findAllSorted();

        return $this->render('papier/index.html.twig', [
            'prod' => $products
        ]);
        }
        else {
            return $this->redirectToRoute('security_logout');
        }

    }
    /**
     * @Route("/Nowa",name="NowyPapier")
     */
    public function NewPap(Request $request)
    {
        if($this->security->isGranted('ROLE_MODERATOR')) {
        $tek=new Papier();
        $form = $this->createForm(PapierType::class, $tek);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($tek);
            $entityManager->flush();
            return $this->redirectToRoute('papierlista');
        }


        return $this->render('papier/Edycja.html.twig', [
            'form' => $form->createView(),
            'type'=>'new'
        ]);
        }
        else {
            return $this->redirectToRoute('security_logout');
        }
    }

    /**
     * @Route("/Edycja", name="EdycjaPapieru")
     */
    public function EditPap(Request $request)
    {
        if($this->security->isGranted('ROLE_MODERATOR')) {
        $tek=new Papier();

        if(isset($_POST['id'])) {
            $tek = $this->getDoctrine()
                ->getRepository(Papier::class)
                ->find($_POST['id']);
        }
        else{

            $form2 = $this->createForm(PapierType::class, $tek);
            $form2->handleRequest($request);
            if(!$form2->isSubmitted())
                return $this->redirectToRoute('tekturatektura');
            $tek = $this->getDoctrine()
                ->getRepository(Papier::class)
                ->find($form2->get('id_post')->getData());
        }
        $form = $this->createForm(PapierType::class, $tek);
        if(isset($_POST['id'])) {
            $form->get('id_post')->setData($_POST['id']);
        }
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($tek);
            $entityManager->flush();
            return $this->redirectToRoute('papierlista');
        }


        return $this->render('papier/Edycja.html.twig', [
            'form' => $form->createView(),
            'type'=>'edit'
        ]);
        }
        else {
            return $this->redirectToRoute('security_logout');
        }
    }

//    /**
//     * @Route("/req", name="ajaxResp")
//     */
//    public function ajaxRespons(Request $request)
//    {
//        if($request->isXmlHttpRequest())
//        return new Response($request->get('test'));
//        else   return new Response("Nie");
//    }
}

