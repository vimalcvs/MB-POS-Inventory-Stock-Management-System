<header class="clearfix">
    <div class="header-company-info-sell-invoice">
        <h2 class="name">{{get_option('app_name')}}</h2>
        <div>{{get_option('address')}}</div>
        <div>{{__('pages.vat_reg_number')}} :{{get_option('vat_reg_no')}}</div>
        <div>{{__('pages.phone')}}: {{get_option('phone')}}</div>
        <div>{{__('pages.outlet')}}: {{auth()->user()->employee->branch->title}}</div>
    </div>
</header>
