<?php

use Bzfvrto\Carbonize\Support\CSVAdemeReader;
use Bzfvrto\Carbonize\Support\Reader;

test('reader can be instantiated', function () {
    $reader = new CSVAdemeReader(
        __DIR__.'/../../assets/base-carboner_combustible.csv'
    );

    expect($reader)->toBeInstanceOf(Reader::class);
});

test('reader will throw exception if file does not exist', function () {
    $reader = new CSVAdemeReader(
        __DIR__.'/../../assets/not_existing_file.csv'
    );
    expect($reader->read())->toThrow(Exception::class);
})->throws(Exception::class, 'Can not open file');
