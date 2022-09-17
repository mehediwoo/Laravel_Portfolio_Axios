@extends('layout.app')
@section('title','Visitor')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 p-5">
            <table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">NO</th>
                    <th class="th-sm">IP</th>
                    <th class="th-sm">Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitor as $key=>$iteam)
                    <tr>
                        <th class="th-sm">{{ $key+1 }}</th>
                        <th class="th-sm">{{ $iteam->ip_address }}</th>
                        <th class="th-sm">{{ $iteam->visite_time }}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#VisitorDt').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');
    });
</script>

@endsection
