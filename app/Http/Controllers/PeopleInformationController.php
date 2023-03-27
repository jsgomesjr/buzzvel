<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\PeopleInformation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class PeopleInformationController extends Controller
{

    protected $repository;

    public function __construct(PeopleInformation $people_information)
    {
        $this->repository = $people_information;
    }

    public function create()
    {
        $result = array();
        try {
            return view('screens.people_information.form');
        } catch (\Exception $e) {
            $result["message_name"] = $e->getMessage();
            $result["message_type"] = "error";
            $result["message_exception"] = $e->getMessage();

            return back()->withErrors($result)->withInput();
        }
    }

    public function store(Request $request)
    {
        $result = array();
        try {
            $data = $request->all();

            $object = $this->repository::create($data);

            // qrcodeurl that's required to make the qrcode image in the frontend
            $qrcode_url = Config::get('system.website_domain') . 'show/' . md5($object->id) . '/' . $object->name;

            $result["message_name"] = 'Successfully registered';
            $result["message_type"] = "success";
            $result["object"] = $object;
            $result["qrcode_url"] = $qrcode_url;

        } catch (\Exception $e) {
            $result["message_name"] = $e->getMessage();
            $result["message_type"] = "error";
            $result["message_exception"] = $e->getMessage();
        } finally {
            return response()->json($result);
        }
    }

    public function show(Request $request)
    {

        $result = array();
        try {
            // Performing the query by the md5 hash ID and the name, as using only the name as a parameter may result in repetitions
            $object = $this->repository::where(DB::raw('MD5(id)'), $request->md5_id)->where('name', $request->name)->first();

            if($object){
                return view('screens.people_information.index', compact('object'));
            } else {
                return view('404');
            }
        } catch (\Exception $e) {
            $result["message_name"] = $e->getMessage();
            $result["message_type"] = "error";
            $result["message_exception"] = $e->getMessage();

            return back()->withErrors($result)->withInput();
        }
    }
}
