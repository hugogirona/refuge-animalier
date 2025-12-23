<?php

use App\Jobs\ProcessUploadPetImage;
use App\Models\Pet;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('local');
    Storage::fake('public');
    Queue::fake();
});

describe('HandleImages Trait - generatePetImage', function () {

    it('generates a pet image with correct filename format', function () {
        $pet = new Pet();
        $file = UploadedFile::fake()->image('test.jpg');

        $filename = $pet->generatePetImage($file, 'Moka le Chien');

        expect($filename)
            ->toBeString()
            ->toStartWith('moka-le-chien-')
            ->toEndWith('.jpg');
    });

    it('stores the original image in private storage', function () {
        $pet = new Pet();
        $file = UploadedFile::fake()->image('test.jpg');

        $filename = $pet->generatePetImage($file, 'Moka');

        Storage::disk('local')->assertExists(config('pets.original_path') . '/' . $filename);
    });

    it('dispatches ProcessUploadPetImage job', function () {
        $pet = new Pet();
        $file = UploadedFile::fake()->image('test.jpg');

        $filename = $pet->generatePetImage($file, 'Moka');

        Queue::assertPushed(ProcessUploadPetImage::class, function ($job) use ($filename) {
            return $job->newOriginalFileName === $filename;
        });
    });

    it('returns only the filename without path', function () {
        $pet = new Pet();
        $file = UploadedFile::fake()->image('test.jpg');

        $filename = $pet->generatePetImage($file, 'Moka');

        expect($filename)->not->toContain('/')
            ->and($filename)->not->toContain('images')
            ->and($filename)->not->toContain('pets');
    });

    it('preserves original file extension', function () {
        $pet = new Pet();

        $jpgFile = UploadedFile::fake()->image('test.jpg');
        $filenameJpg = $pet->generatePetImage($jpgFile, 'Moka');
        expect($filenameJpg)->toEndWith('.jpg');

        $pngFile = UploadedFile::fake()->image('test.png');
        $filenamePng = $pet->generatePetImage($pngFile, 'Rex');
        expect($filenamePng)->toEndWith('.png');
    });

    it('generates unique filenames for same pet name', function () {
        $pet = new Pet();
        $file1 = UploadedFile::fake()->image('test1.jpg');
        $file2 = UploadedFile::fake()->image('test2.jpg');

        $filename1 = $pet->generatePetImage($file1, 'Moka');
        $filename2 = $pet->generatePetImage($file2, 'Moka');

        expect($filename1)->not->toBe($filename2);
    });

    it('returns empty string if storage fails', function () {
        Storage::shouldReceive('disk->putFileAs')->andReturn(false);

        $pet = new Pet();
        $file = UploadedFile::fake()->image('test.jpg');

        $filename = $pet->generatePetImage($file, 'Moka');

        expect($filename)->toBe('');
    });
});

describe('HandleImages Trait - deletePetImage', function () {

    it('deletes original from private storage', function () {
        $pet = new Pet();
        $file = UploadedFile::fake()->image('test.jpg');

        $filename = $pet->generatePetImage($file, 'Moka');
        Storage::disk('local')->assertExists(config('pets.original_path') . '/' . $filename);

        $pet->deletePetImage($filename);

        Storage::disk('local')->assertMissing(config('pets.original_path') . '/' . $filename);
    });

    it('deletes all public variants', function () {
        $filename = 'moka-123.jpg';

        // Créer des variants fictifs
        foreach (config('pets.sizes') as $size) {
            $variantPath = sprintf(config('pets.path_to_variant'), $size['name']);
            Storage::disk('public')->put($variantPath . '/moka-123.webp', 'fake content');
        }

        $pet = new Pet();
        $pet->deletePetImage($filename);

        foreach (config('pets.sizes') as $size) {
            $variantPath = sprintf(config('pets.path_to_variant'), $size['name']);
            Storage::disk('public')->assertMissing($variantPath . '/moka-123.webp');
        }
    });

    it('does nothing if photo path is null', function () {
        $pet = new Pet();

        $pet->deletePetImage(null);

        expect(true)->toBeTrue();
    });

    it('does nothing if photo path is empty string', function () {
        $pet = new Pet();

        $pet->deletePetImage('');

        expect(true)->toBeTrue();
    });
});
