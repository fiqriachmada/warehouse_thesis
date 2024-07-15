<?php 

namespace App\Repositories;

use App\Models\Tax;
use Ramsey\Uuid\Uuid;

class TaxRepository
{
    public function getAllTaxes()
    {
        return Tax::all();
    }

    public function getTax($id)
    {
        return Tax::find($id);
    }

    public function getFirstTax()
    {
        return Tax::first();
    }

    public function getTaxByStatus($status)
    {
        return Tax::where('status', $status);
    }

    public function checkIfTaxAlreadyExistAndActive()
    {
        return Tax::where('status', 'active')->first();
    }

    public function getAllTaxWhereNotById($id)
    {
        return Tax::whereNot('id', $id)->get();
    }

    public function createTax($data)
    {
        return Tax::create([
            'id' => Uuid::uuid4()->toString(),
            'value' => $data['value'],
            'status' => self::checkIfTaxAlreadyExistAndActive() ? 'inactive' : 'active'
        ]);
    }

    public function updateTax($data, $id)
    {
        return Tax::find($id)->update([
            'value' => $data['value']
        ]);
    }

    public function updateTaxStatus($id)
    {
        if (self::getTax($id)->status == 'active') {
            return self::getTax($id)->update([
                'status' => 'inactive'
            ]);
        } else {
            self::getTax($id)->update([
                'status' => 'active'
            ]);

            foreach (self::getAllTaxWhereNotById($id) as $key => $item) {
                $item->update([
                    'status' => 'inactive'
                ]);
            }

            return true;
        }
    }

    public function deleteTax($id)
    {
        self::getTax($id)->delete();

        if (self::getAllTaxes()->count() > 0) {
            self::getFirstTax()->update([
                'status' => 'active'
            ]);
        }

        return true;
    }
}