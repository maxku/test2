$('.draggable').draggable({ revert: true });
$('.droppable').droppable({
    drop: function(e, ui) {
        $(ui.helper).remove(); //destroy clone
        var drag_id = $(ui.draggable).text().split(" ",1);
        $("#content"+drag_id).remove();
        $(ui.draggable).remove(); //remove from list
        var id = $(this).text().split(" ",1);

        $("#content" + id).html('');
        $(this).removeClass('active');
        $.ajax({
            type: 'GET',
            url: 'find',
            data: 'id=' + id+'&dragid='+drag_id,
            success: function (result) {
                $("#content" + id).html(result);
                $(this).addClass('active');
            }
        });
    }
});
