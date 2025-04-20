<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistanceController extends Controller
{
    public function index()
    {
        return view('pages.distance');
    }

    protected function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371;

        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;

        $a = sin($dlat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dlng / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }


    public function calculateDistance(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'lat1' => 'required|numeric|between:-90,90',
                'lng1' => 'required|numeric|between:-180,180',
                'lat2' => 'required|numeric|between:-90,90',
                'lng2' => 'required|numeric|between:-180,180',
            ]);

            if ($validate->fails()) {
                $errorMessage = $validate->errors()->first();
                return redirect()->back()->withInput()->with('error', $errorMessage);
            }

            $distance = $this->getDistance(
                $request->lat1,
                $request->lng1,
                $request->lat2,
                $request->lng2
            );

            return redirect()->route('distance')->with('distance', $distance);
        } catch (Exception $err) {
            return redirect()->back()->withInput()->with('error', $err->getMessage());
        }
    }
}