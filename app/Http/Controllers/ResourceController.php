<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{

    protected $model, $indexUrl, $moduleName, $viewFolder, $service, $moduleId;

    public function __construct($service)
    {
        $this->service = $service;
        $this->service = $service;
    }

    public function moduleName()
    {
        return '';
    }

    public function folderName()
    {
        return '';
    }

    public function subModuleName()
    {
        return '';
    }

    public function storeValidationRequest()
    {
        return '';
    }

    public function isSubModule()
    {
        return false;
    }

    public function setModuleId($id)
    {
        if ($this->isSubModule()) {
            $this->moduleId = $id;
        }
        return $this->moduleId;
    }

    public function moduleToTitle()
    {
        $title = '';
        $data = explode('-', $this->folderName());
        foreach ($data as $d) {
            $title .= $d . ' ';
        }

        return ucwords($title);
    }

    public function defaultRequest()
    {
        return 'Illuminate\Http\Request';
    }

    public function indexUrl()
    {
        if (($this->isSubModule())) {
            return '/system/' . $this->moduleName() . '/' . request()->segment(3) . '/' . $this->subModuleName();
        } else {
            return '/system/' . $this->moduleName();
        }
    }

    public function baseBreadCrumb()
    {
        return [
            'title' => 'Dashboard',
            'link' =>  'system/home',
            'active' => true
        ];
    }

    public function subModuleIndexUrl()
    {
        return $this->indexUrl() . '/' . $this->moduleId . '/' . $this->subModuleName();
    }

    public function breadCrumbForIndex($type = null)
    {
        $breadCrumb = [
            $this->baseBreadCrumb(),
            [
                'title' => $this->moduleToTitle(),
                'link' => isset($type) ? $this->isSubModule() ? 'system/' . $this->moduleName() . '/' . request()->segment(3) . '/' . $this->subModuleName() : 'system/' . $this->moduleName()  : null,

            ],
        ];

        if ($type == 'create' || $type == 'edit') {
            $breadCrumb[] = [
                'title' => $type == 'create' ? 'Create' : 'Edit',
            ];
        } elseif ($type == 'detail') {
            $breadCrumb[] = [
                'title' => 'Show',
            ];
        }

        if ($this->isSubModule()) {
            array_splice($breadCrumb, 1, 0, [
                [
                    'title' => ucfirst($this->moduleName()),
                    'link' => 'system/' . $this->moduleName(),
                ],
            ]);
        }

        return $breadCrumb;
    }

    public function getAllData($keyword)
    {
        return $this->model->where('title', 'LIKE',  '%' . $keyword . '%')->get();
    }

    public function show(Request $request, $id)
    {
        $data = $this->service->showPageData($request, $id);
        $data['indexUrl'] =  $this->indexUrl();
        $data['moduleName'] = $this->moduleToTitle();
        $data['breadCrumb'] =  $this->breadCrumbForIndex('detail');
        return view('system.' . $this->folderName() . '.show', $data);
    }



    public function index(Request $request)
    {
        $data = $this->service->indexPageData($request);
        $data['indexUrl'] =  $this->indexUrl();

        // dd($data['indexUrl']);
        $data['moduleName'] = $this->moduleToTitle();
        $data['breadCrumb'] =  $this->breadCrumbForIndex();
        return view('system.' . $this->folderName() . '.index', $data);
    }

    public function create(Request $request)
    {
        $data = $this->service->createPageData($request);
        $data['indexUrl'] = $this->indexUrl();
        $data['moduleName'] = $this->moduleToTitle();
        $data['breadCrumb'] = $this->breadCrumbForIndex('create');
        return view('system.' . $this->folderName() . '.form', $data);
    }

    public function store()
    {
        if (!empty($this->storeValidationRequest())) {
            $request = $this->storeValidationRequest();
        } else {
            $request = $this->defaultRequest();
        }
        $request = app()->make($request);
        $this->service->store($request);
        return redirect($this->indexUrl())->with(['success' => $this->moduleName . ' created successfully.']);
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
        return redirect($this->indexUrl())->with(['success' => $this->moduleName . ' updated successfully.']);
    }

    public function edit($id)
    {
        $data = $this->service->editPageData($id);
        $data['indexUrl'] = $this->indexUrl();
        $data['moduleName'] = $this->moduleToTitle();
        $data['breadCrumb'] = $this->breadCrumbForIndex('edit');
        return view('system.' . $this->folderName() . '.form', $data);
    }


    public function destroy(Request $request, $id)
    {
        $this->service->delete($request, $id);
        return redirect($this->indexUrl())->with(['success' => $this->moduleName . ' deleted successfully.']);
    }

    public function changeStatus($id)
    {
        $data = $this->service->getItemById($id);
        $data->update([
            'status' => $data->status === 1 ? 0 : 1
        ]);
        flash()->options([
            'timeout' => 2000
        ])->addSuccess('Status changed successfully.');
        return redirect()->back();
    }

    public function toastMessage($type)
    {
        $actions = [
            'create' => 'created',
            'update' => 'updated',
            'delete' => 'deleted',
        ];

        if (array_key_exists($type, $actions)) {
            $action = $actions[$type];
            $message = "has been $action successfully.";
            $module = $this->folderName();
            return flash()->options([
                'timeout' => 2000
            ])->addSuccess("$module $message", 'Success');
        }
    }
}
