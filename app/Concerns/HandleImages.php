<?php

namespace App\Concerns;

use App\Jobs\ProcessUploadAvatarImage;
use App\Jobs\ProcessUploadPetImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandleImages
{

    public function generatePetImage(mixed $photo, string $petName): string
    {
        $slugified_name = Str::slug($petName);
        $unique_id = uniqid();
        $extension = $photo->getClientOriginalExtension();
        $file_name = $slugified_name . '-' . $unique_id . '.' . $extension;

        $original_path = Storage::disk(config('pets.original_disk'))->putFileAs(
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

    public function deletePetImage(?string $photoPath): void
    {
        if (!$photoPath) return;

        $file_name_without_ext = pathinfo($photoPath, PATHINFO_FILENAME);
        $extension = config('pets.image_type');

        Storage::disk(config('pets.original_disk'))->delete(
            config('pets.original_path') . '/' . $photoPath
        );

        foreach (config('pets.sizes') as $size) {
            $variant_path = sprintf(config('pets.path_to_variant'), $size['name']);
            $variant_file = $variant_path . '/' . $file_name_without_ext . '.' . $extension;

            Storage::disk(config('pets.variant_disk'))->delete($variant_file);
        }
    }


    public function generateAvatarImage(mixed $photo, string $userName): string
    {
        $slugified_name = Str::slug($userName);
        $unique_id = uniqid();
        $extension = $photo->getClientOriginalExtension();
        $file_name = $slugified_name . '-' . $unique_id . '.' . $extension;

        $original_path = Storage::disk(config('avatars.original_disk'))->putFileAs(
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

    public function deleteAvatarImage(?string $photoPath): void
    {
        if (!$photoPath) return;

        $file_name_without_ext = pathinfo($photoPath, PATHINFO_FILENAME);
        $extension = config('avatars.image_type');

        Storage::disk(config('avatars.original_disk'))->delete(
            config('avatars.original_path') . '/' . $photoPath
        );

        foreach (config('avatars.sizes') as $size) {
            $variant_path = sprintf(config('avatars.path_to_variant'), $size['name']);
            $variant_file = $variant_path . '/' . $file_name_without_ext . '.' . $extension;

            Storage::disk(config('avatars.variant_disk'))->delete($variant_file);
        }
    }
}
