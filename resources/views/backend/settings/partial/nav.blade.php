<div class="btn-group btn-group-justified nav-buttons" role="group" aria-label="Basic example">
    <a href="{{route('general-settings')}}" class="btn btn-outline-primary {{ active_if_full_match('settings/general') }}"><i class="fas fa-store-alt"></i> {{__('pages.general_settings')}}</a>
    <a href="{{route('currency-settings')}}" class="btn btn-outline-primary {{ active_if_full_match('settings/currency') }}"><i class="fas fa-money-bill-alt"></i>{{__('pages.currency')}}  </a>
    <a href="{{route('prefix-settings')}}" class="btn btn-outline-primary {{ active_if_full_match('settings/prefix') }}"><i class="fab fa-autoprefixer"></i> {{__('pages.prefix')}} </a>
</div>