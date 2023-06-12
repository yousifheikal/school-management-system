<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\Level;
use Illuminate\Http\Request;

class Fees implements FeesInterface
{
    public function index()
    {
        $fees = Fee::all();
        return view('pages.fees.index', compact('fees'));
    }

    public function create()
    {
        $Grades = Level::all();
        return view('pages.fees.add', compact('Grades'));
    }

    public function store($request)
    {
        try {

            $fees = new Fee();

            $fees->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fees->amount = $request->amount;
            $fees->Grade_id = $request->Grade_id;
            $fees->Classroom_id = $request->Classroom_id;
            $fees->description = $request->description;
            $fees->year = $request->year;
            $fees->Fee_type = $request->Fee_type;

            $fees->save();

            toastr()->success('message.success');
            return redirect()->route('Fees.index');
        }
        catch (\Exception $e){

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee = Fee::findOrfail($id);
        $Grades = Level::all();
        return view('pages.fees.edit', compact('fee', 'Grades'));
    }

    public function update($request)
    {
        try {
            $fees = Fee::where('id', $request->id)->first();

            $fees->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fees->amount = $request->amount;
            $fees->Grade_id = $request->Grade_id;
            $fees->Classroom_id = $request->Classroom_id;
            $fees->description = $request->description;
            $fees->year = $request->year;
            $fees->Fee_type = $request->Fee_type;

            $fees->save();
            toastr()->success('message.update');
            return redirect()->route('Fees.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        //
        try {
            Fee::where('id', $request->id)->delete();

            toastr()->error('message.delete');
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
