
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
                            @if(2 > count($errors->all()))

                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach

                            @else
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
                        </div>
                    @endif
                <form action="{{ route('category.update',$category->id) }}"  method="post">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="category_name">Caregory Name</label>
                            <input name="category-name" type="text" class="form-control" id="category_name" placeholder="Name" value="{{ $category->name }}">
                        </div>
                     
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2">Update Category</button>
                    </div>
                   
                </form>
            </div>

        </div>
        <!-- end row -->        
        
    </div> <!-- container -->

@endsection