<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\List_phone_number;
use App\Models\List_task_phone;
use App\Models\Task;
use App\Models\User;

use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_active'] = "data-phone";

        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
        $limit = isset($_GET['limit']) ? $_GET['limit'] : '';
        $offset = isset($_GET['offset']) ? $_GET['offset'] : '';
        $employee = isset($_GET['employee']) ? $_GET['employee'] : '';


        $model = Task::select('task.*', 'transaction.status_payment');
        if ($start_date !== '' && $end_date === '') {
            $model = $model->whereDate('task.created_date', '=', $start_date);
        }
        if ($start_date !== '' && $end_date !== '') {
            $model = $model->whereDate('task.created_date', '>=', $start_date);
        }
        if ($end_date !== '') {
            $model = $model->whereDate('task.created_date', '<=', $end_date);
        }
        if ($employee !== '') {
            $model = $model->where('task.id_employee', $employee);
        }

        $model = $model->leftJoin('transaction', 'transaction.phone', '=', 'task.phone');
        if ($limit !== '' && $offset === '') {
            $model = $model->take($limit);
        }elseif ($limit !== '' && $offset !== '') {
            $model = $model->skip($offset)->take($limit);
        }
        $model = $model->orderBy('task.id','ASC')->get();

        $model_employee = User::whereIn('role', ['employee', 'admin'])->get();

        $data['result_model'] = $model;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['list_employee'] = $model_employee;
        $data['limit'] = $limit;
        $data['offset'] = $offset;
        $data['employee'] = $employee;

        return view('dashboard.task.index1', $data);
    }

    public function task_phone_number()
    {
        $data['menu_active'] = "task";

        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

        $model = Task::select('task.*', 'transaction.status_payment');
        if ($start_date !== '' && $end_date === '') {
            $model = $model->whereDate('task.created_date', '=', $start_date);
        }
        if ($start_date !== '' && $end_date !== '') {
            $model = $model->whereDate('task.created_date', '>=', $start_date);
        }
        if ($end_date !== '') {
            $model = $model->whereDate('task.created_date', '<=', $end_date);
        }

        $user_id = Auth::user()->id;
        $model = $model->leftJoin('transaction', 'transaction.phone', '=', 'task.phone')->where(['task.id_employee' => $user_id]);
        $model = $model->orderBy('task.id','ASC')->get();

        $data['result_model'] = $model;
        $data['start_date'] = $start_date;

        return view('dashboard.task.work1', $data);
    }

    public function upload_list_phone_number(Request $request)
    {
        $date_upload = $request->date_upload;
        $rows = Excel::toArray(new List_phone_number, $request->file('file_list_number'));
        $data = $rows[0];
        if (count($data) > 0) {
            for ($i=0; $i < count($data) ; $i++) { 
                $phone = $this->clean_str($data[$i][0]);

                // $cek_list = List_phone_number::where(['phone' => $phone])->first();
                $cek_list = Task::where(['phone' => $phone])->first();
                if (is_null($cek_list)) {
                    // $create_list = List_phone_number::create([
                    //     'phone' => $phone,
                    //     'car_name' => $data[$i][1],
                    //     'price' => isset($data[$i][2]) ? $data[$i][2] : '',
                    //     'created_date' => $date_upload
                    // ]);

                    // $create_task = List_task_phone::create([
                    //     'phone' => $phone,
                    //     'car_name' => $data[$i][1],
                    //     'price' => isset($data[$i][2]) ? $data[$i][2] : '',
                    //     'id_employee' => Auth::user()->id,
                    //     'created_date' => $date_upload
                    // ]);

                    $add_task = Task::create([
                        'phone' => $phone,
                        'car_name' => $data[$i][1],
                        'id_employee' => Auth::user()->id,
                        'created_date' => $date_upload
                    ]);
                }
            }
        }

        return redirect('/task');
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
        //assign task
        // dd($request);
        if ($request->action_task == "assign") {
            foreach ($request->id_number as $key => $value) {
                $model = Task::findOrFail($value);
                $model->id_employee = $request->assign_to;
                $model->created_date = $request->date_assign;
                $model->save();
            }
        }else if ($request->action_task == "delete") {
            foreach ($request->id_number as $key => $value) {
                $model = Task::findOrFail($value);
                $model->delete();
            }
        }
        return redirect('/task');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    public function clean_str($string) {
        $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
