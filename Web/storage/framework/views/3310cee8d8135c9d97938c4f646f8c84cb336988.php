

<?php $__env->startSection('content'); ?>
	<!--Inner Banner-->
    <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2><?php echo e($title); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <!--/Inner Banner-->
	
	<?php echo $__env->make('displayproducts.products-view', array('products' => $products), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<!--SECTION-5 SIGN UP-->
    <?php echo $__env->make('common.subscrption-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--/SECTION-5 SIGN UP-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
	<script>
    /*
	$(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getProducts(page);
            }
        }
    });
	*/
	/*
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getProducts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    function getProducts(page, param) {
        $.ajax({
            url : '?page=' + page + '&param=' + param,
            dataType: 'html',
        }).done(function (data) {
            $('#products').html(data);			
			//window.location.hash = '?page=' + page + '&param=' + param;
			//location.hash = page;
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    }
	*/
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>