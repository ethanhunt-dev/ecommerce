<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_pagination{
 public function pagination($total_records,$per_page, $page)
 {
    $page = is_numeric($page)?(int)$page :1;
    $total_pages =($total_records>0)?ceil($total_records/$per_page):1;

    $page =max($page,1);
    $page =min($page,$total_pages);

    $offset = ($page-1)* $per_page;
    return [   'page'        => $page,
            'per_page'    => $per_page,
            'total_pages' => $total_pages,
            'offset'      => $offset,
            'prev'        => max($page - 1, 1),
            'next'        => min($page + 1, $total_pages)];


 }

}