<x-layout>
    <h2>Create a New Ninja</h2>

    {{--    validation errors--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="px-4 py-2 bg-red-100">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ninjas.store') }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="1">
        <label for="name">Ninja 姓名:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        <label for="email">邮箱:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        <label for="skill">技能值 (0-100):</label>
        <input type="number" id="skill" name="skill" value="{{ old('skill') }}" required>
        <label for="bio">技能:</label>
        <textarea rows="6" id="bio" name="bio" value="{{ old('bio') }}" required>Biography</textarea>
        <label for="Dojo">道场:</label>
        <select id="dojo_id" name="dojo_id" required>
            <option value="" disabled selected>
                Select A Dojo
            </option>
            @foreach($dojos as $dojo)
                <option value="{{ $dojo->id }}" {{ $dojo->id == old('dojo_id') ? 'selected' : ''}}>
                    {{ $dojo->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn mt-4">提交</button>
    </form>
</x-layout>
