<?php

namespace Tests;

use Faker\Generator;
use Faker\Provider\DateTime;
use Faker\Provider\Lorem;
use Faker\Provider\Miscellaneous;
use Faker\Provider\Person;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{

    /**
     * @var Generator
     */
    protected $faker;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->faker = new Generator();
        $this->faker->addProvider(new DateTime($this->faker));
        $this->faker->addProvider(new Person($this->faker));
        $this->faker->addProvider(new Lorem($this->faker));
        $this->faker->addProvider(new Miscellaneous($this->faker));

        return $app;
    }
}
