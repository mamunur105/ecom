
@extends('../dashboard_layout')
@section('Category', 'Dashboard')

@section('stylesheet')       
    <!-- third party css -->
    <link href="{{ asset('assets/backend/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <!-- App css -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/backend/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
@endsection

@section('scripts')      
    <!-- bundle -->
    <script src="{{ asset('assets/backend/js/vendor.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/app.min.js')}}"></script>
    <!-- third party js -->
    <script src="{{ asset('assets/backend/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/backend/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/vendor/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/vendor/dataTables.checkboxes.min.js') }}"></script>
    <!-- third party js ends -->
    <!-- demo app -->
    <script src="{{ asset('assets/backend/js/pages/demo.products.js') }}"></script>
    <script>
        // $('#products-datatable').DataTable();
    </script>
    <!-- end demo js-->
@endsection

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row py-2">
            <div class="col-12">
                <div class="page-title-box">
                    <h2>Categories</h2>

                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-md-4">
                  @if(session()->has('message'))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form action="{{ route('category.add') }}"  method="post">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Caregory Name</label>
                        <input name="category-name" type="text" class="form-control" id="category_name" placeholder="Name">
                    </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2">Add Category</button>
                    </div>
                   
                </form>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="javascript:void(0);" class="mb-2"> </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                    <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="all" style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Category</th>
                                        <th>Slug</th>

                                        <th class="d-none">none</th>
                                        <th class="d-none">none</th>
                                        <th class="d-none">none</th>

                                        <th>Status</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            Aeron Chairs
                                        </td>
                                       
                                        <td>
                                            SLug
                                        </td>
                                        <td class="d-none">none</td>
                                        <td class="d-none">none</td>
                                        <td class="d-none">none</td>
    
                                   
                                        <td>
                                            <span class="badge badge-success">Status</span>
                                        </td>
    
                                        <td class="table-action">
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                   
                                </tbody>

                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->        
        
    </div> <!-- container -->

@endsection