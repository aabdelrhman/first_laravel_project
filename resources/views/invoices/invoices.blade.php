@extends('layouts.master')
@section('title')
الفواتير
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
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@if (Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة الفواتير</h4>
                                    <div class="col-sm-6 col-md-3">
                                        @can('اضافة فاتورة')
                                            <a href="{{ route('invoices.create') }}" class="btn btn-primary btn-block">أضافة فاتورة</a>
                                        @endcan
                                    </div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0"> رقم الفاتورة</th>
												<th class="border-bottom-0">تاربخ الفاتورة</th>
												<th class="border-bottom-0">تاربخ الاستحقاق</th>
												<th class="border-bottom-0">الحالة</th>
												{{-- <th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">الخصم</th> --}}
												{{-- <th class="border-bottom-0">نسبة الضربية</th>
												<th class="border-bottom-0">قيمة الضربية</th> --}}
												<th class="border-bottom-0">الأجمالي</th>
												{{-- <th class="border-bottom-0">الحالة</th> --}}
												{{-- <th class="border-bottom-0">تفاصيل</th> --}}
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
                                        @if (isset($invoices) && $invoices->count() > 0)
                                        <?php $index = 1 ; ?>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $invoice -> invoice_number }}</td>
                                                <td>{{ $invoice -> invoice_Date }}</td>
                                                <td>{{ $invoice -> Due_date }}</td>
                                                <td>{{ $invoice -> Status }}</td>
                                                {{-- <td>{{ $invoice -> product }}</td> --}}
                                                {{-- <td>{{ $invoice -> section -> section_name  }}</td>
                                                <td>{{ $invoice -> Discount }}</td>
                                                <td>{{ $invoice -> Rate_VAT }}</td>
                                                <td>{{ $invoice -> Value_VAT }}</td> --}}
                                                <td>{{ $invoice -> Total }}</td>
                                                {{-- <td>{{ $invoice -> Status }}</td> --}}
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
                                                    @endif
                                                    @can('حذف الفاتورة')
                                                         <button class="btn btn-danger"
                                                        data-toggle="modal"
                                                        data-invoice_id="{{ $invoice -> id }}"
                                                        data-target="#delete_file">حذف</button>
                                                    @endcan
                                                    @can('ارشفة الفاتورة')
                                                        <button class="btn btn-success"
                                                        data-toggle="modal"
                                                        data-id="{{ $invoice -> id }}"
                                                        data-target="#Archive_file">أرشفة</button>
                                                    @endcan
                                                </td>
                                            </tr>
                                            <?php $index++ ; ?>
                                        @endforeach
                                        @else
                                            {{-- <tr>لا يوجد فواتير في الوقت الحالي</tr> --}}
                                        @endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
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
                <h6 style="color:red"> هل انت متاكد من عملية حذف الفاتورة ؟</h6>
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

{{-- Archive --}}

<div class="modal fade" id="Archive_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">نقل الى الأرشيف</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('invoices/destroy') }}" method="post">
            @method('DELETE')
            @csrf
            <div class="modal-body">
                <p class="text-center">
                <h6 style="color:red"> هل انت متاكد من عملية الأرشفة ؟</h6>
                </p>
                <input type="text" name="id" id="invoice_id" value="">
                <input type="hidden" name="page_id" id="page_id" value="2">

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

    $('#Archive_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })

</script>
@endsection
