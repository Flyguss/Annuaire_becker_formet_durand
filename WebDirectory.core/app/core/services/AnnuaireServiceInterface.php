<?php

namespace WebDirectory\core\services;

interface AnnuaireServiceInterface
{
    public function getDepartments();
    public function createEntry(array $data);

}