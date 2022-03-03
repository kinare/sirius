<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentLeaveApplication;
use App\Http\NavSoap\NavSyncManager;
use App\Http\Resources\StudentResource;
use App\Http\Resources\UserResource;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    protected $filter_model = Student::class;
    use Filterable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $this->authorize('index', Student::class);
        $data = $this->filter($request->all())->paginate();
        if($request->is('api*')){
            return StudentResource::collection($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Student $student)
    {
        if($request->is('api*')){
            return new StudentResource($student);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }

    public function user(Request $request, Student $student){
//        $this->authorize('view', $student);
        if($request->is('api*')){
            return new UserResource($student->user);
        }
    }

    public function picture(Request $request, Student $student){
//        $this->authorize('view', $student);
        if($request->is('api*')){
            $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
            try{

                return response()->file($storagePath."students/$student->No/profile_picture/$student->Profile_Picture");
            }
            catch (\Exception $e){
                return response()->file($storagePath."public/default-avatar.jpg");
            }
        }
    }

    public function timetable(Request $request){
        $manager = new NavSyncManager();
        //return $reg_no = Auth::user()->student->Current_Registration_No;
        $id = Auth::user()->student->ID_Number;
        //$id = Student::where('Current_Registration_No', $reg_no)->first()->ID_Number;
        $base64 = $manager->getTimetable($id);
        $pdf_string = base64_decode($base64);
        $headers = [
            'Content-type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'."$id.pdf".'"',
        ];

        return \Response::make($pdf_string, 200, $headers);
    }

    public function examResults(Request $request){
        //  return 'mamama';
        $manager = new NavSyncManager();
        // $reg_no = Auth::user()->student->Current_Registration_No;
        $reg_no = Auth::user()->student->ID_Number;
        $base64 = $manager->getExamResults($reg_no);
         $pdf_string = base64_decode($base64);

        $headers = [
            'Content-type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'."$reg_no.pdf".'"',
        ];
        return \Response::make($pdf_string, 200, $headers);
    }


}
