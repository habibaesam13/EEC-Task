<?php

namespace App\Repositories;

use App\Models\Pharmacy;

class PharmacyRepository
{
    /**
     * Create a new class instance.
     */
    protected $model;
    public function __construct(Pharmacy $product)
    {
        $this->model=$product;
    }
    public function all(){
        return $this->model->all();
    }

    public function find($id){
        return $this->model->findOrFail($id);
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->model->find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete($id)
    {
        $product = $this->model->find($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }
}
