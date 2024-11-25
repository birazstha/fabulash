<?php

namespace App\Http\Controllers\System\File;

use App\Http\Controllers\ResourceController;
use App\Services\System\File\FileService;
use Illuminate\Http\Request;

class FileController extends ResourceController
{
    public $service;
    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'files';
    }

    public function folderName()
    {
        return 'file';
    }

    public function update(Request $request, $id)
    {
        if (!empty($this->storeValidationRequest())) {
            $request = $this->storeValidationRequest();
        } else {
            $request = $this->defaultRequest();
        }
        $request = app()->make($request);

        $result = $this->service->update($request, $id);

        $this->toastMessage('update');
        return redirect()->route('products.show', $result->fileable->id);
    }

    public function destroy(Request $request, $id)
    {
        $this->service->delete($request, $id);
        return redirect()->back()->with(['success' => $this->moduleName . ' deleted successfully.']);
    }
}
