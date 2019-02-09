@extends('adminlte::page')

@section('title', 'CadMEI')

@section('content_header')

@stop

@section('content')
    
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Serviços Executados</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body" style="">
            <div class="chart">
                <canvas id="servicoChart" style="height: 254px; width: 547px;" width="547" height="254"></canvas>
            </div>
        </div>
    </div>    
</div>

<div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Total Clientes e Empresas</h3>
    
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body" style="">
                <div class="chart">
                    <canvas id="empresasChart" style="height: 254px; width: 547px;" width="547" height="254"></canvas>
                </div>
            </div>
        </div>    
    </div>

<script>
    $(document).ready(function() {
        var ctx = document.getElementById("servicoChart").getContext('2d');
        var servicoChart = new Chart(ctx, {
            type: 'bar',            
            data: {
                labels: [ @foreach ($dados_servicos as $servico)
                                [ "{{ $servico->descricao }}" ], 
                            @endforeach ],
                datasets: [{
                    label: 'Total execução serviços',
                    data: [ @foreach ($dados_servicos as $servico)
                                [ "{{ $servico->qtd }}" ], 
                            @endforeach ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(173, 71, 16, 0.2)',
                        'rgba(173, 118, 16, 0.2)',
                        'rgba(173, 173, 16, 0.2)',
                        'rgba(149, 173, 16, 0.2)',
                        'rgba(102, 173, 16, 0.2)',
                        'rgba(47, 173, 16, 0.2)',
                        'rgba(16, 173, 40, 0.2)',
                        'rgba(16, 173, 107, 0.2)',
                        'rgba(16, 173, 162, 0.2)',
                        'rgba(16, 68, 173, 0.2)',
                        'rgba(16, 21, 173, 0.2)',
                        'rgba(73, 16, 173, 0.2)',
                        'rgba(115, 16, 173, 0.2)',
                        'rgba(154, 16, 173, 0.2)',
                        'rgba(173, 16, 66, 0.2)',
                        'rgba(16, 173, 47, 0.2)',
                        'rgba(173, 100, 16, 0.2)',
                        'rgba(16, 97, 173, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(173, 71, 16, 1)',
                        'rgba(173, 118, 16, 1)',
                        'rgba(173, 173, 16, 1)',
                        'rgba(149, 173, 16, 1)',
                        'rgba(102, 173, 16, 1)',
                        'rgba(47, 173, 16, 1)',
                        'rgba(16, 173, 40, 1)',
                        'rgba(16, 173, 107, 1)',
                        'rgba(16, 173, 162, 1)',
                        'rgba(16, 68, 173, 1)',
                        'rgba(16, 21, 173, 1)',
                        'rgba(73, 16, 173, 1)',
                        'rgba(115, 16, 173, 1)',
                        'rgba(154, 16, 173, 1)',
                        'rgba(173, 16, 66, 1)',
                        'rgba(16, 173, 47, 1)',
                        'rgba(173, 100, 16, 1)',
                        'rgba(16, 97, 173, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontSize: 10,
                            autoSkip: false
                        }
                    }]
                },
                legend: {
                    display: false,
                    position: 'top',
                    labels: {
                        fontColor: 'rgb(255, 99, 132)'
                    }                    
                },
                responsive: true,
            }            
        });
    });

    $(document).ready(function() {
        var ctx = document.getElementById("empresasChart").getContext('2d');
        var empresasChart = new Chart(ctx, {
            type: 'doughnut',            
            data: {
                labels: [ 'Clientes', 'Empresas' ],
                datasets: [{
                    label: 'Total execução serviços',
                    data: [ [ "{{ $dados_empresarios->qtd }}" ], [ "{{ $dados_empresas->qtd }}" ]],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            color: "black"
                        },
                        ticks: {
                            beginAtZero:true,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: "black"
                        },
                        ticks: {
                            fontSize: 10,
                            autoSkip: false
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'top'                    
                },
                responsive: true
            }            
        });
    });
</script>
@stop