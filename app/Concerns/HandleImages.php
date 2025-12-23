<?php

namespace App\Concerns;

use App\Jobs\ProcessUploadPetImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandleImages
{
    /**
     * Generate pet image with name-based filename
     *
     * @param mixed $photo The uploaded file
     * @param string $petName The pet's name
     * @return string The filename only (not the full path)
     */
    public function generatePetImage(mixed $photo, string $petName): string
    {
        $slugifiedName = Str::slug($petName);

        $uniqueId = uniqid();

        $extension = $photo->getClientOriginalExtension();

        $fileName = $slugifiedName . '-' . $uniqueId . '.' . $extension;


        $originalPath = Storage::disk('local')->putFileAs(
            config('pets.original_path'),
            $photo,
            $fileName
        );

        if ($originalPath) {
            ProcessUploadPetImage::dispatch($fileName);
            return $fileName;
        }

        return '';
    }

    /**
     * Delete pet image and all its variants
     *
     * @param string|null $photoPath The photo filename
     * @return void
     */
    public function deletePetImage(?string $photoPath): void
    {
        if (!$photoPath) {
            return;
        }

        $fileNameWithoutExt = pathinfo($photoPath, PATHINFO_FILENAME);
        $extension = config('pets.image_type');

        Storage::disk('local')->delete(
            config('pets.original_path') . '/' . $photoPath
        );

        foreach (config('pets.sizes') as $size) {
            $variantPath = sprintf(config('pets.path_to_variant'), $size['name']);
            $variantFile = $variantPath . '/' . $fileNameWithoutExt . '.' . $extension;

            Storage::disk('public')->delete($variantFile);
        }
    }
}
