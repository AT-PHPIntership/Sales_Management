<div class="top_nav">
  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ url('/file/avatar/' . Auth::user()->avatar) }}" alt="">{{ Auth::user()->name }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="{{ route('user.show', [Auth::user()->id]) }}"> @lang('common.profile')</a></li>
            <li>
              <a href="{{ route('user.edit', [Auth::user()->id]) }}"> @lang('common.settings')</a>
            </li>
            <li><a href="#"> @lang('common.help')<span class="label label-success pull-right"> @lang('common.comming_soon')</span></a></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> @lang('common.logout')</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
