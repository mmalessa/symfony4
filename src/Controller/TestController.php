<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Application\Command\AddDomain;

class TestController extends Controller
{

    /**
     * @Route("/", name="list_all")
     */
    public function listAll()
    {
        $domains = $this->container->get('domain_query')->listAll();
        ob_start();
        dump($domains);
        $response = ob_get_clean();
        return new Response('<html><body><pre>' . $response . '</body></html>');
    }

    /**
     * @Route("/add")
     */
    public function addDomain()
    {
        $domain = new AddDomain([
            'name' => 'www.name' . rand(100000,999999) . '.com',
            'registerId' => rand(1,100)
        ]);

        $this->container->get('add_domain_handler')->handle($domain);

        //return $this->redirectToRoute('list_all');
        return $this->forward('App\Controller\TestController::listAll', []);
    }
}