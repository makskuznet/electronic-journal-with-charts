/**
 * ---------------------------------------
 * This demo was created using amCharts 4.
 * 
 * For more information visit:
 * https://www.amcharts.com/
 * 
 * Documentation is available at:
 * https://www.amcharts.com/docs/v4/
 * ---------------------------------------
 */

 // Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

chart.cursor = new am4charts.XYCursor();
chart.cursor.maxTooltipDistance = 1;		//значения для перехода на другую подсказку

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

//формат дат
chart.dateFormatter.dateFormat = "dd.MM.yyyy";

dateAxis.dateFormats.setKey("month", "MM.yyyy");
dateAxis.dateFormats.setKey("day", "dd.MM.yyyy");
dateAxis.periodChangeDateFormats.setKey("day", "dd.MM.yyyy"); //тут задаём тип первой ячейки в интервале
dateAxis.periodChangeDateFormats.setKey("month", "MM.yyyy");

var subjects_array = [];
  $.ajax({
	type: "POST",
	url: '../data/getSubjectData.php',
	async: false,

	  success: function (subjects_json) {		//получаем массив с датами и оценками в формате json
		  subjects_array = JSON.parse(subjects_json); 	// распарсим JSON
		  console.log(subjects_array); 
	},
	 error: function (jqXHR, exception) {		//обычные функции ошибок
		 if (jqXHR.status === 0) {
			  console.error('Not connect.\n Verify Network.');
		 } else if (jqXHR.status == 404) {
			  console.error('Requested page not found. [404]');
		 } else if (jqXHR.status == 500) {
			  console.error('Internal Server Error [500].');
		 } else if (exception === 'parsererror') {
			  console.error('Requested JSON parse failed.');
		 } else if (exception === 'timeout') {
			  console.error('Time out error.');
		 } else if (exception === 'abort') {
			  console.error('Ajax request aborted.');
		 } else {
			  console.error('Uncaught Error.\n'+ jqXHR.responseText);
		 }
	},
});

for (var i = 0; i < subjects_array.length; i++) {
	createSeries(i);
}

// Create series
function createSeries(id) {
	var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = "mark";
  series.dataFields.dateX = "date";
  series.name = subjects_array[id][0]; //это название для каждой линии (предмет)
	series.strokeWidth = 2;

	//сглаживание
	series.tensionX = 0.8;
	series.tensionY = 1;
	series.tooltipText = "Предмет: {name}\nДата: {dateX}\nСр. оценка: {valueY}";
  series.bullets.push(new am4charts.CircleBullet());

	//тут включаем взаимодействие с графиком при наведении
  var segment = series.segments.template;
  segment.interactionsEnabled = true;

	//изменяем толщину при наведении
  var hoverState = segment.states.create("hover");
  hoverState.properties.strokeWidth = 3;

	//создаём свойство затемнения
  var dimmed = segment.states.create("dimmed");
  dimmed.properties.stroke = am4core.color("#dadada");

  segment.events.on("over", function(event) {
    processOver(event.target.parent.parent.parent);
  });

  segment.events.on("out", function(event) {
    processOut(event.target.parent.parent.parent);
  });

   var data = [];		//массив дата -> оценка для каждой линии в нём несколько элементов
	
  for (var j = 0; j < subjects_array[id][1].length; j++) {
	var dataItem = {					//объект, связывающий оценку и дату
	  date: new Date(subjects_array[id][1][j][0]), //дата, график не принимает стандартную дату, поэтому приходится её разбирать
		mark: subjects_array[id][1][j][1],						//оценка
  };
  data.push(dataItem); 
}

  series.data = data;
  return series;
}

chart.legend = new am4charts.Legend();
chart.legend.position = "right";
chart.legend.scrollable = true;
chart.legend.itemContainers.template.events.on("over", function(event) {
  processOver(event.target.dataItem.dataContext);
})

chart.legend.itemContainers.template.events.on("out", function(event) {
  processOut(event.target.dataItem.dataContext);
})
//если наводимся на линию, она выделяется а все остальные затемняются
function processOver(hoveredSeries) {
  hoveredSeries.toFront();

  hoveredSeries.segments.each(function(segment) {
    segment.setState("hover");
  })

  chart.series.each(function(series) {
    if (series != hoveredSeries) {
      series.segments.each(function(segment) {
        segment.setState("dimmed");
      })
      series.bulletsContainer.setState("dimmed");
    }
  });
}

function processOut(hoveredSeries) {
  chart.series.each(function(series) {
    series.segments.each(function(segment) {
      segment.setState("default");
    })
    series.bulletsContainer.setState("default");
  });
}
