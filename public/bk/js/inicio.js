/**
 * SCRIPTS ESPECIFICOS PARA LA PAGINA DE INICIO
 */

var color_azul = '#4775d1';
var color_rojo = '#e62e00';
var color_verde = '#21930c';


jQuery(document).ready(function() {
    data_busquedas_por_dispositivo();
    data_promociones_origen();
    listado_busquedas_sin_resultados();
    listado_promociones_rubros();
});

/** DATOS BUSQUEDAS POR DISPOSIVO */
function data_busquedas_por_dispositivo() {
    var base_url = $('#base_url').val();
    var token = $('input[name="_token"]').val();
    var url = base_url + '/json_busquedas_por_dispositivo';
    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token},
        cache: false,
        success: function(data){
            data = JSON.parse(data);
            grafico_busquedas_por_dispositivo(data);
        }
    });
}

/** GRAFICO BUSQUEDAS POR DISPOSIVO */
function grafico_busquedas_por_dispositivo(data) {
    var doughnutChart = echarts.init(document.getElementById('busquedas_por_dispositivo'));
    option = {
        tooltip : {
            show: false,
            trigger: 'item',
            formatter: "{b}:<br/>{c} | {d}%"
        },
        legend: {
            data: ['PC', 'Celular']
        },
        toolbox: {
            show : true,
            feature : {
                saveAsImage : {show: true}
            }
        },
        color: [color_azul, color_rojo],
        calculable : true,
        series : [
            {
                name:'Dispositivo',
                type:'pie',
                radius : ['40%', '80%'],
                avoidLabelOverlap: false,
                label: {
                    show: true,
                    position: 'inside',
                    formatter: "{b}\n{d}%"
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '20',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: data
            }
        ]
    };
    // use configuration item and data specified to show chart
    doughnutChart.setOption(option, true), $(function() {
        function resize() {
            setTimeout(function() {
                doughnutChart.resize()
            }, 100)
        }
        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
    });
}

/** DATOS PROMOCIONES ORIGEN */
function data_promociones_origen() {
    var base_url = $('#base_url').val();
    var token = $('input[name="_token"]').val();
    var periodo = $('#promociones_origen_periodo').val();
    var url = base_url + '/json_promociones_origen';
    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token, periodo: periodo},
        cache: false,
        success: function(data){
            data = JSON.parse(data);
            $('#promociones_origen_total span').html(data.total);
            grafico_promociones_origen(data);
        }
    });
}

/** GRAFICO PROMOCIONES ORIGEN */
function grafico_promociones_origen(data) {
    var stackedChart = echarts.init(document.getElementById('promociones_origen'));

    option = {
        color: [color_azul, color_rojo, color_verde],
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            formatter: "{b}<br/>PC: {c0} visitas<br/>Celular: {c1} visitas"
        },
        legend: {
            data: ['PC', 'Celular']
        },
        toolbox: {
            show: true,
            orient: 'vertical',
            left: 'right',
            top: 'center',
            feature: {
                saveAsImage: {show: true}
            }
        },
        xAxis: [
            {
                type: 'category',
                axisTick: {show: false},
                data: ['Google', 'Facebook', 'Instagram', 'Guía Master']
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: 'PC',
                type: 'bar',
                stack: true,
                label: { show: true },
                data: data.pc
            },
            {
                name: 'Celular',
                type: 'bar',
                stack: true,
                label: { show: true },
                data: data.celular
            },
            {
                name: 'Total',
                type: 'bar',
                stack: true,
                label: {
                    normal: {
                        show: true,
                        position: 'top',
                        formatter: function(params) {
                            let val=0;
                            this.option.series.forEach(s => { 
                                val+=s.data[params.dataIndex];
                            } );
                            return 'Total: '+val;
                        }
                    }
                },
                data: [0,0,0,0]
            }
        ]
    };


  
    // use configuration item and data specified to show chart
    stackedChart.setOption(option);
}

function listado_busquedas_sin_resultados() {
    var base_url = $('#base_url').val();
    var token = $('input[name="_token"]').val();
    var url = base_url + '/listado_busquedas_sin_resultados';
    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token},
        cache: false,
        success: function(html){
            $('#busquedas_sin_resultados_wrapper').html(html);
        }
    });
}

function listado_promociones_rubros() {
    var base_url = $('#base_url').val();
    var token = $('input[name="_token"]').val();
    var periodo = $('#promociones_rubros_periodo').val();
    var url = base_url + '/listado_promociones_rubros';
    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token, periodo: periodo},
        cache: false,
        success: function(html){
            $('#promociones_rubros_wrapper').html(html);
        }
    });
}

function eliminar_busqueda_sin_resultados(id) {
    var base_url = $('#base_url').val();
    var token = $('input[name="_token"]').val();
    var url = base_url + '/busquedas/eliminar_busqueda';
    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token, id: id},
        cache: false,
        success: function() {
            var table = $('#busquedas_sin_resultados').DataTable();
            table.rows('#tr-'+id).remove().draw(false);
        }
    });
}