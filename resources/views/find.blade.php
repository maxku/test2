<?php

use App\Employee;

// Prints children of $id up to $depth depth
function printChildren($id, $depth)
{
    $emps = Employee::select('id', 'position')->where('boss_id', '=', $id)->get();
    $active = '';
    if ($depth > 1)
        $active = ' active';
    echo "<ul>";
    foreach ($emps as $emp) {
        echo "<li class='draggable droppable'><a href='#' class='link $active'>$emp->id</a> $emp->position</li>";
        echo "<div id='content$emp->id'>";
        if ($depth > 1)
            printChildren($emp->id, $depth - 1);
        echo "</div>";
    }
    echo "</ul>";
}

// Drag and drop
if (isset($_REQUEST['id']) && isset($_REQUEST['dragid'])) {
    $empl = Employee::find($_REQUEST['dragid']);
    $empl->boss_id = $_REQUEST['id'];
    $empl->save();
}
// Print children only if requested
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['id']))
    printChildren($_REQUEST['id'], 1);
?>
<script>
    $(document).ready(function () {
        $.getScript("/my_script.js", function () {
        });
    });
</script>