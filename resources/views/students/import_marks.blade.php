@extends("admin.admin_layout")
@section('content')

    <section id="input-style">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            <p>
                                الرئيسية/ علامات الطلاب
                            </p>
                            <div class="row">

                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        error <br>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li> {{ $error }} </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($message = Session::get('success'))
                                    <div class="alert alert-success alert">
                                        <button type="button" class="close" data-dismiss="alert"> X </button>
                                        <strong> {{ $message }} </strong>
                                    </div>

                                @endif

                                <form method="post" enctype="multipart/form-data" action="{{route('marks.import')}}">

                                    {{ csrf_field() }}
                                    <input type="file" name="select_file" class="btn gradient-purple-bliss" style="margin: 5px"> </input>
                                    <input type="submit" name="upload" class="btn gradient-purple-bliss" value="تحميل الملف" style="padding:10px; margin: 5px"> </input>

                                </form>

                                    <button type="button" id="createNew"
                                            data-toggle="modal" data-target="#advertModal" class="btn gradient-purple-bliss" style="margin: 5px">إضافة</button>
                            </div>


                            <div class="row">

                                <div class="col-sm-12">
                                    <table id="tableData" class="table table-striped table-sm data-table">

                                        <thead>


                                        <tr>
                                            <th> #</th>
                                            <th>الرقم الجامعي</th>
                                            <th> اسم الطالب </th>
                                            <th> السنة الدراسية </th>
                                            <th> الفصل الدراسي </th>
                                            <th> المقرر </th>
                                            <th> العلامة </th>
                                            <th >العمليات</th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade text-left" id="advertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="modelheading">تعديل بيانات  </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>

                    </button>
                </div>
                <form method="post" id="productForm" enctype="multipart/form-data">
                    <input type="hidden" name="_id" id="_id">
                    <div class="modal-body">
                        <div class="row">
                            @csrf

                        <div class="col-md-6"> <label> الرقم الجامعي </label>
                            <div class="form-group">
                                <input type="number" name="student_id" id="student_id_edit" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6"> <label> اسم الطالب </label>
                            <div class="form-group">
                                <input type="text" name="student_name" id="student_name_edit" placeholder="" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6"> <label> السنة الدراسية </label>
                            <div class="form-group">
                                <input type="text" name="year_id" id="year_id_edit" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6"> <label> الفصل الدراسي </label>
                            <div class="form-group">
                                <input type="text" name="season_id" id="season_id_edit" placeholder="" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6"> <label> المقرر </label>
                            <div class="form-group">
                                <input type="text" name="subject" id="subject_edit" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6"> <label> العلامة </label>
                            <div class="form-group">
                                <input type="number" name="mark" id="mark_edit" placeholder="" class="form-control">
                            </div>
                        </div>

                    </div>
                    </div>
                    <div class="modal-footer">

                        <input type="hidden" name="operation" id="operation"/>
                        <input type="reset" class="btn bg-light-secondary" data-dismiss="modal" value="إغلاق">
                        <input type="submit" name="action" id="action" class="btn btn-primary" value="حفظ">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('pageJs')


    {{--<script type="text/javascript">--}}

        {{--$(function () {--}}


            {{--$.ajaxSetup({--}}

                {{--headers: {--}}

                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}

                {{--}--}}

            {{--});--}}


            {{--var table = $('#tableData').DataTable({--}}
                {{--"language": {--}}
                    {{--"processing": " جاري المعالجة",--}}
                    {{--"paginate": {--}}
                        {{--"first": "الأولى",--}}
                        {{--"last": "الأخيرة",--}}
                        {{--"next": "التالية",--}}
                        {{--"previous": "السابقة"--}}
                    {{--},--}}
                    {{--"search": "البحث :",--}}
                    {{--"loadingRecords": "جاري التحميل...",--}}
                    {{--"emptyTable": " لا توجد بيانات",--}}
                    {{--"info": "من إظهار _START_ إلى _END_ من _TOTAL_ النتائج",--}}
                    {{--"infoEmpty": "Showing 0 إلى 0 من 0 entries",--}}
                    {{--"lengthMenu": "إظهار _MENU_ البيانات",--}}
                {{--},--}}
                {{--processing: true,--}}

                {{--serverSide: true,--}}

                {{--ajax: "{{ route('morasel_news_requests')}}",--}}

                {{--columns: [--}}

                    {{--{data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}

                    {{--{data: 'title', name: 'title'},--}}
                    {{--{data: 'details', name: 'details'},--}}
                    {{--{data: 'image', name: 'image'},--}}
                    {{--{data: 'morasel_id', name: 'morasel_id'},--}}

                    {{--{data: 'action', name: 'action', orderable: false, searchable: false},--}}

                {{--]--}}

            {{--});--}}



            {{--$('body').on('click', '.accept', function () {--}}


                {{--var product_id = $(this).data("id");--}}

                {{--var co = confirm("  هل أنت متأكد من قبول الخبر  !");--}}
                {{--if (!co) {--}}
                    {{--return;--}}
                {{--}--}}


                {{--$.ajax({--}}

                    {{--type: "POST",--}}

                    {{--url: "{{ route('new.agree') }}/" + product_id  ,--}}
                    {{--// data:{--}}
                    {{--//     "_id":product_id,--}}
                    {{--//     "status":1,--}}
                    {{--//     "_token":$("input[name=_token]").val()--}}
                    {{--// },--}}

                    {{--success: function (data) {--}}

                        {{--table.draw();--}}

                    {{--},--}}

                    {{--error: function (data) {--}}

                        {{--console.log('خطأ:', data);--}}

                    {{--}--}}

                {{--});--}}

            {{--});--}}




        {{--});--}}

    {{--</script>--}}
@endpush