<?php

namespace App\Http\Controllers;

use App\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{

    // Check input values
    public function check_validator($input)
    {
        $rules = [
            'id'             => 'numeric',
            'full_name'      => 'required',
            'position'       => 'required',
            'emp_start_date' => 'date',
            'salary'         => 'numeric',
            'boss_id'        => 'numeric',
            'image'          => 'image:jpg,png',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return [
                'fail'   => true,
                'errors' => $validator->getMessageBag()->toArray(),
            ];
        }
    }

    // Fill employee's data from Input
    public function fillData($employee)
    {
        if (Input::get('id') > 0) {
            $employee->id = Input::get('id');
        }
        $employee->full_name = Input::get('full_name');
        $employee->position = Input::get('position');
        $employee->emp_start_date = Input::get('emp_start_date') ?
            Input::get('emp_start_date') : Carbon::now();
        if (Input::get('salary')) {
            $employee->salary = Input::get('salary');
        }
        if (Input::get('boss_id')) {
            $employee->boss_id = Input::get('boss_id');
        }

        // Save image if needed
        if (Input::file()) {
            if ($image = EmployeeController::saveImage(Input::file('image'),
                $employee)
            ) {
                $employee->image = $image;
            }
        }

        return $employee;
    }

    // Get input image and save it
    public function saveImage($image, $employee)
    {
        if (!$image) {
            return false;
        }

        $size = 300;
        $small = 20;
        $filename = $employee->id . '.'
            . $image->getClientOriginalExtension();

        Image::make($image)->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save("pics/$filename");
        Image::make($image)->resize($small, $small)
            ->save("pics/small_$filename");

        return $filename;
    }

    // Index page
    public function getIndex()
    {
        return view('employee.index');
    }

    // Get data for list
    public function getList()
    {
        Session::put('employee_search', Input::has('ok')
            ? Input::get('search')
            : (Session::has('employee_search') ? Session::get('employee_search')
                : ''));
        Session::put('employee_field', Input::has('field')
            ? Input::get('field')
            : (Session::has('employee_field') ? Session::get('employee_field')
                : 'id'));
        Session::put('employee_sort', Input::has('sort')
            ? Input::get('sort')
            : (Session::has('employee_sort') ? Session::get('employee_sort')
                : 'asc'));
        $employees = Employee::where('id', 'like',
            '%' . Session::get('employee_search') . '%')
            ->orWhere('full_name', 'like',
                '%' . Session::get('employee_search') . '%')
            ->orWhere('position', 'like',
                '%' . Session::get('employee_search') . '%')
            ->orWhere('emp_start_date', 'like',
                '%' . Session::get('employee_search') . '%')
            ->orWhere('salary', 'like',
                '%' . Session::get('employee_search') . '%')
            ->orWhere('boss_id', 'like',
                '%' . Session::get('employee_search') . '%')
            ->orderBy(Session::get('employee_field'),
                Session::get('employee_sort'))->paginate(50);
        return view('employee.list', ['employees' => $employees]);
    }

    public function getUpdate($id)
    {
        return view('employee.update', ['employee' => Employee::find($id)]);
    }

    // Update employee
    public function postUpdate($id)
    {
        // Validate
        if (is_array(
            $res = EmployeeController::check_validator(Input::all()))
        ) {
            return $res;
        }

        $employee = Employee::find($id);

        $employee = EmployeeController::fillData($employee);
        $employee->save();

        return ['url' => 'employee/list'];
    }

    public function getCreate()
    {
        return view('employee.create', ['employee' => '']);
    }

    // Create employee
    public function postCreate()
    {
        // Validate
        if (is_array(
            $res = EmployeeController::check_validator(Input::all()))
        ) {
            return $res;
        }

        $employee = new Employee;

        // Check if new employee is in "deleted" list
        $softDeleted = Employee::onlyTrashed()
            ->where('full_name', '=', Input::get('full_name'))
            ->where('position', '=', Input::get('position'))->first();
        if ($softDeleted) {
            $employee = $softDeleted;
            $softDeleted->deleted_at = null;
        }

        $employee = EmployeeController::fillData($employee);
        $employee->save();

        return ['url' => 'employee/list'];
    }

    // Delete employee
    public function getDelete($id)
    {
        $emp = Employee::find($id);

        // Delete image file
        $img = $emp->image;
        if ($img) {
            if (file_exists(public_path() . '/pics/' . $img)) {
                unlink(public_path() . '/pics/' . $img);
            }
            if (file_exists(public_path() . '/pics/small_' . $img)) {
                unlink(public_path() . '/pics/small_' . $img);
            }
        }
        $emp->image = null;
        $emp->save();

        $emp->delete();

        return Redirect('employee/list');
    }

}
