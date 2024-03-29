@extends('admin.index')
@section('content')
@push('js')
    <script type="text/javascript">
      $(document).ready(function () {

        @if($states->country_id)

        $.ajax({
                url:'{{ aurl('states/create') }}',
                type:'get',
                dataType:'html',
                data:{country_id:'{{ $states->country_id }}', select:'{{ $states->city_id }}'},
                success: function(data)
                {
                  $('.city').html(data);
                }
            });

        @endif

        $(document).on('change', '.country_id', function () {
          var country = $('.country_id option:selected').val();
          if(country > 0 )
          {
            $.ajax({
                url:'{{ aurl('states/create') }}',
                type:'get',
                dataType:'html',
                data:{country_id:country,select:''},
                success: function(data) {
                  $('.city').html(data);
                }
            });
          }else {
            $('.city').html('');
          }
        });
      });
    </script>
@endpush
<div class="box">
    <div class="box-header">
      <h3 class="box-title">{{$title}}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['route' => ['states.update',$states->id], 'method' => 'put',]) !!}
        <div class="form-group">
          {!! Form::label('state_name_ar', trans('admin.state_name_ar')) !!}
          {!! Form::text('state_name_ar', $states->state_name_ar,  ['class' => 'form-control'])!!}
      </div>
      <div class="form-group">
              {!! Form::label('state_name_en', trans('admin.state_name_en')) !!}
              {!! Form::text('state_name_en', $states->state_name_en,  ['class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!! Form::label('country_id', trans('admin.country_id')) !!}
        {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'), 'id'), $states->country_id,  ['class' => 'form-control country_id', 'placeholder' => '............'])!!}
      </div>

      <div class="form-group">
        {!! Form::label('city_id', trans('admin.city_id')) !!}
        <span class="city"></span>
      </div>
        
            {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary'])!!}
        {!! Form::close()!!}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection