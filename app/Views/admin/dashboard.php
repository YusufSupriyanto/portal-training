<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="m-1 d-flex flex-row">
    <div class="" style="width:100%;height:100%">
        <div class="card" id="training" style="width:100%;height:100%;color:blue;"></div>
        <div class="d-flex flex-row justify-content-between" style="width:100%;height:10%;">
            <div class="card" id="need_approval" style="width:30%;height:30%;color:blue;"></div>
            <div class="card" id="approval" style="width:30%;height:30%;color:blue;"></div>
            <div class="card" id="rejected" style="width:30%;height:30%;color:blue;"></div>
        </div>
        <div class="d-flex flex-row" style="width:100%;height:100%;">
            <div class="card" id="jenis" style="width:100%;height:100%;"></div>
            <div class="card" id="category" style="width:100%;height:100%;"></div>
        </div>
    </div>

    <div class="card ml-1" style="width:25%;">
        <div class="d-flex align-content-center">
            <div style="width:100%;">
                <center>
                    <h5>Total Budget (RP)</h5>
                    <?php
                    $total = 0;
                    $used = 0;
                    foreach ($budget as $budgets) {
                        $total += $budgets['alocated_budget'];
                        $used += $budgets['used_budget'];
                    }
                    $persent = $used / $total * 100;
                    ?>
                    <input type="text" class="form-control" style="width:70%;"
                        value="<?= "Rp " . number_format($total, 0, ',', '.') ?>">
                    <h5>Used Budget (RP)</h5>
                    <input type="text" class="form-control" style="width:70%;"
                        value="<?= "Rp " . number_format($used, 0, ',', '.') ?>">
                    <h6><?= number_format($persent, 2, ',', '.') ?>%</h6>
                </center>
            </div>
        </div>
        <div class="card m-2" style="background-color:#F0F8FF;height:100%">
            <center>
                <h5>Available Budget</h5>
                <?php foreach ($budget as $budgets) : ?>
                <h6><?= $budgets['department'] ?></h6>
                <div class="mb-1" style="display:flex;justify-content:center;">
                    <input type="text" class="form-control" style="width:50%;height:30px"
                        value="<?= "Rp " . number_format($budgets['available_budget'], 0, ',', '.') ?>">
                    <input type="text" class="form-control" style="width:30%;height:30px"
                        value="<?= $budgets['available_budget'] / $budgets['alocated_budget'] * 100 ?>%">
                </div>
                <?php endforeach; ?>
            </center>

        </div>

    </div>
</div>

<div class="card m-1" style="width:100%;height:400px;">

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
            <?php $i = 0;
            foreach ($department as $Department) :
                $active = ($i == 0) ? 'active' : '';


                $monthDept = $dept->TrainingDahboardMonthDepartment($Department['departemen']);

                $columnDept = $dept->TrainingDahboardCountColumnDepartment($Department['departemen']);
                // d($columnDept);
                $lineDept = $dept->TrainingDahboardCountLineDepartment($Department['departemen']);
                // 
            ?>
            <div class="carousel-item <?= $active ?>">

                <div class="m-1" id="<?= $Department['departemen'] ?>" style="width:100%;height:100%;"></div>
            </div>
            <script>
            Highcharts.chart('<?= $Department['departemen'] ?>', {
                title: {
                    text: '<?= $Department['departemen'] ?>',
                    align: 'center'
                },
                xAxis: {
                    categories: <?= json_encode($monthDept) ?>
                },
                yAxis: {
                    title: {
                        text: 'Training'
                    }
                },
                tooltip: {
                    valueSuffix: 'Training'
                },
                series: [{
                    type: 'column',
                    name: 'Target Training',
                    data: <?= json_encode($columnDept) ?>
                }, {
                    type: 'spline',
                    name: 'Sudah Dilaksanakan',
                    data: <?= json_encode($lineDept) ?>

                }]
            });
            </script>
            <?php $i++;
            endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:black;"></span></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color:black;"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data retrieved from https://netmarketshare.com

    //Highchart Jenis Training
    Highcharts.chart('jenis', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jenis Training',
            align: 'center',
            style: {
                fontSize: '15px'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: <?php echo json_encode($Jenis_training) ?>
        }]
    });


    //Highchart Jenis Training
    Highcharts.chart('category', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Category',
            align: 'center',
            style: {
                fontsize: '15px'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: <?php echo json_encode($category) ?>
        }]
    });

    //training chart
    Highcharts.chart('training', {
        title: {
            text: 'Training',
            align: 'center'
        },
        xAxis: {
            categories: <?= json_encode($month) ?>
        },
        yAxis: {
            title: {
                text: 'Training'
            }
        },
        tooltip: {
            valueSuffix: 'Training'
        },
        series: [{
            type: 'column',
            name: 'Target Training',
            data: <?= json_encode($column) ?>
        }, {
            type: 'spline',
            name: 'Sudah Dilaksanakan',
            data: <?= json_encode($line) ?>

        }]
    });

    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'need_approval',
            type: 'pie'
        },
        title: {
            verticalAlign: 'middle',
            floating: true,
            text: '<?= $need_approval . '% Need Approval' ?>',
        },
        plotOptions: {
            pie: {
                innerSize: '100%'
            },
            series: {
                states: {
                    hover: {
                        enabled: false
                    },
                    inactive: {
                        opacity: 1
                    }
                }
            }
        },
        series: [{
            borderWidth: 0,
            name: 'Need Approval',
            data: [{
                    name: 'Need Approval',
                    y: <?= (float)$need_approval ?>,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                        stops: [
                            [0, '#4679F8'],
                            [1, '#57B2A5']
                        ]
                    },
                },
                {
                    name: 'Approve And Reject',
                    y: <?= (float)100 - (float)$need_approval ?>,
                    color: "#DDF4E4",
                }
            ],
            size: '100%',
            innerSize: '75%',
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }, {
            size: '65%',
            innerSize: '95%',
            dataLabels: {
                enabled: false
            },
            data: [{
                y: 30
            }, {
                y: 20,
                color: 'rgba(0,0,0,0)'
            }]
        }],
        credits: {
            enabled: false
        }
    });

    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'approval',
            type: 'pie'
        },
        title: {
            verticalAlign: 'middle',
            floating: true,
            text: '<?= $approved . '% Approved' ?>',
        },
        plotOptions: {
            pie: {
                innerSize: '100%'
            },
            series: {
                states: {
                    hover: {
                        enabled: false
                    },
                    inactive: {
                        opacity: 1
                    }
                }
            }
        },
        series: [{
            borderWidth: 0,
            name: 'Approved',
            data: [{
                    name: 'Approved',
                    y: <?= (float)$approved ?>,
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                        stops: [
                            [0, 'rgb(255,0,0)'],
                            [1, 'rgb(255,0,0)']
                        ]
                    },
                },
                {
                    name: "Need Approval And Reject",
                    y: <?= (float)100 - (float)$approved ?>,
                    color: "#DDF4E4",
                }
            ],
            size: '100%',
            innerSize: '75%',
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }, {
            size: '65%',
            innerSize: '95%',
            dataLabels: {
                enabled: false
            },
            data: [{

                y: 30
            }, {
                y: 20,
                color: 'rgba(0,0,0,0)'
            }]
        }],
        credits: {
            enabled: false
        }
    });

    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'rejected',
            type: 'pie'
        },
        title: {
            verticalAlign: 'middle',
            floating: true,
            text: '<?= $rejected . '% Rejected' ?>',
        },
        plotOptions: {
            pie: {
                innerSize: '100%'
            },
            series: {
                states: {
                    hover: {
                        enabled: false
                    },
                    inactive: {
                        opacity: 1
                    }
                }
            }
        },
        series: [{
            borderWidth: 0,
            name: 'Rejected',
            data: [{
                    name: "Rejected",
                    y: <?= (float)$rejected ?>,

                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 0,
                            y2: 1
                        },
                        stops: [
                            [0, 'rgb(255,165,0)'],
                            [1, 'rgb(255,165,0)']
                        ]
                    },
                },
                {
                    name: "Approved And Need Approval",
                    y: <?= (float)100 - (float)$rejected ?>,
                    color: "#DDF4E4",
                }
            ],
            size: '100%',
            innerSize: '75%',
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }, {
            size: '65%',
            innerSize: '95%',
            dataLabels: {
                enabled: false
            },
            data: [{
                y: 30
            }, {
                y: 20,
                color: 'rgba(0,0,0,0)'
            }]
        }],
        credits: {
            enabled: false
        }
    });


    Highcharts.chart('department', {
        title: {
            text: 'Training',
            align: 'center'
        },
        xAxis: {
            categories: <?= json_encode($month) ?>
        },
        yAxis: {
            title: {
                text: 'Training'
            }
        },
        tooltip: {
            valueSuffix: 'Training'
        },
        series: [{
            type: 'column',
            name: 'Target Training',
            data: <?= json_encode($column) ?>
        }, {
            type: 'spline',
            name: 'Sudah Dilaksanakan',
            data: <?= json_encode($line) ?>

        }]
    });





});
</script>


<?= $this->endSection() ?>