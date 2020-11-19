<?php


namespace App\Core;


abstract class Model
{
    public function __construct(){}

    public function getById(string $id){}

    public function getAll(){}

    public function create(array $data){}

    public function update(array $data){}

    public function delete(string $id){}
}