<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\IceAndFireApiService;
use Illuminate\Http\Request;

class IceAndFireApiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, IceAndFireApiService $iceService)
    {
        $books =  $iceService->books($request->name);

        return response()->json([
            'data' => $books,
            'status' => 'success',
            'status_code' => 200
        ], 200);

    }
}
