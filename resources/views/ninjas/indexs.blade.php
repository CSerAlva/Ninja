<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')

    <title>Table with Bootstrap and jQuery</title>

    @include('layouts.css')

    <!-- Mix -->
    {{--    <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
    <!-- Scripts -->
    {{--    <script src="{{ mix('/js/app.js') }}"></script>--}}
    {{--    <script src="{{ mix('js/app.js') }}" defer></script>--}}

    <!-- Vite SCSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
<div class="container">
    <table class="table table-bordered table-hover" id="data-table">
        <thead>
        <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Table rows will be added here -->
        </tbody>
    </table>
    <button class="btn btn-danger" id="delete-selected">Delete Selected</button>
</div>
</body>

<!-- 在 <body>底部 包含 Bootstrap 的 JS文件 -->
<script src="{{ asset('js/bootstrap/jquery-3.3.1.slim.min.js') }}"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

<script src="{{ asset('js/bootstrap/popper.min.js') }}"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
</script>

<script>
    // Your JS code here
    $(document).ready(function () {

// Fill the table with data
        var data = [
            {name: 'John Doe', email: 'john@example.com', id: 1},
            {name: 'Jane Doe', email: 'jane@example.com', id: 2}
// ... more data
        ];

        for (var i = 0; i < data.length; i++) {
            var row = $('<tr></tr>');
            row.append($('<td><input type="checkbox" class="select-row"></td>'));
            row.append($('<td>' + data[i].name + '</td>'));
            row.append($('<td>' + data[i].email + '</td>'));
            row.append($('<td><button class="btn btn-danger btn-sm delete-row">Delete</button></td>'));
            $('#data-table tbody').append(row);
        }

// Handle delete button click
        $('#data-table').on('click', '.delete-row', function () {
            $(this).closest('tr').remove();
        });

// Handle select all checkbox
        $('#select-all').click(function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

// Handle delete selected button click
        $('#delete-selected').click(function () {
            $('.select-row:checked').each(function () {
                $('#data-table tbody')
                    .find('tr')
                    .filter(function () {
                        return $(this).find('.select-row').is(':checked');
                    })
                    .remove();
            });
            $('#select-all').prop('checked', false);
        });
    });
</script>

</html>
