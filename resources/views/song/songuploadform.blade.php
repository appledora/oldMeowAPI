@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">File Upload</div>
                    <div class="card-body">
                        <form action="{{ route('songUpload') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                            {{ csrf_field() }}
                        </form>
                        <form method="POST" action="{{ route('songUpload') }}" aria-label="{{ __('Upload') }}">
                            @csrf
                            <div class="form-group row ">
                                <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('File Upload') }}</label>
                                <div class="col-md-6">
                                    <div id="file" class="dropzone"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus />
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="artist" class="col-sm-4 col-form-label text-md-right">{{ __('artist') }}</label>
                                <div class="col-md-6">
                                    <input id="artist" type="text" class="form-control{{ $errors->has('artist') ? ' is-invalid' : '' }}" name="artist" value="{{ old('artist') }}" required autofocus />
                                    @if ($errors->has('artist'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lyric" class="col-sm-4 col-form-label text-md-right">{{ __('lyric') }}</label>
                                <div class="col-md-6">
                                    <textarea id="lyric" cols="10" rows="10" class="form-control{{ $errors->has('lyric') ? ' is-invalid' : '' }}" name="lyric" value="{{ old('lyric') }}" required autofocus></textarea>
                                    @if ($errors->has('lyric'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lyric') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('genre') }}</label>
                                <div class="col-md-6">
                                    <input id="genre" type="text" class="form-control{{ $errors->has('genre') ? ' is-invalid' : '' }}" name="genre" required>
                                    @if ($errors->has('genre'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Upload') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session()->get('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        var drop = new Dropzone('#song', {
            createImageThumbnails: false,
            addRemoveLinks: true,
            url: "{{ route('upload') }}",
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            }
        });
    </script>
    <script>
        Dropzone.options.myDropzone = {
            paramName: 'file',
            maxFilesize: 5, // MB
            maxFiles: 20,
            acceptedFiles: ".jpeg,.jpg,.png,.gif, .mp3",
            init: function() {
                this.on("success", function(file, response) {
                    var a = document.createElement('span');
                    a.className = "thumb-url btn btn-primary";
                    a.setAttribute('data-clipboard-text','{{url('/uploads')}}'+'/'+response);
                    a.innerHTML = "copy url";
                    file.previewTemplate.appendChild(a);
                });
            }
        };
    </script>
@endsection
