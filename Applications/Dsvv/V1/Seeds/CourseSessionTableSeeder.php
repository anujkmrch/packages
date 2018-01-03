<?php
namespace Dsvv\Seeds;
use Illuminate\Database\Seeder;


use Dsvv\Models\CourseSession;
use Dsvv\Models\Course;

Use Carbon\Carbon;

class CourseSessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$now = Carbon::now();
    	$as = Carbon::now()->addMonth(3);
    	$ae = Carbon::now()->addMonth(4);
    	$s = Carbon::now()->addMonth(8);
    	$e = Carbon::now()->addMonth(8)->addMonth(11);

    	$session = [
    				'title' => "2018-19",
    				'application_starts_on' => $as,
    				'applications_ends_on' => $ae,
    				'starts_from' => $s,
    				'ends_on'=> $e,
    			];
    	$s1819 = CourseSession::create($session);

    	// $session = [
    	// 			'title' => "2018-19",
    	// 			'application_starts_on' => $as,
    	// 			'applications_ends_on' => $ae,
    	// 			'starts_from' => $s,
    	// 			'ends_on'=> $e,
    	// 		];
    	// CourseSession::create($session);
    	// $course = [
	    // 		// 'course_session_id' => $s1819->id,
	    // 		'code' => 'BMX002',
	    // 		'title' => 'Bachelor in paradise',
	    // 		'amount' => '123.92',
	    // 		'enabled' => 1,
    	// ];
    	
    	$s1819->courses()->saveMany([
    		new Course(['code'=>'BMX002','title'=>'Bachelor in paradise',
	    		'amount'=>'123.92','enabled'=>1,
    		]),
    		new Course(['code'=>'BMC001','title'=>'Bachelor in china',
	    		'amount'=>'123.92','enabled'=>1,
    		]),
    		new Course(['code'=>'BMS001','title'=>'Bachelor in Spain',
	    		'amount'=>'123.92','enabled'=>1,
    		]),
    		new Course(['code' =>'BMI001','title'=>'Bachelor in India',
	    		'amount'=>'123.92','enabled'=>1,
    		]),

    		new Course(['code'=>'BFX002','title'=>'Bachelorette in paradise',
	    		'amount'=>'123.92','enabled'=>1,]),

    		new Course(['code'=>'BFC001','title'=>'Bachelorette in china',
	    		'amount'=>'123.92','enabled'=>1,
    		]),

    		new Course(['code'=>'BFS001','title'=>'Bachelorette in Spain',
	    		'amount'=>'123.92','enabled'=>1,]),

    		new Course(['code' => 'BFI001','title'=>'Bachelorette in India',
	    		'amount'=>'123.92','enabled'=>1,
    		]),
    	]);
    }
}