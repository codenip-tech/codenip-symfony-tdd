<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HealthCheckController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}
