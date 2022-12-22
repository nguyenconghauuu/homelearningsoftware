<?php

function uploadImg($file ,array $extend  = array() )
{
    $code = 0;
    // lay duong dan anh
    $baseFilename = public_path() . '/uploads/' . $_FILES[$file]['name'];
    // thong tin file
    $info = new SplFileInfo($baseFilename);

    // duoi file
    $ext = strtolower($info->getExtension());

    // kiem tra dinh dang file
    if ( ! $extend )
    {
        $extend = ['png','jpg'];
    }
    if(in_array($ext,$extend))
    {
        $code = 1;
    }
    // Tên file mới
    $filename = date('d-m-Y').'-'.md5($baseFilename) . '.' . $ext;

    // di chuyen file vao thu muc uploads
//        move_uploaded_file($_FILES[$file]['tmp_name'], public_path() . '/uploads/' . $filename);
    $data = [
        'name'              => $filename,
        'name_original'     => $info->getFilename(),
        'code'              => $code,
        'tmp_name'          => $_FILES[$file]['tmp_name']
    ];
    return $data;
}

function showCategory($category, $parent_id)
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($category as $key => $item)
    {
        $k = 1;
        // Nếu là chuyên mục con thì hiển thị
        if ($item->cpo_parent_id == $parent_id)
        {
            $cate_child[] = $item;
            unset($category[$key]);
        }
    }

    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child)
    {
        echo '<ul>';
        foreach ($cate_child as $key => $item)
        {
            $id = $item->id;
            ?>
            <li>
                <a href=""><?= $item->cpo_name ?></a>
            <?php
            showCategory($category, $id);
        }
        echo '</ul>';
    }
}

function showMucDo($number)
{
    switch ($number)
    {
        case 1:
            return " K1 ";
            break;
        case 2:
            return " K2 ";
            break;
        case 3:
            return " K3 ";
            break;
        default:
            return " K4 ";
    }
}