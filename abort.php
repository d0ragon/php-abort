<?php

function debug ($var, $type = 1, $safe = false)
{
  if (!headers_sent())
  {
    header('content-type: text/html; charset=utf-8');
  }

  ob_start();

  if ($type == 1)
  {
    if (is_null($var))
    {
      echo '<i style="font-style: italic;">null</i>';
    }
    elseif ($var === true)
    {
      echo '<i style="font-style: italic;">true</i>';
    }
    elseif ($var === false)
    {
      echo '<i style="font-style: italic;">false</i>';
    }
    elseif ($var === '')
    {
      echo 'string(0): ""';
    }
    elseif (is_string($var))
    {
      echo $safe ? $var : htmlspecialchars($var);
    }
    elseif (is_numeric($var) && !is_int($var))
    {
      echo '<i style="font-style: italic;">number</i> ' . $var;
    }
    elseif (is_int($var))
    {
      echo '<i style="font-style: italic;">int</i> ' . $var;
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
  list($trace) = debug_backtrace();
  debug("\n\n\n\ntrace: " . $trace['file'] . ':' . $trace['line']);
  die;
}







