<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden = [
        'laravel_through_key',
        'created_at',
        'updated_at'
    ];

    public function clients()
    {
        return $this->hasMany(GroupClient::class, 'group_id');

    }
    
}
