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
    public function groups()
    {
        # code...
        return $this->hasMany(GroupClient::class, 'client_id');
    }
    
}
