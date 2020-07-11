<div class="dropdown show float-right">
    <a class="btn btn-secondary dropdown-toggle text-right btn-outline-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{__('pages.last')}}  @if(isset($days)) {{$days}} @else ** @endif {{__('pages.days')}}
    </a>

    <div class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="{{url('report/sell/statistics/last/7/days')}}">{{__('pages.last')}} 7 {{__('pages.days')}}</a>
        <a class="dropdown-item" href="{{url('report/sell/statistics/last/15/days')}}">{{__('pages.last')}} 15  {{__('pages.days')}}</a>
        <a class="dropdown-item" href="{{url('report/sell/statistics/last/30/days')}}">{{__('pages.last')}} 30  {{__('pages.days')}}</a>
        <a class="dropdown-item" href="{{url('report/sell/statistics/last/45/days')}}">{{__('pages.last')}} 45  {{__('pages.days')}}</a>
        <a class="dropdown-item" href="{{url('report/sell/statistics/last/60/days')}}">{{__('pages.last')}} 60  {{__('pages.days')}}</a>
    </div>
</div>
