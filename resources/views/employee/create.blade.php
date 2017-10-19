<h2 class="page-header">New Employee</h2>
{!! Form::open(["id"=>"frm","class"=>"form-horizontal", "files" => true]) !!}
@include("employee._form")
{!! Form::close() !!}