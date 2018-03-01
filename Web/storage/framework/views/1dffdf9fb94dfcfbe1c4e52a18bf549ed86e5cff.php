<?php $__env->startSection('content'); ?>




<?php if(checkRole(getUserGrade(7))): ?>

 <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2><?php echo e(Auth::user()->name); ?></h2>
                </div>
            </div>
        </div>
    </section>
 
<section class="dashboard2">
<div class="container">  
            
<!-- <h1>Create a new message</h1> -->
<div class="panel panel-custom">
                    <div class="panel-heading">
                     <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES); ?>"> <?php echo e(getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'); ?> </a> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES_CREATE); ?>"> 
                            <?php echo e(getPhrase('compose')); ?></a> </div>
                        <h3><?php echo e($title); ?></h3>
                    </div>
                    <div id="historybox" class="panel-body packages inbox-messages-replay">
                         
                        <div class="row library-items">

    <div class="col-md-12">
        <h1><?php echo e(ucfirst($thread->subject)); ?></h1>
        <?php $current_user = Auth::user()->id; ?>
        <?php $__currentLoopData = $thread->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $class='message-sender';
        if($message->user_id == $current_user)
        {
            $class = 'message-receiver';
        }


        ?>
            <div class="<?php echo e($class); ?>">
            <div class="media">
                <a class="pull-left" href="#">
                    <img src="<?php echo e(getProfilePath($message->user->image)); ?>" alt="<?php echo $message->user->name; ?>" class="img-circle" height="100" width="100">
                </a>
                <div class="media-body">
                    <h5 class="media-heading"><?php echo $message->user->name; ?></h5>
                    <p><?php echo $message->body; ?></p>
                    <div class="text-muted"><small>Posted <?php echo $message->created_at->diffForHumans(); ?></small></div>
                </div>
            </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
    </div>
    </div>
                </div>
            </div>
              <h4>Reply</h4>
        <?php echo Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']); ?>

        <!-- Message Form Input -->
        <div class="form-group">
            <?php echo Form::textarea('message', null, ['class' => 'form-control']); ?>

        </div>

        <!-- Submit Form Input -->
        <div class="text-center">
            <?php echo Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']); ?>

        </div>
        <?php echo Form::close(); ?>

            
</div>

</section>
<?php else: ?>
<div id="page-wrapper">

            <div class="container-fluid">
             <section class="content-header">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>              <li><a href="<?php echo e(URL_MESSAGES); ?>">Messages</a> </li>
                            <li class="active"> <?php echo e($title); ?> </li>
                        </ol>
                    </div>
                </div>
                </section>
<!-- <h1>Create a new message</h1> -->
<div class="panel panel-custom">
                    <div class="panel-heading">
                     <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES); ?>"> <?php echo e(getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'); ?> </a> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES_CREATE); ?>"> 
                            <?php echo e(getPhrase('compose')); ?></a> </div>
                        <h3><?php echo e($title); ?></h3>
                    </div>
                    <div id="historybox" class="panel-body packages inbox-messages-replay">
                         
                        <div class="row library-items">

    <div class="col-md-12">
        <h1><?php echo e(ucfirst($thread->subject)); ?></h1>
        <?php $current_user = Auth::user()->id; ?>
        <?php $__currentLoopData = $thread->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $class='message-sender';
        if($message->user_id == $current_user)
        {
            $class = 'message-receiver';
        }


        ?>
            <div class="<?php echo e($class); ?>">
            <div class="media">
                <a class="pull-left" href="#">
                    <img src="<?php echo e(getProfilePath($message->user->image)); ?>" alt="<?php echo $message->user->name; ?>" class="img-circle" height="100" width="100">
                </a>
                <div class="media-body">
                    <h5 class="media-heading"><?php echo $message->user->name; ?></h5>
                    <p><?php echo $message->body; ?></p>
                    <div class="text-muted"><small>Posted <?php echo $message->created_at->diffForHumans(); ?></small></div>
                </div>
            </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
    </div>
    </div>
                </div>
            </div>
              <h4>Reply</h4>
        <?php echo Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']); ?>

        <!-- Message Form Input -->
        <div class="form-group">
            <?php echo Form::textarea('message', null, ['class' => 'form-control']); ?>

        </div>

        <!-- Submit Form Input -->
        <div class="text-center">
            <?php echo Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']); ?>

        </div>
        <?php echo Form::close(); ?>

            
</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script>
 $('#historybox').scrollTop($('#historybox')[0].scrollHeight);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>