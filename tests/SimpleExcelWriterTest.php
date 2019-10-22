<?php

namespace Spatie\SimpleExcel\Tests;

use Spatie\SimpleExcel\SimpleExcelWriter;
use Spatie\Snapshots\MatchesSnapshots;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class SimpleExcelWriterTest extends TestCase
{
    use MatchesSnapshots;

    /** @var \Spatie\TemporaryDirectory\TemporaryDirectory */
    private $temporaryDirectory;

    /** @var string */
    private $pathToCsv;

    public function setUp(): void
    {
        parent::setUp();

        $this->temporaryDirectory = new TemporaryDirectory(__DIR__ . '/temp');

        $this->pathToCsv = $this->temporaryDirectory->path('test.csv');
    }

    /** @test */
    public function it_can_write_a_regular_csv()
    {
        SimpleExcelWriter::create($this->pathToCsv)
            ->addRow([
                'first_name' => 'John',
                'last_name' => 'Doe',
            ])
            ->addRow([
                'first_name' => 'Jane',
                'last_name' => 'Doe',
            ]);;

        $this->assertMatchesFileSnapshot($this->pathToCsv);
    }

    /** @test */
    public function it_can_write_a_csv_without_a_header()
    {
        SimpleExcelWriter::create($this->pathToCsv)
            ->noHeader()
            ->addRow([
                'first_name' => 'John',
                'last_name' => 'Doe',
            ])
            ->addRow([
                'first_name' => 'Jane',
                'last_name' => 'Doe',
            ]);

        $this->assertMatchesFileSnapshot($this->pathToCsv);
    }
}
