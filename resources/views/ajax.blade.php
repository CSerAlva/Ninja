
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
</script>
<script>
    // Your JS code here
    $(document).ready(function () {
        $('#ninja').on('click', function () {
            // alert(111);

            // 发送GET请求
            {{--var url = '{{ route('ninjas.index') }}'; // 生成路由URL--}}
            var url = '/ninjas'; // 生成路由URL
            // 提交表单
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                // success: function (response) {
                success: function (data) {
                    // if (response.success) {
                    if (response) {
                        console.log(response.data);
                        // 成功后的操作，例如：更新UI或显示消息
                        // console.log('请求数据成功');
                        // $('#smileyModalLabel').text('忍者' + response.data.name + '的信息更新成功!');
                    }
                },
                error: function (xhr, status, error) {
                    // 请求失败后的回调函数
                    // 这里可以处理错误信息，例如显示错误通知等
                    console.error("An error occurred: " + status + " - " + error);
                }
            })
//
// // Fill the table with data
//                 var data = [
//                     {name: 'John Doe', email: 'john@example.com', id: 1},
//                     {name: 'Jane Doe', email: 'jane@example.com', id: 2}
// // ... more data
//                 ];
//
//                 for (var i = 0; i < data.length; i++) {
//                     var row = $('<tr></tr>');
//                     row.append($('<td><input type="checkbox" class="select-row"></td>'));
//                     row.append($('<td>' + data[i].name + '</td>'));
//                     row.append($('<td>' + data[i].email + '</td>'));
//                     row.append($('<td><button class="btn btn-danger btn-sm delete-row">Delete</button></td>'));
//                     $('#data-table tbody').append(row);
//                 }
//
// // Handle delete button click
//                 $('#data-table').on('click', '.delete-row', function () {
//                     $(this).closest('tr').remove();
//                 });
//
// // Handle select all checkbox
//                 $('#select-all').click(function () {
//                     $('.select-row').prop('checked', $(this).prop('checked'));
//                 });
//
// // Handle delete selected button click
//                 $('#delete-selected').click(function () {
//                     $('.select-row:checked').each(function () {
//                         $('#data-table tbody')
//                             .find('tr')
//                             .filter(function () {
//                                 return $(this).find('.select-row').is(':checked');
//                             })
//                             .remove();
//                     })
//                     $('#select-all').prop('checked', false);
//                 })
        })
    })
</script>
