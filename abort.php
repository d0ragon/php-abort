<?php

  ini_set('error_reporting', E_ALL);
  error_reporting(-1);
  ini_set('display_errors', 1);


function test ()
{
  print_r(get_defined_vars());
  //var_dump(isset($var));
}
$rame = null;
var_export(get_defined_vars());
test($rame2);
die;

function debug ($var, $type = 1, $safe = false)
{
  if (!headers_sent())
  {
    header('content-type: text/html; charset=utf-8');
  }

  ob_start();

  if ($type == 1)
  {
    if (!isset($var))
    {
      if ($var === null)
      {
        print_r('<i style="font-style: italic;">null</i>');
      }
      else
      {
        print_r('<i style="font-style: italic;">undefined</i>');
      }
    }
    elseif ($var === true)
    {
      print_r('<i style="font-style: italic;">true</i>');
    }
    elseif ($var === false)
    {
      print_r('<i style="font-style: italic;">false</i>');
    }
    elseif ($var === '')
    {
      print_r('string(0): ""');
    }
    elseif (is_string($var))
    {
      print_r($safe ? $var : htmlspecialchars($var));
    }
    else
    {
      print_r($var);
    }
  }
  else
  {
    var_dump(is_string($var) ? ($safe ? $var : htmlspecialchars($var)) : $var);
  }

  $text = ob_get_clean();

  echo '<pre>' . $text . '</pre>';
}

function abort ($var, $type = 1, $safe = false)
{
  for ($i = 1, $n = ob_get_level(); $i <= $n; $i ++)
  {
    ob_end_clean();
  }
  header('content-type: text/html; charset=utf-8');
  debug($var, $type, $safe);
  $trace = reset(debug_backtrace());
  debug("\n\n\n\ntrace: " . $trace['file'] . ':' . $trace['line']);
  die;
}


