<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController
{
    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = \json_decode($request->getContent(), true);

        if (!\array_key_exists('name', $data)) {
            throw new BadRequestHttpException('name is mandatory');
        }

        if (!\array_key_exists('email', $data)) {
            throw new BadRequestHttpException('email is mandatory');
        }

        if (!\array_key_exists('password', $data)) {
            throw new BadRequestHttpException('password is mandatory');
        }

        $user = new User($data['name'], $data['email']);
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $data['password']));

        $this->userRepository->save($user);

        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }
}
