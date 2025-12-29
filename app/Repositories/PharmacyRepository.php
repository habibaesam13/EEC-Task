<?php

namespace App\Repositories;

use App\Contracts\BaseRepository;
use App\Models\Pharmacy;

class PharmacyRepository implements BaseRepository
{
    /**
     * Create a new class instance.
     */
    protected $model;
    public function __construct(Pharmacy $product)
    {
        $this->model=$product;
    }
    public function query()
    {
        return $this->model->newQuery();
    }

    public function find($id){
        return $this->model->find($id);
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
