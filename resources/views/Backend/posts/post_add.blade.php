
@extends('../dashboard_layout')
@section('Category', 'Dashboard')

@section('stylesheet')       
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
    <!-- plugin js -->
    <script src="{{ asset('assets/backend/js/vendor/dropzone.min.js')}}"></script>
    <!-- init js -->
    <script src="{{ asset('assets/backend/js/ui/component.fileupload.js')}}"></script>
    <!-- end demo js-->
@endsection

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                <li class="breadcrumb-item active">Create Project</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Post</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('posts.store') }}" method="post">
                                @csrf
                            
                                <div class="row">
                                    <div class="col-xl-6 ">
              
                                        <div class="form-group">
                                            <label for="projectname">Title</label>
                                            <input name="title" type="text" id="projectname" class="form-control" placeholder="Enter project name" value="{{ old('title') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="project-overview">Content</label>
                                            <textarea name="content" class="form-control" id="project-overview" rows="5" placeholder="Enter some brief about project..">{{ old('content') }}</textarea>
                                        </div>
                                        <!-- Date View -->
                                        <div class="form-group ">
                                            <label for="project-overview">Category</label>
                                            <select name="category" class="form-control select2" data-toggle="select2" value="{{ old('category') }}">
                                                <option>---Select---</option>
                                                <option value="AZ">Mary Scott</option>
                                                <option value="CO">Holly Campbell</option>
                                                <option value="ID">Beatrice Mills</option>
                                                <option value="MT">Melinda Gills</option>
                                                <option value="NE">Linda Garza</option>
                                                <option value="NM">Randy Ortez</option>
                                                <option value="ND">Lorene Block</option>
                                                <option value="UT">Mike Baker</option>
                                            </select>   
                                        </div>
                                        <div class="form-group ">
                                            <select name="status" class="form-control select2" data-toggle="select2" value="{{ old('status') }}">
                                                <option>---Select---</option>
                                                <option value="publish">Publish</option>
                                                <option value="draft">Draft</option>
                                            </select>   
                                        </div>
                                        <div class="form-group mt-3 mt-xl-0">
                                            <label for="projectname" class="">Avatar</label><input name="file" type="file" />
                                        </div>
                                        <div class="form-group ">
                                            <button type="submit" class="btn btn-primary">Update Post</button>
                                        </div>

                                    </div> <!-- end col-->
                                    <div class="col-xl-6 "></div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- container -->

@endsection