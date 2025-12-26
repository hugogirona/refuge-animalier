<?php

namespace App\Concerns;

use App\Jobs\ProcessUploadAvatarImage;
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
        $slugified_name = Str::slug($petName);

        $unique_id = uniqid();

        $extension = $photo->getClientOriginalExtension();

        $file_name = $slugified_name . '-' . $unique_id . '.' . $extension;


        $original_path = Storage::disk('local')->putFileAs(
            config('pets.original_path'),
            $photo,
            $file_name
        );

        if ($original_path) {
            ProcessUploadPetImage::dispatchSync($file_name);
            return $file_name;
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

        $file_name_without_ext = pathinfo($photoPath, PATHINFO_FILENAME);
        $extension = config('pets.image_type');

        Storage::disk('local')->delete(
            config('pets.original_path') . '/' . $photoPath
        );

        foreach (config('pets.sizes') as $size) {
            $variant_path = sprintf(config('pets.path_to_variant'), $size['name']);
            $variant_file = $variant_path . '/' . $file_name_without_ext . '.' . $extension;

            Storage::disk('public')->delete($variant_file);
        }
    }

    public function generateAvatarImage(mixed $photo, string $userName): string
    {
        $slugified_name = Str::slug($userName);

        $unique_id = uniqid();

        $extension = $photo->getClientOriginalExtension();

        $file_name = $slugified_name . '-' . $unique_id . '.' . $extension;

        $original_path = Storage::disk('local')->putFileAs(
            config('avatars.original_path'),
            $photo,
            $file_name
        );

        if ($original_path) {
            ProcessUploadAvatarImage::dispatchSync($file_name);
            return $file_name;
        }

        return '';
    }

    /**
     * Delete avatar image and all its variants
     */
    public function deleteAvatarImage(?string $photoPath): void
    {
        if (!$photoPath) {
            return;
        }

        $file_name_without_ext = pathinfo($photoPath, PATHINFO_FILENAME);
        $extension = config('avatars.image_type');

        Storage::disk('local')->delete(
            config('avatars.original_path') . '/' . $photoPath
        );

        foreach (config('avatars.sizes') as $size) {
            $variant_path = sprintf(config('avatars.path_to_variant'), $size['name']);
            $variant_file = $variant_path . '/' . $file_name_without_ext . '.' . $extension;

            Storage::disk('public')->delete($variant_file);
        }
    }

}
