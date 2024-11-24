<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\PdfToImage\Pdf;

trait FileTrait
{

    public function storeImage($image, $path, $model, $fileType = null)
    {
        $imageName = time() . '_' . uniqid() . '.' . $image->extension();

        $image->move(public_path($path), $imageName);

        $model->files()->create([
            'title' => $imageName,
            'path' => $path . '/' . $imageName,
            'file_type' => $fileType,
        ]);
    }

    public function storeMultipleImages($photos)
    {
        dd($photos);

        // $imageName = time() . '_' . uniqid() . '.' . $image->extension();

        // $image->move(public_path($path), $imageName);

        // $model->files()->create([
        //     'title' => $imageName,
        //     'path' => $path . '/' . $imageName,
        //     'file_type' => $fileType,
        // ]);
    }


    public function updateImage($image, $path, $model)
    {
        //Delete older File
        $filePath = public_path($path . '/' . $model->files()->value('title'));

        if (File::exists($filePath)) {

            File::delete($filePath);
        }

        //Create new File
        $imageName = time() . '_' . uniqid() . '.' . $image->extension();

        $image->move(public_path($path), $imageName);

        //Update File Name
        $oldImage = $model->files()->first();

        if ($oldImage) {
            $oldImage->update([
                'title' => $imageName,
                'path' => $path . '/' . $imageName
            ]);
        } else {
            $model->files()->create([
                'title' => $imageName,
                'path' => $path . '/' . $imageName
            ]);
        }
    }

    public function updateOrCreateImage($image, $path, $model)
    {
        if ($model->files()->exists()) {
            // Update existing image
            $this->updateImage($image, $path, $model);
        } else {
            // Create new image
            $this->storeImage($image, $path, $model);
        }
    }

    public function uploadPdf($pdf, $path, $model)
    {
        DB::transaction(function () use ($pdf, $path, $model) {
            $fileName = time() . '.' . $pdf->extension();


            $pdf->move(public_path($path), $fileName);
            try {
                $model->files()->create([
                    'title' => $fileName,
                    'path' => $path . '/' . $fileName
                ]);
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        });
    }

    public function deleteFile($path, $model)
    {
        $filePath = public_path($path . '/' . $model->files()->value('title'));
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }

    public function deleteBase64Image($path)
    {
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    public function storeBase64Image($fileData)
    {
        // Extracting the image extension of image.
        $imageExtension = explode('/', mime_content_type($fileData['file']))[1];
        $imageName = time() . '_' . uniqid() . '.' . $imageExtension;
        // Decode the base64 data to binary
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fileData['file']));

        // Define the upload directory path
        $uploadPath = public_path($fileData['path']);

        // Check if the directory doesn't exist, create it
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Save the image to the uploads directory
        file_put_contents($uploadPath . '/' . $imageName, $imageData);

        $data = [
            'title' => $imageName,
            'path' => $fileData['path'] . '/' . $imageName
        ];
        return $fileData['model']->files()->create($data);
    }


    public function updateBase64Image($fileData)
    {

        //Delete older File
        $filePath = $fileData['model']->path . '/' . $fileData['model']->name;

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Decode the base64 data to binary
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fileData['file']));

        // Define the upload directory path
        $uploadPath = public_path($fileData['model']->path);

        // Save the image to the uploads directory
        file_put_contents($uploadPath, $imageData);
    }
}
