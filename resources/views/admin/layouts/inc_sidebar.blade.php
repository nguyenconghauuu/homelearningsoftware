<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            </div>
            <div class="pull-left info">
                
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="<?= Request::segment(2)  == 'home' ? 'active' : '' ?>">
                <a href="/admins"><i class="fa fa-dashboard"></i> <span> Trang Chủ </span></a>
            </li>
            <li class="header"> Quản lý </li>
            <li class="<?= Request::segment(2)  == 'category-post' ? 'active' : '' ?>">
                <a href="{{ route('admin.categorypost.index') }}"><i class="fa fa-list"></i> <span> Danh mục </span></a>
            </li>

            <li class="<?= Request::segment(2)  == 'questions' ? 'active' : '' ?>">
                <a href="{{ route('admin.questions.index') }}"><i class="fa fa-question-circle"></i> <span> Câu hỏi </span></a>
            </li>
            <li class="header"> Thành viên  </li>
            <li class="<?= Request::segment(2)  == 'users' ? 'active' : '' ?>">
                <a href="{{ route('admin.users.index') }}"><i class="fa fa-gears"></i> <span> Thành viên  </span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
