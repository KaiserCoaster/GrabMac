@extends('layouts.default')

@section('top-css')

	<!-- DataTables CSS -->
    <link href="/public/assets/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

@stop()

@section('content')

			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Restaurants</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
	                
	                
	                <div class="panel panel-default">
					
							
						<div class="panel-heading">
                        	Restaurants
                    	</div>

						<div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-restaurants">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Zip</th>
                                        <th>State</th>
                                        <th>Sells Mac</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($restaurants as $restaurant)
											
										<tr>
											<td>{{ $restaurant->id }}</td>
	                                		<td><a href="{{ URL::to('restaurant/' . $restaurant->id) }}">{{{ $restaurant->name }}}</a></td>
	                                		<td>{{{ $restaurant->address }}}</td>
	                                		<td>{{{ $restaurant->city }}}</td>
	                                		<td>{{ $restaurant->zip }}</td>
	                                		<td>{{{ $restaurant->stateO->abbr }}}</td>
	                                		<td>{{ Restaurant::printSellsMac($restaurant->sellsMac) }}</td>
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
        $('#dataTables-restaurants').dataTable();
    });
    </script>

@stop()