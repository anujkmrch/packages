<?php
function getPossibleEnumValues ($table, $column) {
     //dd(DB::select("PRAGMA table_info({$table});"));

    // Pulls column string from DB
    $enumStr = DB::select(DB::raw('SHOW COLUMNS FROM '.$table.' WHERE Field = "'.$column.'"'))[0]->Type;

    // Parse string
    preg_match_all("/'([^']+)'/", $enumStr, $matches);

    // Return matches
    return isset($matches[1]) ? $matches[1] : [];
}

if(!function_exists('create_url_slug')){
	function create_url_slug($string){
	   $slug=preg_replace('/[^A-Za-z0-9-\/]+/', '-', $string);
	   return strtolower($slug);
	}
}

if(!function_exists('route_with_redirect'))
{
    function route_with_redirect($route)
    {
        if($path = request()->input('redirect_to'))
            return route($route,['redirect_to'=>$path]);
        return route($route);
    }
}

if(!function_exists('buildTree')):
    function buildTree($flat, $pidKey, $idKey = null)
    {
        $grouped = array();
        foreach ($flat as $sub){
            $grouped[$sub[$pidKey]][] = $sub;
        }

        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if(isset($grouped[$id])) {
                    $sibling['children'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }

            return $siblings;
        };

        $tree = $fnBuilder($grouped[0]);

        return $tree;
    }
endif;

if(!function_exists('buildUlTree')):
    function buildUlTree($flat, $pidKey, $idKey = null,$dropdown='dropdown')
    {
        $grouped = array();

        foreach ($flat as $sub){
            $grouped[$sub[$pidKey]][] = $sub;
        }

        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey,$dropdown) {
            $html = '';
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                $html .= "\n<li".(isset($grouped[$id]) ? " class=\"$dropdown\"" : '')."><a href=\"{$sibling['href']}\">{$sibling['title']}</a>";
                if(isset($grouped[$id])) {
                    $html.= "\n<ul>".$fnBuilder($grouped[$id])."</ul>";
                }
                $html .= "\n</li>";
                // $siblings[$k] = $sibling;
            }
            return $html;
            // return $siblings;
        };
        
        $tree = $fnBuilder($grouped[0]);

        return $tree;
    }
endif;
?>