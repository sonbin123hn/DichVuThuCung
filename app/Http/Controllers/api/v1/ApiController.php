<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function presenterPostJson($item, $code = 201)
    {
        return response()->json($item->presenter(), $code);
    }

    public function sendResponse($resource)
    {
        return $resource->response()->setStatusCode(200);
    }

    public function sendError404($message)
    {
        return response()->json(['message' => $message], 404);
    }

    public function sendError400($resource, $message)
    {
        $data = [
        'message' => $message,
        'errors' => $resource
        ];
        return  response()->json($data, 400);
    }

    // RESOUCES FORMAT JSON RESPONSE
    public function formatJson($class_name, $item, $other = NULL)
    {
        return new $class_name($item, $other);
    }

    public function formatCollectionJson($class_name, $item)
    {
        return $class_name::collection($item);
    }

    public function sendMessage($message, $code = 200)
    {
        $data = [
        "message" => $message
        ];
        return response()->json($data, $code);
    }

    public function sendMessageComment($message, $status, $code = 200)
    {
        $data = [
        "message" => $message,
        'status' => $status
        ];
        return response()->json($data, $code);
    }

    public function sendSuccessResponse($data, $code = 200)
    {
        return response()->json($data, $code);
    }
}
