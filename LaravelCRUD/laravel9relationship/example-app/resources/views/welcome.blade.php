
@foreach ($datas as $data)
<div class="">
    
    <span>{{$data->user_id}}</span><br>
    <span>{{$data->user_name}}</span><br>
    <span>{{$data->user_phone}}</span>
    
</div>
@endforeach
