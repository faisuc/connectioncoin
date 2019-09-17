/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

jQuery(document).ready(function ($) {

    $(document).on('click', '.emotions li a', function (e) {
        e.preventDefault();

        var reaction_id = $(this).data('reaction');
        var story_id = $(this).data('story-id');
        var btn = $(this);

        $('.emotions li a').removeAttr('style');

        $.ajax({
            type: 'POST',
            url: '/like/story',
            data: {
                reaction_id: reaction_id,
                story_id: story_id
            },
            success: function (data) {
                btn.css('color', 'blue');
            }
        });

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var socket = io.connect( APP_URL + ":3001");

    function clientExists()
    {

        var count = $('.messaging .inbox_chat .chat_list').length;

        if (count > 0)
        {
            $('.messaging .inbox_chat .chat_list:first-child a').trigger('click');
        }

    }

    function formatAMPM(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
        dd = '0' + dd;
        }

        if (mm < 10) {
        mm = '0' + mm;
        }

        today = mm + '/' + dd + '/' + yyyy;

        return strTime + ' | ' + today;
    }

    function clearChat() {

        $('.msg_history').html('');
        $('.write_msg').val('');
        $('.write_msg').focus();

    }

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    function getMessages(user_id)
    {
        $('.msg_history').html('');
        $.ajax({
            type: 'GET',
            url: '/messages/' + user_id,
            success: function (data) {
                if (data.length) {

                    var msg = '';

                    for (var i = 0; i < data.length; i++) {

                        if (data[i].from_user_id == $('meta[name="user-id"]').attr('content')) {
                            msg += `<div class="outgoing_msg">
                                <div class="sent_msg">
                                <p>` + data[i].text + `</p>
                                <span class="time_date">` + formatAMPM(new Date) + `</span></div>
                            </div>`;
                        } else {
                            msg += `<div class="incoming_msg">
                                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p>` + data[i].text + `</p>
                                    <span class="time_date">` + formatAMPM(new Date) + `</span></div>
                                </div>
                            </div>`;
                        }

                    }

                    $('.msg_history').append(msg);

                    var div = $('.msg_history');
                    div.scrollTop(div.prop('scrollHeight'));
                }
            }
        });
    }

    function sendMessage(to_user_id, text)
    {

        $.ajax({
            type: 'POST',
            url: '/messages',
            data: {
                to_user_id: to_user_id,
                text: text
            },
            success: function (data) {
                console.log(data);
            }
        });

    }

    socket.emit('add user', {'user_id' : $('meta[name="user-id"]').attr('content')});

    $(document).on('click', '.messaging .inbox_chat .chat_list a', function(e) {

        e.preventDefault();

        var chatUrl = $(this).attr('href');
        var user_id = $(this).attr('data-user-id');

        history.pushState({
            id: 'messages',
            user_id: user_id
        }, 'Test', chatUrl);

        $('.messaging .inbox_chat .chat_list').removeClass('active_chat');
        $('.msg_history').removeAttr('data-user-id');
        $('.msg_history').attr('data-user-id', user_id);

        $(this).parent().addClass('active_chat');

        getMessages(user_id);

        clearChat();

    });

    window.addEventListener('popstate', function (event) {
        if (history.state && history.state.id === 'messages') {
            if (history.state.user_id) {
                $('.messaging .inbox_chat .chat_list:first-child a[data-user-id="' + history.state.user_id + '"]').trigger('click');
                $('.msg_history').removeAttr('data-user-id');
                $('.msg_history').attr('data-user-id', history.state.user_id);
                clearChat();
            }
        }
    }, false);

    $(document).on('click', '.msg_send_btn', function(e) {
        e.preventDefault();

        var message = $.trim($('.write_msg').val());

        var count = $('.messaging .inbox_chat .chat_list').length;

        if (count > 0)
        {
            var msg = '';
            msg += `<div class="outgoing_msg">
                        <div class="sent_msg">
                        <p>` + message + `</p>
                        <span class="time_date">` + formatAMPM(new Date) + `</span></div>
                    </div>`;

            $('.msg_history').append(msg);

            $('.write_msg').val('');
            $('.write_msg').focus();

            if (message != '')
            {

                socket.emit('send chat message', {
                    'from_user_id': $('meta[name="user-id"]').attr('content'),
                    'send_to_user_id': $('.msg_history').attr('data-user-id'),
                    'message': message,
                    'action': 'outgoing'
                });

                sendMessage($('.msg_history').attr('data-user-id'), message);

            }

            var div = $('.msg_history');
            div.scrollTop(div.prop('scrollHeight'));

        }

    });

    socket.on('send chat message triggered', function (data) {
        var msg = '';
            msg += `<div class="incoming_msg">
            <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
            <div class="received_msg">
              <div class="received_withd_msg">
                <p>` + data.message + `</p>
                <span class="time_date">` + formatAMPM(new Date) + `</span></div>
            </div>
          </div>`;

        $('.msg_history[data-user-id=' + parseInt(data.from_user_id) + ']').append(msg);
        var div = $('.msg_history');
        div.scrollTop(div.prop('scrollHeight'));

    });

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            $('.msg_send_btn').trigger('click');
        }
    });


    if (getUrlParameter('user')) {

        var user_id = getUrlParameter('user');

        if (user_id == null) {
            clientExists();
            return;
        }

        if ($('.messaging .chat_list a[data-user-id="' + user_id + '"]').length) {
            $('.messaging .chat_list a[data-user-id="' + user_id + '"]').trigger('click');
        } else {

            $.ajax({
                type: 'GET',
                url: '/users/info/' + getUrlParameter('user'),
                success: function (data) {
                    var html = '';

                    html += `<div class="chat_list active_chat">
                                <a href="#" data-user-id="` + data.id + `">
                                    <div class="chat_people">
                                        <div class="chat_img">
                                            <img src="` + data.thePhoto + `" alt="sunil">
                                        </div>
                                        <div class="chat_ib">
                                            <h5>` + data.first_name + ' ' + data.last_name + `</h5>
                                            <p>i'm good</p>
                                        </div>
                                    </div>
                                </a>
                            </div>`;

                    $('.messaging .chat_list').removeClass('active_chat');

                    $('.messaging .inbox_chat').prepend(html);

                    $('.msg_history').attr('data-user-id', data.id);
                    $('.msg_history').html('');

                },
                error: function(xhr, status, error) {
                    alert('User not found');
                }
            });
        }

    }

    $('.messaging .write_msg').keyup(function (e) {
        if (e.keyCode == 13 && !e.shiftKey)
        {
            e.preventDefault();
        }

        if ($(this).outerHeight() < 300) {
            while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
                $(this).height($(this).height()+1);
            };
        }
    });

});