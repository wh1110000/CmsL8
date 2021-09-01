@if(\Auth::guard('administrator')->check())

    <div class="admin-bar">
        <div class="item">
            <a href="{{ route('admin.dashboard.index') }}" data-toggle="tooltip" data-placement="left" title="Admin Panel">
                <i class="fas fa-tools"></i>
            </a>
        </div>
        @if($post)
            <div class="item">


                    <a href="{{ route('admin.'.($post->getNamespace() == 'contents' ? 'pages' : $post->getNamespace()).'.show', $post) }}" data-toggle="tooltip" data-placement="left" title="Edit Post">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

            </div>
        @elseif($page)
            <div class="item">
                <a href="{{ route('admin.page.show', $page)}}" data-toggle="tooltip" data-placement="left" title="Edit Page">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        @endif
        <div class="item" >
            <a href="{{ route('admin.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="left" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>

            <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST">{{ csrf_field() }}</form>
        </div>
    </div>

    <style>
        .admin-bar
        {
            position: fixed;
            top: 10%;
            right: 0;
            width: 35px;
            background-color: #999;
            z-index: 999;
        }

        .admin-bar .item
        {
            display: inline-block;
            padding: 10px;
        }

        .admin-bar .item a
        {
            color: #fff;
        }
    </style>

@endif
