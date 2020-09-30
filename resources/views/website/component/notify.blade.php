@php
    $response = session("response");
@endphp

@if(isset($response['status']))
@if ($response["status"] == 1)
<script>
    success("{{ $response['message_en'] }}");
</script>
@else 
<script>
    error("{{ $response['message_en'] }}");
</script>
@endif
@endif
 
@php
   session(["response" => null]);
@endphp