<h2 class="page-header">Edit Employee</h2>
{!! Form::model($employee,["id"=>"frm","class"=>"form-horizontal", "files" => true]) !!}
@include("employee._form")
{!! Form::close() !!}