<?php

namespace App\Http\Controllers;

use App\Models\GroupClient;
use App\Models\Groups;
use Illuminate\Http\Request;

class GroupClientController extends Controller
{
    //
    public function groupClient(Request $request)
    {

        $collection =   GroupClient::create([
            'group_id' => $request->group,
            'client_id' => $request->client,
        ]);
        $group = Groups::find($request->group); 
        return  $group->load('clients.clients');
    }
}
