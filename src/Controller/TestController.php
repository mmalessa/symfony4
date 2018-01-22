<?php
namespace App\Controller;

use App\Application\Command\DeleteDomain;
use App\Application\Command\ModifyDomains;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Application\Command\AddDomain;
use Ramsey\Uuid\Uuid;

class TestController extends Controller
{

    /**
     * @Route("/", name="list_all")
     */
    public function listAll()
    {
        $domains = $this->container->get('domain_query')->listAll();

        $domainRepository = $this->container->get('domain_repository');
        $repo = '?';
        if (property_exists($domainRepository, 'em')) {
            $repo = 'Doctrine';
        } elseif (property_exists($domainRepository, 'connection')) {
            $repo = 'DBAL';
        }


        return $this->render('test.html.twig', [
            'domains' => $domains,
            'repo' => $repo
        ]);
    }

    /**
     * @Route("/add", name="add_domain")
     */
    public function addDomain()
    {
        $id = Uuid::uuid1()->getHex();
        $domain = new AddDomain($id, 'http://www.name' . rand(100,999) . '.com', rand(10,99));
        $this->container->get('commandbus')->handle($domain);

        return $this->redirectToRoute('list_all');
        //return $this->forward('App\Controller\TestController::listAll', []);
    }

    /**
     * @Route("/delete/{id}", name="delete_id")
     */
    public function deleteDomain($id)
    {
        $domain = new DeleteDomain($id);
        $this->container->get('commandbus')->handle($domain);

        return $this->redirectToRoute('list_all');
        //return $this->forward('App\Controller\TestController::listAll', []);
    }

    /**
     * @Route("/change/{id}", name="change_id")
     */
    public function changeDomain($id)
    {
        $domain = new AddDomain(
            $id,
            "https://www.changed" . rand(100, 999) . ".com",
            rand(10,99)
        );
        $this->container->get('commandbus')->handle($domain);

        return $this->redirectToRoute('list_all');
        //return $this->forward('App\Controller\TestController::listAll', []);
    }

    /**
     * @Route("/modifyAll", name="modify_all")
     */
    public function modifyDomains()
    {
        $domains = $this->container->get('domain_query')->listAll();
        $ids = array_map(function($row) { return $row['id']; }, $domains);

        $modifyDomains = new ModifyDomains($ids);
        $this->container->get('commandbus')->handle($modifyDomains);

        return $this->redirectToRoute('list_all');
        //return $this->forward('App\Controller\TestController::listAll', []);
    }

}