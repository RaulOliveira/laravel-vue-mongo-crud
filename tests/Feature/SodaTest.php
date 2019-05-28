<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\SodaService;

class SodaRepositoryTest extends TestCase
{
    /**
     * @todo Implementar autentication
     */
    public function testCreateSoda()
    {
        $return = $this->post('/sodas', [
            'brand'        => 'Fanta',
            'liters'       => '1l',
            'type'         => 'Lata',
            'quantity'     => 1,
            'pricePerUnit' => 5.0
        ]);

        $this->assertDatabaseHas('sodas', [
            'brand'        => 'Fanta',
            'liters'       => '1l',
            'type'         => 'Lata',
            'quantity'     => 1,
            'pricePerUnit' => 5.0
        ]);
    }

    public function testUpdateSoda()
    {
        $return = $this->put('/sodas/5ceaf8bfe84de44af161eb42', [
            'brand'        => 'Fanta2',
            'liters'       => '1l',
            'type'         => 'Lata',
            'quantity'     => 1,
            'pricePerUnit' => 10.0
        ]);
        var_dump($return);
        $this->assertDatabaseHas('sodas', [
            'brand'        => 'Fanta2',
            'liters'       => '1l',
            'type'         => 'Lata',
            'quantity'     => 1,
            'pricePerUnit' => 10.0
        ]);
    }

    public function testDeleteSoda()
    {
        $return = $this->delete('/sodas/5ceaf8bfe84de44af161eb42');

        var_dump($return);

        $this->assertDatabaseMissing('sodas', [
            'brand'        => 'Fanta2',
            'liters'       => '1l',
            'type'         => 'Lata',
            'quantity'     => 1,
            'pricePerUnit' => 10.0
        ]);
    }
}
