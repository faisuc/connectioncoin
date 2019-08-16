<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::where('id', '!=', auth()->id())->get();

        $this->views['users'] = $users;

        return view('messages.index', $this->views);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message;
        $message->to_user_id = $request->input('to_user_id');
        $message->from_user_id = auth()->id();
        $message->text = $request->input('text');
        $message->save();

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function getMessagesFor($user_id)
    {
        $messages = Message::where(function ($q) use ($user_id) {
            $q->where('from_user_id', auth()->id());
            $q->where('to_user_id', $user_id);
        })->orWhere(function ($q) use ($user_id) {
            $q->where('from_user_id', $user_id);
            $q->where('to_user_id', auth()->id());
        })->get();

        return response()->json($messages);
    }

}
