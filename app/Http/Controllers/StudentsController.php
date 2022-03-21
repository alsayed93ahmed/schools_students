<?php

namespace App\Http\Controllers;

use App\Mail\Mailer;
use App\Models\School;
use App\Models\Student;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
use DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $schools = School::all();
        return view('students.index', compact('schools'));
    }

    public function list()
    {
        $data = Student::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('school_id', function ($row){
                return $row->school->name;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a id="deleteStudent" href="javascript:void(0)" value="'. $row->id .'" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'school_id' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $student = new Student;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->school_id = $request->school_id;
            $schoolStudents = Student::where('school_id', $request->school_id)->get();
            if ($schoolStudents) {
                $student->order = $schoolStudents->max('order') + 1;
            } else {
                $student->order = 1;
            }

            $student->save();

            DB::commit();
            return response()->json('Student created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Student::where('id', $id)->delete();
        return response()->json('Student Deleted successfully');
    }
}
