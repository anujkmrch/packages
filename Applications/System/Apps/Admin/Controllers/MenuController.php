<?php

namespace System\Apps\admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use System\Models\Menu;
use System\Models\MenuType;
use System\Models\Role;

class MenuController extends Controller
{
    public function index()
    {
    	$menus = MenuType::get();
    	return view('SystemView::admin.menu.index',compact('menus'));
    }

    public function items(Request $request, $menu)
    {
    	$menus = MenuType::with('menus')->where('slug',$menu)->firstorfail();
    	//$menus = $menus->menus;
    	return view('SystemView::admin.menu.items',compact('menus'));
    }

    public function item(Request $request, $menu,$item)
    {
    	$roles = [];
        if($menu = Menu::with(['roles','type'=>function ($query) use($menu) {
            $query->where('slug',$menu);
                },'type.menus'])->findorfail($item)):
            $roles = Role::get();
            $menu->roles = $menu->roles->groupBy('id');
        endif;
    	return view('SystemView::admin.menu.item',compact('menu','roles'));
    }
    /**
     * [doEdit_menu_item Handle the post request]
     * @param  Request $request [description]
     * @param  [type]  $menu    [description]
     * @param  [type]  $item    [description]
     * @return [type]           [description]
     */
    public function doItem(Request $request,$menu,$item) {
        if($menu = Menu::with(['type'=>function ($query) use($menu) {
            $query->where('slug',$menu);
            },'type.menus'])
        ->findorfail($item)):
            $menu->title = $request->input('title');
            $menu->slug = create_url_slug($request->input('slug'));
            //$request->input('slug');//str_slug($request->input('slug'));
            $menu->route = $request->input('route');
            $menu->route_options = $request->input('route_options');
            $menu->ordering = $request->input('ordering',0);
            $menu->enabled = $request->input('enabled',0);
            if($request->input('parent_id') != $menu->parent_id){
                $menu->parent_id = $request->input('parent_id',0);
            }
            $menu->save();
            if($menu->isDirty('parent_id'))
                Menu::fixTree();
            $menu->roles()->sync($request->input('roles'));
            //$roles = \App\Role::whereIn('id',$request->input('roles'))->get();
        endif;
        
        //$menu = \App\MenuType::with('menus')->where('slug',$menu)->first();
        return redirect()->back();
    }

    public function trash(Request $request,$menu,$item) {
        
        if($menu = Menu::findorfail($item)){
            $menu->roles()->detach();
            $menu->delete();
            $request->session()->flash('alert-success', "Successfully deleted");
        } else{
            $request->session()->flash('alert-error', "Could not find menu item");
        }
        return redirect()->back();
    }

    public function createMenu(Request $request) {
        $schemaManager = \DB::getDoctrineSchemaManager();
        $schemaManager->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        $schema = $schemaManager->listTableColumns('menu_types');
        //dd($schema);
        foreach($schema as $key => $column){

            $schema[$key] = ['default' => $column->getDefault(),'options'=>getPossibleEnumValues('menu_types', $key)];
        }
        //dd($schema);
        return view("SystemView::admin.menu.create.menu",compact('schema'));
        //return redirect()->back();
    }

    public function doCreateMenu(Request $request) {
        $menu = $request->only(['title','slug','app','enabled']);
        $menu['slug'] = str_replace(" ", "_", $menu['slug']);
        $menu['slug'] = str_replace("\\", "_", $menu['slug']);
        $menu['slug'] = str_replace("\\/ ", "_", $menu['slug']);
        $menu['slug'] = str_replace("-", "_", $menu['slug']);
        if($menus = MenuType::create($menu)) {
            $request->session()->flash('alert-success', "Successfully Created new menu");
            return redirect()->route('admin.menu.items',['menu' => $menus->slug]);
        } else{
            $request->session()->flash('alert-error', "Menu slug already exists");
        }
        return redirect()->back();
    }

    public function createItem(Request $request,$menu) {
        $type = MenuType::with('menus')->where('slug',$menu)->first();
        $roles = Role::get();
        return view("SystemView::admin.menu.create.item",compact('type','roles'));
        //return redirect()->back();
    }

    public function doCreateItem(Request $request,$menu) { 
        $type = MenuType::with('menus')->where('slug',$menu)->first();
        $create = $request->only(['menu_type_id','title','slug','parent_id','route','route_options','ordering','enabled']);

        // $create['slug'] = str_slug($create['slug']);
        $create['slug'] = create_url_slug($create['slug']);
        $create['ordering']=0;
        $item = Menu::create($create);
        Menu::fixTree();
        $item->roles()->sync($request->input('roles'));
        return redirect()->route('admin.menu.item',['type'=>$type->slug,'id'=>$item->id]);
    }

    public function trashMenu(Request $request,$menu) { 
        if($type = MenuType::where('slug',$menu)->first())
        {
            $type->menus()->delete();
            $type->delete();
            $request->session()->flash('alert-success', "Successfully Created new menu");
            return redirect()->back();
        }
        $request->session()->flash('alert-error', "No menu present");
        return redirect()->back();
    }
}
