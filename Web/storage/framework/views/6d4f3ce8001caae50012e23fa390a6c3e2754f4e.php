 <?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(CSS); ?>select2.css"> <?php if(checkRole(getUserGrade(7))): ?>
<section class="login-banner">
    <div class="container">
        <div class="row">
            <div class="div col-sm-12 test">
                <h2><?php echo e(Auth::user()->name); ?></h2> </div>
        </div>
    </div>
</section> <?php endif; ?>
<div id="page-wrapper">
    <!-- Page Heading -->
    <section class="content-header">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
                    <li><a href="<?php echo e(URL_MESSAGES); ?>"><?php echo e(getPhrase('messages')); ?></a> </li>
                    <li class="active"> <?php echo e($title); ?> </li>
                </ol>
            </div>
        </div>
    </section>
    <!-- <h1>Create a new message</h1> -->
   
   
    <div class="box box-primary">
    <div class="panel panel-custom">
       
        <div class="panel-heading msg">
            <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES); ?>"> <?php echo e(getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'); ?> </a> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES_CREATE); ?>"> 
                            <?php echo e(getPhrase('compose')); ?></a> </div>
            <h1><?php echo e($title); ?></h1> </div>
        <div class="panel-body packages">
            <div class="row library-items create-msg"> <?php echo Form::open(['route' => 'messages.store']); ?>

                <div class="col-md-8 col-md-offset-2">
                    <?php $tosentUsers = array(); ?> <?php if($users->count() > 0): ?>
                        <?php foreach($users as $user) {
                $tosentUsers[$user->id] = $user->name; 
            }
        ?> <?php echo Form::label('Select User', 'Select User', ['class' => 'control-label']); ?> <?php echo e(Form::select('recipients[]', $tosentUsers, null, ['class'=>'form-control select2', 'name'=>'recipients[]', 'multiple'=>'true'])); ?>

                            <?php endif; ?>
                       
                            <!-- Subject Form Input -->
                           
                            <div class="form-group"> <?php echo Form::label('subject', 'Subject', ['class' => 'control-label']); ?> <?php echo Form::text('subject', null, ['class' => 'form-control']); ?> </div>
                      
                    
                           
                         
                            <!-- Message Form Input -->
                            <div class="form-group"> <?php echo Form::label('message', 'Message', ['class' => 'control-label']); ?> <?php echo Form::textarea('message', null, ['class' => 'form-control']); ?> </div>
                               
                    
                            <!-- Submit Form Input -->
                            <div class="btn-center"> <?php echo Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']); ?> </div>
                </div> <?php echo Form::close(); ?> </div>
        </div>
    </div>
    </div>
        
    
</div>

<?php $__env->stopSection(); ?> 

<?php $__env->startSection('footer_scripts'); ?>


<script src="<?php echo e(JS); ?>select2.js"></script>
<script>
    $('.select2').select2({
        placeholder: "Add User"
    , });
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>