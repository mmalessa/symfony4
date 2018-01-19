<?php
namespace App\Controller;

use App\Application\Command\AddDomain;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function doSomething()
    {
        $domain = new AddDomain('www.name' . rand(100000,999999), rand(1,100));



        //return $this->redirectToRoute('list_all');
        return $this->forward('App\Controller\TestController::listAll', []);
    }
}