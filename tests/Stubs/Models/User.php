<?php

declare(strict_types=1);

namespace Noitran\RQL\Tests\Stubs\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User.
 */
class User extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];
}
