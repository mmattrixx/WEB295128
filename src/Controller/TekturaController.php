<?php

namespace App\Controller;

use App\Entity\Tektura;
use App\Form\TekturaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/tektura", name="tektura")
 */
class TekturaController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    /**
     * TekturaController constructor.
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("", name="tektura")
     */
    public function index()
    {

        if ($this->security->isGranted('ROLE_MODERATOR')) {
            $products = $this->getDoctrine()
                ->getRepository(Tektura::class)
                ->findAllSorted();

            return $this->render('tektura/index.html.twig', [
                'prod' => $products
            ]);
        } else {
            return $this->redirectToRoute('security_logout');
        }
    }

    /**
     * @Route("/Nowa",name="NowaTektura")
     */
    public function NewTek(Request $request)
    {
        if ($this->security->isGranted('ROLE_MODERATOR')) {
            $tek = new Tektura();
            $form = $this->createForm(TekturaType::class, $tek);
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tek);
                $entityManager->flush();
                return $this->redirectToRoute('tekturatektura');
            }


            return $this->render('tektura/Edycja.html.twig', [
                'form' => $form->createView(),
                'type' => 'new'
            ]);
        } else {
            return $this->redirectToRoute('security_logout');
        }
    }

    /**
     * @Route("/Edycja", name="EdycjaTektury")
     */
    public function EditTek(Request $request)
    {
        if ($this->security->isGranted('ROLE_MODERATOR')) {
            $tek = new Tektura();

            if (isset($_POST['id'])) {
                $tek = $this->getDoctrine()
                    ->getRepository(Tektura::class)
                    ->find($_POST['id']);
            } else {

                $form2 = $this->createForm(TekturaType::class, $tek);
                $form2->handleRequest($request);
                if (!$form2->isSubmitted())
                    return $this->redirectToRoute('tekturatektura');
                $tek = $this->getDoctrine()
                    ->getRepository(Tektura::class)
                    ->find($form2->get('id_post')->getData());
            }
            $form = $this->createForm(TekturaType::class, $tek);
            if (isset($_POST['id'])) {
                $form->get('id_post')->setData($_POST['id']);
            }
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tek);
                $entityManager->flush();
                return $this->redirectToRoute('tekturatektura');
            }


            return $this->render('tektura/Edycja.html.twig', [
                'form' => $form->createView(),
                'type' => 'edit'
            ]);
        } else {
            return $this->redirectToRoute('security_logout');
        }
    }
    /**
     * @Route("/apiNewTek",name="nowytekturaapi")
     */
    public function NewTekApi(Request $request)
    {
        if ($this->security->isGranted('ROLE_MODERATOR')) {
            $gramatura=$request->request->get('gramatura')==""?0:$request->request->get('gramatura');
            $pap = new Tektura();
            $pap->setGramatura($gramatura);
            $pap->setNazwa($request->request->get('nazwa'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pap);
            $entityManager->flush();

            $papiery = $this->getDoctrine()
                ->getRepository(Tektura::class)
                ->findAllSortedArr();

            $content = "";
            foreach ($papiery as $item) {
                $content .= "<option value='{$item['id']}'> {$item['nazwa']} {$item['gramatura']}</option>";
            }
            return new Response(
                $content
            );
        } else return $this->redirect('security_login');
    }
}
