<?php


namespace App\Domain\Repository\Contracts;


use App\Domain\Model\Developer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface DeveloperRepositoryInterface
{
    public function getDevelopers(): Collection;
    public function getPaginatedDevelopers(string $term): LengthAwarePaginator;
    public function getDeveloper(int $id): ?Developer;
    public function insertDeveloper(array $data): bool;
    public function updateDeveloper(int $id, array $data): bool;
    public function deleteDeveloper(int $id): bool;
}
