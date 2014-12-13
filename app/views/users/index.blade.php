@extends('layouts.default')

@section('top-css')

	<!-- DataTables CSS -->
    <link href="/public/assets/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

@stop()

@section('content')

			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					
					<div class="panel panel-default">
					
							
						<div class="panel-heading">
                        	Users
                    	</div>

						<div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Zip</th>
                                        <th>State</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
										
										<tr>
											<td>{{ $user->id }}</td>
	                                		<td>{{{ $user->username }}}</td>
	                                		<td>{{{ $user->firstName }}}</td>
	                                		<td>{{{ $user->lastName }}}</td>
	                                		<td>{{{ $user->address }}}</td>
	                                		<td>{{{ $user->city }}}</td>
	                                		<td>{{ $user->zip }}</td>
	                                		<td>{{{ $user->stateO->abbr }}}</td>
	                                		<td>{{ $user->latitude }}</td>
	                                		<td>{{ $user->longitude }}</td>
	                                		<td>{{ User::printGender($user->gender) }}</td>
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