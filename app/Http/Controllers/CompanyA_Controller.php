<?php

namespace App\Http\Controllers;

use App\Http\Services\FileManagementService;
use App\Models\CompanyA;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyA_Controller extends Controller
{
    private FileManagementService $fileManagementService;

    public function __construct(FileManagementService $fileManagementService)
    {
        $this->fileManagementService = $fileManagementService;
        $this->middleware('auth');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('layout.adminLayout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $addcompanyA = CompanyA::last();
        return view('pages.companyA', compact('addcompanyA'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'date' => 'required',
            'postSite' => 'required|string',
            'guardName' => 'required|string',
            'shiftStart' => 'required',
            'shiftEnd' => 'required',
            'remarks' => 'required|string',

        ]);


        $companyA = new CompanyA();
        $companyA->date = $request->date;
        $companyA->postSite = $request->postSite;
        $companyA->guardName = $request->guardName;
        $companyA->shiftStart = $request->shiftStart;
        $companyA->shiftEnd = $request->shiftEnd;
        $companyA->remarks = $request->remarks;



        if($request->string('totalHour') && $request->string('sumofth')){
        $shiftStart = Carbon::parse($request->shiftStart);
        $shiftEnd = Carbon::parse($request->shiftEnd);
        $now = Carbon::now();

        $minutes = $shiftStart->diffInMinutes($shiftEnd);
        $totalHour = Carbon::parse($minutes)->format('i:s');


        }
        $companyA->totalHour = $totalHour;


        $companyA->save();

        return redirect()->route('admin.companyA.list')->with('Success', 'New dataset has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyA  $companyA
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list(Request $request)
    {

        $companyAlists = CompanyA::all();
        $companyAlists->date = $request->date;
        $companyAlists->postSite = $request->postSite;
        $companyAlists->guardName = $request->guardName;
        $companyAlists->shiftStart = $request->shiftStart;
        $companyAlists->shiftEnd = $request->shiftEnd;
        $companyAlists->totalHour = $request->totalHour;
        $companyAlists->remarks = $request->remarks;

        $companyAlists = $this->calculateTotalHours($companyAlists);


        return view('pages.companyAlist', compact('companyAlists'));

    }

    public function calculateTotalHours($companyAsearches){
        $times = 0;
        foreach($companyAsearches as $company){
            if (isset($company->totalHour)) {
                $time = Carbon::parse($company->totalHour)->diffInMinutes('00:00');
            }
            else{
                $time = 0;
            }
            $times = $times + $time;
        }
        $companyAsearches->sumOfTotalHour = Carbon::parse($times)->format('i:s');
        return $companyAsearches;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyA  $companyA
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $companyAsearches = CompanyA::all();

        //search by Post Site
        if( $request->postSite){
            $companyAsearches = CompanyA::where('postSite', 'LIKE', "%" . $request->postSite . "%")->get();
        }
        //search by Guard Name
        if( $request->guardName){
            $companyAsearches = CompanyA::where('guardName', 'LIKE', "%" . $request->guardName . "%")->get();
        }

        //Search by Date From
        if( $request->date_from){
            $date_from = $request->input('date_from');
            $companyAsearches = CompanyA::where('date', '>=', $date_from)->get();
        }
        //Search by Date To
        if( $request->date_to){
            $date_to = $request->input('date_to');
            $companyAsearches = CompanyA::where('date', '<=', $date_to)->get();
        }
        //search by Date Range
        if( $request->date_from && $request->date_to ){

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');

            $companyAsearches = DB::table('company_a_s')->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->get();

        }

        //search by Post Site & Guard Name
        if( $request->postSite && $request->guardName ){
            $companyAsearches = CompanyA::where('postSite', 'LIKE', "%" . $request->postSite . "%")
                                                 ->where('guardName', 'LIKE', "%" . $request->guardName . "%")
                                                 ->get();
        }
        //search by Post Site & Date
        if( $request->postSite && $request->date ){
            $date = $request->input('date_from');
            $companyAsearches = DB::table('company_a_s')->where('postSite', 'LIKE', "%" . $request->postSite . "%")
                ->where('date', 'LIKE', "%" . $request->$date . "%")
                ->get();
        }

        //search by Date & Guard Name
        if( $request->date && $request->guardName ){
            $date = $request->input('date_from');
            $companyAsearches = DB::table('company_a_s')->where('date', 'LIKE', "%" . $request->$date . "%")
                ->where('guardName', 'LIKE', "%" . $request->guardName . "%")
                ->get();
        }
        //search by Post Site, Guard Name & Date
        if( $request->postSite && $request->guardName && $request->date ){
            $date = $request->input('date_from');
            $companyAsearches = DB::table('company_a_s')->where('postSite', 'LIKE', "%" . $request->postSite . "%")
                ->where('guardName', 'LIKE', "%" . $request->guardName . "%")
                ->where('date', 'LIKE', "%" . $request->$date . "%")
                ->get();
        }
        $companyAsearches = $this->calculateTotalHours($companyAsearches);
//        dd($companyAsearches->sumOfTotalHour);

//        $companyAsearches = $companyAsearches->paginate(10);
        return view('pages.companyAsearch', compact('companyAsearches'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyA  $companyA
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $companyAlists = CompanyA::find($id);
        return view('pages.companyAedit', compact('companyAlists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompanyA $companyA
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [

            'date' => 'required',
            'postSite' => 'required|string',
            'guardName' => 'required|string',
            'shiftStart' => 'required',
            'shiftEnd' => 'required',
            'remarks' => 'required|string',

        ]);


        $companyA = CompanyA::find($id);
        $companyA->date = $request->date;
        $companyA->postSite = $request->postSite;
        $companyA->guardName = $request->guardName;
        $companyA->shiftStart = $request->shiftStart;
        $companyA->shiftEnd = $request->shiftEnd;
        $companyA->remarks = $request->remarks;



        if($request->string('totalHour') && $request->string('sumofth')){
            $shiftStart = Carbon::parse($request->shiftStart);
            $shiftEnd = Carbon::parse($request->shiftEnd);
            $now = Carbon::now();

            $minutes = $shiftStart->diffInMinutes($shiftEnd);
            $totalHour = Carbon::parse($minutes)->format('i:s');


        }
        $companyA->totalHour = $totalHour;


        $companyA->save();


        $companyA->save();

        return redirect()->route('admin.companyA.list')->with('Success', 'New dataset has been created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyA  $companyA
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $companyAlists = CompanyA::find($id);

//        if(!isset($companyAlists)) return redirect()->route('admin.icon.list')->with('Failed', 'No Info was found');
//        if(is_null($companyAlists->icon)) return redirect()->route('admin.icon.list')->with('Failed', 'No Info was found');
//
//        $replacementPart = 'storage/' . $this->fileManagementService->iconPath();
//
//        $iconFile = !isset($companyAlists) ? null : str_replace($replacementPart, '' , $companyAlists->icon);
//        $iconDeleteFileResponse = $this->fileManagementService->deleteFile($this->fileManagementService->iconPath(), $iconFile);
//
//        if(!$iconDeleteFileResponse) return redirect()->route('admin.specialization')->with('Failed', 'No Info was found');



        $companyAlists->delete();

        return redirect()->route('admin.companyA.list')->with('Success', 'Info has been deleted successfully.');
    }
}
