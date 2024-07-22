<?php
namespace App\Services\Interface;

class InterfaceService
{
    public function addProducts($data)
    {
        if($data['type'] == 'add-yourself') {
            
        }elseif($data['type'] == 'add-from-suppot') {

        }else {
            return false;
        }
    }

}