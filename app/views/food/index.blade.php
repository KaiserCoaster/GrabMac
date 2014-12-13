@extends('layouts.default')

@section('top-css')

	<!-- DataTables CSS -->
    <link href="/public/assets/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

@stop()

@section('content')

			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Food</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					
					<div class="panel panel-default">
					
							
						<div class="panel-heading">
                        	Food
                    	</div>

						<div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Calories</th>
                                        <th>Gluten Free</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($food as $foo)
										
										<tr>
											<td>{{ $foo->id }}</td>
	                                		<td>{{{ $foo->name }}}</td>
	                                		<td>{{{ $foo->calories }}}</td>
	                                		<td>{{ Food::printGlutenFree($foo->glutenFree) }}</td>
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