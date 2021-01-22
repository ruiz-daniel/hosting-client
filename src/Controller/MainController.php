<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Contract;
use App\Entity\FormData;
use App\Entity\HostedSite;
use App\Entity\LdapUser;
use App\Entity\Site;
use App\Form\MainFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        // return $this->render('main/index.html.twig', [
        //     'controller_name' => 'MainController',
        // ]);
        $formData = new FormData();
        $form = $this->createForm(MainFormType::class, $formData);
        return $this->render('main/vueForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/viewdata/", name="view", methods={"POST", "GET"})
     */
    public function viewdata(Request $request)
    {
        $node = 0;
        if (isset($_POST['node'])) $node = 1;

        return $this->render('main/viewdata.html.twig', [
            'site_name' => $_POST['site_name'],
            'client' => $_POST['client'],
            'node' => $node,
            'template_version' => $_POST['template_version'],
            'protectedfiles' => $_POST['protectedfiles'],
            'index' => $_POST['index'],
            'web_server' => $_POST['web_server'],
            'php_version' => $_POST['php_version'],
            'db' => $_POST['db'],
            'alias' => $_POST['alias'],
            
            'diskspace' => $_POST['diskspace'],
            'extradiskspace' => $_POST['extradiskspace'],
            'dbspace' => $_POST['dbspace'],
            'extradbspace' => $_POST['extradbspace'],
            'dbpass' => $_POST['dbpass'],
            'ldapname' => $_POST['ldapname'],
            'ldaplastname' => $_POST['ldaplastname'],
            'ldapemail' => $_POST['ldapemail'],
            'ldapphone' => $_POST['ldapphone'],
            'ldappass' => $_POST['ldappass'],
        ]);
    }

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

        $site = new Site(
            $_POST['site_name'],
            $_POST['alias']
        );
        $site->setClient($client);
        $entityManager->persist($site);

        $contract = new Contract(
            $request->query->get("diskspace"),
            $request->query->get("extradiskspace"),
            $request->query->get("dbspace"),
            $request->query->get("extradbspace")
        );
        $contract->setClient($client);
        $entityManager->persist($contract);

        $ldapUser = new LdapUser(
            $request->query->get("site_name")."ftp",
            $request->query->get("ldappass")
        );
        $ldapUser->setClient($client);
        $entityManager->persist($ldapUser);

        $hosted_site = new HostedSite(
            $request->query->get("webserver"),
            $request->query->get("phpversion"),
            $request->query->get("node"),
            $request->query->get("db"),
            $request->query->get("dbpass"),
            $request->query->get("webtechname"),
            $request->query->get("version"),
            $request->query->get("protectedfiles"),
            $request->query->get("index")
        );
        $hosted_site->setSite($site);
        $hosted_site->setLdapUser($ldapUser);
        $entityManager->persist($hosted_site);

        $entityManager->flush();

        $database = "";
        $node = "";
        $web_server = "";
        $web_tech = "";

        if($request->query->get("db") == "1") $database = "MySQL";
        else if ($request->query->get("db") == "2") $database = "PostgreSQL";

        if($request->query->get("node") == "1") $node = "Sí";
        else $node = "No";

        if($request->query->get("webserver") == "1") $web_server = "Apache/PHP/Node.js";
        else if ($request->query->get("webserver") == "2") $web_server = "Apache Tomcat";

        if ($request->query->get("webtech") == "1") $web_tech = "Framework";
        else if ($request->query->get("webtech") == "2") $web_tech = "LMS";
        else if ($request->query->get("webtech") == "3") $web_tech = "CMS";
        else if ($request->query->get("webtech") == "4") $web_tech = "Desarrollo Autónomo";

        return $this->render('main/viewdata.html.twig', [
            'site_name' => $request->query->get("site_name"),
            'site_dom' => $request->query->get("site_dom"),
            'node' => $node,
            'webtechname' => $request->query->get("webtechname"),
            'version' => $request->query->get("version"),
            'protectedfiles' => $request->query->get("protectedfiles"),
            'index' => $request->query->get("index"),
            'webserver' => $web_server,
            'phpversion' => $request->query->get("phpversion"),
            'webtech' => $web_tech,
            'db' => $database,
            'alias' => $request->query->get("alias"),
            'client' => $request->query->get("client"),
            'diskspace' => $request->query->get("diskspace")." MB",
            'extradiskspace' => $request->query->get("extradiskspace")." MB",
            'dbspace' => $request->query->get("dbspace")." MB",
            'extradbspace' => $request->query->get("extradbspace")." MB",
            'dbpass' => $request->query->get("dbpass"),
            'ldapname' => $request->query->get("ldapname"),
            'ldaplastname' => $request->query->get("ldaplastname"),
            'ldapemail' => $request->query->get("ldapemail"),
            'ldapphone' => $request->query->get("ldapphone"),
            'ldappass' => $request->query->get("ldappass"),
        ]);
    }

    /**
     * @Route("/formSite/", name = "formSite")
     */
    public function formSite(Request $request){
        $formData = new FormData();
        $form = $this->createForm(MainFormType::class, $formData);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formData);

            $entityManager->flush();
        }

        return $this->render('main/mainForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //EndPoint Routes

    /**
     * @Route("/EPcommit/", name = "commit")
     */
}
