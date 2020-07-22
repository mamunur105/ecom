
@extends('../dashboard_layout')
@section('Category', 'Dashboard')

@section('stylesheet')       
    <!-- third party css -->
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
@endsection

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row py-2">
            <div class="col-12">
                <div class="page-title-box">
                    <h2>Posts</h2>

                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="add-new col-md-12">   

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
                         

                        </div>

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
                            
                            <table class="table table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;" >Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories->posts as $post)
                                    <tr>
                                        <td><img width="80px"  src="{{ $post->thumbnail_path }}" alt=""></td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            <a href="{{ route('category.show',$categories->id)}}">{{ $categories->name }}</a>
                                        </td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->status }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <span>
                                                    <a style="width: 50px;" href="{{ route('posts.edit',$post->id) }}" class="action-icon"> 
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                </span>
                                                <span>
                                                    <form method="post" action="{{ route('posts.destroy',$post->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
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