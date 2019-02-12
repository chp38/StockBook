import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

/**
 * Ibitialize the chart if the correct element with id exists
 * @type {HTMLElement}
 */
var ctx = document.getElementById("chartdiv");

if(ctx != null) {
  var id = ctx.getAttribute('currency-pair');

  getChartData(id);
}

/**
 * Get the chart data through Ajax
 * @param pairId
 */
function getChartData(pairId) {
  $.ajax({
    url: "/api/currency/pairs/prices/"+pairId,
    success: function (result) {
      var data = [];
      data = result.prices;
      renderChart(data);
    },
    error: function (err) {
      //$("#loadingMessage").html("Error");
    }
  });
}

function renderChart(data)
{
  am4core.useTheme(am4themes_animated);
  var chart          = am4core.create("chartdiv", am4charts.XYChart);
  chart.paddingRight = 20;

  chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm:ss";
  chart.dateFormatter.dateFormat = "yyyy-MM-dd HH:mm:ss";
  chart.durationFormatter.durationFormat = 'yyyy-MM-dd HH:mm:ss';

  var dateAxis                             = chart.xAxes.push(new am4charts.DateAxis());
  dateAxis.renderer.grid.template.location = 0;
  dateAxis.dateFormats.setKey("day", "yyyy-MM-dd HH:mm:ss");
  dateAxis.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm:ss";
  dateAxis.dateFormatter.dateFormat = "yyyy-MM-dd HH:mm:ss";

  dateAxis.baseInterval = {
    "timeUnit": "minute",
    "count": 5
  };

  var valueAxis              = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.tooltip.disabled = true;

  var series                   = chart.series.push(new am4charts.CandlestickSeries());
  series.dataFields.dateX      = "date";
  series.dataFields.valueY     = "close";
  series.dataFields.openValueY = "open";
  series.dataFields.lowValueY  = "low";
  series.dataFields.highValueY = "high";
  series.dataFields.minPeriod = "mm";
  series.simplifiedProcessing  = true;
  series.tooltipText           = "Open:${openValueY.value}\nLow:${lowValueY.value}\nHigh:${highValueY.value}\nClose:${valueY.value}";

  chart.cursor = new am4charts.XYCursor();

  // a separate series for scrollbar
  var lineSeries                             = chart.series.push(new am4charts.LineSeries());
  lineSeries.dataFields.dateX                = "date";
  lineSeries.dataFields.valueY               = "close";
  // need to set on default state, as initially series is "show"
  lineSeries.defaultState.properties.visible = false;

  // hide from legend too (in case there is one)
  lineSeries.hiddenInLegend = true;
  lineSeries.fillOpacity    = 0.5;
  lineSeries.strokeOpacity  = 0.5;

  // Scroll bar not great - need a better solution in the end
  /*var scrollbarX = new am4charts.XYChartScrollbar();
  scrollbarX.series.push(lineSeries);
  chart.scrollbarX = scrollbarX;*/

  chart.data = data;
}