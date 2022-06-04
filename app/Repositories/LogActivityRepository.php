<?php
namespace App\Repositories;

use App\Repositories\LogActivityRepository as Log;
use App\Models\LogActivity;
use App\Models\User;

class LogActivityRepository 
{
    public static function create($data)
    {
        $logActivity = LogActivity::create([
            'id_user' => $data['id_user'],
            'id_table' => $data['id_table'],
            'table' => $data['table'],
            'description' => $data['description']
        ]);

        return $logActivity;
    }

}
