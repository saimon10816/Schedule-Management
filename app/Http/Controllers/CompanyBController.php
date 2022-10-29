<?php

namespace App\Http\Controllers;

use App\Http\Services\FileManagementService;
use App\Models\CompanyB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyBController extends Controller
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
        $addcompanyB = CompanyB::last();
        return view('pages.companyB', compact('addcompanyB'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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


        $companyB = new CompanyB();
        $companyB->date = $request->date;
        $companyB->postSite = $request->postSite;
        $companyB->guardName = $request->guardName;
        $companyB->shiftStart = $request->shiftStart;
        $companyB->shiftEnd = $request->shiftEnd;
        $companyB->remarks = $request->remarks;



        if($request->string('totalHour')){
            $shiftStart = Carbon::parse($request->shiftStart);
            $shiftEnd = Carbon::parse($request->shiftEnd);
            $now = Carbon::now();

            $minutes = $shiftStart->diffInMinutes($shiftEnd);
            $totalHour = Carbon::parse($minutes)->format('i:s');
        }

        $companyB->totalHour = $totalHour;


        $companyB->save();

        return redirect()->route('admin.companyB.list')->with('Success', 'New dataset has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyB  $companyB
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list(Request $request)
    {

        $companyBlists = CompanyB::all();
        $companyBlists->date = $request->date;
        $companyBlists->postSite = $request->postSite;
        $companyBlists->guardName = $request->guardName;
        $companyBlists->shiftStart = $request->shiftStart;
        $companyBlists->shiftEnd = $request->shiftEnd;
        $companyBlists->totalHour = $request->totalHour;
        $companyBlists->remarks = $request->remarks;

        $companyBlists = $this->calculateTotalHours($companyBlists);



        return view('pages.companyBlist', compact('companyBlists'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyB  $companyB
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(CompanyB $companyB)
    {
        $companyBlists = CompanyB::find($id);
        return view('pages.companyBedit', compact('companyBlists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyB  $companyB
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CompanyB $companyB)
    {
        $this->validate($request, [

            'date' => 'required',
            'postSite' => 'required|string',
            'guardName' => 'required|string',
            'shiftStart' => 'required',
            'shiftEnd' => 'required',
            'remarks' => 'required|string',

        ]);


        $companyB = CompanyB::find($id);
        $companyB->date = $request->date;
        $companyB->postSite = $request->postSite;
        $companyB->guardName = $request->guardName;
        $companyB->shiftStart = $request->shiftStart;
        $companyB->shiftEnd = $request->shiftEnd;
        $companyB->remarks = $request->remarks;



        if($request->string('totalHour')){
            $shiftStart = Carbon::parse($request->shiftStart);
            $shiftEnd = Carbon::parse($request->shiftEnd);
            $now = Carbon::now();

            $minutes = $shiftStart->diffInMinutes($shiftEnd);
            $totalHour = Carbon::parse($minutes)->format('i:s');
        }

        $companyB->totalHour = $totalHour;


        $companyB->save();

        return redirect()->route('admin.companyB.list')->with('Success', 'New dataset has been created successfully.');
    }

    public function calculateTotalHours($companyBsearches){
        $times = 0;
        foreach($companyBsearches as $company){
            if (isset($company->totalHour)) {
                $time = Carbon::parse($company->totalHour)->diffInMinutes('00:00');
            }
            else{
                $time = 0;
            }
            $times = $times + $time;
        }
        $companyBsearches->sumOfTotalHour = Carbon::parse($times)->format('i:s');
        return $companyBsearches;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyB  $companyA
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $companyBsearches = CompanyB::all();

        //search by Post Site
        if( $request->postSite){
            $companyBsearches = CompanyB::where('postSite', 'LIKE', "%" . $request->postSite . "%")->get();
        }
        //search by Guard Name
        if( $request->guardName){
            $companyBsearches = CompanyB::where('guardName', 'LIKE', "%" . $request->guardName . "%")->get();
        }
        //search by Date
        if( $request->date){
            $companyBsearches = CompanyB::where('date', 'LIKE', "%" . $request->date . "%")->get();
        }
        //search by Post Site & Guard Name
        if( $request->postSite && $request->guardName ){
            $companyBsearches = CompanyB::where('postSite', 'LIKE', "%" . $request->postSite . "%")
                ->where('guardName', 'LIKE', "%" . $request->guardName . "%")
                ->get();
        }
        //search by Post Site & Date
        if( $request->postSite && $request->date ){
            $companyBsearches = CompanyB::where('postSite', 'LIKE', "%" . $request->postSite . "%")
                ->where('date', 'LIKE', "%" . $request->date . "%")
                ->get();
        }

        if( $request->date_from && $request->date_to ){

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');

            $companyBsearches = DB::table('company_b_s')->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->get();

        }

        //search by Date & Guard Name
        if( $request->date && $request->guardName ){
            $companyBsearches = CompanyB::where('date', 'LIKE', "%" . $request->date . "%")
                ->where('guardName', 'LIKE', "%" . $request->guardName . "%")
                ->get();
        }
        //search by Post Site, Guard Name & Date
        if( $request->postSite && $request->guardName && $request->date ){
            $companyBsearches = CompanyB::where('postSite', 'LIKE', "%" . $request->postSite . "%")
                ->where('guardName', 'LIKE', "%" . $request->guardName . "%")
                ->where('date', 'LIKE', "%" . $request->date . "%")
                ->get();
        }
        $companyBsearches = $this->calculateTotalHours($companyBsearches);


//        $companyBsearches = $companyBsearches->paginate(10);
        return view('pages.companyBsearch', compact('companyBsearches'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyB  $companyB
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $companyBlists = CompanyB::find($id);

//        if(!isset($companyBlists)) return redirect()->route('admin.icon.list')->with('Failed', 'No Info was found');
//        if(is_null($companyBlists->icon)) return redirect()->route('admin.icon.list')->with('Failed', 'No Info was found');
//
//        $replacementPart = 'storage/' . $this->fileManagementService->iconPath();
//
//        $iconFile = !isset($companyBlists) ? null : str_replace($replacementPart, '' , $companyBlists->icon);
//        $iconDeleteFileResponse = $this->fileManagementService->deleteFile($this->fileManagementService->iconPath(), $iconFile);
//
//        if(!$iconDeleteFileResponse) return redirect()->route('admin.specialization')->with('Failed', 'No Info was found');



        $companyBlists->delete();

        return redirect()->route('admin.companyB.list')->with('Success', 'Info has been deleted successfully.');
    }
}
