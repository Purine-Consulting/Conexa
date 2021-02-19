<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Return all payments 
     * 
     * @return Payment
     */
    public function showAll()
    {
        if (!auth()->user()->hasPermissionTo('see_payments')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Payment::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant du paiement
     * 
     * @return Payment
     */
    public function showOne($id)
    {
        if (!auth()->user()->hasPermissionTo('see_payment')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Payment::find($id));
    } 

    public function create(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_payment')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'ref'       => 'required',
            'date'      => 'required',
            'invoice'   => 'required',
        ]);

        $payment = Payment::create($request->all());
        return response()->json($payment, 201);
    }
    
    public function update($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('update_payment')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'ref'       => 'required',
            'date'      => 'required',
            'invoice'   => 'required',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());
        return response()->json($payment, 200);
    }
}
