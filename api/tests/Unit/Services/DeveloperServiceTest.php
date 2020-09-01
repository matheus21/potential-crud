<?php

namespace Tests\Unit\Services;
use App\Domain\Model\Developer;
use App\Domain\Repository\DeveloperRepository;
use App\Domain\Service\DeveloperService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\Mock;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class DeveloperServiceTest extends TestCase
{
    /**
     * @var DeveloperService
     */
    private $service;

    /**
     * @var Mock
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = \Mockery::mock(DeveloperRepository::class);
        $this->instance(DeveloperRepository::class, $this->repository);

        $this->service = $this->app->make(DeveloperService::class);
    }

    /**
     * @test
     */
    public function shouldGetAllDevelopers()
    {
        $expectedResult = new Collection();
        $expectedResult->push($this->getDeveloperMock());

        $this->repository->shouldReceive('getDevelopers')->withNoArgs()->once()->andReturn($expectedResult);
        $result = $this->service->getDevelopers();

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldGetPaginatedDevelopers()
    {
        $collectionOfDevelopers = new Collection();
        $collectionOfDevelopers->push($this->getDeveloperMock());
        $term = "ForTesting";

        $expectedResult = new LengthAwarePaginator($collectionOfDevelopers, 1, $this->faker->numberBetween(1, 10), 1);
        $this->repository->shouldReceive('getPaginatedDevelopers')->with($term)->once()->andReturn($expectedResult);

        $result = $this->service->getPaginatedDevelopers($term);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenGetDevelopersPaginatedQueryWithoutRegisters()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage(trans('exception.developer.not_found'));

        $term = "ForTesting";
        $paginatedDevelopersQueryResult = new LengthAwarePaginator([], 0, $this->faker->numberBetween(1, 10), 1);

        $this->repository->shouldReceive('getPaginatedDevelopers')->with($term)->once()->andReturn($paginatedDevelopersQueryResult);
        $this->service->getPaginatedDevelopers($term);
    }

    /**
     * @test
     */
    public function shouldGetOneDeveloper()
    {
        $expectedResult = $this->getDeveloperMock();
        $developerId = $expectedResult->id;

        $this->repository->shouldReceive('getDeveloper')->with($developerId)->once()->andReturn($expectedResult);
        $result = $this->service->getDeveloper($developerId);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenGetsNoDeveloper()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage(trans('exception.developer.not_found'));

        $developerId = $this->faker->randomDigitNotNull;
        $queryResult = null;

        $this->repository->shouldReceive('getDeveloper')->with($developerId)->once()->andReturn($queryResult);
        $this->service->getDeveloper($developerId);
    }

    /**
     * @test
     */
    public function shouldInsertANewDeveloper()
    {
        $developer = $this->getDeveloperMock()->toArray();
        unset($developer['id']);

        $this->repository->shouldReceive('insertDeveloper')->with($developer)->once()->andReturn(true);
        $this->service->insertDeveloper($developer);
    }

    /**
     * @test
     */
    public function shouldThrowExcepctionWhenNewDeveloperInsertFailed()
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(trans('exception.developer.insert_failed'));

        $developer = $this->getDeveloperMock()->toArray();
        unset($developer['id']);

        $this->repository->shouldReceive('insertDeveloper')->with($developer)->once()->andReturn(false);
        $this->service->insertDeveloper($developer);
    }

    /**
     * @test
     */
    public function shouldUpdateADeveloper()
    {
        $developer = $this->getDeveloperMock()->toArray();
        $developerId = $developer['id'];
        unset($developer['id']);

        $this->repository->shouldReceive('updateDeveloper')->with($developerId, $developer)->once()->andReturn(true);
        $this->service->updateDeveloper($developerId, $developer);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenDeveloperUpdateFailed()
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(trans('exception.developer.update_failed'));

        $developer = $this->getDeveloperMock()->toArray();
        $developerId = $developer['id'];
        unset($developer['id']);

        $this->repository->shouldReceive('updateDeveloper')->with($developerId, $developer)->once()->andReturn(false);
        $this->service->updateDeveloper($developerId, $developer);
    }

    /**
     * @test
     */
    public function shouldDeleteADeveloper()
    {
        $developerId = $this->faker->randomDigitNotNull;

        $this->repository->shouldReceive('deleteDeveloper')->with($developerId)->once()->andReturn(true);
        $this->service->deleteDeveloper($developerId);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenDeveloperDeleteFailed()
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage(trans('exception.developer.delete_failed'));

        $developerId = $this->faker->randomDigitNotNull;

        $this->repository->shouldReceive('deleteDeveloper')->with($developerId)->once()->andReturn(false);
        $this->service->deleteDeveloper($developerId);
    }

    private function getDeveloperMock()
    {
        $developerMock = \Mockery::mock(Developer::class)->makePartial();

        $developerMock->id = $this->faker->randomDigitNotNull;
        $developerMock->nome = $this->faker->name;
        $developerMock->sexo = $this->faker->randomElement(['M', 'F']);
        $developerMock->idade = $this->faker->randomNumber(2);
        $developerMock->hobby = $this->faker->sentence;
        $developerMock->datanascimento = $this->faker->date('Y-m-d');

        return $developerMock;
    }
}
