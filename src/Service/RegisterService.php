<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Http\DTO\RegisterRequest;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordEncoderInterface $userPasswordEncoder
    ) {
    }

    public function __invoke(RegisterRequest $request): User
    {
        $user = new User($request->getName(), $request->getEmail());
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $request->getPassword()));

        $this->userRepository->save($user);

        return $user;
    }
}
