<div xmlns:wire="http://www.w3.org/1999/xhtml" @if($video->processing_percentage < 100) wire:poll @endif>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="row">
                    <div class="col-md-4">
                        <img class="img-thumbnail" src="{{ asset($this->video->thumbnail) }}" alt="">
                    </div>

                    <div class="col-md-8">
                        <p>processing ({{$this->video->processing_percentage}})</p>
                    </div>

                </div>


                <form wire:submit.prevent="update">

                    {{--Title Input--}}
                    <div class="form-group mb-2">
                        <label for="title">
                            Title
                            <input type="text" class="form-control" wire:model="video.title">
                        </label>
                    </div>
                    @error('video.title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror


                    {{--description Input--}}
                    <div class="form-group mb-2">
                        <label for="description">
                            Description
                            <textarea cols="30" rows="4" class="form-control" wire:model="video.description"></textarea>
                        </label>
                    </div>
                    @error('video.description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    {{--Title Input--}}
                    <div class="form-group mb-2">
                        <label for="visibility">
                            Visibility
                            <select wire:model="video.visibility" class="form-control">
                                <option value="private">private</option>
                                <option value="public">public</option>
                                <option value="unlisted">unlisted</option>
                            </select>
                        </label>
                    </div>
                    @error('video.visibility')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </form>


            </div>
        </div>
    </div>


</div>
