<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\Controller;

use App\MyHammer\Infrastructure\Helper\JsonResponseFormatter;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
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
        } catch (\Exception $error) {
            return $this->view(
                JsonResponseFormatter::errorResponse($error->getMessage()),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    /**
     * @Rest\Get("/findJobs", name="FindJob")
     * @Rest\QueryParam(name="job_id")
     * @Rest\QueryParam(name="id_user")
     * @Rest\QueryParam(name="service_id")
     * @Rest\QueryParam(name="zipcode")
     * @param Request $request
     * @return View
     */
    public function findJob(Request $request): View
    {
        $params = [
            'id' => $request->get('job_id'),
            'service_id' => $request->get('service_id'),
            'zipcode' => $request->get('zipcode'),
            'id_user' => $request->get('id_user')
        ];

        echo '<pre>' .json_encode($params). '</pre>';
        die;

        try {
            $searchAction = $this->get('action.SearchJobAction');
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
