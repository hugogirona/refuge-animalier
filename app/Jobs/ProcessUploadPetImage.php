<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Laravel\Facades\Image;



class ProcessUploadPetImage implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function __construct(
        public string $newOriginalFileName
    ) {}

    public function handle(): void
    {
        $sizes = config('pets.sizes');
        $extension = config('pets.image_type', 'webp');
        $compression = config('pets.compression', config('pets.compression'));

        $originalPath = config('pets.original_path') . '/' . $this->newOriginalFileName;

        if (!Storage::disk('local')->exists($originalPath)) {
            return;
        }

        $image = Image::read(
            Storage::disk('local')->get($originalPath)
        );

        $fileNameWithoutExt = pathinfo($this->newOriginalFileName, PATHINFO_FILENAME);

        foreach ($sizes as $size) {

            $variant = clone $image;

            $variant->cover($size['width'], $size['height']);

            $variantFolder = sprintf(config('pets.path_to_variant'), $size['name']);
            $newFileName = $fileNameWithoutExt . '.' . $extension;
            $fullVariantPath = $variantFolder . '/' . $newFileName;

            Storage::disk('public')->put(
                $fullVariantPath,
                $variant->encodeByExtension($extension, $compression)
            );
        }
    }
}
