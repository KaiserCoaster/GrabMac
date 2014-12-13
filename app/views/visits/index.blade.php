@extends('layouts.default')

@section('top-css')

	<!-- DataTables CSS -->
    <link href="/public/assets/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

@stop()

@section('content')

			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Visits</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					
					<div class="panel panel-default">
					
							
						<div class="panel-heading">
                        	Visits
                    	</div>

						<div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                                <thead>
                                    <tr>
                                        <th>Visitor Name</th>
                                        <th>Restaurant Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Which Mac</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($visits as $visit)
										<?php $visitor = $visit->visitor ?>
										<tr>
	                                		<td>{{{ $visitor->firstName . " " . $visitor->lastName }}}</td>
	                                		<td>{{{ $visit->restaurant->name }}}</td>
	                                		<td>{{ date("D F jS Y", $visit->time) }}</td>
	                                		<td>{{ date("g:ia", $visit->time) }}</td>
	                                		<td>
			                                	@if($visit->whichMac > 0)
		                                			{{ $visit->mac->name }}
		                                		@endif
	                                		</td>
										</tr>
	                                
	                                @endforeach
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
            </div>
                    
@stop()

@section('bottom-js')

	<!-- DataTables JavaScript -->
    <script src="/public/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/public/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>

	<script>
    $(document).ready(function() {
        $('#dataTables-users').dataTable();
    });
    </script>

@stop()