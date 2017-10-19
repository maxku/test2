<div style="display:block; margin-bottom:20px;">
    @if ($employee && $employee->image)
        <img src="/pics/{{$employee->image}}?t={{time()}}" style="display:block; margin:auto;"/>
    @endif
</div>
<div class="form-group required" id="form-id-error">
    {!! Form::label("id","ID",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::text("id",null,["class"=>"form-control required","id"=>"focus"]) !!}
        <span id="id-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-full_name-error">
    {!! Form::label("full_name","Full Name *",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::text("full_name",null,["class"=>"form-control required"]) !!}
        <span id="full_name-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-position-error">
    {!! Form::label("position","Position *",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::text("position",null,["class"=>"form-control required"]) !!}
        <span id="position-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-emp_start_date-error">
    {!! Form::label("emp_start_date","Employment Start",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::text("emp_start_date",null,["class"=>"form-control required"]) !!}
        <span id="emp_start_date-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-salary-error">
    {!! Form::label("salary","Salary",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::text("salary",null,["class"=>"form-control required"]) !!}
        <span id="salary-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-boss_id-error">
    {!! Form::label("boss_id","Boss ID",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::text("boss_id",null,["class"=>"form-control required"]) !!}
        <span id="boss_id-error" class="help-block"></span>
    </div>
</div>
<div class="form-group required" id="form-image-error">
    {!! Form::label("image","Image",["class"=>"control-label col-md-3"]) !!}
    <div class="col-md-6">
        {!! Form::file("image",null,["class"=>"form-control required"]) !!}
        <span id="image-error" class="help-block"></span>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-push-3">
        <a href="javascript:ajaxLoad('employee/list')" class="btn btn-danger"><i
                    class="glyphicon glyphicon-backward"></i>
            Back</a>
        {!! Form::button("<i class='glyphicon glyphicon-floppy-disk'></i> Save",["type" => "submit","class"=>"btn
    btn-primary"])!!}
    </div>
</div>
<script>
    $("#frm").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var data = new FormData($(this)[0]);
        var url = form.attr("action");
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#frm input.required, #frm textarea.required').each(function () {
                        index = $(this).attr('id');
                        if (index in data.errors) {
                            $("#form-" + index + "-error").addClass("has-error");
                            $("#" + index + "-error").html(data.errors[index]);
                        }
                        else {
                            $("#form-" + index + "-error").removeClass("has-error");
                            $("#" + index + "-error").empty();
                        }
                    });
                    $('#focus').focus().select();
                } else {
                    $(".has-error").removeClass("has-error");
                    $(".help-block").empty();
                    ajaxLoad(data.url, data.content);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        return false;
    });
</script>