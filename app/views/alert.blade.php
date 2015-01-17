@if (Session::get('message'))
<div class="alert alert-info">
	{{ Session::get('message') }}
</div>
@endif
@if (Session::get('error'))
<div class="alert alert-danger">
	{{ Session::get('error') }}
</div>
@endif