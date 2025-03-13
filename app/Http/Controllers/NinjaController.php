<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Models\Dojo;
use App\Models\Ninja;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

class NinjaController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function shows(string $id): Response
    {
        return Inertia::render('Users/Profile', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');//给用户做认证
    }

    public function index(): View
    {
        $ninjas = Ninja::with('dojo')->where('skill', '>', 0)->orderBy('updated_at', 'desc')->latest()->paginate(2);
        return view('ninjas.index', ['greeting' => 'hi', 'ninjas' => $ninjas]);

//$ninjas=Ninja::findOrFail(1);
//if($ninjas){
//    return response()->json(['success' => 'ok', 'message' => 'Request successful', 'data' => $ninjas]);
//}

    }

    public function show(Ninja $ninja) //$id // Laravel 使用路由模型绑定 为我们抓取 ninja
    {
//        $res = Ninja::with('dojo')->findOrFail($id);
        $res = $ninja->load('dojo');
        if (!$res) {
            throw new CustomException('Ninja not found!');
            Log::info('Ninja not found!');
        }
        Log::info('ID:' . $ninja->id);
        return view('ninjas.show', ['ninja' => $ninja]);
    }

    public function create()
    {
//        $dojos = Dojo::all();
        $dojos = Dojo::orderBy('created_at', 'desc')->get();
        return view('ninjas.create', compact('dojos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:10',
            'dojo_id' => 'required|exists:dojos,id',
            'status' => 'required|numeric',
            'email' => 'required|email',
            'skill' => 'required|integer|min:1|max:100',
            'bio' => 'required|string|min:1|max:100',
        ]);
        if (Ninja::create($validatedData)) {
            return redirect()->route('ninjas.index')->with('success', '忍者添加成功!');
        }
        return response()->json(['error' => 'Ninja data create failed', 400]);
        Log::info('ID');
    }

    public function edit(Ninja $ninja)
    {
//授权: Gate 和 Policies
//两者都是授权, Gate 一般都是闭包, 封装简单的逻辑。
// Policies 多以控制器的形式存在,可能涉及到 模型 或者 资源。

        if (!Gate::allows('update', $ninja)) {
//            return abort(403, '抱歉您还不是管理员,没有该权限');
            return redirect()->route('ninjas.index');
//            return redirect()->route('ninjas.index')->with('message','抱歉您还不是管理员,没有该权限');
        }

        $res = $ninja->load('dojo');
        if (!$res) {
            throw new CustomException('Ninja not found!');
        }
        return view('ninjas.edit', ['ninja' => $ninja]);
    }

    public function update(Request $request, Ninja $ninja)
    {
        $ninja->skill = $request->skill;
        $ninja->bio = $request->bio;
        $res = $ninja->save();
        if ($res) {
            return response()->json(['success' => 'ok', 'message' => 'Update successful', 'data' => $ninja]);
        }
        return response()->json(['error' => 'ok']);
    }

    public function destroy(Ninja $ninja): RedirectResponse
    {
        Gate::authorize('delete', $ninja);

        $ninja->delete();

        return redirect()->route('ninjas.index');
    }
}
