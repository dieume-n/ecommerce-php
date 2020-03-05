@extends("admin.layout.base")

@section('title', 'Product Category')

@section('css')
<link rel="stylesheet" href="/css/datatables.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#create-category">
                            <i class="nav-icon fas fa-plus"></i>
                            Add Category
                        </button>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Category Slug</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->created_at->toFormattedDateString() }}</td>
                                <td class="">
                                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-category-{{ $category->id }}">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <div class="modal fade" id="edit-category-{{ $category->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Category</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="hide-edit-{{ $category->id }}">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="name">Category Name</label>
                                                            <input type="text" class="form-control" id="category-{{ $category->id }}" value="{{ $category->name }}">
                                                            <span class="invalid-feedback" id="error-{{$category->id }}"></span>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-success update-category" value="Save changes" id="{{ $category->id }}" data-token="{{ App\Utilities\Helpers\CSRFToken::token() }}">

                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <a href="" class="ml-3 btn btn-danger btn-sm delete-category" data-categoryid="{{$category->id}}">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<div class="modal fade" id="create-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="hide-modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control" name="name" id="category-name">
                        <span class="invalid-feedback" id="error-message"></span>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success create-category" value="Create category" data-token="{{ App\Utilities\Helpers\CSRFToken::token() }}">
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection


@section('scripts')
<script src="/js/jquery-datatable.js"></script>
<script src="/js/bootstrap-datatable.js"></script>
@endsection