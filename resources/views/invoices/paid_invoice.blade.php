@extends('layouts.master')
@section('title')
@if ($Value_Status == 1)
    الفواتير المدفوعة
@elseif ($Value_Status == 2)
الفواتير الغير مدفوعة
@else
الفواتير المدفوعة جزئيا
@endif
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
@if (Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @if ($Value_Status == 1)
                                الفواتير المدفوعة
                            @elseif ($Value_Status == 2)
                            الفواتير الغير مدفوعة
                            @else
                            الفواتير المدفوعة جزئيا
                            @endif</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">@if ($Value_Status == 1)
                                        الفواتير المدفوعة
                                    @elseif ($Value_Status == 2)
                                    الفواتير الغير مدفوعة
                                    @else
                                    الفواتير المدفوعة جزئيا
                                    @endif </h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0"> رقم الفاتورة</th>
												<th class="border-bottom-0">تاربخ الفاتورة</th>
												<th class="border-bottom-0">تاربخ الاستحقاق</th>
												<th class="border-bottom-0">الحالة</th>
												<th class="border-bottom-0">الأجمالي</th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@if (isset($invoices) && $invoices->count() > 0)
                                        <?php $index = 1 ; ?>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $index++ }}</td>
                                                <td>{{ $invoice -> invoice_number }}</td>
                                                <td>{{ $invoice -> invoice_Date }}</td>
                                                <td>{{ $invoice -> Due_date }}</td>
                                                <td>{{ $invoice -> Status }}</td>
                                                <td>{{ $invoice -> Total }}</td>
                                                <td>
                                                    <a href="{{ route('invoices.show' , $invoice -> id ) }} " class="btn btn-info">معرفة المزيد</a>
                                                    @if ($invoice -> Value_Status != 1)
                                                    @can('تعديل الفاتورة')
                                                        <a href="{{ route('invoices.edit' , $invoice -> id ) }} " class="btn btn-info">تعديل الفاتورة</a>
                                                    @endcan
                                                    @can('تغير حالة الدفع')
                                                        <a href="{{ route('show_status' , $invoice -> id ) }} " class="btn btn-success"
                                                        >تعديل حالة الفاتورة</a>
                                                    @endcan
                                                    @else
                                                    @can('طباعةالفاتورة')
                                                        <a href="{{ route('print_invoice' , $invoice -> id ) }} " class="btn btn-info">طباعة الفاتورة</a>
                                                    @endcan

                                                    @endif
                                                    @can('حذف الفاتورة')
                                                        <button class="btn btn-danger"
                                                        data-toggle="modal"
                                                        data-invoice_id="{{ $invoice -> id }}"
                                                        data-target="#delete_file">حذف</button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        @endif
										</tbody>
									</table>
								</div><!-- bd -->
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

                <!-- delete -->
<div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('invoices/destroy') }}" method="post">
            @method('DELETE')
            @csrf
            <div class="modal-body">
                <p class="text-center">
                <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                </p>
                <input type="hidden" name="id" id="invoice_id" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })

</script>
@endsection
