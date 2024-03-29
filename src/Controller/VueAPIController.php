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
use App\Entity\LdapUser;
use App\Entity\Quota;
use App\Entity\User;
use App\Entity\UserRole;

class VueAPIController extends AbstractController
{

    /**
     * @Route("/", name="vueapi")
     */
    public function index(): Response
    {
        return $this->render('vue_api/index.html.twig', []);
    }

    /**
     * @Route("/epcommit", methods={"POST"})
     */
    public function commit(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $client = new Client(
            $request_data['client_name'],
            $request_data['client_last_name'],
            $request_data['client_email'],
            $request_data['client_phone'],
            $request_data['client_type']
        );

        $quota = new Quota();
        $quota->setPacketId($request_data['packet']);
        $quota->setExtraDiskSpace($request_data['extra_disk_space']);
        $quota->setExtraDbSpace($request_data['extra_db_space']);

        $site = new Site(
            $request_data['site_name'],
            $request_data['alias']
        );
        $site->setClient($client);
        $site->setQuota($quota);
        $site->setIndexName($request_data['index']);
        $site->setProtectedDir($request_data['protected_dir']);
        $site->setWebServerId($request_data['web_server']);
        $site->setPhpVersion($request_data['php_version']);
        $site->setNodeJs($request_data['node']);
        if ($request_data['database_server'] !== null && $request_data['database_server'] !== "") {
            $site->setDbServerId($request_data['database_server']);
            $site->setDbName($request_data['database_name']);
            $site->setDbUser($request_data['database_user']);
            $site->setDbPassword($request_data['database_password']);
        } else {
            $site->setDbServerId(0);
            $site->setDbName("");
            $site->setDbUser("");
            $site->setDbPassword("");
        }
        
        $site->setTemplateId($request_data['template']);
        $site->setTemplateVersion($request_data['template_version']);
        $site->setIPs($request_data['IPs']);
        $site->setHosted(False);
        $site->setModified(False);
        $site->setDeleted(False);

        foreach ($request_data['ldap_users'] as $ldap_user) {
            $ldap_user = new LdapUser($ldap_user['ldap_user'], $ldap_user['ldap_password']);
            $ldap_user->setSite($site);
            $entityManager->persist($ldap_user);
        }

        

        $entityManager->flush();

        return $this->json("inserted");
    }

    /**
     * @Route("/epupdate", methods={"POST", "GET"})
     */
    public function updateSite(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $site = $entityManager->getRepository(Site::class)->find($request_data['id']);
        $site->setName($request_data['site_name']);
        $site->setAlias($request_data['alias']);
        $site->setIndexName($request_data['index']);
        $site->setProtectedDir($request_data['protected_dir']);
        $site->setWebServerId($request_data['web_server']);
        $site->setPhpVersion($request_data['php_version']);
        $site->setNodeJs($request_data['node']);
        $site->setDbServerId($request_data['database_server']);
        if ($request_data['database_server'] == 0) {
            $site->setDbName("");
            $site->setDbUser("");
            $site->setDbPassword("");
        } else {
            $site->setDbName($request_data['database_name']);
            $site->setDbUser($request_data['database_user']);
            $site->setDbPassword($request_data['database_password']);
        }
        
        $site->setTemplateId($request_data['template']);
        $site->setTemplateVersion($request_data['template_version']);
        $site->setHosted($request_data['hosted']);
        $site->setIPs($request_data['IPs']);
        $site->setModified(true);

        $quota = $site->getQuota();
        $quota->setPacketId($request_data['packet']);
        $quota->setExtraDiskSpace($request_data['extra_disk_space']);
        $quota->setExtraDbSpace($request_data['extra_db_space']);

        $client = $site->getClient();
        $client->setName($request_data['client_name']);
        $client->setLastName($request_data['client_last_name']);
        $client->setEmail($request_data['client_email']);
        $client->setPhone($request_data['client_phone']);
        $client->setType($request_data['client_type']);

        $old_ldap_users = $site->getLdapUsers();
        foreach ($old_ldap_users as $user) {
            $entityManager->remove($user);
        }
        foreach ($request_data['ldap_users'] as $ldap_user) {
            $ldap_user = new LdapUser($ldap_user['ldap_user'], $ldap_user['ldap_password']);
            $ldap_user->setSite($site);
            $entityManager->persist($ldap_user);
        }
        $entityManager->flush();

        return $this->json("updated");
    }

    /**
     * @Route("/epdelete", methods={"POST"})
     */
    public function deleteSite(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $site = $entityManager->getRepository(Site::class)->find($request_data['id']);
        $site->setDeleted(True);
        $entityManager->flush();

        return $this->json("deleted");
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
        
        return $this->json($packets);
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
        
        return $this->json($servers);
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
        
        return $this->json($servers);
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
        
        return $this->json($templates);
    }

    /**
     * @Route("/epgetsites", methods={"POST"})
     */
    public function getSites(){
        $entityManager = $this->getDoctrine();
        $sites_response = $entityManager->getRepository(Site::class)->findAll();
        $sites = [];
        foreach ($sites_response as $site) {
            if($site->getDeleted() == False) {
                $sites[] = [
                    'id' => $site->getId(),
                    'site_name' => $site->getName(),
                    'alias' => $site->getAlias(),
                    'client' => $site->getClient()->getId(),
                    'client_name' => $entityManager->getRepository(Client::class)->find($site->getClient()->getId())->getName()
                    ." ".$entityManager->getRepository(Client::class)->find($site->getClient()->getId())->getLastName(),
                    'hosted' => $site->getHosted(),
                    'modified' => $site->getModified()
                ];
            }
            
        }
        
        return $this->json($sites);
    }

    /**
     * @Route("/epsitedata", methods={"POST"})
     */
    public function getSiteData(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $site = $entityManager->getRepository(Site::class)->find($request_data['site_id']);
        $web_server = $entityManager->getRepository(AvailableWebServer::class)->find($site->getWebServerId());
        $db_server = $entityManager->getRepository(DatabaseServer::class)->find($site->getDbServerId());
        $template = $entityManager->getRepository(Template::class)->find($site->getTemplateId());
        $client = $site->getClient();
        $quota = $site->getQuota();
        $packet = $entityManager->getRepository(Packet::class)->find($quota->getPacketId());
        $result = [
            'id' => $site->getId(),
            'site_name' => $request_data['site_name'],
            'alias' => $request_data['alias'],
            'web_server' => $web_server->getName(),
            'php_version' => $site->getPhpVersion(),
            'node' => $site->getNodeJs(),
            'db_server' => $db_server->getName(),
            'db_password' => $site->getDbPassword(),
            'db_user' => $site->getDbUser(),
            'db_name' => $site->getDbName(),
            'template' => $template->getName(),
            'template_version' => $site->getTemplateVersion(),
            'protected_dir' => $site->getProtectedDir(),
            'index' => $site->getIndexName(),
            'ldap_users' => [],
            'ldap_passwords' => [],
            'packet' => $packet->getName(),
            'disk_space' => $packet->getDiskSpace(),
            'db_space' => $packet->getDbSpace(),
            'extra_disk_space' => $quota->getExtraDiskSpace(),
            'extra_db_space' => $quota->getExtraDbSpace(),
            'client_name' => $client->getName(),
            'client_last_name' => $client->getLastName(),
            'client_email' => $client->getEmail(),
            'client_phone' => $client->getPhone(),
            'client_type' => $client->getType(),
            'hosted' => $site->getHosted(),
            'IPs' => $site->getIPs()
        ];
        foreach ($site->getLdapUsers() as $ldap_user) {
            $result['ldap_users'][] = $ldap_user->getUserName();
            $result['ldap_passwords'][] = $ldap_user->getPassword();
        }
        
        return $this->json($result);
    }

    /**
     * @Route("/epsitename", methods={"POST"})
     */
    public function getSiteName(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $result = $entityManager->getRepository(Site::class)->find($request_data['site'])->getName();
        
        return $this->json($result);
    }

    /**
     * @Route("/eplogin", methods={"POST"})
     */
    public function getUserFromDB(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $user = $entityManager->getRepository(User::class)->findOneBy(['username'=>$request_data['username'], 'password'=>md5($request_data['password'])]);
        $result = "";
        if ($user) {
            $result = [
                'username' => $user->getUserName(),
                'role' => $entityManager->getRepository(UserRole::class)->find($user->getRoleId())->getName()
            ];
        } else {
            $result = "incorrect";
        }
        
        return $this->json($result);
    }

    /**
     * @Route("/epgetusers", methods={"POST"})
     */
    public function getUsersList() {
        $entityManager = $this->getDoctrine()->getManager();
        $users_response = $entityManager->getRepository(User::class)->findAll();
        $users = [];
        foreach ($users_response as $user) {
            if ($user->getRoleId() != 3) {
                $users[] = [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'password' => $user->getPassword(),
                    'role' => $entityManager->getRepository(UserRole::class)->find($user->getRoleId())->getName()
                ];
            }
            
        }
        
        return $this->json($users);
    }

    /**
     * @Route("/epadduser", methods={"POST"})
     */
    public function addUser(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);

        $user = new User();
        $user->setUsername($request_data['username']);
        $user->setPassword(md5($request_data['password']));
        $user->setRoleId($request_data['role']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(true);
    }

    /**
     * @Route("/epupdateuser", methods={"POST"})
     */
    public function updateUser(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        
        $user = $entityManager->getRepository(User::class)->find($request_data['id']);
        $user->setUsername($request_data['username']);
        $user->setRoleId($request_data['role']);

        $entityManager->flush();

        return $this->json(true);
    }

    /**
     * @Route("/epupdatepassword", methods={"POST"})
     */
    public function updatePassword(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        
        $user = $entityManager->getRepository(User::class)->find($request_data['id']);
        $user->setPassword(md5($request_data['password']));

        $entityManager->flush();

        return $this->json(true);
    }

    /**
     * @Route("/epdeleteuser", methods={"POST"})
     */
    public function deleteUser(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        
        $user = $entityManager->getRepository(User::class)->find($request_data['id']);
        if ($user->getRoleId() != 3)
            $entityManager->remove($user);

        $entityManager->flush();

        return $this->json(true);
    }

    /**
     * @Route("/epuserroles", methods={"GET"})
     */
    public function getUserRoles() {
        $entityManager = $this->getDoctrine()->getManager();
        $roles_response = $entityManager->getRepository(UserRole::class)->findAll();
        $roles = [];
        foreach ($roles_response as $role) {
            $roles[] = ['id'=>$role->getId(), 'name'=>$role->getName()];
        }
        
        return $this->json($roles);
    }

    /**
     * @Route("/epchangepassword", methods={"POST"})
     */
    public function changePassword(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $response = null;

        //check current password
        $user = $entityManager->getRepository(User::class)->findOneBy(["username" => $request_data['username']]);
        if ($user->getPassword() != md5($request_data['old_password'])) {
            $response = $response = $this->json("incorrect password");
        }
        else if ($user->getPassword() == md5($request_data['old_password'])) {
            $user->setPassword(md5($request_data['password']));
            $entityManager->flush();
            $response = $this->json(true);
        }
        return $response;
    }

    /**
     * @Route("/epcheckpassword", methods={"POST"})
     */
    public function checkPassword(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $response = $this->json(false);

        $user = $entityManager->getRepository(User::class)->findOneBy(["username" => $request_data['username']]);
        if ($user->getPassword() == md5($request_data['password'])) {
            $response = $this->json(true);
        }
        return $response;

    }

    /**
     * @Route("/epgetusernames", methods={"POST"})
     */
    public function getUsernames() {
        $entityManager = $this->getDoctrine()->getManager();
        $users_response = $entityManager->getRepository(User::class)->findAll();
        $usernames = [];
        foreach ($users_response as $user) {
            $usernames[] = 
                $user->getUsername();
        }
        
        return $this->json($usernames);
    }

    /**
     * @Route("/epchangeusername", methods={"POST"})
     */
    public function changeUsername(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $request_data = \json_decode($request->getContent(), true);
        $user = $entityManager->getRepository(User::class)->findOneBy(["username" => $request_data['old_username']]);
        $auth = $user->getPassword() == md5($request_data['password']);
        $response = null;

        if($auth) {
            $user->setUsername($request_data['username']);
            $entityManager->flush();
            $response = $this->json(true);
        }
        else {
            $response = $this->json("incorrect password");
        }
        return $response;
    }

    /**
     * @Route("/epsitesstats", methods={"POST"})
     */
    public function getStats() {
        $entityManager = $this->getDoctrine()->getManager();
        $hosted = 0;
        $modified = 0;
        $deleted = 0;

        $php_node = 0;
        $tomcat = 0;
        $no_db = 0;
        $mysql = 0;
        $postgres = 0;

        $sites = $entityManager->getRepository(Site::class)->findAll();
        foreach ($sites as $site) {
            if($site->getDeleted() == False) {
                $hosted++;
                if($site->getModified()) {
                    $modified++;
                }
                if($site->getWebServerId() == 1) {
                    $php_node++;
                }
                else if($site->getWebServerId() == 2) {
                    $tomcat++;
                }
                if($site->getDbServerId() == 0) {
                    $no_db++;
                }
                else if($site->getDbServerId() == 1) {
                    $mysql++;
                }
                else if($site->getDbServerId() == 2) {
                    $postgres++;
                }
            } 
            else if($site->getDeleted() == True) {
                $deleted++;
            } 
        }
        $stats = [
            'hosted' => $hosted,
            'modified' => $modified,
            'deleted' => $deleted,
            'php_node' => $php_node,
            'tomcat' => $tomcat,
            'no_db' => $no_db,
            'mysql' => $mysql,
            'postgres' => $postgres
        ];

        return $this->json($stats);
    }

}
