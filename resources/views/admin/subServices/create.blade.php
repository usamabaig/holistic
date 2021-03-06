@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Package
    </div>

    <div class="card-body">
        <form action="{{ route("admin.sub-services.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.subService.fields.name') }}</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($subService) ? $subService->name : '') }}">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    Enter package name
                </p>
            </div>
            <div class="form-group {{ $errors->has('charges') ? 'has-error' : '' }}">
                <label for="charges">{{ trans('cruds.subService.fields.charges') }}</label>
                <input type="text" id="charges" name="charges" class="form-control" value="{{ old('charges', isset($subService) ? $subService->charges : '') }}">
                @if($errors->has('charges'))
                    <p class="help-block">
                        {{ $errors->first('charges') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.subService.fields.charges_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.subService.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($subService) ? $subService->description : '') }}</textarea>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.subService.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                <label for="service">Category
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="services[]" id="services" class="form-control select2" multiple="multiple">
                    @foreach($services as $id => $service)
                        <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || isset($subService) && $subService->services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                </select>
                @if($errors->has('services'))
                    <p class="help-block">
                        {{ $errors->first('services') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.subService.fields.service_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
                <label for="picture">{{ trans('cruds.subService.fields.picture') }}</label>
                <div class="needsclick dropzone" id="picture-dropzone">

                </div>
                @if($errors->has('picture'))
                    <p class="help-block">
                        {{ $errors->first('picture') }}
                    </p>
                @endif
                <p class="helper-block">
                    Pick package picture
                </p>
            </div>
            {{-- is women --}}

            <div class="form-group">
              <label for="">Is Women</label>
              <select class="form-control" name="is_women" id="">
                <option selected hidden>Select</option>
                <option value="1">Yes</option>
                <option value="0">No</option>

              </select>
            </div>

            {{-- is women end --}}

            {{--<div class="form-group {{ $errors->has('why_use_us') ? 'has-error' : '' }}">
                <label for="why_use_us">{{ trans('cruds.subService.fields.why_use_us') }}</label>
                <input type="text" id="why_use_us" name="why_use_us" class="form-control" value="{{ old('why_use_us', isset($subService) ? $subService->why_use_us : '') }}">
                @if($errors->has('why_use_us'))
                    <p class="help-block">
                        {{ $errors->first('why_use_us') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.subService.fields.why_use_us_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('how_it_work') ? 'has-error' : '' }}">
                <label for="how_it_work">{{ trans('cruds.subService.fields.how_it_work') }}</label>
                <input type="text" id="how_it_work" name="how_it_work" class="form-control" value="{{ old('how_it_work', isset($subService) ? $subService->how_it_work : '') }}">
                @if($errors->has('how_it_work'))
                    <p class="help-block">
                        {{ $errors->first('how_it_work') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.subService.fields.how_it_work_helper') }}
                </p>
            </div>--}}
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedPictureMap = {}
Dropzone.options.pictureDropzone = {
    url: '{{ route('admin.sub-services.storeMedia') }}',
    maxFilesize: 3, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 3,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="picture[]" value="' + response.name + '">')
      uploadedPictureMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPictureMap[file.name]
      }
      $('form').find('input[name="picture[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($subService) && $subService->picture)
      var files =
        {!! json_encode($subService->picture) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="picture[]" value="' + file.file_name + '">')
        }
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
