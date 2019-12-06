@extends('layouts.admin')
@section('content')

<head>



    <style type="text/css">
        input[type=file] {

            display: inline;

        }

        /* #image_preview {

            border: 1px solid lightgray;
            border-radius: 3px;
            padding: 10px;
            width:710px;


        }

        #image_preview img {

            width: 250px;

            padding: 5px;

        } */

        .modal-body{
            width: 100%;
        }
    </style>

</head>


<body>

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif


    @if(session()->has('error'))
    <div class="alert alert-warning">
        {{ session()->get('error') }}
    </div>
    @endif


    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Slider Images</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modelId">
                        Upload Images
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width:800px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Upload Images</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>


                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">

                                        <div >

                                            <h1>Slider</h1>

                                            <form method="POST" action="{{ route('admin.slider.store') }}"
                                                enctype="multipart/form-data" >
                                                <p><small>Note: Total size of uploading files shold not be greater than
                                                        5 MB.</small></p>
                                                <div class="form-group">
                                                    <label for="">Image:</label> <br>
                                                    <input type="file" name="image[]" id="uploadFile"
                                                        accept="image/png, image/jpeg, image/jpg, image/gif"
                                                        class="form-control" multiple /><br><br>

                                                        <label for="">Title:</label><br>
                                                    <input type="text" name="title" placeholder="Image title "
                                                        class="form-control" required /> <br>


                                                        <label for="">Description:</label>
                                                    <textarea name="description" id="" cols="36" rows="5"
                                                        class="form-control" placeholder="Image description "
                                                        required></textarea>

                                                        <label for="">Status:</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1">Publish</option>
                                                        <option value="0">Save in draft</option>
                                                    </select>
                                                </div>
                                                {{ csrf_field() }}

                                                <div style="text-align:center;"><br>

                                                    <button type="submit" class="btn btn-success"
                                                        style="margin-bottom: 0px;">Upload</button>

                                                    <button type="reset" class="btn btn-primary">Reset</button>



                                                </div>



                                            </form>



                                            <br />

                                            <div id="image_preview"></div>

                                        </div>

                                        <div style="height:20px;">
                                        </div>

                                         <div id="dvProgress" style="width: 200px; min-width: 2em;">
                                                    </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="ln_solid"></div>

                    @if(empty($images->count()))
                    <p>No record found.</p>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Image</th>

                                    <th>title</th>
                                    <th>description</th>

                                    <th>Status</th>
                                    <th>Date/Time Added</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($images as $image)
                                <tr>
                                    <td>{{ (($images->currentPage() - 1 ) * $images->perPage() ) + $loop->iteration }}
                                    </td>
                                    <td><img class="img-responsive thumbnail_img"
                                            src="{{  asset($image->image) }}" width="310px;" /></td>

                                    <td>{{ $image->title }}</td>
                                    <td>{{ $image->description }}</td>

                                    <td>
                                        @if($image->status == 1)
                                        <span class="enable">Active</span>
                                        @else
                                        <span class="disable">Inactive</span>
                                        @endif
                                    </td>



                                    <td>{{ $image->updated_at->format('F d, Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.slider.update', $image->id) }}" method="post"
                                            onsubmit="return confirm('Revert process will Enable/Disable the image. Continue?');">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="put" />
                                            <input type="hidden" name="id" value="{{ $image->id }}" />
                                            <button type="submit" class="btn btn-sm btn-info action_btn">Revert</button>
                                        </form>
                                        <form action="{{ route('admin.slider.destroy', $image->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete"
                                                class="btn btn-sm btn-danger action_btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($images->total() != 0)
                        <div>Showing
                            {{ ($images->currentpage()-1) * $images->perpage()+1}} to
                            {{(($images->currentpage()-1) * $images->perpage())+$images->count()}} of
                            {{$images->total()}} records
                        </div>
                        {{ $images->links() }}
                        @else
                        No records found.
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



</body>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>



<script>
    $('#exampleModal').on('show.bs.modal', event => {
        console.log(event);
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM

    });
</script>


<script type="text/javascript">
    $("#uploadFile").change(function(){

     $('#image_preview').html("");

     var total_file=document.getElementById("uploadFile").files.length;

     for(var i=0;i<total_file;i++)

     {

      $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");

     }

  });



  $('form').ajaxForm(function()

   {

  window.location.href = '{{ url('admin/slider')}}';

   });




</script>




  <script type="text/javascript">
            $(function () {
                $('#uploadFile').on("change", function () {
                    var sizeInKb = parseFloat($(this).prop("files")['0'].size / 1024).toFixed(2);
                    var fileName = $(this).prop("files")['0'].name;
                    uploadProgress = $('#dvProgress').progressbarManager({
                        totalValue: sizeInKb,
                        initValue: '0kb',
                        animate: true,
                        stripe: true,
                        style: 'primary'
                    });
                    var chunk = 0;
                    var uploading = setInterval(function () {
                        uploadProgress.setValue(chunk);
                        if (uploadProgress.isComplete()) {
                            clearInterval(uploading);
                            uploadProgress.style('success');
                        }
                        chunk += 500;
                    }, 500);
                });
            });
        
</script>


<script src="{{asset('js/bootstrap-progressbar.min.js')}}" type="text/javascript"></script>


@stop
