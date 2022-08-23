<?php

declare(strict_types=1);

namespace WrkFlow\ApiSdkBuilder\Events;

use Psr\Http\Message\RequestInterface;

class SendingRequestEvent
{
    public function __construct(
        public readonly string $id,
        public readonly RequestInterface $request,
        public readonly float $timeStartInSeconds,
    ) {
    }
}
