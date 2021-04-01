<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Http\DTO\RegisterRequest;
use App\Service\RegisterService;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterController
{
    public function __construct(private RegisterService $registerService)
    {
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = $this->registerService->__invoke($request);

        return new JsonResponse(
            [
                'user' => [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                ],
            ], JsonResponse::HTTP_CREATED
        );
    }
}
