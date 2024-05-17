<?php
use App\Models\Mak;
use App\Models\Perjalanan;
use Illuminate\Http\UploadedFile;

test('perjalanan memiliki MAK', function () {
    // expect(true)->toBeTrue();
   $perjalanan = Perjalanan::factory()
    ->for(
        Mak::factory()
    )
    ->create();

    expect($perjalanan->mak)
        ->toBeInstanceOf(Mak::class);
});

it('deletes Files dari perjalanan setelah update', function () {
    Storage::fake('documents');

    $files = ['doctest1.docx', 'doctest2.docx'];

    $perjalanan = Perjalanan::factory()
        ->for(Mak::factory())
        ->state([
            'files' => $files
        ])
        ->create();

        foreach($files as $file) {
            $file = UploadedFile::fake()->create($file);
            Storage::disk('documents')->put($file->name, $file->path());
        }

        array_shift($files);

        $perjalanan->save();
        $deletedDocuments = array_diff($perjalanan->getOriginal('documents'), $perjalanan->documents);
});
