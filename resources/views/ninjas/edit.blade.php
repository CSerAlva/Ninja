<x-layout>
    <h2>{{ $ninja->id }} --- {{ $ninja->name }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 触发模态框的按钮 -->
    <button type="button" class="btn btn-primary bg-danger" data-toggle="modal" data-target="#updateModal">修改</button>

    <!-- 模态框（updateModal） -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModallLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="updateModalLabel">确定要修改吗？</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-warning" id="confirmUpdate">确认</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 模态框（smileyModal1） -->
    <div class="modal fade" id="smileyModal" tabindex="-1" role="dialog" aria-labelledby="smileyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="smileyModalLabel"></h1>
                </div>
                <div class="modal-body">
                    <!-- 笑脸表情 -->
                    <div class="text-center">
                        <img src="{{ asset('images/smiley.png') }}" alt="笑脸"
                             style="display: block;margin: 0 auto; max-width: 100%;height: auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="myForm">
        @csrf
        @method('PUT')
        {{--        <input type="hidden" name="id" value="{{ $ninja->id }}">--}}
        <div class="bg-gray-200 p-4 rounded">
            <p><strong>技能值:</strong></p>
            <input type="text" name="skill" value="{{ $ninja->skill }}">
            <p><strong>关于我:</strong></p>
            <textarea name="bio" id="" cols="30" rows="10" value="">
                {{ $ninja->bio }}
            </textarea>
        </div>
        <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
            <h3>道场信息</h3>
            <p><strong>Name:</strong>{{ $ninja->dojo->name }}</p>
            <p><strong>Location:</strong>{{ $ninja->dojo->location }}</p>
            <p><strong>About the Dojo:</strong></p>
            <p>{{ $ninja->dojo->description }}</p>
        </div>
    </form>

</x-layout>

<script>
    $(document).ready(function () {
        $('#confirmUpdate').on('click', function () {
            $('#updateModal').modal('hide'); // 关闭模态框

            // 发送PUT请求
            var formData = $('#myForm').serialize(); // 序列化表单数据
            var url = '{{ route('ninjas.update', ['ninja' => $ninja]) }}'; // 生成路由URL
            // 提交表单
            $.ajax({
                type: 'PUT',
                url: url,
                data: formData, // 序列化表单数据
                dataType: 'json',
                success: function (response) {
                    // if (response.success) {
                    if (response) {
                        // console.log(response.data);

                        $('#smileyModal').modal('show'); // 显示微笑模态框
                        // 成功后的操作，例如：更新UI或显示消息
                        console.log('更新成功');
                        $('#smileyModalLabel').text('忍者' + response.data.name + '的信息更新成功!');
                        // 3秒后关闭模态框并跳转
                        setTimeout(function () {
                            window.location.href = "{{ route('ninjas.index') }}"
                        }, 3000);
                    }
                },
                error: function (xhr, status, error) {
                    // 请求失败后的回调函数
                    console.log('更新失败');
                    // 这里可以处理错误信息，例如显示错误通知等
                    console.error("An error occurred: " + status + " - " + error);
                }
            })
        })
    })
</script>
