<?php

declare(strict_types=1);

namespace WrkFlow\ApiSdkBuilderTests\TestApi\Endpoints;

use Http\Mock\Client;
use WrkFlow\ApiSdkBuilder\Contracts\ApiContract;
use WrkFlow\ApiSdkBuilder\Endpoints\AbstractEndpoint;

abstract class AbstractTestEndpoint extends AbstractEndpoint
{
    protected Client $client;

    public function __construct(ApiContract $api)
    {
        parent::__construct($api);

        $client = $this->api->factory()
            ->client();

        assert($client instanceof Client);

        $this->client = $client;
    }
}