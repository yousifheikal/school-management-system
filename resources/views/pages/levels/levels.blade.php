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
                    {{ trans('levels.add_Grade') }}
                </button>
                <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('levels.Name') }}</th>
                                <th>{{ trans('levels.Notes') }}</th>
                                <th>{{ trans('levels.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($levels as $level)
                                <tr>
                                        <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $level->Level_Name }}</td>
                                    <td>{{ $level->Notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $level->id }}"
                                                title="{{ trans('levels.Edit') }}"><i class="fa fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $level->id }}"
                                                title="{{ trans('levels.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $level->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('levels.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form to update-->
                                                <form action="{{route('levels.update', $level->id)}}" method="post">
                                                    @method("PATCH")
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('levels.stage_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$level->getTranslation('Level_Name', 'en')}}"
                                                                   name="Name_en" required>
                                                        </div>

                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('levels.stage_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="Name"
                                                                   class="form-control"
                                                                   value="{{$level->getTranslation('Level_Name', 'ar')}}"
                                                                   required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $level->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('levels.Notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="Notes"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="3">{{ $level->Notes }}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('levels.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('levels.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $level->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('levels.delete_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('levels.destroy', $level->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    {{ trans('levels.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $level->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('levels.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('levels.deletes') }}</button>
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





        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('levels.add_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{route('levels.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('levels.stage_name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" name="Name" class="form-control" >
                                </div>
                                <div class="col">
                                    <label for="Name_en" class="mr-sm-2">{{ trans('levels.stage_name_en') }}
                                        :</label>
                                    <label>
                                        <input type="text" class="form-control" name="Name_en" >
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('levels.Notes') }}
                                    :</label>
                                <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                            </div>
                            <br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('levels.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('levels.submit') }}</button>
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
    @toastr_js
    @toastr_render
    <script
@endsection
