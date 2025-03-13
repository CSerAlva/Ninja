<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class ImageUploadController extends Controller
{
    //
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|file|image|mimes:jpeg,png,gif,svg|max:1024'
            ]);

            if ($validator->fails()) {
                return redirect('images')->withErrors($validator)->withInput();
            }

            //验证上传的文件是否合法
            $validator = Validator::make($request->all(), [
                'image' => 'required|file|image|mimes:png,jpg,jpeg,gif,svg|max:1024'
            ]);

            if ($validator->fails()) {
                return redirect('images')->withErrors($validator)->withInput();
            }

            //        //Validate that an uploaded file is exactly 1 - 1024 kilobytes...
            //        $validatorData = $request->validate([
            //            'image' => [
            //                'required',
            //                'mimes:jpeg,png,jpg,gif,svg',
            //                File::image()
            //                    ->min(1)
            //                    ->max(1024)
            ////                    ->dimensions(Rule::dimensions()->maxWidth(1000)->maxHeight(500)),
            //            ],
            //        ]);

            //        $file = $request->files;$a = $file->hashName('images');dd($a);
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $fileExtension = $image->getClientOriginalExtension();
            $newFileName = md5($filename . time() . mt_rand(1, 10000)) . '.' . $fileExtension;
            $savePath = 'images/' . $newFileName;
            $webPath = '/storage/' . $savePath;

            //将文件保存在本地 storage/app/public/images目录下,如果存在相同文件 则返回json格式的路径
            if (Storage::disk('public')->has($savePath)) {
                return response()->json(['path' => $webPath]);
            };

            //执行保存操作,保存成功将访问路径返回给调用方
            if ($image->storePubliclyAs('images', $newFileName, ['disk' => 'public'])) {
//                $filePath = $image->store('images', 'public');
                //        dd($filename);

                $imageModel = new Image();
                $imageModel->name = $newFileName;
                $imageModel->path = $savePath;
                $imageModel->url = $savePath;

                if ($imageModel->save()) {
                    $request->session()->put('newImageId', $imageModel->id);
                    return redirect()->route('images.index')->with('success', '图片上传成功.');
                }
                return response()->json(['path' => $webPath]);
            }
            return response()->json('图片文件上传失败', '405');
        } else {
            return redirect()->route('images.index')->withErrors('请选择要上传的文件');
        }
    }

    //
    public function index(Request $request)
    {
        $newImageId = $request->session()->get('newImageId');
        $newImage = null;
        if ($newImageId) {
            $newImage = Image::findOrFail($newImageId);
            $request->session()->forget('newImageId');

            return view('upload/images/upload', compact('newImage'));
        }
        return view('upload/images/upload');
    }
}
