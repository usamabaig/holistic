@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.serviceCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.service-categories.update", [$serviceCategory->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group {{ $errors->has('banner_image') ? 'has-error' : '' }}">
                <label for="banner_image">Banner Image</label>
                <div class="needsclick dropzone" id="banner_image-dropzone">

                </div>
                @if($errors->has('banner_image'))
                    <p class="help-block">
                        {{ $errors->first('banner_image') }}
                    </p>
                @endif
                <p class="helper-block">
                    Pick banner image
                </p>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Service Name*</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', isset($serviceCategory) ? $serviceCategory->name : '') }}" required>
                @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
                @endif
                <p class="helper-block">
                    Enter service name
                </p>
            </div>
            <div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
                <label for="picture">Service Icon</label>
                <div class="needsclick dropzone" id="picture-dropzone">

                </div>
                @if($errors->has('picture'))
                <p class="help-block">
                    {{ $errors->first('picture') }}
                </p>
                @endif
                <p class="helper-block">
                    Pick icon
                </p>
            </div>

            <div class="form-group {{ $errors->has('category_picture') ? 'has-error' : '' }}">
                <label for="category_picture">Service Picture</label>
                <div class="needsclick dropzone" id="category_picture-dropzone">

                </div>
                @if($errors->has('category_picture'))
                    <p class="help-block">
                        {{ $errors->first('category_picture') }}
                    </p>
                @endif
                <p class="helper-block">
                    Pick picture
                </p>
            </div>

            <div class="form-group {{ $errors->has('how_it_work') ? 'has-error' : '' }}">
                <label for="how_it_work">How it work</label>
                <textarea id="how_it_work" name="how_it_work" class="form-control ckeditor">{{ old('how_it_work', isset($serviceCategory) ? $serviceCategory->how_it_work : '') }}</textarea>
                @if($errors->has('how_it_work'))
                    <p class="help-block">
                        {{ $errors->first('how_it_work') }}
                    </p>
                @endif
                <p class="helper-block">
                    Type how it work
                </p>
            </div>

            <div class="form-group {{ $errors->has('how_it_work_picture') ? 'has-error' : '' }}">
                <label for="how_it_work_picture">How it Work Picture</label>
                <div class="needsclick dropzone" id="how_it_work_picture-dropzone">

                </div>
                @if($errors->has('how_it_work_picture'))
                    <p class="help-block">
                        {{ $errors->first('how_it_work_picture') }}
                    </p>
                @endif
                <p class="helper-block">
                Pick how it work picture
                </p>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control ckeditor">{{ old('description', isset($serviceCategory) ? $serviceCategory->description : '') }}</textarea>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    Type description
                </p>
            </div>


            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')

<script>
    Dropzone.options.bannerImageDropzone = {
    url: '{{ route('admin.service-categories.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="banner_image"]').remove()
      $('form').append('<input type="hidden" name="banner_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($serviceCategory) && $serviceCategory->banner_image)
      var file = {!! json_encode($serviceCategory->banner_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $serviceCategory->banner_image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>





<script>
    Dropzone.options.pictureDropzone = {
    url: '{{ route('admin.service-categories.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="picture"]').remove()
      $('form').append('<input type="hidden" name="picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($serviceCategory) && $serviceCategory->picture)
      var file = {!! json_encode($serviceCategory->picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="picture" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>

<script>
    Dropzone.options.categoryPictureDropzone = {
    url: '{{ route('admin.service-categories.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="category_picture"]').remove()
      $('form').append('<input type="hidden" name="category_picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="category_picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($serviceCategory) && $serviceCategory->category_picture)
      var file = {!! json_encode($serviceCategory->category_picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $serviceCategory->category_picture->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="category_picture" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>


<script>
    Dropzone.options.howItWorkPictureDropzone = {
    url: '{{ route('admin.service-categories.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="how_it_work_picture"]').remove()
      $('form').append('<input type="hidden" name="how_it_work_picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="how_it_work_picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($serviceCategory) && $serviceCategory->how_it_work_picture)
      var file = {!! json_encode($serviceCategory->how_it_work_picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $serviceCategory->how_it_work_picture->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="how_it_work_picture" value="' + file.file_name + '">') 
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>


@stop
