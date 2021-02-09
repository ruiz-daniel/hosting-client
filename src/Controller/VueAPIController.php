<?php

namespace App\Controller;

use App\Entity\AvailableWebServer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Client;
use App\Entity\DatabaseServer;
use App\Entity\Packet;
use App\Entity\Site;
use App\Entity\Template;
use App\Entity\Contract;
use App\Entity\HostedSite;
use App\Entity\LdapUser;

class VueAPIController extends AbstractController
{
    /**
     * @Route("/test", name="vueindex", methods={"GET"})
     */
    public function main(){
        return $this->render('main/mainForm.html.twig', []);
    }

    /**
     * @Route("/", name="vueapi")
     */
    public function index(): Response
    {
        return $this->render('vue_api/index.html.twig', []);
    }

    /**
     * @Route("/epcommit", methods={"POST", "GET"})
     */
    public function commit(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $client = new Client(
            $request_data['ldap_name'],
            $request_data['ldap_last_name'],
            $request_data['ldap_email'],
            $request_data['ldap_phone'],
            $request_data['client']
        );

        $site = new Site(
            $request_data['site_name'],
            $request_data['alias']
        );
        $site->setClient($client);
        $entityManager->persist($site);

        $contract = new Contract(
            $request_data["extra_disk_space"],
            $request_data["extra_db_space"],
            $request_data['packet']
        );
        $contract->setClient($client);
        $entityManager->persist($contract);

        $ldapUser = new LdapUser(
            $request_data["ldap_user"],
            $request_data["ldap_password"]
        );
        $ldapUser->setClient($client);
        $entityManager->persist($ldapUser);

        $hosted_site = new HostedSite(
            $request_data["web_server"],
            $request_data["php_version"],
            $request_data["node"],
            $request_data["database_server"],
            $request_data["database_password"],
            $request_data["template"],
            $request_data["template_version"],
            $request_data["protected_files"],
            $request_data["index"]
        );
        $hosted_site->setSite($site);
        $hosted_site->setLdapUser($ldapUser);
        $entityManager->persist($hosted_site);

        $entityManager->flush();

        return $this->render('vue_api/index.html.twig', []);
    }

    /**
     * @Route("/eppackets", methods={"GET"})
     */
    public function getPackets(){
        $entityManager = $this->getDoctrine()->getManager();
        $packets_response = $entityManager->getRepository(Packet::class)->findAll();
        // var_dump($packets[0]->getName());
        $packets = [];
        foreach ($packets_response as $packet) {
            $packets[] = ['id'=>$packet->getId(), 'name'=>$packet->getName(), 'disk_space'=>$packet->getDiskSpace(), 'db_space'=>$packet->getDbSpace(), 'client_type'=>$packet->getClientType()] ;
        }
        $response = new Response(
            \json_encode($packets),
            200,
            ['content-type' => 'json'],
        );
        return $response;
    }

    /**
     * @Route("/epwebservers", methods={"GET"})
     */
    public function getWebServers(){
        $entityManager = $this->getDoctrine()->getManager();
        $servers_response = $entityManager->getRepository(AvailableWebServer::class)->findAll();
        $servers = [];
        foreach ($servers_response as $server) {
            $servers[] = ['id'=>$server->getId(), 'name'=>$server->getName()];
        }
        $response = new Response(
            \json_encode($servers),
            200,
            ['content-type' => 'json']
        );
        return $response;
    }

    /**
     * @Route("/epdbservers", methods={"GET"})
     */
    public function getDatabaseServers(){
        $entityManager = $this->getDoctrine()->getManager();
        $servers_response = $entityManager->getRepository(DatabaseServer::class)->findAll();
        $servers = [];
        foreach ($servers_response as $server) {
            $servers[] = ['id'=>$server->getId(), 'name'=>$server->getName()];
        }
        $response = new Response(
            \json_encode($servers),
            200,
            ['content-type' => 'json']
        );
        return $response;
    }

    /**
     * @Route("/eptemplates", methods={"GET"})
     */
    public function getTemplates(){
        $entityManager = $this->getDoctrine()->getManager();
        $templates_response = $entityManager->getRepository(Template::class)->findAll();
        $templates = [];
        foreach ($templates_response as $template) {
            $templates[] = ['id'=>$template->getId(), 'name'=>$template->getName(), 'web_technology_type'=>$template->getWebTechnologyType()];
        }
        $response = new Response(
            \json_encode($templates),
            200,
            ['content-type' => 'json']
        );
        return $response;
    }

    /**
     * @Route("/epgetsites", methods={"GET"})
     */
    public function getSites(){
        $entityManager = $this->getDoctrine();
        $sites_response = $entityManager->getRepository(Site::class)->findAll();
        $sites = [];
        foreach ($sites_response as $site) {
            $sites[] = [
                'id' => $site->getId(),
                'site_name' => $site->getName(),
                'alias' => $site->getAlias(),
                'client' => $site->getClient()->getId(),
                'client_name' => $entityManager->getRepository(Client::class)->find($site->getClient()->getId())->getName()
                ." ".$entityManager->getRepository(Client::class)->find($site->getClient()->getId())->getLastName()
            ];
        }
        $response = new Response(
            \json_encode($sites),
            200,
            ['content-type' => 'json']
        );
        return $response;
    }

    /**
     * @Route("/epsitedata", methods={"POST"})
     */
    public function getSiteData(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        
    }

    /**
     * @Route("/epsitename", methods={"POST"})
     */
    public function getSiteName(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $result = $entityManager->getRepository(Site::class)->find($request_data['site'])->getName();
        $response = new Response(
            \json_encode($result),
            200,
            ['content-type' => 'json']
        );
        return $response;
    }
}
