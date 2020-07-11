<table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
    <thead>
    <tr class="bg-secondary text-white">
        <th>{{__('pages.sl')}}</th>
        <th>{{__('pages.requisition_id')}}</th>
        <th> {{__('pages.from')}}</th>
        <th> {{__('pages.to')}}</th>
        <th>{{__('pages.created_date')}}</th>
        <th width="10%">{{__('pages.status')}}</th>
        <th width="8%">{{__('pages.action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requisitions as $key => $requisition)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$requisition->requisition_id}}</td>
            <td>{{$requisition->requisitionFrom->title}}</td>
            <td>{{$requisition->requisitionTo->title}}</td>
            <td>
                {{$requisition->requisition_date->format(get_option('app_date_format'))}}
            </td>
            <td>
                @if($requisition->status == 0)
                    <label class="btn btn-warning btn-sm btn-block"><b>Pending</b></label>
                @elseif($requisition->status == 1)
                    <label class="btn btn-info btn-sm btn-block"><b>Delivered</b></label>
                @elseif($requisition->status == 2)
                    <label class="btn btn-success btn-sm btn-block"><b>Complete</b></label>
                @elseif($requisition->status == 3)
                    <label class="btn btn-danger btn-sm btn-block"><b>Rejected</b></label>
                @else
                    <label class="btn btn-danger btn-sm btn-block"><b>Canceled</b></label>
                @endif
            </td>
            <td>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a href="{{route('requisition.show', [$requisition->id])}}" class="btn btn-secondary rounded-0"><i class="fa fa-eye"></i> </a>
                    @if($requisition->requisition_from == auth()->user()->employee->branch_id && $requisition->status == 0)
                        <a href="{{route('requisition.edit', [$requisition->id])}}" class="btn btn-primary rounded-0"><i class="fa fa-edit"></i> {{$requisition->sttaus}} </a>
                        <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        <form action="{{ route('requisition.destroy',$requisition->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>