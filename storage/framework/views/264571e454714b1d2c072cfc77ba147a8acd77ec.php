<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SMS center</title>
	<meta name="description" content="">
	<style type="text/css">
	    <?php 
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('css/Raleway.css')));
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('css/app.css')));
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('css/style.css')));
	     ?>
	</style>
	<script type="text/javascript">
	    <?php 
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('js/app.js')));
	     ?>
	</script>
	<script type="text/javascript">
	    <?php 
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('js/bootstrap.js')));
	     ?>
	</script>
    </head>
    <body>
	<?php echo $__env->make("layouts/analitics", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="wrapper container-fluid">

	<?php echo $__env->make("layouts/header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make("layouts/menu", [
	    "links" => [
		"active", "", "", ""
	    ]
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	    <div class="row">
		<div class="col-md-12">
		    <div class="page-header">
			<h1>SMS center <small>dashboard</small></h1>
		    </div>
		    <h3>Messages history</h3>
		    <div class="col-md-12">
			    <div class="table-responsive">
				<table class="table table-bordered">
				    <thead>
					<tr class="info">
					    <th>#</th>
					    <th>sender</th>
					    <th>phone</th>
					    <th>text</th>
					    <th>type</th>
					    <th>date</th>
					</tr>
				    </thead>
				    <tbody>
					<?php $__currentLoopData = $sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
					    <td><?php echo e($item->id); ?></td>
					    <td><?php echo e($item->sender); ?></td>
					    <td><?php echo e($item->phone); ?></td>
					    <td><?php echo e($item->text); ?></td>
					    <td><?php echo e($item->type); ?></td>
					    <td><?php echo e($item->created_at); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    </tbody>
				</table>
			    </div>
			<div>
			    <?php echo e($sms->links()); ?>

			</div>
		    </div>
		</div>
	    </div>
	</div>

	<?php echo $__env->make("layouts/footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </body>
</html>