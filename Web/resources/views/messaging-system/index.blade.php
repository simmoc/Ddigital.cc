@extends($layout) @section('content') {{--
<link rel="stylesheet" type="text/css" href="{{CSS}}select2.css"> --}} @if(checkRole(getUserGrade(7)))
<section class="login-banner">
    <div class="container">
        <div class="row">
            <div class="div col-sm-12">
                <h2>{{ Auth::user()->name }}</h2> </div>
        </div>
    </div>
</section>
<section class="dashboard2">
    <div class="container">
        <div class="panel panel-custom digi-inbox">
            <div class="panel-heading">
                <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES_CREATE}}"> 
                            {{getPhrase('compose')}}</a> </div>
                <h1>{{getPhrase('inbox')}}</h1> </div>
            <?php $currentUserId = Auth::user()->id;?>
                <div class="panel-body packages">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="inbox-message-list inbox-message-nocheckbox"> @if(count($threads)>0)
                                <?php $cnt = 0; ?> @foreach($threads as $thread)
                                    <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                                        <?php $sender = getUserRecord($thread->latestMessage->user_id); ?>
                                            <li class="unread-message {!!$class!!}">
                                                <?php $image_path = getProfilePath($sender->image);?> <img class="sender" src="{{$image_path}}" alt="" height="100" width="100">
                                                    <a href="{{URL_MESSAGES_SHOW.$thread->id}}" class="message-suject">
                                                        <h3>{{ucfirst($thread->subject)}}</h3>
                                                        <p>{!! $thread->latestMessage->body !!}</p>
                                                    </a> <span class="receive-time"><i class="mdi mdi-clock"></i> {{$thread->latestMessage->updated_at->diffForHumans()}}</span> </li> @endforeach @else
                                            <p>{{getPhrase('sorry_no_messages_available')}}.</p> @endif </ul>
                            <div class="custom-pagination pull-right"> {!! $threads->links() !!} </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section> @else
<div id="page-wrapper">
    <section class="content-header">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
                    <li><a href="{{URL_MESSAGES}}">Messages</a> </li>
                </ol>
            </div>
        </div>
    </section>
    <div class="panel panel-custom msg-panel">
        <div class="panel-heading">
            <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES_CREATE}}"> 
                            {{getPhrase('compose')}}</a> </div>
            <h1>{{getPhrase('inbox')}}</h1> </div>
        <?php $currentUserId = Auth::user()->id;?>
            <div class="panel-body packages">
                <div class="row">
                    <div class="col-md-12 digi-inbox">
                        <ul class="inbox-message-list inbox-message-nocheckbox"> @if(count($threads)>0)
                            <?php $cnt = 0; ?> @foreach($threads as $thread)
                                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                                    <?php $sender = getUserRecord($thread->latestMessage->user_id); ?>
                                        <li class="unread-message {!!$class!!}">
                                            <?php $image_path = getProfilePath($sender->image);?> <img class="sender" src="{{$image_path}}" alt="" height="100" width="100">
                                                <a href="{{URL_MESSAGES_SHOW.$thread->id}}" class="message-suject">
                                                    <h3>{{ucfirst($thread->subject)}}</h3>
                                                    <p>{!! $thread->latestMessage->body !!}</p>
                                                </a> <span class="receive-time"><i class="mdi mdi-clock"></i> {{$thread->latestMessage->updated_at->diffForHumans()}}</span> </li> @endforeach @else
                                        <p>{{getPhrase('sorry_no_messages_available')}}.</p> @endif </ul>
                        <div class="custom-pagination pull-right"> {!! $threads->links() !!} </div>
                    </div>
                </div>
            </div>
    
    </div>
    
</div>

@endif @stop
<!-- /.container-fluid -->
@section('footer_scripts')
