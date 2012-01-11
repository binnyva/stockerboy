<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery-ui.css" />
<script type="text/javascript" src="<?= base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/exporting.js"></script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'chart',
         defaultSeriesType: 'line',
         marginRight: 130,
         marginBottom: 25
      },
      title: {
         text: 'Sales',
         x: -20 //center
      },
      xAxis: {
         categories: [
