@extends('dashboard.layouts.app')

@section('section', $sectionName)

@section('styles')
    {{-- Bootstrap file input --}}
    <link href="{{ asset('/dashboard_assets/libs/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>

    {{-- Bootstrap Switch --}}
    <link href="{{ asset('/dashboard_assets/libs/bootstrap-switch/css/bootstrap-switch' . getRtlDirection() . '.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection


@section('content')


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
    <div>

        <a href="{{ route('dashboard.orders.destroy',  $order) }}"
            class="d-sm-inline-block btn btn-sm btn-danger shadow-sm mr-1" data-toggle="modal"
            data-target="#deleteModel-{{ $order->id }}" title="@lang('main.delete')">
            <i class="fas fa-trash fa-sm text-white-50"></i>
            @lang('main.delete')
        </a>

        <a href="{{ route('dashboard.orders.index') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user-tie fa-sm text-white-50"></i>
            @lang('main.show_all') @lang('main.orders')
        </a>

        @component('dashboard.components.deleteModelForm')
            @slot('id', $order->id )
            @slot('deleteTitle', trans('main.order') . ' ' . $order->cards->name)
            @slot('url', route('dashboard.orders.destroy', $order->id) )
        @endcomponent

    </div>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-1 col-md-1"></div>
    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
        <div class="card border-left-success">
            <div class="card-body">
                <div class="card-text">
                    <div class="row">

                        {{-- Name --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.name'): </span>

                                <span class="text-muted">{{ $order->users->full_name }}</span>
                            </div>
                            <hr>
                        </div>

                        
                        {{-- Email --}}
                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.email'): </span>

                                <span class="text-muted">{{ $order->users->email }}</span>
                            </div>
                            <hr>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="h6">
                                <span class="font-weight-bold">@lang('main.phone'): </span>

                                <span class="text-muted">{{ $order->users->phone }}</span>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12 col-sm-12  mb-3">
        <div class="card border-left-info">
            <div class="card-body">
                <h5 class="card-title"><strong>@lang('main.cards'): </strong></h5>
 
 <p class="card-text">
  <h6 class="card-title"> @lang('main.name'):   {{ $order->cards->name_by_lang }}</strong></h6>
 </p>

 <p class="card-text">
<h6 class="card-title"> @lang('main.price'):  {{ $order->cards->price }} </h6>
</p>

<p class="card-text">
    <h6 class="card-title">@lang('main.date'):  {{ $order->cards->date_to }} </h6>
</p>


<p class="card-text">
    <h6 class="card-title">@lang('main.limitations'): @lang('main.'.$order->cards->limitations) </h6>
</p>


<p class="card-text">
    <h6 class="card-title">@lang('main.frequency'): 
          
        @if ($order->cards->frequency == 'unlimited')

                 @lang('main.unlimited') 
        @else
        {{ $order->cards->frequency }}   
        @endif
        
        
        </h6>
</p>



            </div>
        </div>
    </div>



    <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
        <div class="card border-left-info">
            <div class="card-body">
                <h5 class="card-title"><strong>@lang('main.usage_details'): </strong></h5>
          
                <p class="card-text">
                    <h6 class="card-title"> @lang('main.frequency_availability'): 
                        
                        @if ($order->card_limit =='unlimited')

                        @lang('main.'.$order->card_limit)
                 @else
                 {{$order->card_limit}}
                 @endif
                    
                    </strong></h6>
                   </p>

 <p class="card-text">
  <h6 class="card-title"> @lang('main.date_of_last_use'):  {{$order->date_of_used}} </strong></h6>
    </p>


               

            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="card border-left-info">
            <div class="card-body">
                <h5 class="card-title"><strong>@lang('main.status'): </strong></h5>
          
    <form action="{{ route('dashboard.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')     
                <div class="form-group mb-4 row">
                    <label class="col-sm-2 col-form-label" for="status"> </label>
                    <div class="col-sm-10">
                    <input type="hidden" name="id" value="{{$order->id}}">
                        <input type="hidden" name="status" value="disable">
                        
                        <input type="checkbox" id="status" name="status" class="switch"  
                            data-on-color="success" 
                            data-off-color="danger" 
                            data-on-text="@lang('main.active')" 
                            data-off-text="@lang('main.disable')" 
                            value="active"
                            {{ $order->status === 'active' ? 'checked' : '' }}
                            >
                            
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-info">@lang('main.edit') @lang('main.order')</button>
        </div>
    </div>
</form>

            </div>
        </div>
    </div>


  

</div>


@endsection


@section('scripts')
    {{-- Bootstrap file input --}}
    <script src="{{ asset('/dashboard_assets/libs/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    {{-- Bootstrap Switch --}}
    <script src="{{ asset('/dashboard_assets/libs/bootstrap-switch/js/bootstrap-switch.js') }}" type="text/javascript"></script>
@endsection