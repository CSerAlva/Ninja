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

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('ninjas.edit',$ninja->id) }} ">
                <button type="submit" class="btn my-4 btn-primary bg-success">
                    编辑
                </button>
            </form>
        </div>
        <div class="col-md-6">
            <!-- 触发模态框的按钮 -->
            <button type="button" class="btn my-4 btn-primary bg-primary" data-toggle="modal" data-target="#delModal">
                删除
            </button>

            <!-- 模态框（delModal） -->
            <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="关闭">
                                <span aria-hidden="true">点击关闭弹窗 &times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            真的要删除忍者 {{ $ninja->name }} 吗？
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary bg-primary" data-dismiss="modal">取消
                            </button>
                            <form action="{{ route('ninjas.destroy',$ninja->id) }} " method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary bg-danger">删除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-200 p-4 rounded">
        <div>
            <p><strong>技能值:</strong></p>
            <input type="text" name="skill" value="{{ $ninja->skill }}" disabled>
        </div>
        <div>
            <p><strong>关于我:</strong></p>
        </div>
        <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
            <textarea name="bio" id="" cols="30" rows="10" value="" disabled>
                {{ $ninja->bio }}
            </textarea>
        </div>
    </div>

    <div class="border-2 border-dashed bg-warning px-4 pb-4 my-4">
        <h3>道场信息</h3>
        <p><strong>名称:</strong>{{ $ninja->dojo->name }}</p>
        <p><strong>位置:</strong>{{ $ninja->dojo->location }}</p>
        <p><strong>关于道场:</strong></p>
        <p>{{ $ninja->dojo->description }}</p>
    </div>
</x-layout>
