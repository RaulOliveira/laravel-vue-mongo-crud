<?php

namespace App\Services;

use App\Soda;

class SodaService
{

    public function getPaginatedSodaList($page){
        return Soda::all();
    }

    public function getSodaById($id){
        return Soda::findOrFail($id);
    }

    public function verifyExistsSodaWithBrandAndLiters($brand, $liters)
    {
        $count = Soda::where('brand', $brand)
                        ->where('liters', $liters)
                        ->count();
        if( $count ) {
            throw new \ErrorException(
                "Já existe um refrigerante com a marca {$brand} de litragem {$liters}!"
            );
        }
    }

    public function createSoda($data)
    {
        $this->verifyExistsSodaWithBrandAndLiters($data['brand'], $data['liters']);

        return Soda::create($data);
    }

    public function updateSoda($data, $id)
    {
        $soda = Soda::find($id);

        if(!$soda) {
            throw new \ErrorException('Não foi possivel identificar o refrigerante!');
        }

        $this->verifyExistsSodaWithBrandAndLiters($data['brand'], $data['liters']);

        return $soda->update($data);
    }


    public function deleteSoda($id)
    {
        $soda = Soda::find($id);
        if(!$soda) {
            throw new \ErrorException('Não foi possivel identificar o refrigerante!');
        }
        return $soda->delete();
    }
}
