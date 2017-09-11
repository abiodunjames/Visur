(function ($, window) {
    var url = 'graph';
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
        map: {
            itemStyle: {
                normal: {
                    areaStyle: {
                        color: '#ddd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                },
                emphasis: {
                    areaStyle: {
                        color: '#99d2dd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
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
    var barchart = (function () {
        function get() {
            var range = document.getElementById('visur__current__selected__timeline').value;
            var link = url + '/barchart?timeline='+range;

            $.get(link, function (response, status) {
                if (response.status = true) {
                    var event =response.event;

                    var x_axis = new Array();
                    $.each(event, function () {
                        x_axis.push(this.timestamp);
                    });
                    var y_axis = new Array();
                    $.each(event,function () {
                        y_axis.push(this.count);
                    });
                    var echartBar = echarts.init(document.getElementById('dashboard_barchart'), theme);
                    echartBar.setOption({
                        title: {
                            text: response.title,
                            subtext: response.subtitle,
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: [response.title]
                        },
                        toolbox: {
                            show: false
                        },
                        calculable: true,
                        xAxis: [{
                            type: 'category',
                            name: 'Date of the week',
                            data:  x_axis,
                            axisTick: {
                                alignWithLabel: true
                            }
                        }],
                        yAxis: [{
                            type: 'value'
                        }],
                        series: [{
                            name: 'Event Count',
                            type: 'bar',
                            data: y_axis,

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
                        }],
                    });
                }
            });
        }
        function startChart() {
            get();
        }

        return {
            init: function () {
                return startChart();
            }
        }
    })();

    var piechart=( function () {
        var range = document.getElementById('visur__current__selected__timeline').value;
        var link = url + '/piechart?timeline='+range;
        function get() {
            $.get(link, function (response, status) {
                if(response.status){
                    var keys = new Array();
                    $.each(response.event, function () {
                        keys.push(this.name);
                    });
                    if ($('#event_piechart').length ){
                        var echartPie = echarts.init(document.getElementById('event_piechart'), theme);

                        echartPie.setOption({
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            legend: {
                                x: 'center',
                                y: 'bottom',
                                data: keys
                            },
                            toolbox: {
                                show: true,
                                feature: {
                                    magicType: {
                                        show: true,
                                        type: ['pie', 'funnel'],
                                        option: {
                                            funnel: {
                                                x: '25%',
                                                width: '50%',
                                                funnelAlign: 'left',
                                                max: 1548
                                            }
                                        }
                                    },
                                    restore: {
                                        show: true,
                                        title: "Restore"
                                    },
                                    saveAsImage: {
                                        show: true,
                                        title: "Save Image"
                                    }
                                }
                            },
                            calculable: true,
                            series: [{
                                name: 'Events',
                                type: 'pie',
                                radius: '55%',
                                center: ['50%', '48%'],
                                data: response.event
                            }]
                        });

                        var dataStyle = {
                            normal: {
                                label: {
                                    show: false
                                },
                                labelLine: {
                                    show: false
                                }
                            }
                        };

                        var placeHolderStyle = {
                            normal: {
                                color: 'rgba(0,0,0,0)',
                                label: {
                                    show: false
                                },
                                labelLine: {
                                    show: false
                                }
                            },
                            emphasis: {
                                color: 'rgba(0,0,0,0)'
                            }
                        };

                    }
                }
            });

        }
        function startPieChart() {
            get();
        }
      return {
            init: function () {
                return startPieChart();
            }
      }
    })();

    /*
     |--------------------------------------------------------------------------
     | Initialize charts
     |--------------------------------------------------------------------------
     */
    $(document).ready(function () {
        barchart.init();
        piechart.init()

    })

})(jQuery, window);





