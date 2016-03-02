<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
        <ul class="am-list admin-sidebar-list">
            <li><a href="{{ route('backend::admin.index') }}"><span class="am-icon-home"></span> 首页</a></li>
            <li>
                <a class="am-cf" data-am-collapse="{target: '#collapse-content-setting'}"><span class="am-icon-plus"></span> 内容管理<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
                <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-content-setting">
                    <li><a href="{{ route('backend::admin.categories.index') }}" class="am-cf"><span class="am-icon-check"></span> 分类管理<span class="am-fr am-margin-right admin-icon-yellow"></span></a></li>
                    <li><a href="{{ route('backend::admin.posts.index') }}"><span class="am-icon-file-text"></span> 动态管理</a></li>
                    <li><a href="{{ route('backend::admin.comments.index') }}"><span class="am-icon-comment"></span> 评论管理</a></li>
                    <li><a href="{{ route('backend::admin.events.index') }}"><span class="am-icon-flag"></span> 活动管理</a></li>
                </ul>
            </li>
            <li>
                <a class="am-cf" data-am-collapse="{target: '#collapse-site-setting'}"><span class="am-icon-plus"></span> 站点管理<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
                <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-site-setting">
                    <li><a href="{{ route('backend::admin.navigations.index') }}"><span class="am-icon-navicon"></span> 导航管理</a></li>
                    <li><a href="{{ route('backend::admin.carousels.index') }}"><span class="am-icon-film"></span> 幻灯片管理</a></li>
                    <li><a href="{{ route('backend::admin.notices.index') }}"><span class="am-icon-bell"></span> 公告管理</a></li>
                    <li><a href="{{ route('backend::admin.users.index') }}"><span class="am-icon-user"></span> 用户管理</a></li>
                    <li><a href="{{ route('backend::admin.flush') }}"><span class="am-icon-recycle"></span> 刷新站点缓存</a></li>
                </ul>
            </li>
            <li><a href="{{ url('admin/logout') }}"><span class="am-icon-sign-out"></span> 注销</a></li>
        </ul>
        <div class="am-panel am-panel-default admin-sidebar-panel">
            <div class="am-panel-bd">
                <p><span class="am-icon-bookmark"></span> 公告</p>
                <p>欢迎使用Startups Campfire管理后台</p>
            </div>
        </div>
    </div>
</div>