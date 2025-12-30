<?php

namespace App\Services;

use App\Models\Pharmacy;
use App\Repositories\PharmacyRepository;

class PharmacyService
{
    /**
     * Create a new class instance.
     */
    protected $repository;
    /**
     * Create
     *  a new class instance.
     */
    public function __construct(PharmacyRepository $pharmacyRepository)
    {
        $this->repository = $pharmacyRepository;
    }

    public function all( int $pageSize = 10)
    {
        return $this->repository
            ->query()
            ->cursorPaginate($pageSize);
    }

    public function store(array $data)
    {
        return $this->repository->create($data);
    }

    public function destroy(Pharmacy $pharmacy): void
    {
        if (! $pharmacy) {
            throw new \Exception('Pharmacy not found');
        }
        $this->repository->delete($pharmacy);
    }

    public function show(Pharmacy $pharmacy)
    {
        if (! $pharmacy) {
            throw new \Exception('Pharmacy not found');
        }
        return $pharmacy;
    }
    public function update(Pharmacy $pharmacy, array $data)
    {
        return $this->repository->update($pharmacy, $data);
    }
}
