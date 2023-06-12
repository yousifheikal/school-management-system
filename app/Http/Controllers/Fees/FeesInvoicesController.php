<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Repository\FeeInvoicesInterface;
use Illuminate\Http\Request;

class FeesInvoicesController extends Controller
{

    protected $Fees_Invoice;


    public function __construct(FeeInvoicesInterface $Fees_Invoice)
    {
        $this->Fees_Invoice = $Fees_Invoice;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->Fees_Invoice->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return $this->Fees_Invoice->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return $this->Fees_Invoice->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
