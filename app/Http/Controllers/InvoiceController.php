<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Return all invoices 
     * 
     * @return Invoice
     */
    public function showAll()
    {
        return response()->json(Invoice::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant de la facture
     * 
     * @return Invoice
     */
    public function showOne($id)
    {
        return response()->json(Invoice::find($id));
    } 

    public function create(Request $request)
    {
        $this->validate($request, [
            'lib'       => 'required',
            'amount'    => 'required',
            'mentee'    => 'required',
        ]);

        $invoice = Invoice::create($request->all());
        return response()->json($invoice, 201);
    }
    
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'lib'       => 'required',
            'amount'    => 'required',
            'mentee'    => 'required',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->lib = $request->input('lib');
        $invoice->amount = $request->input('amount');
        $invoice->mentee = $request->input('mentee');
        $invoice->save();
        return response()->json($invoice, 200);
    }
    
    public function cancel($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = 2;
        $invoice->update();
        return response()->json($invoice, 200);
    }
}
