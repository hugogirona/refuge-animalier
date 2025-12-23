<?php

use App\Jobs\ProcessUploadPetImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    Storage::fake('local');
    Storage::fake('public');
});

describe('ProcessUploadPetImage Job', function () {

    it('processes image successfully', function () {

        $file = UploadedFile::fake()->image('test.jpg', 800, 600);
        $filename = 'moka-123.jpg';

        Storage::disk('local')->putFileAs(
            config('pets.original_path'),
            $file,
            $filename
        );

        $job = new ProcessUploadPetImage($filename);
        $job->handle();

        Storage::disk('local')->assertExists(config('pets.original_path') . '/' . $filename);
    });

    it('creates all variant sizes', function () {
        $file = UploadedFile::fake()->image('test.jpg', 1600, 1200);
        $filename = 'moka-123.jpg';

        Storage::disk('local')->putFileAs(
            config('pets.original_path'),
            $file,
            $filename
        );

        $job = new ProcessUploadPetImage($filename);
        $job->handle();

        // Vérifier que tous les variants sont créés
        foreach (config('pets.sizes') as $size) {
            if ($size['name'] === 'original' || is_null($size['width'])) {
                continue;
            }

            $variantPath = sprintf(config('pets.path_to_variant'), $size['name']);
            $variantFile = $variantPath . '/moka-123.webp';

            Storage::disk('public')->assertExists($variantFile);
        }
    });


    it('converts images to webp format', function () {
        $file = UploadedFile::fake()->image('test.jpg', 800, 600);
        $filename = 'moka-123.jpg';

        Storage::disk('local')->putFileAs(
            config('pets.original_path'),
            $file,
            $filename
        );

        $job = new ProcessUploadPetImage($filename);
        $job->handle();

        foreach (config('pets.sizes') as $size) {
            if ($size['name'] === 'original' || is_null($size['width'])) {
                continue;
            }

            $variantPath = sprintf(config('pets.path_to_variant'), $size['name']);
            $variantFile = $variantPath . '/moka-123.webp';

            expect(Storage::disk('public')->exists($variantFile))->toBeTrue()
                ->and($variantFile)->toEndWith('.webp');
        }
    });

});
