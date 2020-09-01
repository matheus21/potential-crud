<?php


namespace App\Http\Controllers;

use App\Domain\Service\DeveloperService;
use App\Http\Requests\DeleteDeveloperRequest;
use App\Http\Requests\InsertDeveloperRequest;
use App\Http\Requests\UpdateDeveloperRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DevelopersController extends Controller
{
    /**
     * @var DeveloperService
     */
    private $service;

    /**
     * DevelopersController constructor.
     * @param DeveloperService $service
     */
    public function __construct(DeveloperService $service)
    {
        $this->service = $service;
    }

    public function getDevelopers(Request $request): JsonResponse
    {
        $term = $request->get('termo');

        if (is_null($term)) {
            $this->response['data'] = $this->service->getDevelopers();
            return new JsonResponse($this->response, Response::HTTP_OK);
        }

        try {
            $this->response['data'] = $this->service->getPaginatedDevelopers($term);
        } catch (NotFoundHttpException $e) {
            $this->response['type'] = 'error';
            $this->response['message'] = $e->getMessage();

            return new JsonResponse($this->response, $e->getStatusCode());
        }

        return new JsonResponse($this->response, Response::HTTP_OK);
    }

    public function getDeveloper(int $id): JsonResponse
    {
        try {
            $this->response['data'] = $this->service->getDeveloper($id);
        } catch (NotFoundHttpException $e) {
            $this->response['type'] = 'error';
            $this->response['message'] = $e->getMessage();

            return new JsonResponse($this->response, $e->getStatusCode());
        }

        return new JsonResponse($this->response, Response::HTTP_OK);
    }

    public function postDeveloper(InsertDeveloperRequest $request)
    {
        try {
            $this->service->insertDeveloper($request->validated());
        } catch (BadRequestException $e) {
            $this->response['type'] = 'error';
            $this->response['message'] = $e->getMessage();

            return new JsonResponse($this->response, $e->getStatusCode());
        }

        return new JsonResponse($this->response, Response::HTTP_CREATED);
    }

    public function putDeveloper(UpdateDeveloperRequest $request, int $id)
    {
        try {
            $this->service->updateDeveloper($id, $request->validated());
        } catch (BadRequestException $e) {
            $this->response['type'] = 'error';
            $this->response['message'] = $e->getMessage();

            return new JsonResponse($this->response, $e->getStatusCode());
        }

        return new JsonResponse($this->response, Response::HTTP_OK);
    }

    public function deleteDeveloper(DeleteDeveloperRequest $request, int $id)
    {
        try {
            $this->service->deleteDeveloper($id);
        } catch (BadRequestException $e) {
            $this->response['type'] = 'error';
            $this->response['message'] = $e->getMessage();

            return new JsonResponse($this->response, $e->getStatusCode());
        }

        return new JsonResponse($this->response, Response::HTTP_NO_CONTENT);
    }
}
