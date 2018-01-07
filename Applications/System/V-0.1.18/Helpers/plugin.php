<?php
static $hooks=[];
/**
  * A hook can be a function or an object
  */
function plugin_register_hooks($name,$hook)
{

}

/**
  * Call hook method will the regitered hooks method and return the result
  */
function plugin_call_hook($name, $arguments=null)
{

}

/**
  * In case we want to remove some hooks from plugin,
  * it will just remove from the hooks array
  */
function plugin_remove_hooks($name)
{
}

?>
