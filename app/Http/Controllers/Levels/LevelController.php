<?php

namespace App\Http\Controllers\Levels;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Response;
use App\Models\Classroom;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*** SEND DATA IN TABLE LEVELS TO BLADE-PAGE ***/
        $levels = Level::all();
        return view('pages.levels.levels', compact('levels'));
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
        /**** CHECK LEVEL-NAME UNIQUE OR NO ****/
        if (Level::where('Level_Name->ar', $request->Name)->orWhere('Level_Name->en', $request->Name_en)->exists()){
            return redirect()->back()->withErrors(trans('message.unique'));
        }

        /**** USING TRY-CATCH FOR CATCH ANY ERROR AND DISPLAY MSG ERROR ****/
        try {

            /**** VALIDATION FOR DATA COMING FORM ADD-LEVEL ****/
            $validate = $request->validate([
                'Name' => 'required',
            ],[
                'Name.required' => trans('validation.required'),
            ]);

            /**** INSERT DATA COMING FORM ADD-LEVEL IN TABLE LEVELS ****/
            $levels = new Level();
            $levels
                /**** USING PACKAGE FOR SPATIE FOR TRANSLATING COLUMN ****/
                ->setTranslation('Level_Name', 'en', $request->Name_en)
                ->setTranslation('Level_Name', 'ar', $request->Name)
                ->setTranslation('Notes', 'en', $request->Notes)
                ->setTranslation('Notes', 'ar', $request->Notes)
                ->save();

            /**** USING PACKAGE FOR TOASTR FOR DISPLAY BEAUTIFUL MSG  ****/
            toastr()->success(trans('message.success'));
            return redirect()->route('levels.index');
        }
        catch (\Exception $e)
        {
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /**** USING TRY-CATCH FOR CATCH ANY ERROR AND DISPLAY MSG ERROR ****/
        try {

            /**** VALIDATION FOR DATA COMING FORM ADD-LEVEL ****/
            $validate = $request->validate([
                'Name' => 'required',
                'Name_en' => 'required',
            ],[
                'Name.required' => trans('validation.required'),
                'Name_en.required' => trans('validation.required'),
            ]);

            /**** UPDATING DATA COMING FORM EDIT-LEVEL ****/
            $level = Level::findOrFail($request->id);
            $level->update([
                $level->Level_Name = ['ar' => $request->Name, 'en' => $request->Name_en],
                $level->Notes = ['ar' => $request->Notes, 'en' => $request->Notes],
            ]) ;

            /**** USING PACKAGE FOR TOASTR FOR DISPLAY BEAUTIFUL MSG  ****/
            toastr()->success(trans('message.update'));
            return redirect()->route('levels.index');
        }
        catch (\Exception $e)
        {
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        /*** IF YOU COLUMN LEVEL IN RELATIONSHIP WITH CLASSROOM NOT DELETE ***/
        $classroom = Classroom::where('level_id', $id)->pluck('level_id');

        if ($classroom->count() == 0)
        {
            Level::destroy($id);
            toastr()->success(trans('message.delete'));
            return redirect()->route('levels.index');
        }
        else
        {
            toastr()->warning(trans('message.delete-error'));
            return redirect()->back();
        }
    }
}
