@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @sharedAlerts
    <div class="messaging">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                    <h4>Recent</h4>
                    </div>
                    {{-- <div class="srch_bar">
                    <div class="stylish-input-group">
                        <input type="text" class="search-bar"  placeholder="Search" >
                        <span class="input-group-addon">
                        <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                        </span> </div>
                    </div> --}}
                </div>
                <div class="inbox_chat">
                    @foreach ($messages as $message)
                        <div class="chat_list">
                            <a href="#" data-user-id="<?php echo $message->user->id; ?>">
                                <div class="chat_people">
                                <div class="chat_img"> <img src="{{ $message->user->thePhoto }}" alt="sunil"> </div>
                                    <div class="chat_ib">
                                    <h5>{{ $message->user->getFullName() }} <span class="chat_date">{{ ! is_null($message->user->getLastMessage()) ? $message->user->getLastMessage()->theFormattedTimeAgo : '' }}</span></h5>
                                    <p>{{ ! is_null($message->user->getLastMessage()) ? $message->user->getLastMessage()->text : '' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                </div>
                <div class="mesgs">
                <div class="msg_history" data-user-id="">
                    
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                    <input type="text" class="write_msg" placeholder="Type a message" />
                    <button class="msg_send_btn" type="button">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
@endsection
