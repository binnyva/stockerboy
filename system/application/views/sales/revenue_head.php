]
      }]
   });
   
   
});
</script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'graph',
         defaultSeriesType: 'line',
         marginRight: 130,
         marginBottom: 25
      },
      title: {
         text: 'Revenue',
         x: -20 //center
      },
      xAxis: {
         categories: [