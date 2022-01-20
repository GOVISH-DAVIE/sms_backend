<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\GroupClient;
use App\Models\Groups;
use Illuminate\Http\Request;

class GroupClientController extends Controller
{
    public function groupClient(Request $request)
    {
// return $request->all();
// return [
//     'group_id' => intval($request->group_id),
//     'client_id' => intval($request->client_id),
// ];
        $collection =   GroupClient::create([
            'group_id' => intval($request->group_id),
            'client_id' => intval($request->client_id),
        ]);
        // return $request->all();
        $group = Groups::find($request->group);
        // return $group;
        $s =   GroupClient::where('group_id', intval($request->group_id))->get()->load('clients');

        return [
            'groups' => $group,
            'clients' => $s
        ];
    }
}