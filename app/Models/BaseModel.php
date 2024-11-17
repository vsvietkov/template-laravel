<?php

namespace App\Models;

use App\Traits\GraphQLModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @method GraphQLQueryBuilder query()
 */
abstract class BaseModel extends Model
{
    use GraphQLModelTrait;
}
