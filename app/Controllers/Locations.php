<?php

namespace App\Controllers;

use App\Models\LocationModel;

class Locations extends BaseController
{

    public function index()
    {
        $locationModel = new LocationModel();
        $data['locations'] = $locationModel->findAll();
        $data['pageTitle'] = 'Manage Locations';
        return view('locations', $data);
    }

    public function addLocation()
    {
        $db = \Config\Database::connect();
        $data = [
            'locationName' => $this->request->getPost('formLocation')
        ];
        $db->table('tbllocations')->insert($data);
        return redirect()->back();
    }

    public function deleteLocation($id = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbllocations');
        $builder->where('locationID', $id);
        $builder->delete();

        // $delete = $builder->where('id', $id)->delete();

        // $delete = $model->where('id', $id)->delete();
        // if ($delete) {
        //     echo json_encode(array("status" => true));
        // } else {
        //     echo json_encode(array("status" => false));
        // }
    }

    // public function viewLocation($id = null)
    // {
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('tbllocations')->select('*')->where('locationID', $id)->get();
    //     $data = $builder->getResultArray();


    //     if ($data) {
    //         echo json_encode(array("status" => true, 'data' => $data));
    //     } else {
    //         echo json_encode(array("status" => false));
    //     }
    // }


    public function viewLocation()
    {
        $db = \Config\Database::connect();
        $query = $db->table('tbllocations')->select('*')->get();
        $data = $query->getResultArray();
        return json_encode($data);
    }

}