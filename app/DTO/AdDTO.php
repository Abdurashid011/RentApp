<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class AdDTO extends DataTransferObject
{
    public int     $id;
    public string  $title;
    public ?string $address;
    public float   $price;
    public int     $rooms;
    public float   $square;
    public ?string $description;
    public ?string $gender;
    public int     $user_id;
    public int     $branch_id;
    public int     $status_id;
    public string  $created_at;
}