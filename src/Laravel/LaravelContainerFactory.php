<?php

declare(strict_types=1);

namespace WrkFlow\ApiSdkBuilder\Laravel;

use Illuminate\Contracts\Container\Container;
use Psr\Http\Message\ResponseInterface;
use WrkFlow\ApiSdkBuilder\AbstractApi;
use WrkFlow\ApiSdkBuilder\Contracts\SDKContainerFactoryContract;
use WrkFlow\ApiSdkBuilder\Endpoints\AbstractEndpoint;
use WrkFlow\ApiSdkBuilder\Responses\AbstractResponse;

class LaravelContainerFactory implements SDKContainerFactoryContract
{
    public function __construct(
        private readonly Container $container
    ) {
    }

    public function makeEndpoint(AbstractApi $api, string $endpointClass): AbstractEndpoint
    {
        return $this->container->make($endpointClass, [
            'api' => $api,
        ]);
    }

    public function make(string $class): mixed
    {
        return $this->container->make($class);
    }

    public function has(string $classOrKey): bool
    {
        return $this->container->has($classOrKey);
    }

    public function makeResponse(string $class, ResponseInterface $response, mixed $body): AbstractResponse
    {
        return $this->container->make($class, [
            'response' => $response,
            'container' => $this,
            'body' => $body,
        ]);
    }
}