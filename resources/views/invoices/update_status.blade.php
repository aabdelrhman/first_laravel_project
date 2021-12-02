@extends('layouts.master')
@section('title')
حالة الفاتورة
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تغيير الحالة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                        @if (isset($invoice))
                    <form action="{{ Route('update_status' , $invoice -> id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="invoice_number">رقم الفاتورة</label>
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="text" name="invoice_number" id="" value="{{ $invoice -> invoice_number }}" class="form-control" disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="invoice_Date">تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ $invoice -> invoice_Date }}"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="Due_date">تاريخ الأستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ $invoice -> Due_date }}"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="product">اسم المنتج</label>
                                <input type="text" name="product" id="" value="{{ $invoice -> product }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="section">اسم القسم</label>
                                <input type="text" name="section" id="" value="{{ $invoice -> section -> section_name }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="Amount_collection">مبلغ التحصيل</label>
                                <input type="text" name="Amount_collection" id="" value="{{ $invoice -> Amount_collection }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="Amount_Commission">مبلغ العمولة</label>
                                <input type="text" name="Amount_Commission" id="" value="{{ $invoice -> Amount_Commission }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="Discount">الخصم</label>
                                <input type="text" name="Discount" id="" value="{{ $invoice -> Discount }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="Value_VAT">نسبة ضريبة القيمة المضافة</label>
                                <input type="text" name="Value_VAT" id="" value="{{ $invoice -> Value_VAT }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="Rate_VAT">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" name="Rate_VAT" id="" value="{{ $invoice -> Rate_VAT }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="Total">الاجمالي شامل الضريبة</label>
                                <input type="text" name="Total" id="Total" value="{{ $invoice -> Total }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="Status">الحالة</label>
                                <input type="text" name="Status" id="" value="{{ $invoice -> Status }}" class="form-control"  disabled readonly>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label for="note">ملاحظات</label>
                                <textarea name="note" id="" cols="30" rows="10" class="form-control"  disabled readonly>{{ $invoice -> note }}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 form-group">
                                <label for="Status">الحالة</label>
                                <select name="new_status" id="" class="form-control">
                                    <option selected value="" disabled> اختر حالة الدفع</option>
                                    <option value="1">مدفوعة</option>
                                    <option value="3">مدفوع جزئي</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 form-group">
                                <label for="Status">تاريخ الدفع</label>
                                <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 form-group hide_section" style="display: none;">
                                <label for="">المبلغ المدفوع</label>
                                <input type="text" class="form-control" id="paid" value="" name="paid"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 form-group hide_section"  style="display: none;">
                                <label for="Status">المبلغ المتبقي</label>
                                <input type="text" class="form-control" id="remaining" value="" name="remaining" readonly>
                            </div>
                            <div class="form-group mx-auto">
                                @if ($invoice -> Value_Status == 1)
                                    <input type="submit" value="تم الدفع" class="btn btn-info" disabled>
                                @else
                                    <input type="submit" value="تحديث" class="btn btn-info">
                                @endif
                            </div>
                        </div>
                        @endif
                    </form>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
    <script>
        $(document).ready(function() {
            $('select[name="new_status"]').on('change', function() {
                if( $('select[name="new_status"]').val() == 3){
                    $('.hide_section').show();
                }
                else{
                    $('.hide_section').hide();
                }
                    $("#paid").keyup(function(){
                        $total = $('#Total').val();
                        $paid = $('#paid').val();
                        $remining = Number($total - $paid);
                        $('#remaining').val($remining);
                    });
            });
        })
    </script>
@endsection
