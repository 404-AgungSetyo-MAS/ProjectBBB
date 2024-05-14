<?php
use App\Models\Mak;
use App\Models\Perjalanan;

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
