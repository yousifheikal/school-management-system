@extends('layouts.master')

@section('title')
    قائمة المراحل الدراسية
@stop

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('main_sidebar.List of academic levels')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><h4>{{trans('main_sidebar.school grade')}}</h4></li>
                    <li class="breadcrumb-item active">{{trans('main_sidebar.List of academic levels')}}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
<div class="row">

    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif


    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('classes.add_class') }}
                </button>
                    <button type="button" class="button x-small" id="btn_delete_all">
                        {{ trans('classes.delete_checkbox') }}
                    </button>
                <br><br>

                <form action="{{ route('filter') }}" method="POST">
                    @csrf
                    <select class="selectpicker" data-style="btn-info" name="level_id" required
                            onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('classes.disable') }}</option>
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->Level_Name }}</option>
                        @endforeach
                    </select>
                </form>


            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                       style="text-align: center">
                    <thead>
                    <tr>
                        <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                        <th>#</th>
                        <th>{{ trans('classes.Classroom') }}</th>
                        <th>{{ trans('classes.Name_Grade') }}</th>
                        <th>{{ trans('classes.Processes') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($details))
                        <?php $classrooms = $details?>
                    @else
                        <?php $classrooms = $classrooms?>
                    @endif
                    <?php $i = 0; ?>
                    @foreach ($classrooms as $classroom)

                        <tr>
                                <?php $i++; ?>
                            <td><input type="checkbox"  value="{{ $classroom->id }}" class="box1" ></td>
                            <td>{{ $i }}</td>
                            <td>{{ $classroom->classroom }}</td>
                            <td>{{ $classroom->levels->Level_Name}}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $classroom->id }}"
                                        title="{{ trans('classes.Edit') }}"><i class="fa fa-edit"></i></button>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $classroom->id }}"
                                        title="{{ trans('classes.Delete') }}"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>


                    <!-- edit_modal_Grade -->
                <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{ trans('classes.edit_class') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- add_form to update-->
                                <form action="{{ route('classrooms.update', 'test') }}" method="post">
                                    @method("PATCH")
                                    @csrf
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name_en"
                                                   class="mr-sm-2">{{ trans('classes.Name_class_en') }}
                                                :</label>
                                            <input type="text" class="form-control"
                                                   value="{{$classroom->getTranslation('classroom', 'en')}}"
                                                   name="Name_enn" required>
                                        </div>

                                        <div class="col">
                                            <label for="Name"
                                                   class="mr-sm-2">{{ trans('classes.Name_class') }}
                                                :</label>
                                            <input id="Name" type="text" name="Name_ar"
                                                   class="form-control"
                                                   value="{{$classroom->getTranslation('classroom', 'ar')}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="exampleFormControlTextarea1">{{ trans('classes.Name_Grade') }}
                                            :</label>
                                        <select class="form-control form-control-lg"
                                                id="exampleFormControlSelect1" name="level_id">
                                            <option value="{{ $classroom->levels->id }}" disabled>{{$classroom->levels->Level_Name}}</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}">
                                                    {{ $level->Level_Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input id="id" type="hidden" name="id" class="form-control"
                                           value="{{ $classroom->id }}">
                                    <br><br>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('classes.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('classes.submit') }}</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- delete_modal_Grade -->
                <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{ trans('classes.Delete') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    {{ trans('classes.Warning_Grade') }}
                                    <input id="id" type="hidden" name="id" class="form-control"
                                           value="{{ $classroom->id }}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('classes.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-danger">{{ trans('classes.Delete') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>





                <!-- add_modal_class -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                    {{ trans('classes.add_class') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Classes">
                                                <div data-repeater-item>
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('classes.Name_class') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="Name"  required/>
                                                        </div>


                                                        <div class="box">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('classes.Name_class_en') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="Name_class_en" required/>
                                                        </div>


                                                        <div class="col">
                                                            <label for="level"
                                                                   class="mr-sm-2">{{ trans('classes.Name_Grade') }}
                                                                :</label>
                                                                <select class="fancyselect" name="level_id">
                                                                    @foreach ($levels as $level)
                                                                        <option value="{{ $level->id }}">{{ $level->Level_Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>

                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('classes.Processes') }}
                                                                :</label>
                                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                                   type="button" value="{{ trans('classes.delete_row') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-20">
                                                <div class="col-12">
                                                    <input class="button" data-repeater-create type="button" value="{{ trans('classes.add_row') }}"/>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('classes.Close') }}</button>
                                                <button type="submit"
                                                        class="btn btn-success">{{ trans('classes.submit') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    </div>

        <!-- حذف مجموعة صفوف -->
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('classes.delete_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('delete_selected') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            {{ trans('classes.Warning_Grade') }}
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('classes.Close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ trans('classes.Delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- row closed -->
@endsection
@section('js')
    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });

    </script>
@endsection
