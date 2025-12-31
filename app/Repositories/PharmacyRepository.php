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
    public function __construct(Pharmacy $pharmacy)
    {
        $this->model=$pharmacy;
    }
    public function query()
    {
        return $this->model->newQuery()->orderByDesc('id');
    }

    public function find($id){
        return $this->model->find($id);
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($pharmacy, array $data)
    {
        if ($pharmacy) {
            $pharmacy->update($data);
            return $pharmacy;
        }
        return null;
    }

    public function delete($pharmacy)
    {
        if ($pharmacy) {
            return $pharmacy->delete();
        }
        return false;
    }
}
