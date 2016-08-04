@extends('layouts.app')

@section('page-title')
    @lang('statistics.common.title')
@stop

@section('section-title')
    @lang('statistics.common.title')
@stop

@push('stylesheet')
  <link rel="stylesheet" href="/bower_resources/gentelella/build/css/custom.min.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="/bower_resources/jquery-ui-month-picker/src/MonthPicker.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="/bower_resources/jquery-ui/themes/smoothness/jquery-ui.min.css" type="text/css" media="all" />
@endpush

@section('page-content')
  <div class="col-md-3 col-sm-4 col-xs-6 date-picker pull-right">
    <div class="control-group">
      <div class="controls xdisplay_inputx form-group has-feedback">
        <form id="date-selector" action="{{ route('statistic.monthly') }}" method="get">
          <div class="form-group">
              <div class="input-group">
                <input name="date_picker" id="selected-month-year" class="form-control date-picker form-control has-feedback-left" title="@lang('statistics.title_select_date')" 
                  required="required" type="text" value="{{ $month }}/{{ $year }}">
                  <span class="fa fa-calendar fa-5x form-control-feedback left" aria-hidden="true"></span>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
    <div class="row">
        <?php
            $firstBill = $billMonths->first() == null ? 0 : $billMonths->first()->sum('total_cost');
            $firstOrder = $orderMonths->first() == null ? 0 : $orderMonths->first()->sum('total_cost');
            $firstMonthIncome = $firstBill - $firstOrder;
            $incomeMonths = [];
            // set key for months statistic
            $keys = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        foreach ($keys as $key) {
            $bill = $billMonths->has($key) ? $billMonths[$key]->sum('total_cost') : 0;
            $order = $orderMonths->has($key) ? $orderMonths[$key]->sum('total_cost') : 0;
            $income = ($bill - $order) == 0 ? 0 : ceil((( ($bill - $order) / $firstMonthIncome -1) * \Config::get('common.ONE_HUNDRED')));
            array_push($incomeMonths, $income);
        }
            $incomeMonths[0] = 0;
        ?>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>@lang('statistics.label_increase_percentage_over_month')</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <canvas id="statistic-increasing-percentage"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>@lang('statistics.top_5_hot_product')</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php
                $total_amount = $topProducts->sum(function ($value) {
                    return $value->sum('amount');
                });
                $color = array("aero", "purple", "red", "green", "blue");
                $i = 0;
                $subtractHotProduct = 0;
            ?>
            <table class="" style="width:100%">
              <tr>
                <th style="width: 50%;">
                  <p>@lang('statistics.label_top_5')</p>
                </th>
                <th>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <p class="">@lang('statistics.label_product')
                      
                    </p>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <p class="">@lang('statistics.label_percent')</p>
                  </div>
                </th>
              </tr>
              <tr>
                <td>
                  <canvas id="top-products-chart" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                </td>
                <td>
                  <table class="tile_info">
                    @foreach ($topProducts->take(\Config::get('common.TOP_4')) as $topProduct)
                      <tr>
                        <td>
                          <p><i class="fa fa-square {{ $color[$i++] }}"></i>{{ $topProduct->first()->product->name }} </p>
                        </td>
                        <td>
                          {{ ceil(($topProduct->sum('amount') * \Config::get('common.ONE_HUNDRED')) / $total_amount) }}@lang('statistics.label_percent')
                        </td>
                        <?php
                            $subtractHotProduct += ceil(($topProduct->sum('amount') * \Config::get('common.ONE_HUNDRED')) / $total_amount)
                        ?>
                      </tr>
                    @endforeach
                    <tr>
                      <td>
                        <p><i class="fa fa-square {{ $color[$i++] }}"></i>@lang('statistics.label_others') </p>
                      </td>
                      <td>{{ \Config::get('common.ONE_HUNDRED') - $subtractHotProduct }}@lang('statistics.label_percent')</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-sm-6 col-xs-12">
        <?php
          $subtractDedicatedStaff = 0;
          $leftCost = $totalCost;
        ?>
        <div class="x_panel">
          <div class="x_title">
            <h2> @lang('statistics.top_5_dedicated_staff')</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @foreach ($staffsData as $staffData)
              <div class="widget_summary">
                <div class="col-md-5 col-xs-5">
                  <span>{{ $staffData->first()->user->name }}</span>
                </div>
                <div class="col-md-6 col-xs-6">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar"
                        style="width: {{ $staffData->sum('total_cost')*\Config::get('common.ONE_HUNDRED') / $totalCost }}%;" title="@lang('common.usa_currency_label'){{ $staffData->sum('total_cost') }}">
                    </div>
                  </div>
                </div>
                <div class="col-md-1 col-xs-1">
                  <span style="font-size: 14px;">
                    {{ ceil(($staffData->sum('total_cost') * \Config::get('common.ONE_HUNDRED')) / $totalCost) }}@lang('statistics.label_percent')
                    <?php
                      $subtractDedicatedStaff += ceil(($staffData->sum('total_cost') * \Config::get('common.ONE_HUNDRED')) / $totalCost);
                      $leftCost -= $staffData->sum('total_cost');
                    ?>
                  </span>
                </div>
                <div class="clearfix"></div>
              </div>
            @endforeach
            <div class="widget_summary">
              <div class="col-md-5 col-xs-5">
                <span>@lang('statistics.label_others')</span>
              </div>
              <div class="col-md-6 col-xs-6">
                <div class="progress">
                  <div class="progress-bar bg-green" role="progressbar"
                      style="width: {{ ceil((\Config::get('common.ONE_HUNDRED') - $subtractDedicatedStaff)) }}%;" title="@lang('common.usa_currency_label'){{ $leftCost }}">
                  </div>
                </div>
              </div>
              <div class="col-md-1 col-xs-1">
                <span style="font-size: 14px;">
                  {{ ceil((\Config::get('common.ONE_HUNDRED') - $subtractDedicatedStaff)) }}@lang('statistics.label_percent')
                </span>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Charts -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>@lang('statistics.label_monthly_statistic')</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="monthly-statistic" style="height: 500%;width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Charts --> 
@stop

@push('end-page-scripts')
  <script src="/bower_resources/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="/bower_resources/gentelella/vendors/echarts/dist/echarts.min.js" charset="utf-8"></script>
  <script src="/bower_resources/gentelella/build/js/custom.min.js" charset="utf-8"></script>
  <script src="/bower_resources/gentelella/vendors/Chart.js/dist/Chart.min.js" charset="utf-8"></script>
  <script src="/bower_resources/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js" charset="utf-8"></script>
  <script src="/bower_resources/gentelella/vendors/nprogress/nprogress.js" charset="utf-8"></script>
  <script src="/bower_resources/jquery-ui-month-picker/src/MonthPicker.js" charset="utf-8"></script>
  <script>
      var language = {!! json_encode(trans('statistics')) !!};
  </script>
  <script type="text/javascript">
    var label_monthly_statistic = "@lang('statistics.label_monthly_statistic_chart')";
    var label_sales = "@lang('statistics.label_sales')";
    var label_orders = "@lang('statistics.label_orders')";
    var billsData = [
      @foreach ($billMonths as $billMonth)
        {{ $billMonth->sum('total_cost') }},
      @endforeach
    ];
    var ordersData = [
      @foreach ($orderMonths as $orderMonth)
        {{ $orderMonth->sum('total_cost') }},
      @endforeach
    ];
    var labels = [
      @foreach ($topProducts->take(\Config::get('common.TOP_4')) as $topProduct)
        '{{ $topProduct->first()->product->name }}',
      @endforeach
    ];
    labels.push("@lang('statistics.label_others')");
    var data = [
      @foreach ($topProducts->take(\Config::get('common.TOP_4')) as $topProduct)
        {{ ceil(($topProduct->sum('amount') * \Config::get('common.ONE_HUNDRED')) / $total_amount) }},
      @endforeach
    ];
    var label_increase_percentage = "@lang('statistics.label_increase_percentage')";
    data.push({{ \Config::get('common.ONE_HUNDRED') - $subtractHotProduct }});
    var profitOverMonths = [
      @foreach ($incomeMonths as $incomeMonth)
        {{ $incomeMonth }},
      @endforeach
    ];
    profitOverMonths[0] = 0 ;
    var label_percent = "@lang('statistics.label_percent')";
  </script>
  <script src="/js/statistics/monthly.js" charset="utf-8"></script>
@endpush
