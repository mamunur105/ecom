
@extends('../layouts')

@section('title', 'Page Title')


@section('content')

<article class="col-md-12 card mb-4 pb-5">
    <h2 class="text-center pb-5 pt-5">Registeration Form</h2>
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

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form method="post" action="{{ route('registrationForm') }}" enctype="multipart/form-data">
        @csrf 
        <div class="form-row">
             <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" name="name" class="form-control" id="inputName" value="{{old('name')}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" name="useremail" class="form-control" id="inputEmail4" value="{{old('useremail')}}">
            </div>

        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{old('address')}}">
        </div>
       
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input name="city" type="text" class="form-control" id="inputCity" value="{{old('city')}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select name="choosestate" id="inputState" class="form-control" value="{{old('choosestate')}}">
                    <option>Choose...</option>
                   
                    <option
                         @if("one" == old('choosestate') ) selected="selected" @endif
                    value="one">One </option>
                    <option   
                        @if('two' == old('choosestate') ) selected="selected" @endif
                    value="two">Two </option>
                    <option 
                        @if('three' == old('choosestate') ) selected="selected" @endif
                    value="three">Three </option>

                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input name="zipcode" type="text" class="form-control" id="inputZip" value="{{old('zipcode')}}">
            </div>
             <div class="form-group col-md-6">
                <label for="photoInput">Photo</label>
                <input name="photo" type="file" class="form-control" id="photoInput">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input name="password" type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" id="inputPassword4">
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</article><!-- /.card -->

@endsection