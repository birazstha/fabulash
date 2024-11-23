<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\MeetupRequest;
use App\Http\Resources\MeetupResource;
use App\Models\Meetup;
use Illuminate\Http\Request;

class MeetupController extends ApiController
{

    protected $model;
    public function __construct(Meetup $meetup)
    {
        $this->model = $meetup;
    }

    public function store(MeetupRequest $request)
    {
        $data =  $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $finalName = date('His') . $fileName;
            $request->file('image')->storeAs('images/', $finalName, 'public');
        }
        $data['image'] = $finalName;
        $this->model->create($data);
        return $this->responseSuccess();
    }

    public function index()
    {
        $data = $this->model->orderBy('created_at', 'DESC')->get();
        return MeetupResource::collection($data);
    }

    public function show($id)
    {
        $data =  $this->model->find($id);
        if (!isset($data)) {
            return $this->errorNotFound();
        }
        return new MeetupResource($data);
    }

    public function destroy($id)
    {
        $data =  $this->model->find($id);
        if (!isset($data)) {
            return $this->errorNotFound();
        }
        $data->delete();
        return response()->json([
            "message" => "Meetup has been deleted",
        ]);
    }

    public function update(Request $request, $id)
    {
        $data =  $this->model->find($id);
        if (!isset($data)) {
            return $this->errorNotFound();
        }
        $data->update($request->all());
        return response()->json([
            "message" => "Updated successfully",
        ]);
    }
}
