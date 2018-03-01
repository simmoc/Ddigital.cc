 <?php $__env->startSection('content'); ?>  <?php if(checkRole(getUserGrade(7))): ?>
<section class="login-banner">
    <div class="container">
        <div class="row">
            <div class="div col-sm-12">
                <h2><?php echo e(Auth::user()->name); ?></h2> </div>
        </div>
    </div>
</section>
<section class="dashboard2">
    <div class="container">
        <div class="panel panel-custom digi-inbox">
            <div class="panel-heading">
                <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES); ?>"> <?php echo e(getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'); ?> </a> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES_CREATE); ?>"> 
                            <?php echo e(getPhrase('compose')); ?></a> </div>
                <h1><?php echo e(getPhrase('inbox')); ?></h1> </div>
            <?php $currentUserId = Auth::user()->id;?>
                <div class="panel-body packages">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="inbox-message-list inbox-message-nocheckbox"> <?php if(count($threads)>0): ?>
                                <?php $cnt = 0; ?> <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                                        <?php $sender = getUserRecord($thread->latestMessage->user_id); ?>
                                            <li class="unread-message <?php echo $class; ?>">
                                                <?php $image_path = getProfilePath($sender->image);?> <img class="sender" src="<?php echo e($image_path); ?>" alt="" height="100" width="100">
                                                    <a href="<?php echo e(URL_MESSAGES_SHOW.$thread->id); ?>" class="message-suject">
                                                        <h3><?php echo e(ucfirst($thread->subject)); ?></h3>
                                                        <p><?php echo $thread->latestMessage->body; ?></p>
                                                    </a> <span class="receive-time"><i class="mdi mdi-clock"></i> <?php echo e($thread->latestMessage->updated_at->diffForHumans()); ?></span> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?>
                                            <p><?php echo e(getPhrase('sorry_no_messages_available')); ?>.</p> <?php endif; ?> </ul>
                            <div class="custom-pagination pull-right"> <?php echo $threads->links(); ?> </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section> <?php else: ?>
<div id="page-wrapper">
    <section class="content-header">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
                    <li><a href="<?php echo e(URL_MESSAGES); ?>">Messages</a> </li>
                </ol>
            </div>
        </div>
    </section>
    <div class="panel panel-custom msg-panel">
        <div class="panel-heading">
            <div class="pull-right messages-buttons"> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES); ?>"> <?php echo e(getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'); ?> </a> <a class="btn btn-lg btn-info button" href="<?php echo e(URL_MESSAGES_CREATE); ?>"> 
                            <?php echo e(getPhrase('compose')); ?></a> </div>
            <h1><?php echo e(getPhrase('inbox')); ?></h1> </div>
        <?php $currentUserId = Auth::user()->id;?>
            <div class="panel-body packages">
                <div class="row">
                    <div class="col-md-12 digi-inbox">
                        <ul class="inbox-message-list inbox-message-nocheckbox"> <?php if(count($threads)>0): ?>
                            <?php $cnt = 0; ?> <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                                    <?php $sender = getUserRecord($thread->latestMessage->user_id); ?>
                                        <li class="unread-message <?php echo $class; ?>">
                                            <?php $image_path = getProfilePath($sender->image);?> <img class="sender" src="<?php echo e($image_path); ?>" alt="" height="100" width="100">
                                                <a href="<?php echo e(URL_MESSAGES_SHOW.$thread->id); ?>" class="message-suject">
                                                    <h3><?php echo e(ucfirst($thread->subject)); ?></h3>
                                                    <p><?php echo $thread->latestMessage->body; ?></p>
                                                </a> <span class="receive-time"><i class="mdi mdi-clock"></i> <?php echo e($thread->latestMessage->updated_at->diffForHumans()); ?></span> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?>
                                        <p><?php echo e(getPhrase('sorry_no_messages_available')); ?>.</p> <?php endif; ?> </ul>
                        <div class="custom-pagination pull-right"> <?php echo $threads->links(); ?> </div>
                    </div>
                </div>
            </div>
    
    </div>
    
</div>

<?php endif; ?> <?php $__env->stopSection(); ?>
<!-- /.container-fluid -->
<?php $__env->startSection('footer_scripts'); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>