@extends('main')

@section('title', 'Contact')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				
				<h2>Contact Intermak</h2>

				<form action="{{ url('contact') }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label name="email">Email:</label>
						<input id="email" name="email" class="form-control">
					</div>

					<div class="form-group">
						<label name="subject">Subject:</label>
						<input id="subject" name="subject" class="form-control">
					</div>

					<div class="form-group">
						<label name="message">Message:</label>
						<textarea id="message" name="message" class="form-control">Type Your Message Here...</textarea>
					</div>

					<input type="submit" value="Send Message" class="btn btn-success">
				</form>

			</div>

			<div class="col-md-6">
			</div>
		</div>
	</div>

@stop