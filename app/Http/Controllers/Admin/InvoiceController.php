<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'total_price' => 'required|integer',
            'status' => 'required|in:Pending,Paid',
        ]);
    
        Invoice::create([
            'invoice_number' => 'INV-' . strtoupper(uniqid()),
            'customer_name' => $request->customer_name,
            'total_price' => $request->total_price,
            'status' => $request->status
        ]);
    
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice created successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view('admin.invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'invoice_number' => 'required|string|max:20',
            'customer_name' => 'required|string|max:100',
            'total_price' => 'required|integer',
            'status' => 'required|in:Pending,Paid',
        ]);
    
        $invoice->invoice_number = $request->invoice_number;
        $invoice->customer_name = $request->customer_name;
        $invoice->total_price = $request->total_price;
        $invoice->status = $request->status;
        $invoice->save();
    
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted successfully!');
    }
}
