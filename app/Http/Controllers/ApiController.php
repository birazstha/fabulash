<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use Exception;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    protected $model, $indexUrl, $moduleName, $viewFolder, $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function successResponse($message = "OK")
    {
        return $this->message($message, 200);
    }

    public function errorNotFound($message = "Data not found")
    {

        return $this->message($message, 400);
    }

    public function internalServerError($message)
    {
        return $this->message($message, 500);
    }

    public function message($message, $statusCode)
    {
        return response()->json([
            'errors' => [
                'message' => $message
            ]
        ], $statusCode);
    }

    public function storeValidationRequest()
    {
        return '';
    }

    public function defaultRequest()
    {
        return 'Illuminate\Http\Request';
    }

    public function index(Request $request)
    {
        $data = $this->service->getAllData($request);
        return new CategoryResourceCollection($data);
    }

    public function store(Request $request)
    {
        if (!empty($this->storeValidationRequest())) {
            $request = $this->storeValidationRequest();
        } else {
            $request = $this->defaultRequest();
        }
        $request = app()->make($request);

        $this->service->store($request);
        return $this->successResponse('Created Successfully');
    }

    public function show($id)
    {
        $data = $this->service->getItemById($id);
        if ($data) {
            return new CategoryResource($data);
        } else {
            return $this->errorNotFound();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if (!empty($this->storeValidationRequest())) {
                $request = $this->storeValidationRequest();
            } else {
                $request = $this->defaultRequest();
            }
            $request = app()->make($request);
            $this->service->update($request, $id);
            return $this->successResponse('Updated Successfully');
        } catch (Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $data = $this->service->getItemById($id);
            if ($data) {
                $data->delete();
                return $this->successResponse('Deleted Successfully');
            } else {
                return $this->errorNotFound();
            }
        } catch (Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }
}
