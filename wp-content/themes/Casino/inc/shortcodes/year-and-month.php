<?php

add_shortcode('year', 'year_func');

function year_func()
{
  return date('Y');
}

add_shortcode('month', 'month_func');

function month_func()
{
  return date('F');
}
