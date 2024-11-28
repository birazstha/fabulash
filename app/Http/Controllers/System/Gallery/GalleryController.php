<?php

namespace App\Http\Controllers\System\Gallery;

use App\Http\Controllers\ResourceController;
use App\Services\System\Gallery\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends ResourceController
{
    protected $service;

    public function __construct(GalleryService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'galleries';
    }

    public function folderName()
    {
        return 'gallery';
    }

    public function store()
    {
        if (!empty($this->storeValidationRequest())) {
            $request = $this->storeValidationRequest();
        } else {
            $request = $this->defaultRequest();
        }
        $request = app()->make($request);
        $id = $this->service->store($request);
        $this->toastMessage('create');
        return redirect()->route($this->moduleName() . '.show', $id);
    }

    public function update(Request $request, $id)
    {
        if (!empty($this->storeValidationRequest())) {
            $request = $this->storeValidationRequest();
        } else {
            $request = $this->defaultRequest();
        }
        $request = app()->make($request);
        $this->service->update($request, $id);
        return redirect()->route($this->moduleName() . '.show', $id)->with(['success' => $this->moduleName . ' updated successfully.']);
    }
}
