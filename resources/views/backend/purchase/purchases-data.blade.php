<div class="table-responsive">
    <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
        <thead>
        <tr class="bg-secondary text-white">
            <th>{{__('pages.sl')}}</th>
            <th>{{__('pages.invoice_id')}}</th>
            <th>{{__('pages.date')}}</th>
            @if (Auth::user()->can('access_to_all_branch'))
                <th>{{__('pages.branch')}}</th>
            @endif
            <th>{{__('pages.supplier')}}</th>
            <th>{{__('pages.total_amount')}}</th>
            <th>{{__('pages.paid_amount')}}</th>
            <th>{{__('pages.due_amount')}}</th>
            <th width="8%">{{__('pages.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($purchases as $key => $purchase)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$purchase->invoice_id}}</td>
                <td>{{$purchase->purchase_date->format(get_option('app_date_format'))}}</td>
                @if (Auth::user()->can('access_to_all_branch'))
                    <td>
                        {{$purchase->branch->title}}
                    </td>
                @endif
                <td>{{$purchase->supplier->company_name}}</td>
                <td> {{get_option('app_currency')}}{{number_format($purchase->total_amount, 2)}} </td>
                <td> {{get_option('app_currency')}}{{number_format($purchase->paid_amount, 2)}} </td>
                <td> {{get_option('app_currency')}}{{number_format($purchase->due_amount, 2)}} </td>
                <td class="font-14">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="{{route('purchase.edit', [$purchase->id])}}" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                        <a href="{{route('purchase.show', [$purchase->id])}}" class="mr-2"><i class="fa fa-eye text-primary"></i> </a>
                        <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                        <form action="{{ route('purchase.destroy',$purchase->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$purchases->links()}}
</div>