@extends('./admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">Update Book Area</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Book Area</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">

                            <form  action="{{ route('book.area.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{$book->id}}">
                                
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Short Title</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="short_title" class="form-control"
                                            value="{{ $book->short_title }}" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Main Title</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="main_title" class="form-control" value="{{ $book->main_title }}"  />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Short Description</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea class="form-control" id="input40" name="short-desc" rows="3" placeholder="Description"> {{ $book->short_desc }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Link Url</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="link_url" class="form-control" value="{{ $book->link_url }}"  />
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input id="image" type="file" name="image" class="form-control" />
                                            <img id="showImage"
                                                src="{{ asset($book->image) }}"
                                                alt="Admin" class="p-1 mt-2 rounded-circle bg-primary" width="60">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="px-4 btn btn-primary" value="Save Changes" />
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

    {{-- select image show in the img  --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
                position: {
                    required : true,
                }, 
                facebook: {
                    required : true,
                }, 
                image: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter Team Name',
                }, 
                position: {
                    required : 'Please Enter Position Name',
                }, 
                facebook: {
                    required : 'Please Enter Facebook Url',
                }, 
                image: {
                    required : 'Please Select Image',
                }, 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>
@endsection


