@extends('layouts.default')

@section('top-css')

	<!-- DataTables CSS -->
    <link href="/public/assets/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

@stop()

@section('content')

			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{{ $restaurant->name }}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3">
	                
	                
	                <div class="panel panel-default">
					
							
						<div class="panel-heading">
                        	Restaurant Info
                    	</div>
                    	
                    	<div class="panel-body">
	                    	{{{ $restaurant->address }}}<br />
	                    	{{{ $restaurant->city }}}, {{{ $restaurant->stateO->abbr }}} {{ $restaurant->zip }}<br />
	                    	<br />
							Sells Mac? {{ Restaurant::printSellsMac($restaurant->sellsMac) }}
                    	</div>
					</div>
                </div>
                <div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mac & Cheese vs Other Food Sold
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart-mac-other"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mac & Cheese Breakdown
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart-mac-breakdown"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                
                <div class="col-lg-6">
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        Top Eaters at {{{ $restaurant->name }}}
	                    </div>
	                    <!-- /.panel-heading -->
	                    <div class="panel-body">
	                        <div class="table-responsive">
	                            <table class="table">
	                                <thead>
	                                    <tr>
	                                        <th>Name</th>
	                                        <th>State</th>
	                                        <th>Visits</th>
	                                    </tr> 
	                                </thead>
	                                <tbody>
		                                @foreach($topEaters as $topEater)
	                                    <tr>
	                                        <td>{{{ $topEater->firstName }}} {{{ $topEater->lastName }}}</td>
	                                        <td>{{{ $topEater->stateName }}}</td>
	                                        <td>{{{ $topEater->num }}}</td>
	                                    </tr>
										@endforeach
	                                </tbody>
	                            </table>
	                        </div>
	                        <!-- /.table-responsive -->
	                    </div>
	                    <!-- /.panel-body -->
	                </div>
	                <!-- /.panel -->
	            </div>
                
                <div class="col-lg-6">
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        Top Mac and Cheese Eaters at {{{ $restaurant->name }}}
	                    </div>
	                    <!-- /.panel-heading -->
	                    <div class="panel-body">
	                        <div class="table-responsive">
	                            <table class="table">
	                                <thead>
	                                    <tr>
	                                        <th>Name</th>
	                                        <th>State</th>
	                                        <th>Visits</th>
	                                    </tr> 
	                                </thead>
	                                <tbody>
		                                @foreach($topMacEaters as $topMacEater)
	                                    <tr>
	                                        <td>{{{ $topMacEater->firstName }}} {{{ $topMacEater->lastName }}}</td>
	                                        <td>{{{ $topMacEater->stateName }}}</td>
	                                        <td>{{{ $topMacEater->num }}}</td>
	                                    </tr>
										@endforeach
	                                </tbody>
	                            </table>
	                        </div>
	                        <!-- /.table-responsive -->
	                    </div>
	                    <!-- /.panel-body -->
	                </div>
	                <!-- /.panel -->
	            </div>
            </div>
                    
@stop()

@section('bottom-js')

	<!-- Flot Charts JavaScript -->
    <script src="/public/assets/js/plugins/flot/excanvas.min.js"></script>
    <script src="/public/assets/js/plugins/flot/jquery.flot.js"></script>
    <script src="/public/assets/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/public/assets/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/public/assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script type="text/javascript">
	    
	    //Flot Mac vs Other Pie Chart
		$(function() {
		
		    var data = [{
		        label: "Mac and Cheese ({{ $count_mac }})",
		        data: {{ $count_mac }}
		    }, {
		        label: "Other Food ({{ $count_other }})",
		        data: {{ $count_other }}
		    }];
		
		    var plotObj = $.plot($("#flot-pie-chart-mac-other"), data, {
		        series: {
		            pie: {
		                show: true
		            }
		        },
		        grid: {
		            hoverable: true
		        },
		        tooltip: true,
		        tooltipOpts: {
		            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
		            shifts: {
		                x: 20,
		                y: 0
		            },
		            defaultTheme: false
		        }
		    });
		
		});


		//Flot Mac breakdown Pie Chart
		$(function() {
		
		    var data = [{
		        label: "Regular Mac ({{ $regMac }})",
		        data: {{ $regMac }}
		    }, {
		        label: "Bacon Mac ({{ $baconMac }})",
		        data: {{ $baconMac }}
		    },{
		        label: "Lobster Mac ({{ $lobsterMac }})",
		        data: {{ $lobsterMac }}
		    },{
		        label: "Baked Mac ({{ $bakedMac }})",
		        data: {{ $bakedMac }}
		    },{
		        label: "Four Cheese Mac ({{ $fourMac }})",
		        data: {{ $fourMac }}
		    },{
		        label: "Fried Mac Balls ({{ $friedMac }})",
		        data: {{ $friedMac }}
		    }];
		
		    var plotObj = $.plot($("#flot-pie-chart-mac-breakdown"), data, {
		        series: {
		            pie: {
		                show: true
		            }
		        },
		        grid: {
		            hoverable: true
		        },
		        tooltip: true,
		        tooltipOpts: {
		            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
		            shifts: {
		                x: 20,
		                y: 0
		            },
		            defaultTheme: false
		        }
		    });
		
		});

		
	</script>

@stop()