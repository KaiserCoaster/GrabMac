&lt;?xml version="1.0" ?&gt;

<GrabMac>
	
	<restaurants>
		@foreach($restaurants as $rest)
			
			<restaurant id="{{ $rest->id }}">
				<address street="{{ $rest->address }}" city="{{ $rest->city }}" state="{{ $rest->stateO->abbr }}" zip="{{ $rest->zip }}" />
			</restaurant>
		@endforeach
	</restaurants>
	
	<food-items>
		@foreach($food as $f)
			<food-item id="{{ $f->id }}">
				<name>{{ $f->name }}</name>
			</food-item>
		@endforeach
	</food-items>
	
	<visits>
		@foreach($visits as $v)
			<visit>
				<date>{{ date("n/j/y", $v->time) }}</date>
				<time>{{ date("g:ia", $v->time) }}</time>
				<visitor-id>{{ $v->userID }}</visitor-id>
				<restaurant-id>{{ $v->restaurantID }}</restaurant-id>
			</visit>
		@endforeach
	</visits>
	
	<visitors>
		@foreach($visitors as $vs)
			<visitor id="{{ $vs->id }}">
				<name>{{ $vs->firstName }} {{ $vs->lastName }}</name>
				<address street="{{ $vs->address }}" city="{{ $vs->city }}" state="{{ $vs->stateO->abbr }}" zip="{{ $vs->zip }}" />
			</visitor>
		@endforeach
	</visitors>
	
</GrabMac>