<?php

use Illuminate\Support\Str;
use App\Models\Config;
use App\Models\FrontendConfig;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

function getConfig($slug)
{
    return Config::where('slug', $slug)->value('value') ?? '';
}

function statusBadge($item, $indexUrl)
{
    return $item->status ? '<a class="badge badge-success" href="' . $indexUrl . '/change-status/' . $item->id  . '">' . 'Active' . '</a>' : '<a class="badge badge-danger" href="' . $indexUrl . '/change-status/' . $item->id  . '">' . 'Inactive' . '</a>';
}

function paginate()
{
    return 10;
}

function authUser()
{
    return Auth::user();
}


function generateToken($length)
{
    return bin2hex(openssl_random_pseudo_bytes($length));
}

function generatePassword($length)
{
    return Str::random($length);
}

function printFirstNameOnly($name)
{
    $nameParts = explode(" ", $name);
    return $nameParts[0];
}

function moduleId($moduleName)
{
    return Module::where('route', $moduleName)->value('id') ?? null;
}

function limitWords($word, $limit)
{
    return Str::words($word, $limit, '...');
}

function convertToTime($time)
{
    $dateTime = \Carbon\Carbon::parse($time);
    $time12Hour = $dateTime->format('Y-m-d h:i A');
    return $time12Hour;
}

function convertToDate($date)
{
    $dateTime = \Carbon\Carbon::parse($date);
    return $dateTime->format('Y-m-d');
}

function formatter($name)
{
    $name = str_replace('_id', '', $name);
    $name = preg_replace('/\[[^\]]*\]/', '', $name);
    $formattedName = ucwords(str_replace('_', ' ', $name));
    return $formattedName;
}


function fileName($slug)
{
    return FrontendConfig::where('key', $slug)->first();
}

function frontendConfig($key, $isFile = false)
{
    $model = FrontendConfig::where('key', $key);
    if ($isFile) {
        return $model->first()->files()->value('path');
    }

    return $model->value('value');
}

function usernameConverter($name)
{
    $lowercaseName = strtolower($name);
    $username = str_replace(' ', '_', $lowercaseName);
    return $username;
}


function fileNameFormatter($input)
{
    $pattern = '/file\[(.*?)\]/';
    preg_match_all($pattern, $input, $matches);
    return $matches[1][0];
}

function indexImagePreview($item)
{
    $imagePath = asset($item->files()->value('path') . '/' . $item->files()->value('title'));
    return '
        <a class="image-link" href="' . $imagePath . '">
            <img src="' . $imagePath . '" width="200px" alt="" class="img-thumbnail">
        </a>';
}

function urlFormatter($seg1, $seg2, $seg3)
{
    $url = $seg1 . '/' . $seg2 . '/' . $seg3;
    $finalUrl = preg_replace('/\d+/', '*', $url);
    return rtrim($finalUrl, '/');
}

function convertToAmount($amount)
{
    if ($amount != 0) {

        $formattedNumber = number_format($amount, 0, '.', ',');

        return 'Rs. ' . $formattedNumber . '/-';
    }
    return '-';
}

function noDataFound($colspan)
{
    return '<tr><th colspan=' . $colspan . ' class="text text-danger text-center">No data found.' . '</th></tr>';
}

function showLink($item, $route)
{
    return '<a href="' . route($route . '.show', $item->id) . '">' . $item->title . '</a>';
}

function generateOrderId()
{
    $prefix = "ORD";
    $randomNum = rand(1000, 9999);
    return $prefix . $randomNum;
}


function generateSlug($string)
{
    $slug = strtolower($string);
    $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}
