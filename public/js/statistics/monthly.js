// top 5 hot products
$(document).ready(function(){
  var options = {
    legend: false,
    responsive: false
  };
  new Chart(document.getElementById("top-products-chart"), {
    type: 'doughnut',
    tooltipFillColor: "rgba(51, 51, 51, 0.55)",
    data: {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: [
          "#BDC3C7",
          "#9B59B6",
          "#E74C3C",
          "#26B99A",
          "#3498DB"
        ],
        hoverBackgroundColor: [
          "#CFD4D8",
          "#B370CF",
          "#E95E4F",
          "#36CAAB",
          "#49A9EA"
        ]
      }]
    },
    options: options
  });
});

// monthly orders and bills
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

var echartBar = echarts.init(document.getElementById('monthly-statistic'), theme);
echartBar.setOption({
  calculable : true,
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    data: [label_sales, label_orders]
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
    name: label_sales,
    type: 'bar',
    data: billsData,
    markPoint: {
      data: [{
        type: 'max',
        name: language.label_max
      }, {
        type: 'min',
        name: language.label_min
      }]
    },
    markLine: {
      data: [{
        type: 'average',
        name: language.label_avarage
      }]
    }
  }, {
    name: label_orders,
    type: 'bar',
    data: ordersData,
    markPoint: {
      data: [{
        name: label_sales,
        value: 182.2,
        xAxis: 7,
        yAxis: 183,
      }, {
        name: label_orders,
        value: 2.3,
        xAxis: 11,
        yAxis: 3
      }]
    },
    markLine: {
      data: [{
        type: 'average',
        name: language.label_avarage
      }]
    }
  }]
});
$(window).on('resize', function(){
    if(echartBar != null && echartBar != undefined){
        echartBar.resize();
    }
});

// percentage increase chart
var ctx = document.getElementById("statistic-increasing-percentage");
var statistic_increasing_percentage = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
      language.label_january,
      language.label_february,
      language.label_march,
      language.label_april,
      language.label_may,
      language.label_july,
      language.label_june,
      language.label_august,
      language.label_september,
      language.label_october,
      language.label_november,
      language.label_december,
    ],
    datasets: [{
      label: label_percent +" "+ label_increase_percentage,
      backgroundColor: "rgba(38, 185, 154, 0.31)",
      borderColor: "rgba(38, 185, 154, 0.7)",
      pointBorderColor: "rgba(38, 185, 154, 0.7)",
      pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
      pointHoverBackgroundColor: "#fff",
      pointHoverBorderColor: "rgba(220,220,220,1)",
      pointBorderWidth: 1,
      data: profitOverMonths
    }]
  }
});

$('#selected-month-year').MonthPicker({
  MaxMonth: -1,
  Button: false,
  OnAfterChooseMonth: function () {
    $("form").submit();
  }
});
