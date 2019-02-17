<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hospital;

class HospitalController extends Controller
{

    public function Display()
    {
        try {

            return response()->json(Hospital::all());
        }
        catch (\Exception $e)
        {
            return array('success' => false, 'message' => "List of Hospitals");
        }
    }

    public function listfacilities($id)
    {
        try {
            $facility = Hospital::findOrFail($id);
//            echo "<pre>"; print_r($facility); die;
        return response()->json($facility);
    } catch (\Exception $ex) {

        return array('success' => false, 'message' => "hospital not found");
    }
    }
}
