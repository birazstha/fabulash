<?php

namespace App\Http\Controllers\System\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDO;

class DashboardController extends Controller
{

    protected $model, $indexUrl, $moduleName;
    public function __construct()
    {
        $this->indexUrl = 'home';
        $this->moduleName = 'Home';
    }

    public function indexUrl()
    {
        return $this->indexUrl . '' . '.index';
    }

    public function baseBreadCrumb()
    {
        return [
            'title' => 'Dashboard',
            'link' =>  'home.index',
            'active' => true
        ];
    }

    public function breadCrumbForIndex()
    {
        $breadCrumb = [
            $this->baseBreadCrumb(), [
                'title' => $this->moduleName,
                'link' => $this->indexUrl(),
            ]
        ];
        return $breadCrumb;
    }

    public function index()
    {
        $data['indexUrl'] = $this->indexUrl;
        $data['moduleName'] = $this->moduleName;
        $data['breadCrumb'] = $this->breadCrumbForIndex();
        return view('system.dashboard.index', $data);
    }
}
