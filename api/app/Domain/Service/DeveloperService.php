<?php

namespace App\Domain\Service;

use App\Domain\Model\Developer;
use App\Domain\Repository\Contracts\DeveloperRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeveloperService
{
    /**
     * @var DeveloperRepositoryInterface
     */
    protected $repository;

    public function __construct(DeveloperRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getDevelopers(): Collection
    {
        return $this->repository->getDevelopers();
    }

    public function getPaginatedDevelopers(string $term): LengthAwarePaginator
    {
        $result = $this->repository->getPaginatedDevelopers($term);

        if(empty($result->items())) {
            throw new NotFoundHttpException(trans('exception.developer.not_found'));
        }

        return $result;
    }

    public function getDeveloper(int $id): Developer
    {
        $result = $this->repository->getDeveloper($id);

        if(is_null($result)) {
            throw new NotFoundHttpException(trans('exception.developer.not_found'));
        }
        return $result;
    }

    public function insertDeveloper(array $data): void
    {
        $data['datanascimento'] = Carbon::createFromFormat('d/m/Y', $data['datanascimento'])->toDateString();

        $result = $this->repository->insertDeveloper($data);

        if(!$result) {
            throw new BadRequestException(trans('exception.developer.insert_failed'));
        }
    }

    public function updateDeveloper(int $id, array $data): void
    {
        $data['datanascimento'] = Carbon::createFromFormat('d/m/Y', $data['datanascimento'])->toDateString();

        $result = $this->repository->updateDeveloper($id, $data);

        if(!$result) {
            throw new BadRequestException(trans('exception.developer.update_failed'));
        }
    }

    public function deleteDeveloper(int $id): void
    {
        $result = $this->repository->deleteDeveloper($id);

        if(!$result) {
            throw new BadRequestException(trans('exception.developer.delete_failed'));
        }
    }
}
