<?php
	$c = ['course_session_id' => [
			'title' => 'Session',
		   	'type' => 'select',
		   	'scope' => 'configuration', //{column, relation, configuration}//
		   	'callback' => 'dsvv_extract_course_session_list',
		],

		'per_row_only' => [
			'title' => 'Per row',
		   	'type' => 'select',
		   	'scope' => 'configuration', //{column, relation, configuration}//
		   	'callback' => 'widget_true_false_options',
		   	'required'  => true,
		],
	];
?>
	<?php
use Dsvv\Models\CourseSession;

$session = CourseSession::with('courses')->find($widget->getConfiguration('course_session_id',0));
?>

<?php
if($widget->hasConfiguration('show_title') and $widget->getConfiguration('show_title',false) == true)	?>
	<h1><?php echo $widget->title.' for '.$session->title;  ?></h1>
<?php if($widget->getConfiguration('per_row_only',0)==1): ?>
	<div class="row">
<?php endif; ?>
<?php foreach($session->courses as $course): ?>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<div class="thumbnail">
			<h3><?php echo $course->title ?></h3>
		</div>
	</div>
<?php endforeach; ?>

<?php if($widget->getConfiguration('per_row_only',0)==1): ?>
	</div>
<?php endif; ?>
