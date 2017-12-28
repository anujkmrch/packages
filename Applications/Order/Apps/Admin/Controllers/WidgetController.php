<?php

namespace System\Apps\admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use System\Models\Menu;
use System\Models\Widget;

class WidgetController extends Controller
{
    public function index()
    {
    	$widgets = Widget::with('menus')->get();
    	return view('SystemView::admin.widget.index',compact('widgets'));
    }

    public function edit(Request $request,$id)
    {
			$options = ['type'=>'text','masthead'=>['head'=>'text','subtitle'=>'text','lead'=>'text'],'slider'=> []];
			// dd(json_encode($options));

			$query = "SELECT * FROM widgets_menus as wm WHERE wm.id=$id";

			$pivot = Widget::hydrate(\DB::select($query))->first();

			$configuration = !is_null($pivot->configuration) ? json_decode($pivot->configuration) : [];
			$menus = Menu::get();
			$widget = Widget::with('menus')->find($pivot->widget_id);
			if(!empty($widget->options))
				$widget->options = json_decode($widget->options,true);

			return view("SystemView::admin.widget.edit",compact('menus','widget','configuration'));
    }

		public function assign(Request $request, $id)
		{
			return $id;
		}
}
