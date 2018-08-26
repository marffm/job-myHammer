<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class JobController extends FOSRestController
{

    /**
     * @Rest\Post("/insertJob")
     * @param Request $request
     * @return View
     */
    public function insertJob(Request $request): View
    {

        $service = $this->get('service.InsertNewJob');

        $test = $service->insertJob();


        return $this->view($test, '200');
        //echo '<pre>' .json_encode($test). '</pre>';die;
    }
}
