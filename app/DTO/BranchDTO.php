<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class BranchDTO extends DataTransferObject
{
    public int     $id;
    public string  $name;
    public ?string $address;
    public string  $created_at;
}