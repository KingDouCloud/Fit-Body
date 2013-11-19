/********* Javascript Generated with phpChart **********/ 
var _plot1_plot_properties;
$(document).ready(function()
{ 
	setTimeout( 
		function() 
		{ 
			_plot1_plot_properties = 
			{
			  "legend":
			  {"show":true},
			  "series":
			  [
				{"label":"lions"},
				{"label":"tigers"},
				{"label":"bears"}
			  ]
			}
			$.jqplot.config.enablePlugins = true;
			$.jqplot.config.defaultHeight = 300;
			$.jqplot.config.defaultWidth  = 400;
			 _plot1= $.jqplot(
				"plot1", 
				[
					[2,3,1,4,3,2.5],
					[1,4,3,2,5,3.1],
					[7,9,11,6,8]
				],
				_plot1_plot_properties
			);
		},
		200 
	);
});