<?php

namespace App\Contracts;

interface BaseRepository
{
    public function query();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
