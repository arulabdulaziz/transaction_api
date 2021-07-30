<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helper\Response;
use App\Utility\Utility;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getData(){
    //     return "getDAta";
    // }
    function responseUndefinedData()
    {
        $result['message'] = "Transaction not Found";
        $result['messageId'] = "Transaksi tidak ditemukan";
        return Response::jsonErrorSimple(
            Controller::BAD_REQUEST_STATUS,
            Controller::INCORRECT_DATA,
            $result['message'],
            $result['messageId']
        );
    }
    public function index(Request $request)
    {
        $searchItem = $request->search_item;
        $itemPerPage = $request->item_per_page;
        $transaction = Transaction::where("title", "like", "%" . $searchItem . "%")->paginate($itemPerPage, ["id", "title", "time", "type", "amount"]);
        return Response::jsonSuccessSimple(true, $transaction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'type' => 'required|string|in:expense,revenue',
            'amount' => 'required|numeric',
            'time' => 'required|date_format:Y-m-d H:i:s',

        ], Utility::getErrorMessage());
        if ($validator->fails()) {
            return Response::jsonErrorValidation($validator);
        }
        $transaction = new Transaction;
        $transaction->title = $request->title;
        $transaction->amount = $request->amount;
        $transaction->type = $request->type;
        $transaction->time = $request->time;
        $transaction->save();
        return Response::jsonSuccessSimple(true, $transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data = Transaction::find($id);
        if (!$data) {
            return $this->responseUndefinedData();
        }
        return Response::jsonSuccessSimple(true, $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return $this->responseUndefinedData();
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'type' => 'required|string|in:expense,revenue',
            'amount' => 'required|numeric',
            'time' => 'required|date_format:Y-m-d H:i:s',

        ], Utility::getErrorMessage());
        if ($validator->fails()) {
            return Response::jsonErrorValidation($validator);
        }
        $transaction->title = $request->title;
        $transaction->amount = $request->amount;
        $transaction->type = $request->type;
        $transaction->time = $request->time;
        $transaction->save();
        return Response::jsonSuccessSimple(true, $transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return $this->responseUndefinedData();
        }
        $transaction->delete();
        return Response::jsonSuccessSimple(true, $transaction);
    }
}
