<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property string $method
 * @property string $url
 * @property string $payload
 * @property string $body
 * @property string $response
 * @property string $duration
 * @property string $controller
 * @property string $action
 * @property string $ip
 */

class LogRoute extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_routes';
    /**
     * @var array
     */

    protected $fillable = ['method' , 'url' , 'body' , 'payload' , 'response', 'code' , 'duration' , 'controller' , 'action' , 'ip' ];
    /**
     * @var mixed
     */

}
