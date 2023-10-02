<?php

declare(strict_types=1);

namespace WrkFlow\ApiSdkBuilderTests\Laravel;

use Http\Mock\Client;
use Psr\Http\Client\ClientInterface;
use WrkFlow\ApiSdkBuilder\Contracts\ApiFactoryContract;
use WrkFlow\ApiSdkBuilder\Testing\Environments\TestingEnvironment;
use WrkFlow\ApiSdkBuilderTests\TestApi\TestApi;

abstract class ApiTestCase extends TestCase
{
    protected TestApi $api;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockBeforeApiFactory();

        $this->api = new TestApi(
            environment: new TestingEnvironment(),
            factory: $this->make(ApiFactoryContract::class),
        );
    }

    protected function mockBeforeApiFactory(): void
    {
        $this->useMockApiClient();
    }

    private function useMockApiClient(): void
    {
        $client = new Client();
        $this->app()
            ->bind(ClientInterface::class, static fn () => $client);
    }
}
