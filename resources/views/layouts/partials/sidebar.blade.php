<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section menu_fixed">
    <h3>{{ strtoupper(Auth::user()->role->name) }}</h3>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-buysellads"></i> @lang('common.menu_sales') <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('bill.create') }}">@lang('common.item_new_bill')</a></li>
          <li><a href="{{ route('bill.index') }}">@lang('common.item_list_bill')</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-database"></i> @lang('common.menu_products') <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('product.create') }}">@lang('common.item_add_product')</a></li>
          <li><a href="{{ route('product.index') }}">@lang('common.item_list_product')</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-folder-open-o"></i> @lang('common.menu_categories') <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('category.create') }}">@lang('common.item_new_category')</a></li>
          <li><a href="{{ route('category.index') }}">@lang('common.item_list_categories')</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-arrow-circle-right"></i> @lang('common.menu_import') <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('order.create') }}">@lang('common.item_add_order')</a></li>
          <li><a href="{{ route('order.index') }}">@lang('common.item_list_order')</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-line-chart"></i> @lang('common.menu_statistic') <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('statistic.daily') }}">@lang('common.item_daily')</a></li>
          <li><a href="{{ route('statistic.monthly') }}">@lang('common.item_monthly')</a></li>
          <li><a href="{{ route('statistic.quarterly') }}">@lang('common.item_quarterly')</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-users"></i> @lang('common.menu_human_src') <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('user.create') }}">@lang('common.item_add_account')</a></li>
          <li><a href="{{ route('product.index') }}">@lang('common.item_list_account')</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
