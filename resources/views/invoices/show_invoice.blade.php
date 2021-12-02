@extends('layouts.master')
@section('title')
عرض الفاتورة
@endsection
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<!---Internal Fancy uploader css-->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
@if (Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif
                    <div class="panel panel-primary tabs-style-2">
                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line">
                                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">Tab 01</a></li>
                                    <li><a href="#tab5" class="nav-link" data-toggle="tab">Tab 02</a></li>
                                    <li><a href="#tab6" class="nav-link" data-toggle="tab">Tab 03</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab4">
                                    <form action="" method="post">
                                        @csrf
                                        @if (isset($invoices))
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="invoice_number">رقم الفاتورة</label>
                                                <input type="text" name="invoice_number" id="" value="{{ $invoices -> invoice_number }}" class="form-control" disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="invoice_Date">تاريخ الفاتورة</label>
                                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                                type="text" value="{{ $invoices -> invoice_Date }}"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="Due_date">تاريخ الأستحقاق</label>
                                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                                type="text" value="{{ $invoices -> Due_date }}"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="product">اسم المنتج</label>
                                                <input type="text" name="product" id="" value="{{ $invoices -> product }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="section">اسم القسم</label>
                                                <input type="text" name="section" id="" value="{{ $invoices -> section -> section_name }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="Amount_collection">مبلغ التحصيل</label>
                                                <input type="text" name="Amount_collection" id="" value="{{ $invoices -> Amount_collection }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="Amount_Commission">مبلغ العمولة</label>
                                                <input type="text" name="Amount_Commission" id="" value="{{ $invoices -> Amount_Commission }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="Discount">الخصم</label>
                                                <input type="text" name="Discount" id="" value="{{ $invoices -> Discount }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="Value_VAT">نسبة ضريبة القيمة المضافة</label>
                                                <input type="text" name="Value_VAT" id="" value="{{ $invoices -> Value_VAT }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="Rate_VAT">قيمة ضريبة القيمة المضافة</label>
                                                <input type="text" name="Rate_VAT" id="" value="{{ $invoices -> Rate_VAT }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="Total">الاجمالي شامل الضريبة</label>
                                                <input type="text" name="Total" id="" value="{{ $invoices -> Total }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="Status">الحالة</label>
                                                <input type="text" name="Status" id="" value="{{ $invoices -> Status }}" class="form-control"  disabled readonly>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                                <label for="note">ملاحظات</label>
                                                <textarea name="note" id="" cols="30" rows="10" class="form-control"  disabled readonly>{{ $invoices -> note }}</textarea>
                                            </div>
                                        </div>
                                        @endif
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab5">
                                    @if (isset($invoices -> details) && $invoices -> details -> count() > 0)
                                    <div class="col-xl-12">
                                        <div class="card w-100">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">تفاصيل الفاتورة</h4>
                                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                                </div>

                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>رقم الفاتورة</th>
                                                                <th>نوع المنتج</th>
                                                                <th>القسم</th>
                                                                <th>حالة الدفع</th>
                                                                <th>تاريخ الدفع </th>
                                                                <th>المبلغ المدفوع</th>
                                                                <th>المبلغ المتبقي</th>
                                                                <th>ملاحظات</th>
                                                                <th>تاريخ الاضافة </th>
                                                                <th>المستخدم</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $index = 1 ; ?>
                                                            @foreach ($invoices -> details as $detail)
                                                                <tr>
                                                                    <td>{{ $index++ }}</td>
                                                                    <td>{{ $detail -> invoice_number}}</td>
                                                                    <td>{{ $detail -> product }}</td>
                                                                    <td>{{ $invoices -> section -> section_name }}</td>
                                                                    <td>{{ $detail -> status}}</td>
                                                                    <td>{{ $detail -> Payment_Date}}</td>
                                                                    <td>{{ $detail -> amount_paid}}</td>
                                                                    <td>{{ $detail -> remaining_amout}}</td>
                                                                    <td>{{ $detail -> note}}</td>
                                                                    <td>{{ $detail -> created_at}}</td>
                                                                    <td>{{ $detail -> user}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div><!-- bd -->
                                            </div><!-- bd -->
                                        </div><!-- bd -->
                                    </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="tab6">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">ملحقات الفاتورة</h4>
                                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0 text-md-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <tr class="text-dark">
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">اسم الملف</th>
                                                                    <th scope="col">قام بالاضافة</th>
                                                                    <th scope="col">تاريخ الاضافة</th>
                                                                    <th scope="col">العمليات</th>
                                                                </tr>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (isset($invoices -> attachment) && $invoices -> attachment ->count() > 0)
                                                                <?php $index = 1 ; ?>
                                                                @foreach ($invoices -> attachment as $attachment)
                                                                    <tr>
                                                                        <td>{{ $index++ }}</td>
                                                                        <td>{{ $attachment ->  file_name}}</td>
                                                                        <td>{{ $attachment -> created_by}}</td>
                                                                        <td>{{ $attachment -> created_at}}</td>
                                                                        <td>
                                                                            <a class="btn btn-outline-success btn-sm"
                                                                            href="{{ url('show_file') }}/{{ $attachment->file_name }}"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            عرض</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ url('download') }}/{{ $attachment->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>
                                                                            @can('حذف المرفق')
                                                                                <button class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-file_name="{{ $attachment->file_name }}"
                                                                                data-invoice_number="{{ $attachment->invoice_number }}"
                                                                                data-id_file="{{ $attachment->id }}"
                                                                                data-target="#delete_file">حذف</button>
                                                                            @endcan
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    <form action="{{ Route('invoice_attachment.store') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @can('اضافة مرفق')
                                                             <label for="">أضافة ملحق</label>
                                                            <div>
                                                                <input type="hidden" name="invoice_number" value="{{ $invoices -> invoice_number }}">
                                                                <input type="hidden" name="invoice_id" value="{{ $invoices -> id }}">
                                                                <input type="file" name="file" class="dropify" data-height="200">
                                                                <input type="submit" value="أضافة" class="btn btn-info btn-block">
                                                            </div>
                                                        @endcan
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <form action="{{ Route('invoice_attachment.destroy') }}" method="post">

            @csrf
            <div class="modal-body">
                <p class="text-center">
                <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                </p>

                <input type="hidden" name="id_file" id="id_file" value="">
                <input type="hidden" name="file_name" id="file_name" value="">
                <input type="hidden" name="invoice_number" id="invoice_number" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
            </div>
        </form>
    </div>
</div>
</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!--Internal Fancy uploader js-->
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<!--Internal  Form-elements js-->
<script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!--Internal Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<!-- Internal TelephoneInput js-->
<script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)

        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })

</script>
@endsection
