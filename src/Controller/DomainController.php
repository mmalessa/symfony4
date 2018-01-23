<?php
namespace App\Controller;

use App\Application\Command\DeleteDomain;
use App\Application\Command\ModifyDomains;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Application\Command\AddDomain;
use Ramsey\Uuid\Uuid;

class DomainController extends Controller
{

    /**
     * @Route("/", name="list_all")
     */
    public function listAll()
    {
        $domainRepository = $this->container->get('domain_repository');
        $repo = '?';
        if (property_exists($domainRepository, 'em')) {
            $repo = 'Doctrine';
        } elseif (property_exists($domainRepository, 'connection')) {
            $repo = 'DBAL';
        }

        $domains = $this->container->get('domain_query')->listAll();
        return $this->render('domain/domain.html.twig', [
            'repo' => $repo,
            'domains' => $domains
        ]);
    }

    /**
     * @Route("/add", name="add_domain")
     */
    public function addDomain()
    {
        $groupId = $this->getRandomGroupId();

        $id = Uuid::uuid1()->getHex();
        $domain = new AddDomain($id, 'http://www.name' . rand(100,999) . '.com', $groupId);
        $this->container->get('commandbus')->handle($domain);
        return $this->redirectToRoute('list_all');
    }

    /**
     * @Route("/delete/{id}", name="delete_id")
     */
    public function deleteDomain($id)
    {
        $domain = new DeleteDomain($id);
        $this->container->get('commandbus')->handle($domain);
        return $this->redirectToRoute('list_all');
    }

    /**
     * @Route("/change/{id}", name="change_id")
     */
    public function changeDomain($id)
    {
        $groupId = $this->getRandomGroupId();

        $domain = new AddDomain(
            $id,
            "https://www.changed" . rand(100, 999) . ".com",
            $groupId
        );
        $this->container->get('commandbus')->handle($domain);
        return $this->redirectToRoute('list_all');
    }

    /**
     * @Route("/modifyAll", name="modify_all")
     */
    public function modifyDomains()
    {
        $groupId = $this->getRandomGroupId();

        $domains = $this->container->get('domain_query')->listAll();
        $ids = array_map(function($row) { return $row['id']; }, $domains);

        $modifyDomains = new ModifyDomains($ids, $groupId);

        $this->container->get('commandbus')->handle($modifyDomains);

        return $this->redirectToRoute('list_all');
    }

    private function getRandomGroupId()
    {
        $groups = $this->container->get('group_query')->listAll();
        if (count($groups) == 0) {
            $groupId = null;
        }
        shuffle($groups);
        return $groups[0]['id'];
    }

}
