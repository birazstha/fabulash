<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Config;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ConfigSeeder extends Seeder
{
    protected $model;

    public function __construct(Config $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        Config::truncate();

        $directory = public_path() . '/uploads/config';
        if (is_dir($directory) != true) {
            File::makeDirectory($directory, $mode = 0755, true);
        }

        File::copy(public_path('images/logo.png'), public_path('uploads/config/cms_logo.png'));
        File::copy(public_path('images/logo.png'), public_path('uploads/config/fav_icon.png'));
        File::copy(public_path('images/logo_white.png'), public_path('uploads/config/cms_logo_white.png'));


        $configs = [
            [
                'label' => 'CMS Title',
                'slug' => 'cms-title',
                'type' => 'text',
                'value' => 'Fabulash',
            ],
            [
                'label' => 'CMS Logo',
                'slug' => 'cms-logo',
                'type' => 'file',
                'value' => 'cms_logo.png',
            ],
            [
                'label' => 'CMS Logo White',
                'slug' => 'cms-logo-white',
                'type' => 'file',
                'value' => 'cms_logo_white.png',
            ],
            [
                'label' => 'CMS Favicon',
                'slug' => 'fav-icon',
                'type' => 'file',
                'value' => 'fav_icon.png',
            ],
            [
                'label' => 'Email',
                'slug' => 'email',
                'type' => 'text',
                'value' => 'birajshrestha51@gmail.com',
            ],

        ];

        foreach ($configs as $config) {
            $this->model->updateOrInsert(
                ['slug' => $config['slug']],
                [
                    'label' => $config['label'],
                    'slug' => $config['slug'],
                    'type' => $config['type'],
                    'value' => $config['value'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
