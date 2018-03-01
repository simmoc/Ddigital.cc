@extends($layout)

@section('content')

{{-- <link rel="stylesheet" type="text/css" href="{{CSS}}select2.css"> --}}


@if(checkRole(getUserGrade(7)))

 <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
            </div>
        </div>
    </section>
 
<section class="dashboard2">
<div class="container">  
            
<!-- <h1>Create a new message</h1> -->
<div class="panel panel-custom digi-scroll">
    <div class="panel-heading">
        <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES_CREATE}}"> 
                            {{getPhrase('compose')}}</a> </div>
                        <h3>{{$title}}</h3>
                    </div>
                    <div id="historybox" class="panel-body packages inbox-messages-replay">
                         
                        <div class="row library-items">

    <div class="col-md-12">
        <h1>{{ ucfirst($thread->subject) }}</h1>
        <?php $current_user = Auth::user()->id; ?>
        @foreach($thread->messages as $message)
        <?php $class='message-sender';
        if($message->user_id == $current_user)
        {
            $class = 'message-receiver';
        }


        ?>
            <div class="{{$class}}">
            <div class="media">
                <a class="pull-left" href="#">
                    <img src="{{getProfilePath($message->user->image)}}" alt="{!! $message->user->name !!}" class="img-circle" height="100" width="100">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">{!! $message->user->name !!}</h5>
                    <p>{!! $message->body !!}</p>
                    <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                </div>
            </div>
            </div>
        @endforeach
 
    </div>
    </div>
                </div>
            </div>
              <h4>Reply</h4>
        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Submit Form Input -->
        <div class="text-center">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']) !!}
        </div>
        {!! Form::close() !!}
            
</div>

</section>
@else
<div id="page-wrapper">

            <div class="container-fluid">
             <section class="content-header">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>              <li><a href="{{URL_MESSAGES}}">Messages</a> </li>
                            <li class="active"> {{ $title }} </li>
                        </ol>
                    </div>
                </div>
                </section>
<!-- <h1>Create a new message</h1> -->
<div class="panel panel-custom">
                    <div class="panel-heading">
                     <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES_CREATE}}"> 
                            {{getPhrase('compose')}}</a> </div>
                        <h3>{{$title}}</h3>
                    </div>
                    <div id="historybox" class="panel-body packages inbox-messages-replay">
                         
                        <div class="row library-items">

    <div class="col-md-12 digi-scroll">
        <h1>{{ ucfirst($thread->subject) }}</h1>
        <?php $current_user = Auth::user()->id; ?>
        @foreach($thread->messages as $message)
        <?php $class='message-sender';
        if($message->user_id == $current_user)
        {
            $class = 'message-receiver';
        }


        ?>
            <div class="{{$class}}">
            <div class="media">
                <a class="pull-left" href="#">
                    <img src="{{getProfilePath($message->user->image)}}" alt="{!! $message->user->name !!}" class="img-circle" height="100" width="100">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">{!! $message->user->name !!}</h5>
                    <p>{!! $message->body !!}</p>
                    <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                </div>
            </div>
            </div>
        @endforeach
 
    </div>
    </div>
                </div>
            </div>
              <h4>Reply</h4>
        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Submit Form Input -->
        <div class="text-center">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']) !!}
        </div>
        {!! Form::close() !!}
            
</div>
</div>
@endif
@stop

@section('footer_scripts')
<script>
 $('#historybox').scrollTop($('#historybox')[0].scrollHeight);
</script>
@stop