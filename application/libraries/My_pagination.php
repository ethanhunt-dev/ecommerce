<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
class My_pagination 
{
        public function paginate($total_rows,$page)
        {
                $per_page =10;
                $page = is_numeric($page)?(int)$page:1;
                $total_pages =($total_rows>0)?(int) ceil($total_rows/$per_page):1;
                       if($page<1)
                        {
                                $page = 1;
                        }
                        if($page>$total_pages)
                        {
                               $page= $total_pages;
                        }

                        $offset = ($page -1)*$per_page;
                        return ['page'=>$page,
                        'per_page'=>$per_page,
                        'total_pages'=>$total_pages,
                        'offset'=>$offset,
                        'prev' =>($page>1)?$page-1:1,
                        'next' =>($page<$total_pages)?$page+1:$total_pages
                        ];





        
        }
}
