Hello,

{{ $input['firstName'] }} {{ $input['lastName'] }} send you the following message:

{{ $input['comment'] }}

Email: {{ $input['email'] }}
@if(isset($input['phone']))
Phone: {{ $input['phone'] }}
@endif
