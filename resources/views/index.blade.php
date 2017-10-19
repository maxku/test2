@extends('template')

@section('content')
    <style>
        .ui-droppable-hover {
            margin-left: 15px;
            font-size: large;
        }

        .ui-draggable-dragging {
            font-size: smaller;
        }
    </style>
    @include('find')
    <?php
    // Print tree root and root's children
    printChildren(-1, 2);
    ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.link', function (e) {
                e.preventDefault();
                var id = $(this).text();
                if (!$(this).hasClass('active')) {
                    $.ajax({
                        type: 'GET',
                        url: 'find',
                        data: 'id=' + $(this).text(),
                        success: function (result) {
                            $("#content" + id).html(result);
                        }
                    });
                    $(this).addClass('active');
                }
                else {
                    $("#content" + id).html('');
                    $(this).removeClass('active');
                }
                return false;
            });
        });
    </script>

@stop