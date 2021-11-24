<?php

namespace Tests\Feature;

use Tests\TestCase;

class DataSampleTest extends TestCase
{
    public function test_datatable_file()
    {
        $path = app_path();
        $this->assertTrue(file_exists($path . '/Traits/DataTable.php'));
    }
}