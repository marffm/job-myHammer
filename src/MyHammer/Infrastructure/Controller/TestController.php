<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class TestController extends FOSRestController
{

    /**
     * @Rest\Get("/")
     * @return View
     */
    public function printSomething(): View
    {
        return $this->view(['test' => 'return an array'], Response::HTTP_OK);
    }


}