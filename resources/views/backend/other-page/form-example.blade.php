@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Forms</h3>
                        </div>
                    </div>
                </div> <!-- Row end  -->

                <div class="row align-item-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Basic Form</h6> 
                            </div>
                            <div class="card-body">
                            <form id="basic-form" >
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Text Input</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Email Input</label>
                                                <input type="email" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Text Area</label>
                                                <textarea class="form-control" rows="5" cols="30" ></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Checkbox</label>
                                                <br/>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="checkbox"  data-parsley-errors-container="#error-checkbox">
                                                    <span>Option 1</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="checkbox">
                                                    <span>Option 2</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="checkbox">
                                                    <span>Option 3</span>
                                                </label>
                                                <p id="error-checkbox"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Radio Button</label>
                                                <br />
                                                <label class="fancy-radio">
                                                    <input type="radio" name="gender" value="male"  data-parsley-errors-container="#error-radio">
                                                    <span><i></i>Male</span>
                                                </label>
                                                <label class="fancy-radio">
                                                    <input type="radio" name="gender" value="female">
                                                    <span><i></i>Female</span>
                                                </label>
                                                <p id="error-radio"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Validate</button>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Basic Validation Form</h6> 
                            </div>
                            <div class="card-body">
                            <form method="post" action="{{route('admin.form.basic')}}">
                                    @csrf
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-6">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" name="firstname" class="form-control" id="firstname">
                                            @error('firstname')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input type="text" name="lastname" class="form-control" id="lastname" >
                                            @error('lastname')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="form-label">Phone Number</label>
                                            <input type="text" name="phonenumber" class="form-control" id="phonenumber" >
                                            @error('phonenumber')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="emailaddress" class="form-label">Email Address</label>
                                            <input type="email" name="emailaddress" class="form-control" id="emailaddress" >
                                            @error('emailaddress')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Date</label>
                                            <input type="date" name="admitdate" class="form-control" id="admitdate" >
                                            @error('admitdate')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admittime" class="form-label">Time</label>
                                            <input type="time" name="admittime" class="form-control" id="admittime" >
                                            @error('admittime')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="formFileMultiple" class="form-label"> File Upload</label>
                                            <input class="form-control" name="formFileMultiple" type="file" id="formFileMultiple" multiple >
                                            @error('formFileMultiple')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="form-label">Gender</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios11" value="option1" checked>
                                                        <label class="form-check-label" for="exampleRadios11">
                                                         Male
                                                        </label>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios22" value="option2">
                                                        <label class="form-check-label" for="exampleRadios22">
                                                           Female
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('exampleRadios')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="addnote" class="form-label">Add Note</label>
                                            <textarea name="addnote" class="form-control" id="addnote" rows="3"></textarea> 
                                            @error('addnote')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Advanced Validation Form</h6> 
                            </div>
                            <div class="card-body">
                                <form id="advanced-form" method="post" action="{{route('admin.form.advance')}}">
                                    @csrf
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="text-input1" class="form-label">Min. 8 Characters</label>
                                                <input type="text" id="text-input1" name="min8" class="form-control"  data-parsley-minlength="8">
                                                @error('min8')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="text-input2" class="form-label">Between 5-10 Characters</label>
                                                <input type="text" id="text-input2" name="between5to10" class="form-control"  data-parsley-length="[5,10]">
                                                @error('between5to10')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="text-input3" class="form-label">Min. Number ( >= 5 )</label>
                                                <input type="text" id="text-input3" name="between_min_number" class="form-control"  data-parsley-min="5">
                                                @error('between_min_number')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="text-input4" class="form-label">Between 20-30</label>
                                                <input type="text" id="text-input4" name="between20to30" class="form-control"  data-parsley-range="[20,30]">
                                                @error('between20to30')
                                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Select Min. 2 Options</label>
                                                <br />
                                                <label class="control-inline fancy-checkbox">
                                                    <input type="checkbox" name="checkbox2"  data-parsley-mincheck="2" data-parsley-errors-container="#error-checkbox2">
                                                    <span>Option 1</span>
                                                </label>
                                                <label class="control-inline fancy-checkbox">
                                                    <input type="checkbox" name="checkbox2">
                                                    <span>Option 2</span>
                                                </label>
                                                <label class="control-inline fancy-checkbox">
                                                    <input type="checkbox" name="checkbox2">
                                                    <span>Option 3</span>
                                                </label>
                                                <p id="error-checkbox2"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Select Between 1-2 Options</label>
                                                <br />
                                                <label class="control-inline fancy-checkbox">
                                                    <input type="checkbox" name="checkbox3"  data-parsley-check="[1,2]" data-parsley-errors-container="#error-checkbox3">
                                                    <span>Option 1</span>
                                                </label>
                                                <label class="control-inline fancy-checkbox">
                                                    <input type="checkbox" name="checkbox3">
                                                    <span>Option 2</span>
                                                </label>
                                                <label class="control-inline fancy-checkbox">
                                                    <input type="checkbox" name="checkbox3">
                                                    <span>Option 3</span>
                                                </label>
                                                <p id="error-checkbox3"></p>
                                            </div>
                                        </div>
                                    </div>
                                     <button type="submit" class="btn btn-primary">Validate</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- Row end  -->

            </div>
        </div>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script> 
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
