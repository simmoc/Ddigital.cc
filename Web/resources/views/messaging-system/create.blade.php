@extends($layout) @section('content')
<link rel="stylesheet" type="text/css" href="{{CSS}}select2.css"> @if(checkRole(getUserGrade(7)))
<section class="login-banner">
    <div class="container">
        <div class="row">
            <div class="div col-sm-12 test">
                <h2>{{ Auth::user()->name }}</h2> </div>
        </div>
    </div>
</section> @endif
<div id="page-wrapper" class="edd-messaging">
    <!-- Page Heading -->
    <!-- <section class="content-header">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
                    <li><a href="{{URL_MESSAGES}}">{{getPhrase('messages')}}</a> </li>
                    <li class="active"> {{ $title }} </li>
                </ol>
            </div>
        </div>
    </section> -->
    <!-- <h1>Create a new message</h1> -->
   
   
    <div class="box box-primary">
    <div class="panel panel-custom">
       
        <div class="col-md-8 col-md-offset-2 panel-heading msg">
            <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a> <a class="btn btn-lg btn-info button" href="{{URL_MESSAGES_CREATE}}"> 
                            {{getPhrase('compose')}}</a> </div>
            <h1>{{$title}}</h1> </div>
        <div class="panel-body packages">
            <div class="row library-items create-msg"> {!! Form::open(['route' => 'messages.store']) !!}
                <div class="col-md-8 col-md-offset-2">
                    <?php $tosentUsers = array(); ?> @if($users->count() > 0)
                        <?php foreach($users as $user) {
                $tosentUsers[$user->id] = $user->name; 
            }
        ?> {!! Form::label('Select User', 'Select User', ['class' => 'control-label']) !!} {{Form::select('recipients[]', $tosentUsers, null, ['class'=>'form-control select2', 'name'=>'recipients[]', 'multiple'=>'true'])}}
                            @endif
                       
                            <!-- Subject Form Input -->
                           
                            <div class="form-group"> {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!} {!! Form::text('subject', null, ['class' => 'form-control']) !!} </div>
                      
                    
                           
                         
                            <!-- Message Form Input -->
                            <div class="form-group"> {!! Form::label('message', 'Message', ['class' => 'control-label']) !!} {!! Form::textarea('message', null, ['class' => 'form-control']) !!} </div>
                               
                    
                            <!-- Submit Form Input -->
                            <div class="btn-center"> {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']) !!} </div>
                </div> {!! Form::close() !!} </div>
        </div>
    </div>
    </div>
        
    
</div>

@stop 

@section('footer_scripts')


<script src="{{JS}}select2.js"></script>
<script>
    $('.select2').select2({
        placeholder: "Add User"
    , });
</script> @stop