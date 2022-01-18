<?php

namespace App\Http\Controllers;

use App\Models\GroupClient;
use Illuminate\Http\Request;

class GroupClientController extends Controller
{
    //
    public function groupClient(Request $request)
    {
        return  $request->all();
        GroupClient::create([
            'group_id' => $request->group,
            'client_id' => $request->client,
        ]);
    }
}
