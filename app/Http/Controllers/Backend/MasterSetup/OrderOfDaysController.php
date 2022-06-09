<?php

namespace App\Http\Controllers\Backend\MasterSetup;


use App\Model\OrderOfDay;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\NoticeRulesRequest;
use Illuminate\Support\Facades\Validator;
use Auth;


class OrderOfDaysController extends Controller
{

    public function index()
    {
        return view('backend.master_setup.orderofdays.index');
    }

    public function store(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'order_date' => 'required',
            'order_document'  => 'required|mimes:pdf|max:5048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        if ($request->hasfile('order_document')) {

            $request->order_date = (isset($request->order_date) && $request->order_date != '') ? date('Y-m-d', strtotime($request->order_date)) : null;

            // Delete Data to Notice Attachment Table
            if (!is_null($id)) {
                $orderData = OrderOfDay::where('id', $id)->get();
                foreach ($orderData as $attachmentFile) {
                    $folder = public_path('/backend/attachment/');
                    @unlink($folder . $attachmentFile->order_document);
                }
                OrderOfDay::where('id', $id)->delete();
            }

            if ($files = $request->file('order_document')) {
                //foreach ($files as $file) {
                $extension = $files->getClientOriginalExtension();
                $filename = 'OrderOfDay' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
                $folder = public_path('/backend/attachment/'); // Define folder path
                $files->move($folder, $filename); // Upload image
                // Insert Data to Notice Attachment Table
                $orderData = new OrderOfDay();
                $orderData->order_date = $request->order_date; 
                $orderData->order_name = $request->order_name; 
                $orderData->order_document = $filename; // Set file path in database to filePath
                $done = $orderData->save();
                if ($done) {

                if (isApi()) {
                    $response['status'] = 'success';
                    $response['message'] = 'Data Store Successfully';
                    return response()->json($response);
                }
                    return Response()->json([
                        "success" => true,
                        'file_name' => $filename
                    ]);
                }
                // }
                
            } else {
                if (isApi()) {
                    $response['status'] = 'error';
                    $response['message'] = 'Sorry! Data not insert';
                    return response()->json($response);
                }
                return Response()->json([
                    "success" => false
                ]);
            }
        }
    }

    public function listOrders(Request $request)
    {
        $order_date = explode("~",$request->order_date);

        $start = date('Y-m-d', strtotime($order_date[0]));
        $end = date('Y-m-d', strtotime($order_date[1]));

        $data['order_lists'] = OrderOfDay::whereBetween('order_date', [$start, $end])->get();
        
            if (isApi()) {
                $response['document_path']    = asset('public/backend/attachment/');
                
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = $data;
                return response()->json($response);
            }
       
        $final_result = ' <table id="list_orders_table" class="table table-sm table-bordered table-striped"> <thead> <tr> <th>' . \Lang::get("Date") . '</th> <th>' . \Lang::get("Order Document") . '</th><th>'. \Lang::get("Action") .'</th> </tr></thead><tbody>';

        if(count($data['order_lists'])>0){
            foreach($data['order_lists'] as $r){
                $final_result .= '<tr><td>' . digitDateLang(nanoDateFormat($r->order_date)) . '</td><td><a href="'.asset('public/backend/attachment/'.$r->order_document).'" target="_blank"> Orders of the Day '.date('d-m-Y', strtotime($r->order_date)).' </a></td><td><a class="btn btn-sm btn-danger destroy" data-route="' . route('admin.master_setup.orderofdays.destroy', $r->id) . '"><i class="fa fa-trash"></i></a></td></tr>';
            }
            $final_result .= '</tbody></table>';
            return json_encode(array('status' => true, 'data' => $final_result), true);
        }
        else {
            return json_encode(array('status' => false), true);
        }


    }

    public function destroy($id)
    {
        try {
            $orderofDay = OrderOfDay::where('id', $id)->get();
            foreach ($orderofDay as $attachmentFile) {
                $folder = public_path('/backend/attachment/');
                @unlink($folder . $attachmentFile->order_document);
            }
            OrderOfDay::where('id', $id)->delete();
                if (isApi()) {
                    $response['status'] = 'success';
                    $response['message'] = 'Data Delete Successfully';
                    return response()->json($response);
                }
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = 'You are facing some error';
                return response()->json($response);
            }
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }
}
