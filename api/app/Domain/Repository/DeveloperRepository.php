<?php

namespace App\Domain\Repository;


use App\Domain\Model\Developer;
use App\Domain\Repository\Contracts\DeveloperRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DeveloperRepository implements DeveloperRepositoryInterface
{
    public function model()
    {
        return Developer::class;
    }

    public function getDevelopers(): Collection
    {
        return $this->model()::select(
            "developers.id",
            "developers.nome",
            "developers.sexo",
            "developers.idade",
            "developers.hobby",
            "developers.datanascimento"
        )->get();
    }

    public function getPaginatedDevelopers(string $term): LengthAwarePaginator
    {
        $query = $this->model()::select(
            "developers.id",
            "developers.nome",
            "developers.sexo",
            "developers.idade",
            "developers.hobby",
            "developers.datanascimento"
        );

        $query->whereRaw("
            nome like '%{$term}%' OR
            sexo like '%{$term}%' OR
            idade like '%{$term}%' OR
            hobby like '%{$term}%' OR
            datanascimento LIKE '%{$term}%'
        ");

        return $query->paginate();
    }

    public function getDeveloper(int $id): ?Developer
    {
        return $this->model()::find($id)->makeHidden(['created_at', 'updated_at']);
    }

    public function insertDeveloper(array $data): bool
    {
        return $this->model()::insert($data);
    }

    public function updateDeveloper(int $id, array $data): bool
    {
        return $this->model()::where('id', $id)->update($data);
    }

    public function deleteDeveloper(int $id): bool
    {
        return $this->model()::where('id', $id)->delete();
    }
}
