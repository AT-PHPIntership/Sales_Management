<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section menu_fixed">
    <h3>MANAGEMENT</h3>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-buysellads"></i> Sales <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('/bill/create') }}">New Bill</a></li>
          <li><a href="{{ url('/bill') }}">List Bills</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-database"></i> Products <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('/product/create') }}">Add Product</a></li>
          <li><a href="{{ url('/product') }}">Products Status</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-folder-open-o"></i> Categoies <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('/category/create') }}">New Category</a></li>
          <li><a href="{{ url('/category') }}">List Category</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-arrow-circle-right"></i> Import <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('/order/create') }}">Add Order</a></li>
          <li><a href="{{ url('/order') }}">List Orders</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-line-chart"></i> Finance <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('/statistic/daily') }}">Daily Statistic</a></li>
          <li><a href="{{ url('/statistic/monthly') }}">Monthly Statistic</a></li>
          <li><a href="{{ url('/statistic/quarterly') }}">Quarterly Statistic</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-users"></i> Human Resource <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('/user/create') }}">Add New Staff</a></li>
          <li><a href="{{ url('/user') }}">List Staffs</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
