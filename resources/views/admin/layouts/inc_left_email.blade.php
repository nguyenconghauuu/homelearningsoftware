<a href="{{ route('admin.gmail.sendemail') }}" class="btn btn-primary btn-block margin-bottom"> Gửi gmail </a>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title"> Danh sách chức năng </h3>
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body no-padding">
       <ul class="nav nav-pills nav-stacked">
            <li class="{{ Request::segment(2) == 'gmail' ? 'active' : '' }}">
                <a href="{{ route('admin.gmail.index') }}">
                    <i class="fa fa-filter"></i> Danh sách gmail <span class="label label-warning pull-right">65</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-inbox"></i> Inbox
                    <span class="label label-primary pull-right">12</span>
                </a>
            </li>
            <li><a href="#"><i class="fa fa-envelope-o"></i>  Danh sách gủi đi  </a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i>  Thông báo lỗi   </a></li>
            <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
        </ul>
    </div>
    <!-- /.box-body -->
</div>