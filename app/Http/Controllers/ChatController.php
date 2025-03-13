<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Msg;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function msg(Request $request)
    {
        $validatedData = $request->validate([
//            'roomId' => 'required|numeric',
            'msg' => 'required|string|min:2|max:255'
        ]);
        $msg = new Msg;
        $msg->roomId = $request->roomId;
        $msg->uid = Auth::id();
        $msg->msg = $request->msg;

        if ($msg->save()) {
            return response()->json(['success' => 'ok', 'message' => 'Create successful']);
//            return redirect()->route('/home');
//            broadcast(new \App\Events\NewMessage_Leo($roomId, $msg))->toOthers();
        }
        return response()->json(['error' => 'Msg data create failed', 400]);


    }

}
