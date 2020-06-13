<?php

namespace MixCode;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MixCode\Utils\UsingUuid;

class Review extends Model
{
    use UsingUuid, SoftDeletes;

    protected $fillable = ['name', 'email', 'review', 'rate'];
}
