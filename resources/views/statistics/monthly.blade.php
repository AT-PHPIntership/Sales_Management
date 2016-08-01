@extends('layouts.app')

@section('page-title')
    @lang('statistics.common.title')
@stop

@section('section-title')
    @lang('statistics.common.title')
@stop

@push('stylesheet')
  <link rel="stylesheet" href="/bower_resources/gentelella/build/css/custom.min.css" media="screen" title="no title" charset="utf-8">
@endpush

@section('page-content')
    
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hang hoa ban chay <small>Sessions</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <canvas id="canvasDoughnut"></canvas>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2> Top 5 nhan vien ${{ $total_cost }}</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @foreach ($staffsData as $staffData)
              <div class="widget_summary">
                <div class="w_left w_25">
                  <span>{{ $staffData->first()->user->name }}</span>
                </div>
                <div class="w_center w_55">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" 
                        style="width: {{ $staffData->sum('total_cost')*100/$total_cost }}%;" title="{{ ceil($staffData->sum('total_cost')*100/$total_cost) }}%">
                      <span class="sr-only">{{ $staffData->sum('total_cost') }}% Complete</span>
                    </div>
                  </div>
                </div>
                <div class="w_right w_20">
                  <span>@lang('common.usa_currency_label'){{ $staffData->sum('total_cost') }}</span>
                </div>
                <div class="clearfix"></div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    
    <!-- Charts -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bar Graph</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div id="mainb" style="height: 500%;width: 100%;"></div>

          </div>
        </div>
      </div>
    </div>
    <!-- /Charts --> 
@stop




@push('end-page-scripts')
  <script src="/bower_resources/gentelella/vendors/echarts/dist/echarts.min.js" charset="utf-8"></script>
  <script src="/bower_resources/gentelella/build/js/custom.min.js" charset="utf-8"></script>
  <!-- <script src="/bower_resources/gentelella/vendors/echarts/map/js/world.js" charset="utf-8"></script> -->
  <script src="/bower_resources/gentelella/vendors/Chart.js/dist/Chart.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    // Doughnut chart
    var ctx = document.getElementById("canvasDoughnut");
    var staffsData = [
      @foreach ($staffsData as $staffData)
        {{ $staffData->sum('total_cost') }},
      @endforeach
    ];
    var data = {
      labels: [
        "Dark Grey",
        "Purple Color",
        "Gray Color",
        "Green Color",
        "Blue Color"
      ],
      datasets: [{
        data: staffsData,
        backgroundColor: [
          "#455C73",
          "#9B59B6",
          "#BDC3C7",
          "#26B99A",
          "#3498DB"
        ],
        hoverBackgroundColor: [
          "#34495E",
          "#B370CF",
          "#CFD4D8",
          "#36CAAB",
          "#49A9EA"
        ]

      }]
    };

    var canvasDoughnut = new Chart(ctx, {
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: data
    });
  </script>
  <script type="text/javascript">
    var theme = {
        color: [
            '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
            '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
        ],

        title: {
            itemGap: 8,
            textStyle: {
                fontWeight: 'normal',
                color: '#408829'
            }
        },

        dataRange: {
            color: ['#1f610a', '#97b58d']
        },

        toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
        },

        tooltip: {
            backgroundColor: 'rgba(0,0,0,0.5)',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: '#408829',
                    type: 'dashed'
                },
                crossStyle: {
                    color: '#408829'
                },
                shadowStyle: {
                    color: 'rgba(200,200,200,0.3)'
                }
            }
        },

        dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
        },
        grid: {
            borderWidth: 0
        },

        categoryAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },

        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitArea: {
                show: true,
                areaStyle: {
                    color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },
        timeline: {
            lineStyle: {
                color: '#408829'
            },
            controlStyle: {
                normal: {color: '#408829'},
                emphasis: {color: '#408829'}
            }
        },

        k: {
            itemStyle: {
                normal: {
                    color: '#68a54a',
                    color0: '#a9cba2',
                    lineStyle: {
                        width: 1,
                        color: '#408829',
                        color0: '#86b379'
                    }
                }
            }
        },
        force: {
            itemStyle: {
                normal: {
                    linkStyle: {
                        strokeColor: '#408829'
                    }
                }
            }
        },
        chord: {
            padding: 4,
            itemStyle: {
                normal: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                },
                emphasis: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                }
            }
        },
        gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
                show: true,
                lineStyle: {
                    color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                    width: 8
                }
            },
            axisTick: {
                splitNumber: 10,
                length: 12,
                lineStyle: {
                    color: 'auto'
                }
            },
            axisLabel: {
                textStyle: {
                    color: 'auto'
                }
            },
            splitLine: {
                length: 18,
                lineStyle: {
                    color: 'auto'
                }
            },
            pointer: {
                length: '90%',
                color: 'auto'
            },
            title: {
                textStyle: {
                    color: '#333'
                }
            },
            detail: {
                textStyle: {
                    color: 'auto'
                }
            }
        },
        textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
        }
    };
    
    var echartBar = echarts.init(document.getElementById('mainb'), theme);
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
    
    echartBar.setOption({
      title: {
        text: 'Graph title',
        subtext: 'Graph Sub-text'
      },
      calculable : true,
      tooltip: {
        trigger: 'axis'
      },
      legend: {
        data: ['sales', 'orders']
      },
      toolbox: {
        show: false
      },
      xAxis: [{
        type: 'category',
        data: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
      }],
      yAxis: [{
        type: 'value'
      }],
      series: [{
        name: 'sales',
        type: 'bar',
        data: billsData,
        markPoint: {
          data: [{
            type: 'max',
            name: '???'
          }, {
            type: 'min',
            name: '???'
          }]
        },
        markLine: {
          data: [{
            type: 'average',
            name: '???'
          }]
        }
      }, {
        name: 'orders',
        type: 'bar',
        data: ordersData,
        markPoint: {
          data: [{
            name: 'sales',
            value: 182.2,
            xAxis: 7,
            yAxis: 183,
          }, {
            name: 'orders',
            value: 2.3,
            xAxis: 11,
            yAxis: 3
          }]
        },
        markLine: {
          data: [{
            type: 'average',
            name: '???'
          }]
        }
      }]
    });
    $(window).on('resize', function(){
        if(echartBar != null && echartBar != undefined){
            echartBar.resize();
        }
    });
  </script>
@endpush
