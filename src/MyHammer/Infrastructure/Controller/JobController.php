<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\Controller;

use App\MyHammer\Infrastructure\Helper\JsonResponseFormatter;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JobController extends FOSRestController
{

    /**
     * @Rest\Post("/insertJob")
     * @param Request $request
     * @return View
     */
    public function insertJob(Request $request): View
    {
        $body = json_decode($request->getContent(), true);
        $params = $body['data'];

        try {
            $insertAction = $this->get('action.InsertJobAction');
            $response = $insertAction->insertJob($params);

            return $this->view(
                JsonResponseFormatter::successResponse($response),
                Response::HTTP_OK
            );
        } catch (\InvalidArgumentException $error) {
            return $this->view(
                JsonResponseFormatter::errorResponse($error->getMessage()),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        } catch (\RuntimeException $error) {
            return $this->view(
                JsonResponseFormatter::errorResponse($error->getMessage()),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
