<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Groups;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $clients = Clients::all();
        $groups = Groups::all();
        return [
            'clients'=>$clients,
            'groups'=>$groups
        ];
    }
}
