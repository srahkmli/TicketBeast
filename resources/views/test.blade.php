
<h2>{{ $concert->title }}</h2>
<h2>{{ $concert->subtitle }}</h2>
{{-- <p>{{ $concert->date }}</p> --}}
<p>{{ $concert->formatted_date }}</p>
<p>Doors at {{ $concert->formatted_started_time }}</p>
<p>{{ $concert->formatted_ticketprice_in_dollors }}</p>
<p>{{ $concert->venue }}</p>
<p>{{ $concert->venue_address }}</p>
<p>{{ $concert->city }}, {{ $concert->state }} {{ $concert->zip }}</p>
<p>{{ $concert->additional_information }}</p>