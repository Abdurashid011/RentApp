<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public int     $id;
    public string  $name;
    public ?string $email;
    public ?int    $phone;
    public ?string $gender;
    public ?string $position;
    public ?string $created_at;
}