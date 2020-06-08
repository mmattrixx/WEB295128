<?php


namespace App\Controller;


use App\Entity\Papier;
use App\Entity\Pomiary;
use App\Entity\Tektura;
use App\Entity\User;
use DateTime;
use DoctrineExtensions\Query\Mysql\Date;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class ListaPomiarowController extends AbstractController
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;
    /**
     * @var Security
     */
    private $security;

    /**
     * ListaPomiarowController constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {

        $this->security = $security;
    }

    /**
     * @Route("/", name="Wszystkie_pomiaryT200")
     */
    public function main()
    {
        if($this->security->isGranted('ROLE_ONLYSHOW')) {
            $products = $this->getDoctrine()
                ->getRepository(Pomiary::class)
                ->findByYearT200(date('Y'));

            return $this->render('ListaPomiarow/WszystkiePomiaryT200.html.twig', [
                'prod' => $products,
                'current_Year' => date('Y')
            ]);
        }
        else {
            $this->security->getToken()->eraseCredentials();
            return $this->redirectToRoute('security_logout');
        }

    }
    /**
     * @Route("/WszystkiePomiary", name="Wszystkie_pomiary")
     */
    public function AllPom()
    {
        if($this->security->isGranted('ROLE_ONLYSHOW')) {
            $products = $this->getDoctrine()
                ->getRepository(Pomiary::class)
                ->findByYear(date('Y'));

            return $this->render('ListaPomiarow/WszystkiePomiary.html.twig', [
                'prod' => $products,
                'current_Year' => date('Y')
            ]);
        }
        else {
            $this->security->getToken()->eraseCredentials();
            return $this->redirectToRoute('security_logout');
        }

    }

    /**
     * @Route("/search",name="searchEtc")
     */
    public function Search(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_ONLYSHOW');

        $tektury = $this->getDoctrine()
            ->getRepository(Tektura::class)
            ->findAllSorted();
        $papiery = $this->getDoctrine()
            ->getRepository(Papier::class)
            ->findAllSorted();
        $users=$this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $dataForm=[
            1=>'Pomiar 1',
            2=>'Pomiar 2',
            3=>'Pomiar 3',
            4=>'Pomiar 4',
            5=>'Pomiar 5',
            6=>'Numer Programu',
            7=>'Numer Zlecenia',
            8=>'ECT MAX',
            9=>'ECT MIN',
            10=>'ECT Średnie',
            11=>'Odchylenie standardowe',
            12=>'Waga',
            13=>'Temperatura',
            14=>'Wilgotność ',
            15=>'Wilgotność Tektury',
            16=>'Grubość Tektury'

        ];

        //searchToken
        $submittedToken = $request->request->get('token');

        // 'delete-item' is the same value used in the template to generate the token
        if ($this->isCsrfTokenValid('searchToken', $submittedToken)) {
            $wyniki = $this->getDoctrine()
                ->getRepository(Pomiary::class)
                ->findBySearchFilters($request->request->all());
            return $this->render('ListaPomiarow/Szukaj.html.twig', [
                'findForm'=>$dataForm,
                'tektury'=>$tektury,
                'papiery'=>$papiery,
                'hideFilter'=>1,
                'prod'=>$wyniki,
                'users'=>$users
            ]);
        }
        else{
            return $this->render('ListaPomiarow/Szukaj.html.twig', [
                'findForm'=>$dataForm,
                'tektury'=>$tektury,
                'papiery'=>$papiery,
                'hideFilter'=>0,
                'prod'=>'',
                'users'=>$users
            ]);
        }



    }

    /**
     * @Route("/pomiary/{rok}", name="Wszystkie_pomiary_rok")
     */
    public function ListByYear($rok)
    {
        if($this->security->isGranted('ROLE_ONLYSHOW')) {
            $products = $this->getDoctrine()
                ->getRepository(Pomiary::class)
                ->findByYear($rok);

            return $this->render('ListaPomiarow/WszystkiePomiary.html.twig', [
                'prod' => $products,
                'current_Year' => $rok
            ]);
        }
        else {
            return $this->redirectToRoute('security_logout');
        }

    }
    /**
     * @Route("/pomiary/top200/{rok}", name="Wszystkie_pomiary_rok_t200")
     */
    public function ListByYearT200($rok)
    {
        if($this->security->isGranted('ROLE_ONLYSHOW')) {
            $products = $this->getDoctrine()
                ->getRepository(Pomiary::class)
                ->findByYearT200($rok);

            return $this->render('ListaPomiarow/WszystkiePomiaryT200.html.twig', [
                'prod' => $products,
                'current_Year' => $rok
            ]);
        }
        else {
            return $this->redirectToRoute('security_logout');
        }

    }


    /**
     * @Route("/kasuj/{id}",name="pomiary_kasuj")
     */
    public function delete($id){
        if($this->security->isGranted('ROLE_ADMIN')) {
            $entityManager = $this->getDoctrine()->getManager();
            $product = $entityManager->getRepository(Pomiary::class)->find($id);
            $entityManager->remove($product);
            $entityManager->flush();
            return $this->redirectToRoute('Wszystkie_pomiary');
        }
        else {
            return $this->redirectToRoute('security_logout');
        }

    }/**
     * @Route("/edycja/{id}",name="pomiary_edycja")
     */
    public function Edit($id,Request $request){
        if($this->security->isGranted('ROLE_MODERATOR')) {
        $entityManager = $this->getDoctrine()->getManager();
        $pomiar = $entityManager->getRepository(Pomiary::class)->find($id);
        $tektury=$entityManager->getRepository(Tektura::class)->findAllSorted();
        $papiery=$entityManager->getRepository(Papier::class)->findAllSorted();

        $submittedToken = $request->request->get('token');

        // 'delete-item' is the same value used in the template to generate the token
        if ($this->isCsrfTokenValid('edit-item', $submittedToken)) {
           $pomiar->setTektura($entityManager->getRepository(Tektura::class)->find($request->request->get('tektura')));
           $pomiar->setPokrycie1($entityManager->getRepository(Papier::class)->find($request->request->get('pokrycie1')));
           $pomiar->setPokrycie2($entityManager->getRepository(Papier::class)->find($request->request->get('pokrycie2')));
           $pomiar->setPokrycie3($entityManager->getRepository(Papier::class)->find($request->request->get('pokrycie3')));
           $pomiar->setFala1($entityManager->getRepository(Papier::class)->find($request->request->get('fala1')));
           $pomiar->setFala2($entityManager->getRepository(Papier::class)->find($request->request->get('fala2')));
           $pomiar->setNumerProgramu($request->request->get('numerProgramu'));
           $pomiar->setGruboscTektury($request->request->get('grubosc'));
           $pomiar->setWilgotnoscMierzona($request->request->get('wilgotnosc'));
           $entityManager->flush();
            return $this->redirectToRoute('Wszystkie_pomiary');
        }
        return $this->render('ListaPomiarow/EdycjaPomiary.html.twig', [
            'pomiar' => $pomiar,
            'tektury'=>$tektury,
            'papiery'=>$papiery

        ]);
        }
        else {
            return $this->redirectToRoute('security_logout');
        }
    }

    /**
     * @Route("/nowy",name="Nowy_pomiar")
     */
    public function nowyPomiar(Request $request,Security $security)
    {
        if($this->security->isGranted('ROLE_MODERATOR')) {
        $submittedToken = $request->request->get('token');

        // 'delete-item' is the same value used in the template to generate the token
        if ($this->isCsrfTokenValid('new-item', $submittedToken)) {

            if(isset($_FILES['MyFile'])){

                $name=explode(".",$_FILES['MyFile']['name']);
                if($name[count($name)-1]=='inf') {


                    $data = NULL;
                    $czas = NULL;
                    $nr_zlecenia = NULL;
                    $waga = NULL;
                    $temperatura = NUll;
                    $wilgotnosc = NULL;
                    $pomiar1 = NULL;
                    $pomiar2 = NULL;
                    $pomiar3 = NULL;
                    $pomiar4 = NULL;
                    $pomiar5 = NULL;

                    if ($dataFile = file_get_contents($_FILES['MyFile']['tmp_name'])) {
                        $arr_temp = explode("\n", $dataFile);
                        foreach ($arr_temp as $i => $item) {
                            $arr_temp2 = explode("=", $arr_temp[$i]);
                            $arr_temp2 = explode("=", $arr_temp[$i]);
                            //echo "arr_temp2[0]=[".$arr_temp2[0]."] input_string=[".$input_string."] arr_temp2[1]=".$arr_temp2[1]."<br>";
                            //echo "arr_temp2=".$arr_temp2[0]."=".$arr_temp2[1]."<br>";
                            if (trim($arr_temp2[0]) == "1.y") {
                                $pomiar1 = $arr_temp2[1];
                            }
                            if (trim($arr_temp2[0]) == "2.y") {
                                $pomiar2 = $arr_temp2[1];
                            }
                            if (trim($arr_temp2[0]) == "3.y") {
                                $pomiar3 = $arr_temp2[1];
                            }
                            if (trim($arr_temp2[0]) == "4.y") {
                                $pomiar4 = $arr_temp2[1];
                            }
                            if (trim($arr_temp2[0]) == "5.y") {
                                $pomiar5 = $arr_temp2[1];
                            }
                            if (trim($arr_temp2[0]) == "3") {
                                $waga = $arr_temp2[1];
                            }
                            if (trim($arr_temp2[0]) == "6") {
                                $data = $arr_temp2[1];
                            }
                            if (trim($arr_temp2[0]) == "7") {
                                $czas = $arr_temp2[1];
                            }
                            if (trim($arr_temp2[0]) == "8") {
                                $temperatura = $arr_temp2[1];
                                if (!(($temperatura) > 0)) {
                                    $temperatura = 0;
                                }
                            }
                            if (trim($arr_temp2[0]) == "9") {
                                $wilgotnosc = $arr_temp2[1];
                                if (!(($wilgotnosc) > 0)) {
                                    $wilgotnosc = 0;
                                }
                            }
                            if (trim($arr_temp2[0]) == "10") {
                                $nr_zlecenia = $arr_temp2[1];
                                if ((!(($nr_zlecenia) > 0))) {
                                    $nr_zlecenia = 0;
                                }
                            }
                        }
                        $pomiar1 = str_replace(",", ".", trim($pomiar1));
                        $pomiar2 = str_replace(",", ".", trim($pomiar2));
                        $pomiar3 = str_replace(",", ".", trim($pomiar3));
                        $pomiar4 = str_replace(",", ".", trim($pomiar4));
                        $pomiar5 = str_replace(",", ".", trim($pomiar5));


                        if (!(($pomiar1) > 0)) {
                            $pomiar1 = 0;
                        }
                        if (!(($pomiar2) > 0)) {
                            $pomiar2 = 0;
                        }
                        if (!(($pomiar3) > 0)) {
                            $pomiar3 = 0;
                        }
                        if (!(($pomiar4) > 0)) {
                            $pomiar4 = 0;
                        }
                        if (!(($pomiar5) > 0)) {
                            $pomiar5 = 0;
                        }

                        $liczbaPomiarow = 0;
                        if ($pomiar1 > 0) {
                            $liczbaPomiarow = $liczbaPomiarow + 1;
                        }
                        if ($pomiar2 > 0) {
                            $liczbaPomiarow = $liczbaPomiarow + 1;
                        }
                        if ($pomiar3 > 0) {
                            $liczbaPomiarow = $liczbaPomiarow + 1;
                        }
                        if ($pomiar4 > 0) {
                            $liczbaPomiarow = $liczbaPomiarow + 1;
                        }
                        if ($pomiar5 > 0) {
                            $liczbaPomiarow = $liczbaPomiarow + 1;
                        }
                        if ($liczbaPomiarow == 0) {
                            $srednia = 0;
                            $liczbaPomiarow = 1;

                            $odchylenieStd = 0;
                            if ($pomiar1 > 0) {
                                $odchylenieStd = +pow(($pomiar1 - $srednia), 2);
                            }
                            if ($pomiar2 > 0) {
                                $odchylenieStd = +pow(($pomiar2 - $srednia), 2);
                            }
                            if ($pomiar3 > 0) {
                                $odchylenieStd = +pow(($pomiar3 - $srednia), 2);
                            }
                            if ($pomiar4 > 0) {
                                $odchylenieStd = +pow(($pomiar4 - $srednia), 2);
                            }
                            if ($pomiar5 > 0) {
                                $odchylenieStd = +pow(($pomiar5 - $srednia), 2);
                            }
                            $odchylenieStd = sqrt((1 / ($liczbaPomiarow - 2)) * $odchylenieStd);

                        } else {
                            $srednia = ($pomiar1 + $pomiar2 + $pomiar3 + $pomiar4 + $pomiar5) / $liczbaPomiarow;

                            $odchylenieStd = 0;
                            if ($pomiar1 > 0) {
                                $odchylenieStd = +pow(($pomiar1 - $srednia), 2);
                            }
                            if ($pomiar2 > 0) {
                                $odchylenieStd = +pow(($pomiar2 - $srednia), 2);
                            }
                            if ($pomiar3 > 0) {
                                $odchylenieStd = +pow(($pomiar3 - $srednia), 2);
                            }
                            if ($pomiar4 > 0) {
                                $odchylenieStd = +pow(($pomiar4 - $srednia), 2);
                            }
                            if ($pomiar5 > 0) {
                                $odchylenieStd = +pow(($pomiar5 - $srednia), 2);
                            }
                            $odchylenieStd=0;
                            if(($liczbaPomiarow - 1)!=0){
                                $odchylenieStd = sqrt((1 / ($liczbaPomiarow - 1)) * $odchylenieStd);
                            }



                        }


                        if ($pomiar1 == 0) {
                            $pomiar1min = 100000;
                        } else {
                            $pomiar1min = $pomiar1;
                        }
                        if ($pomiar2 == 0) {
                            $pomiar2min = 100000;
                        } else {
                            $pomiar2min = $pomiar2;
                        }
                        if ($pomiar3 == 0) {
                            $pomiar3min = 100000;
                        } else {
                            $pomiar3min = $pomiar3;
                        }
                        if ($pomiar4 == 0) {
                            $pomiar4min = 100000;
                        } else {
                            $pomiar4min = $pomiar4;
                        }
                        if ($pomiar5 == 0) {
                            $pomiar5min = 100000;
                        } else {
                            $pomiar5min = $pomiar5;
                        }


                        $user = $security->getUser();
                        $pomiar = new Pomiary();
                        $pomiar->setUser($user);
                        $pomiar->setDataWykonania(new DateTime(trim($data)." ".trim($czas)));
                        $pomiar->setNumerZlecenia(addslashes(($nr_zlecenia)));
                        $pomiar->setPomiar1(str_replace(",",".",trim($pomiar1)));
                        $pomiar->setPomiar2(str_replace(",",".",trim($pomiar2)));
                        $pomiar->setPomiar3(str_replace(",",".",trim($pomiar3)));
                        $pomiar->setPomiar4(str_replace(",",".",trim($pomiar4)));
                        $pomiar->setPomiar5(str_replace(",",".",trim($pomiar5)));
                        $pomiar->setEctMax(str_replace(",",".",trim(max($pomiar1,$pomiar2,$pomiar3,$pomiar4,$pomiar5))));
                        $pomiar->setEctMin(str_replace(",",".",trim(min($pomiar1,$pomiar2,$pomiar3,$pomiar4,$pomiar5))));
                        $pomiar->setEctAvg(str_replace(",",".",trim(($pomiar1+$pomiar2+$pomiar3+$pomiar4+$pomiar5)/$liczbaPomiarow)));
                        $pomiar->setStandardDeviation(str_replace(",",".",trim($odchylenieStd)));
                        $pomiar->setWaga(str_replace(",",".",trim($waga)));
                        $pomiar->setTemperaturaEct(str_replace(",",".",trim($temperatura)));
                        $pomiar->setWilgotnoscEct(str_replace(",",".",trim($wilgotnosc)));
                        $pomiar->setWilgotnoscMierzona(0);
                        $pomiar->setGruboscTektury(0);
                        $pomiar->setNumerProgramu('');





                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($pomiar);
                        $entityManager->flush();

                         return $this->redirectToRoute('pomiary_edycja',['id'=> $pomiar->getId()]);

                    }
                }
                else {
                    return $this->render('ListaPomiarow/NowyPomiar.html.twig', [
                        'error'=>'Błędne rozszerzenie '
                    ]);
                }
            }
            else {
                return $this->render('ListaPomiarow/NowyPomiar.html.twig', [
                    'error'=>'Błąd dodawania pliku '
                ]);
            }

        }




        return $this->render('ListaPomiarow/NowyPomiar.html.twig', [
            'error'=>false
        ]);
        }
        else {
            $this->security->getToken()->eraseCredentials();
            return $this->redirectToRoute('security_logout');
        }
    }


}