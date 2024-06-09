<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportVendor implements ToModel, WithHeadingRow
{
    public $rowCount = 0;
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rowCount;
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => $row['password'],
            'role' => User::ROLE_VENDOR
        ]);
    }

    public function getRowCount()
    {
        $arr = (array)$this->rowCount;
        return count($arr);
    }
}
