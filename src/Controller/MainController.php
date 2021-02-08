<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Contract;
use App\Entity\FormData;
use App\Entity\HostedSite;
use App\Entity\LdapUser;
// use App\Entity\Site;
use App\Form\MainFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{

    /**
     * @Route("/persistSite/", name = "persistSite", methods={"{POST}"})
     */
    public function peristSite(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $client = new Client(
            $_POST['ldapname'],
            $_POST['ldaplastname'],
            $_POST['ldapemail'], 
            $_POST['ldapphone'],
            $_POST['client']
        );

        // $site = new Site(
        //     $_POST['site_name'],
        //     $_POST['alias']
        // );
        // $site->setClient($client);
        // $entityManager->persist($site);

        $contract = new Contract(
            $_POST["extradiskspace"],
            $_POST["extradbspace"],
            $_POST['packet']
        );
        $contract->setClient($client);
        $entityManager->persist($contract);

        $ldapUser = new LdapUser(
            $_POST["site_name"]."ftp",
            $_POST["ldappass"]
        );
        $ldapUser->setClient($client);
        $entityManager->persist($ldapUser);

        $hosted_site = new HostedSite(
            $_POST["webserver"],
            $_POST["phpversion"],
            $_POST["node"],
            $_POST["db"],
            $_POST["dbpass"],
            $_POST["template"],
            $_POST["version"],
            $_POST["protectedfiles"],
            $_POST["index"]
        );
        //$hosted_site->setSite($site);
        $hosted_site->setLdapUser($ldapUser);
        $entityManager->persist($hosted_site);

        $entityManager->flush();

        $formData = new FormData();
        $form = $this->createForm(MainFormType::class, $formData);
        $form->handleRequest($request);

        return $this->render('main/mainForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/form_symfony/", name = "formSymfony")
     */
    public function index(Request $request){
        $formData = new FormData();
        $form = $this->createForm(MainFormType::class, $formData);
        $form->handleRequest($request);

        return $this->render('main/mainForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
