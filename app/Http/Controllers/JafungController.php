<?php

namespace App\Http\Controllers;

use App\Models\Jafung;
use Auth;
use Inertia\Inertia;
use Request;

class JafungController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($klas = null)
    {
        if($klas){
            $klasifikasi = ucfirst($klas);
        }
        $jafungs = Jafung::query()->where('klasifikasi',$klasifikasi)
        ->when(Request::input('search'), function ($query, $search) {
            $query->where('unsur', 'like', "%{$search}%")
            ->orWhere('sub_unsur', 'like', "%{$search}%")
            ->orWhere('uraian_kegiatan', 'like', "%{$search}%")
            ->orWhere('output', 'like', "%{$search}%");
        })->paginate(6)->withQueryString()
        ->through(fn($jafung) => [
            'id' => $jafung->id,
            'klasifikasi' => $jafung->klasifikasi,
            'no' => $jafung->no,
            'unsur' => $jafung->unsur,
            'sub_kode' => $jafung->sub_kode,
            'sub_unsur' => $jafung->sub_unsur,
            'no_keg' => $jafung->no_keg,
            'uraian_kegiatan' => $jafung->uraian_kegiatan,
            'sub_unsur' => $jafung->sub_unsur,
            'output' => $jafung->output,
            'angka_kredit' => $jafung->angka_kredit,
            'butir' => $jafung->butir,
            'pelaksana' => $jafung->pelaksana,
            ]);
        return Inertia::render('Jafung/Index', [
            'jafungs' => $jafungs,
            'filters' => Request::only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'department_name' => 'required',
            'phone_number' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',

        ]);

        if($validator->fails()){
            return $this->sendErrorValidationResponse('Validation Error.', $validator->errors());
        }

        $product = Employee::create($input);

        return $this->sendSuccessResponse(new EmployeeResource($product), 'Employee saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        $jafungs = Jafung::where('id',$id)->first();

        // TODO: REGEX untuk split text setiap nomor
        $text1 = $jafungs->deskripsi;
        $text2 = $jafungs->bukti_fisik;

        $deskripsi_keg = preg_split("/[0-9]+[.]/", $text1);
        $buktiFisik = preg_split("/[0-9]+[.]/", $text2);
        // return $buktiFisik;
        // return array_merge([
        //     'desc' => $keywords,
        //     'jafung' => $jafungs,
        //     ]);
        // collect($jafungs)->through(fn ($jafungs) => [
        //     'id' => $jafungs->id,
        //     'klasifikasi' => $jafungs->klasifikasi,
        //     'no' => $jafungs->no,
        //     'unsur' => $jafungs->unsur,
        //     'sub_kode' => $jafungs->sub_kode,
        //     'sub_unsur' => $jafungs->sub_unsur,
        //     'no_keg' => $jafungs->no_keg,
        //     // 'organization' => $contact->organization ? $contact->organization->only('name') : null,
        // ]);

        // ->map([
        //     'id' => $jafungs->id,
        //     'klasifikasi' => $jafungs->klasifikasi,
        //     'no' => $jafungs->no,
        //     'unsur' => $jafungs->unsur,
        //     'sub_kode' => $jafungs->sub_kode,
        //     'sub_unsur' => $jafungs->sub_unsur,
        //     'no_keg' => $jafungs->no_keg,
        //     'uraian_kegiatan' => $keywords,
        //     'sub_unsur' => $jafungs->sub_unsur,
        //     'output' => $jafungs->output,
        //     'angka_kredit' => $jafungs->angka_kredit,
        //     'butir' => $jafungs->butir,
        //     'pelaksana' => $jafungs->pelaksana,
        // ]);
        // return jafungs;
        return Inertia::render('Jafung/Show', [
            'jafungs' => $jafungs,
            'dekripsiKeg' => $deskripsi_keg,
            'buktiFisik' => $buktiFisik,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (empty($employee)) {
            return $this->sendErrorResponse("Employee not found");
        }
        $input = $request->all();

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'department_name' => 'required',
            'phone_number' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        if($validator->fails()){
            return $this->sendErrorValidationResponse('Validation Error.', $validator->errors() );
        }

        $employee->first_name = $input['first_name'];
        $employee->last_name = $input['last_name'];
        $employee->email = $input['email'];
        $employee->phone_number = $input['phone_number'];
        $employee->department_name = $input['department_name'];
        $employee->start_date = $input['start_date'];
        $employee->end_date = $input['end_date'];
        $employee->save();

        return $this->sendSuccessResponse(new EmployeeResource($employee), 'Employee updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (empty($employee)) {
            return $this->sendErrorResponse('Employee not found');
        }
        $employee->delete();
        return $this->sendSuccessResponse([], 'Employee deleted successfully.');
    }
}
