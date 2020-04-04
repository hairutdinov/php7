<?php
function br($return = false)
{
  if ($return) return "<br>";
  echo "<br>";
}

function hr($return = false)
{
  if ($return) return "<hr>";
  echo "<hr>";
}


function h2 ($str) {
  echo "<h2>{$str}</h2>";
}