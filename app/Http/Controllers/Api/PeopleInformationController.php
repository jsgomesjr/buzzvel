<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\PeopleInformation;
use Illuminate\Support\Facades\DB;

class PeopleInformationController extends Controller
{

    protected $repository;

    public function __construct(PeopleInformation $people_information)
    {
        $this->repository = $people_information;
    }

    public function store(Request $request)
    {
        $result = array();
        try {
            $data = $request->all();

            $object = $this->repository::create($data);

            $result["message_name"] = 'Successfully registered';
            $result["message_type"] = "success";
            $result["object"] = $object;

            return response()->json($result, 201);
        } catch (\Exception $e) {
            $result["message_name"] = $e->getMessage();
            $result["message_type"] = "error";
            $result["message_exception"] = $e->getMessage();

            return response()->json($result);
        }
    }

    public function show(Request $request)
    {

        $result = array();
        try {
            // Performing the query by the md5 hash ID and the name, as using only the name as a parameter may result in repetitions
            $object = $this->repository::where(DB::raw('MD5(id)'), $request->md5_id)->where('name', $request->name)->first();

            $result["message_name"] = 'Request successfully fulfilled';
            $result["message_type"] = "success";
            $result["object"] = $object;
        } catch (\Exception $e) {
            $result["message_name"] = $e->getMessage();
            $result["message_type"] = "error";
            $result["message_exception"] = $e->getMessage();

        } finally {
            return response()->json($result);
        }
    }

    public function update(Request $request, $id)
    {
        $result = array();
        try {
            $object = $this->repository::find($id)->update($request->all());

            $result["message_name"] = 'Updated successfully';
            $result["message_type"] = "success";
            $result["object"] = $object;
        } catch (\Exception $e) {
            $result["message_name"] = $e->getMessage();
            $result["message_type"] = "error";
            $result["message_exception"] = $e->getMessage();

        } finally {
            return response()->json($result);
        }
    }

}
