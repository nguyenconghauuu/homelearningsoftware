<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Lịch sử làm bài</title>
</head>
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Fragment Mono', monospace;
    }

    .header {
        width: 100%;
        height: auto;
        display: flex;
    }

    .navbar {
        width: 100%;
    }



    /*  */
    .main {
        display: flex;
        width: 100%;

    }

    .slide-content {
        width: 21%;
        height: auto;
        padding:20px 0px 0px 20px;
        display: flex;
        flex-direction: column;
    }

    .slide-content a {
        text-decoration: none;
        color: #000;
        display: block;
    }

    .container {
        display: flex;
        width: 100%;
        height: auto;
        margin-top: 20px;
    }

    .content {
        width: 100%;
        height: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .page{
        margin: auto;
    }
    /*  */
    
    .list-cate-sidebar .active {
        color: #28a745;
    }

    .box-sm{ background: white}
    .panel-default { border-radius: 0;border-color: white;border: 0 !important;}
    .panel-heading { background-color: #fff !important;border: none}
    .title-nav {
        color: #000;
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .panel-body{ border: 0 !important;padding-top: 0!important;}
    .panel-group .panel { border: 0 !important;border-radius: 0!important;}
    .title_post_sub
    {
        color: #666;
        display: block;
        padding-bottom: 1px;
        padding-top: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .title-post a { color: #666; display: block; padding-bottom: 1px;  padding-top: 1px;  white-space: nowrap;  overflow: hidden; text-overflow: ellipsis;}
    .title-post a:hover {  color: #00a888 !important;}
    .title-new { text-transform: uppercase;font-size: 20px; text-align: center ;  border-bottom: 1px solid #dfdfdf;padding-bottom: 10px;}
    .title-footer { font-size: 20px;text-transform: uppercase;border-bottom: 2px solid #72c02c;padding-bottom: 15px;width: 90%}
</style>

<body>
@include('frontend.component._inc_header')
<div class="main" style="">

    <div class="container shadow p-3 mb-5 bg-white rounded" style="background-color: whitesmoke;">
        <div class="content">
            <h2> Lịch sử làm bài </h2>
            <div class="row">
                <table class="table table-striped shadow p-3 mb-5 bg-white" >
                    <thead>
                    <tr>
                        <th>Họ và tên</th>
                        <th>Bài học</th>
                        <th>Câu đúng</th>
                        <th>Câu sai</th>
                        <th>Câu đã làm</th>
                        <th>Câu chưa làm</th>
                        <th>Điểm</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach($lists as $item)
                        <tr>
                            <td>{{ $item->user->u_name ?? "[N\A]" }}</td>
                            <td>{{ $item->category->cpo_name ?? "[N\A]" }}</td>
                            <td>{{ $item->correct }}</td>
                            <td>{{ $item->wrong }}</td>
                            <td>{{ $item->did }}</td>
                            <td>{{ $item->do_not }}</td>
                            <td>{{ $item->er_point }}</td>
                            <td><a href="{{ route('get.kq.quiz', ['iduser' => $item->er_user_id,'idde' => $item->er_exam_id,'categoryID' => $item->category_id]) }}" target="_blank">Chi tiết</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>
<div class="footer" style="padding: 20px ; width: 100%;
    height: auto;
    display: flex;
    flex-direction: column;
    background-color: rgb(2, 2, 2);
    text-align: center;
    color: white;">
        <p> Homelearningsoftware được tối ưu hóa cho việc học tập. Các ví dụ có thể được đơn giản hóa để cải thiện khả
            năng đọc và hiểu cơ bản. Các hướng dẫn, tài liệu tham khảo nhưng chúng tôi không thể đảm bảo tính chính xác
            hoàn toàn của tất cả nội dung. Trong khi sử dụng trang web này, bạn đồng ý đã đọc và chấp nhận các điều
            khoản sử dụng, cookie và chính sách bảo mật của chúng tôi.
            </p>
            <p>Copyright by Nam & Hau</p>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>


</html>
