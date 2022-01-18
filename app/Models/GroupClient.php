<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupClient extends Model
{
    use HasFactory;
    protected $fillable=[
        'group_id',
        'client_id'
    ];
    public function clients()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
    public function group()
    {
        return $this->belongsTo(Groups::class, 'group_id');
    }
}
