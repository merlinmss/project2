<?php

namespace App\DTOs\User;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Logging\OpenTestReporting\Status;

class CreateUserData
{
    public function __construct(
        public string $name,
        public int $phone,
        public string $email,
        public string $status,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            email: $data['email'],
            status: $data['status'],
        );
    }
}
