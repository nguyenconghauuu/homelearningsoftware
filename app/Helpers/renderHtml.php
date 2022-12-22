<?php

if (! function_exists('renderBtnDelete'))
{
    /**
     * @param $link
     * @return string
     * echo btn delete
     */
    function renderBtnDelete($link,$val = ' Trash ')
    {
        return '<a href="'.$link.'" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i>'.$val.'</a>';
    }
}
if( ! function_exists("renderBtnRestore"))
{
    function renderBtnRestore($link)
    {
        return '<a href="'.$link.'" class="custome-btn btn-info btn-xs" ><i class="fa fa-history"></i> Khôi phục </a>';
    }
}

if (! function_exists('renderBtnEdit'))
{
    /**
     * @param $link
     * @return string
     * echo btn edit
     */
    function renderBtnEdit($link)
    {
        return '<a href="'.$link.'" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>';
    }
}
if ( ! function_exists( 'renderBtnSearch'))
{
    /**
     * @param $value
     * @return string
     * echo btn search
     */
    function renderBtnSearch($value = 'Tìm kiếm')
    {
        return '<button type="submit" class="btn btn-blue btn-xs"><i class="zmdi zmdi-search"></i>'.$value.'</button>';
    }
}
if( ! function_exists( 'renderBtnReset'))
{
    /**
     * @param string $value
     * @return string
     * echo btn reset
     */
    function renderBtnReset($value = ' Reset ')
    {
        return '<button type="reset" value="Reset"  class="btn btn-danger btn-xs"><i class="zmdi zmdi-refresh-alt"></i>'.$value.'</button>';
    }
}
//
if( ! function_exists('renderBtnAdd'))
{
    /**
     * @param $link
     * @param string $value
     * @return string
     * echo btn add
     */
    function renderBtnAdd($link , $value = ' add ')
    {
        return '<a href="'.$link.'"   class="btn btn-primary btn-xs"><i class="zmdi zmdi-plus"></i>'.$value.'</a>';
    }
}
if (! function_exists('renderBtnListTrash'))
{
    /**
     * @param $link
     * @param $number
     * @param string $value
     * @return string
     * echo btn list trash
     */
    function renderBtnListTrash($link ,$number, $value = 'List Trash')
    {
        return '<a href="'.$link.'" class="btn btn-success btn-xs"><i class="fa fa-list"></i> '.$value.' ( '.$number.')</a>';
    }
}

if (! function_exists('renderBtnDeleteTrash'))
{
    /**
     * @param string $value
     * @return string
     * echo btn delete
     */
    function renderBtnDeleteTrash($value = 'Delete')
    {
//        return '<button  class="btn btn-danger btn-xs" id="delete-all"><i class="zmdi zmdi-delete"></i> '.$value.' </button>';
        return '<button   class="btn btn-danger btn-xs" id="delete-all"><i class="zmdi zmdi-delete"></i>'.$value.'</button>';
    }
}
if ( ! function_exists('renderPaginate'))
{
    /**
     * @param $currentPage
     * @param $perPage
     * @param $lastPage
     * @param $link
     * @return string
     * echo paginate
     */
    function renderPaginate($paginate,$filter = '')
    {
        return '<div class="custome-paginate">
                <div class="pull-left">
                    <p>Trang <b>'.$paginate->currentPage().'</b> - Số bản ghi hiển thị <b>'.$paginate->perPage().'</b> - Tổng số trang <b>'.$paginate->lastPage().'</b> - Tổng số bản ghi <b>'.$paginate->total().'</b></p>
                </div>
                <div class="pull-right">'.$paginate->appends($filter)->links().'</div>
            </div>';
    }
}

if (! function_exists('renderHot'))
{
    /**
     * @param $link
     * @param $type
     * @return string
     * echo btn hot
     */
    function renderHot($link = '',$hot)
    {
        $string = 'label-default';
        $value  = 'None';
        if($hot == 1)
        {   
            $string = 'label-info';
            $value = 'Hot';
        }

        return '<a href="'.$link.'" class="custome-btn label '.$string.'"><span>'.$value.'</span></a>';
    }

}

if (! function_exists('renderActive'))
{
    /**
     * @param $link
     * @param $type
     * @return string
     * echo btn active
     */
    function renderActive($link = '',$active)
    {
        $string = 'label-default';
        $value  = 'Hide';
        if($active == 1)
        {
            $string = 'label-info';
            $value = 'Active';
        }

        return '<a href="'.$link.'" class="custome-btn label '.$string.'"><span>'.$value.'</span></a>';
    }

}
function checkedRadio($type,$val)
{
    return $type == $val  ? 'checked' : '';
}
