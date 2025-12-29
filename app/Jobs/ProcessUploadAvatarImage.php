<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProcessUploadAvatarImage implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function __construct(
        public string $newOriginalFileName
    ) {}

    public function handle(): void
    {
        $sizes = config('avatars.sizes');
        $extension = config('avatars.image_type', 'webp');
        $compression = config('avatars.compression', 90);

        $originalDisk = config('avatars.original_disk');
        $variantDisk  = config('avatars.variant_disk');

        $originalPath = config('avatars.original_path') . '/' . $this->newOriginalFileName;

        if (!Storage::disk($originalDisk)->exists($originalPath)) {
            return;
        }

        $image = Image::read(
            Storage::disk($originalDisk)->get($originalPath)
        );

        $fileNameWithoutExt = pathinfo($this->newOriginalFileName, PATHINFO_FILENAME);

        foreach ($sizes as $size) {
            $variant = clone $image;

            $variant->cover($size['width'], $size['height']);

            $variantFolder = sprintf(config('avatars.path_to_variant'), $size['name']);
            $newFileName = $fileNameWithoutExt . '.' . $extension;
            $fullVariantPath = $variantFolder . '/' . $newFileName;

            Storage::disk($variantDisk)->put(
                $fullVariantPath,
                $variant->encodeByExtension($extension, $compression)
            );
        }
    }
}
