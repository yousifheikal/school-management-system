<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Repository\FeesInterface;
use Illuminate\Http\Request;

class FeeController extends Controller
{

    protected $fees;

    public function __construct(FeesInterface $fees)
    {
        $this->fees = $fees ;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->fees->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return $this->fees->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return $this->fees->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return $this->fees->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        return $this->fees->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->fees->destroy($request);
    }
}
