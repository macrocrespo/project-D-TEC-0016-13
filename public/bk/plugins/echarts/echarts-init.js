

// ------------------------------
    // Stacked bar chart
    // ------------------------------
    // based on prepared DOM, initialize echarts instance
    var stackedChart = echarts.init(document.getElementById('stacked-bar'));

    // specify chart configuration item and data
    var option = {
            // Setup grid
            grid: {
                x: 40,
                x2: 40,
                y: 45,
                y2: 25
            },

            // Add tooltip
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // Axis indicator axis trigger effective
                    type : 'shadow'        // The default is a straight line, optionally: 'line' | 'shadow'
                }
            },

            // Add legend
            legend: {
                data: ['Google', 'Facebook', 'Instagram', 'Guía Master', 'Otros']
            },

            // Add custom colors
            color: ['#2962FF', '#4fc3f7', '#212529', '#f62d51', '#dadada'],

            // Horizontal axis
            yAxis: [{
                type: 'value',
            }],

            // Vertical axis
            xAxis: [{
                type: 'category',
                data: ['Marzo', 'Abril']
            }],

            toolbox: {
                show : true,
                feature : {
                    saveAsImage : {show: true}
                }
            },

            // Add series
            series : [
                {
                    name:'Google',
                    type:'bar',
                    stack: 'Total',
                    itemStyle : { normal: {label : {show: true, position: 'insideRight'}}},
                    data:[320, 302]
                },
                {
                    name:'Facebook',
                    type:'bar',
                    stack: 'Total',
                    itemStyle : { normal: {label : {show: true, position: 'insideRight'}}},
                    data:[120, 132]
                },
                {
                    name:'Instagram',
                    type:'bar',
                    stack: 'Total',
                    itemStyle : { normal: {label : {show: true, position: 'insideRight'}}},
                    data:[220, 182]
                },
                {
                    name:'Guía Master',
                    type:'bar',
                    stack: 'Total',
                    itemStyle : { normal: {label : {show: true, position: 'insideRight'}}},
                    data:[150, 212]
                },
                {
                    name:'Otros',
                    type:'bar',
                    stack: 'Total',
                    itemStyle : { normal: {label : {show: true, position: 'insideRight'}}},
                    data:[820, 832]
                }
            ]
        };
    // use configuration item and data specified to show chart
    stackedChart.setOption(option);