<div>
    <div class="header d-print-none">
        <div class="header-container">
            <div class="header-left">
                <ul class="navbar-nav">
                    <li class="nav-item navigation-toggler">
                        <a href="#" class="nav-link">
                            <i class="ti-menu"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="header-search-form">
                            <form class="d-flex">
                                <button class="btn">
                                    <i class="ti-search"></i>
                                </button>
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="header-right">
                <ul class="navbar-nav">
                    <li class="nav-item btn-mobile-search">
                        <a href="#" title="Search" class="nav-link">
                            <i data-feather="search"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown d-sm-inline d-none">
                        <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                            <i class="maximize" data-feather="maximize"></i>
                            <i class="minimize" data-feather="minimize"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <div wire:init="loadData">
                            <a href="#" class="nav-link" title="Notifications"
                               data-toggle="dropdown">
                                <span class="badge badge-danger nav-link-notify">{{ count($notifications) }}</span>
                                <i data-feather="bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div
                                    class="bg-primary px-3 py-3 text-center d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Notifications</h6>
                                    @if(count($notifications))
                                        <small class="opacity-7">{{ number_format(count($notifications)) }} unread
                                            notifications</small>
                                    @endif
                                </div>
                                <div class="dropdown-scroll" style="overflow: auto">
                                    <ul class="list-group list-group-flush">
                                        @foreach($notifications as $notification)
                                            <li>
                                                <a href="#"
                                                   class="list-group-item px-3 d-flex align-items-center hide-show-toggler">
                                                    <div>
                                                        <figure class="avatar mr-2">
                                                            <img
                                                                src="{{ \App\Http\Controllers\SystemController::generateAvatars($notification->subject,200) }}"
                                                                alt="" class="rounded-circle">
                                                        </figure>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                            {{ $notification->description }}
                                                            <i title="Mark as unread" data-toggle="tooltip"
                                                               class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                                        </p>
                                                        <span
                                                            class="text-muted small">{{ \App\Http\Controllers\SystemController::elapsedTime($notification->created_at) }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if(count($notifications))
                                    <div class="px-3 py-2 text-center border-top bg-primary">
                                        <ul class="list-inline small">
                                            <li class="list-inline-item mb-0">
                                                <a href="#" wire:click="markAsRead">Mark All Read</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>

                    {{--                    <li class="nav-item dropdown">--}}
                    {{--                        <a href="#" class="nav-link" title="Settings" data-sidebar-target="#settings">--}}
                    {{--                            <i data-feather="settings"></i>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                            <span class="mr-2 d-sm-inline d-none">
                                {{ \App\Http\Controllers\SystemController::pass_greetings_to_user() }}! <strong>{{ $user->name }}</strong>
                            </span>
                            <figure class="avatar avatar-sm">
                                <img
                                    src="{{ \App\Http\Controllers\SystemController::generateAvatars($user->slug,400) }}"
                                    class="rounded-circle"
                                    alt="avatar">
                            </figure>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                            <div class="text-center py-4"
                                 data-background-image="https://lh3.googleusercontent.com/proxy/0ZqJrcX0-JhadejFUkliUpw22DuqhbVVLvGRPrvy61nTINvWjksJj9XLHEyox1uryxJ0hQEqpDHJxBKb51t_UQtm96I">
                                <figure class="avatar avatar-lg mb-3 border-0">
                                    <img
                                        src="{{ \App\Http\Controllers\SystemController::generateAvatars($user->slug,400) }}"
                                        class="rounded-circle" alt="image">
                                </figure>
                                <h5 class="mb-0">{{ $user->name }}</h5>
                            </div>
                            <div class="list-group list-group-flush">
                                <a href="{{ route('admin.profile') }}" class="list-group-item">Profile</a>
                                {{--                                <a href="#" class="list-group-item" data-sidebar-target="#settings">Settings</a>--}}
                                <a href="{{ route('admin.logout') }}" class="list-group-item text-danger">Sign Out!</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item header-toggler">
                    <a href="#" class="nav-link">
                        <i class="ti-arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
