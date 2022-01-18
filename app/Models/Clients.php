<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'tel'
    ];
    protected $hidden = [
        'laravel_through_key',
        'created_at',
        'updated_at'
    ];
    public function groups()
    {

        return $this->hasManyThrough(Groups::class, GroupClient::class, 'client_id', 'id');
    }

    // public function gr()
    // {
    //     return $this->hasManyThrough();
    // }

}
