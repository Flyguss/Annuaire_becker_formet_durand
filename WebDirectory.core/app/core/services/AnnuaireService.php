<?php

namespace WebDirectory\core\services;

class AnnuaireService implements AnnuaireServiceInterface
{


    public function getDepartments()
    {
        $sql = "SELECT id, nom FROM Département";
        $result = $this->conn->query($sql);
        $departments = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departments[] = $row;
            }
        }

        return $departments;
    }

    public function createEntry(array $data)
    {
        // TODO: Implement createEntry() method.
    }
}