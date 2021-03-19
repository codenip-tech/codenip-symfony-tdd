<?php

declare(strict_types=1);

namespace Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HealthCheckControllerTest extends WebTestCase
{
    private const ENDPOINT = '/api/v1/health-check';

    public function testHealthCheck(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, self::ENDPOINT);

        $response = $client->getResponse();

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }
}
