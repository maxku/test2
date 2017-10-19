<h1 class="page-header">Employees
    <div class="pull-right">
        <a href="javascript:ajaxLoad('employee/create')" class="btn btn-success pull-right"><i
                    class="glyphicon glyphicon-plus-sign"></i> New</a>
    </div>
</h1>
<div class="col-sm-7 form-group">
    <div class="input-group">
        <input class="form-control" id="search" value="{{ Session::get('employee_search') }}"
               onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('employee/list')}}?ok=1&search='+this.value)"
               placeholder="Search..."
               type="text">

        <div class="input-group-btn">
            <button type="button" class="btn btn-default"
                    onclick="ajaxLoad('{{url('employee/list')}}?ok=1&search='+$('#search').val())"><i
                        class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>
            <a href="javascript:ajaxLoad('employee/list?field=id&sort={{Session::get("employee_sort")=="asc"?"desc":"asc"}}')">
                ID
            </a>
        </th>
        <th>
            <a href="javascript:ajaxLoad('employee/list?field=full_name&sort={{Session::get("employee_sort")=="asc"?"desc":"asc"}}')">
                Full Name
            </a>
        </th>
        <th>
            <a href="javascript:ajaxLoad('employee/list?field=position&sort={{Session::get("employee_sort")=="asc"?"desc":"asc"}}')">
                Position
            </a>
        </th>
        <th>
            <a href="javascript:ajaxLoad('employee/list?field=emp_start_date&sort={{Session::get("employee_sort")=="asc"?"desc":"asc"}}')">
                Employment Start
            </a>
        </th>
        <th>
            <a href="javascript:ajaxLoad('employee/list?field=salary&sort={{Session::get("employee_sort")=="asc"?"desc":"asc"}}')">
                Salary
            </a>
        </th>
        <th>
            <a href="javascript:ajaxLoad('employee/list?field=boss_id&sort={{Session::get("employee_sort")=="asc"?"desc":"asc"}}')">
                Boss ID
            </a>
        </th>
        <th>
            Image
        </th>
        <th width="140px"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $key=>$employee)
        <tr>
            <td>{{$employee->id}}</td>
            <td>{{$employee->full_name}}</td>
            <td>{{$employee->position}}</td>
            <td>{{$employee->emp_start_date}}</td>
            <td>{{$employee->salary}}</td>
            <td>{{$employee->boss_id}}</td>
            <td>
                @if ($employee->image)
                    <img src="/pics/small_{{$employee->image}}?t={{time()}}" style="max-height:20px;max-width:20px"/>
                @endif
            </td>
            <td style="text-align: center">
                <a class="btn btn-primary btn-xs" title="Edit"
                   href="javascript:ajaxLoad('employee/update/{{$employee->id}}')">
                    <i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a class="btn btn-danger btn-xs" title="Delete"
                   href="javascript:if(confirm('Are you sure want to delete?')) ajaxLoad('employee/delete/{{$employee->id}}')">
                    <i class="glyphicon glyphicon-trash"></i> Delete
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pull-left">{!! str_replace('/?','?',$employees->render()) !!}</div>

<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
</script>