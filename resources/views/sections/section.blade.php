@extends('layouts.master')
@section('title')
الأقسام
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الأعدادت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  الأقسام</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

               <!-- Modal add section -->
                <div class="modal" id="modaldemo8">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">أضافة قسم جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{ route('section.store') }}" method="POST" >
                                    @csrf
									<div class="form-group">
										<input type="text" name="section_name" class="form-control" id="inputName" placeholder="اسم القسم" >
									</div>
                                    <div class="col-lg">
										<textarea class="form-control" name="section_description" placeholder="وصف القسم" rows="3"></textarea>
									</div>
									<div class="form-group mb-0 mt-3 justify-content-end">
										<div>
											<button type="submit" class="btn btn-primary">أَضافة القسم</button>
											<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">ألغاء</button>
										</div>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal add section-->
                <!-- Modal edit section -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <form action="section/update" method="post" autocomplete="off">
                            @method('PATCH')
                               @csrf
                               <div class="form-group">
                                   <input type="hidden" name="id" id="id" value="">
                                   <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                                   <input class="form-control" name="section_name" id="section_name" type="text">
                               </div>
                               <div class="form-group">
                                   <label for="message-text" class="col-form-label">ملاحظات:</label>
                                   <textarea class="form-control" id="section_description" name="section_description"></textarea>
                               </div>
                       </div>
                       <div class="modal-footer">
                           <button type="submit" class="btn btn-primary">تاكيد</button>
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                       </div>
                       </form>
                   </div>
               </div>
           </div>
                <!-- End Modal edit section-->
                <!-- Modal delete section -->
                <div class="modal" id="modaldemo9">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                               type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="section/destroy" method="post">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                    <input type="hidden" name="id" id="id" value="">
                                    <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- End Modal delete section-->
                <div class="col-xl-12">
                    <div class="card">
                            <div class="col-sm-6 col-md-4 col-xl-2 mg-t-20 mg-xl-t-2">
                                @can('اضافة قسم')
                                    <a class="modal-effect btn btn-primary btn-block" data-effect="effect-newspaper" data-toggle="modal" href="#modaldemo8"> <i class="typcn typcn-document-add"></i> أضافة قسم</a>
                                @endcan

                            </div>
                        <div class="card-header pb-0">
                            @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('error') }}</strong>
                            </div>
                            @endif
                            @if(Session::has('success'))
                            <div class="alert alert-info" role="alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('success') }}</strong>
                            </div>
                            @endif
                            @error('section_name')
                            <div class="alert alert-danger" role="alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>هناك مشكلة في ادخال القسم حاول مرة اخرى</strong>
                            </div>
                            @enderror
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">الأقسام </h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم القسم</th>
                                            <th>الوصف</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($sections) && $sections->count() > 0)
                                        <?php $index = 1 ?>
                                            @foreach ($sections as $section )
                                                <tr>
                                                    <th scope="row">{{ $index }}</th>
                                                    <td>{{ $section -> section_name }}</td>
                                                    <td>{{ $section -> description }}</td>
                                                    <td>
                                                        @can('تعديل قسم')
                                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                            data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
                                                            data-description="{{ $section->description }}" data-toggle="modal" href="#exampleModal2"
                                                            title="تعديل"><i class="las la-pen"></i></a>
                                                        @endcan
                                                        @can('حذف قسم')
                                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                            data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}" data-toggle="modal"
                                                            href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                <?php $index++ ?>
                                            @endforeach
                                        @else

                                        @endif
                                    </tbody>
                                </table>
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var section_description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #section_description').val(section_description);
        })
</script>
<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
    })
</script>
@endsection



