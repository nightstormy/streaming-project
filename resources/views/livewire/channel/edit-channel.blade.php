<div xmlns:wire="http://www.w3.org/1999/xhtml">
    @if($channel->image)
        <img src="{{asset('images' . '/' . $channel->image)}}" alt="'">
    @endif
    <form wire:submit.prevent="update">

        {{--Name Input--}}
        <div class="form-group mb-2">
            <label for="name">
                Name
                <input type="text" class="form-control" wire:model="channel.name">
            </label>
        </div>
        @error('channel.name')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror

        {{--slug Input--}}
        <div class="form-group mb-2">
            <label for="slug">
                Slug
                <input type="text" class="form-control" wire:model="channel.slug">
            </label>
        </div>
        @error('channel.slug')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror

        {{--description Input--}}
        <div class="form-group mb-2">
            <label for="description">
                Description
                <textarea cols="30" rows="4" class="form-control" wire:model="channel.description"></textarea>
            </label>
        </div>
        @error('channel.description')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror

        {{--image Input--}}
        <div class="form-group mb-4">
            <label for="image">
                Image
                <input type="file" class="form-control" wire:model="image">
            </label>
        </div>
        <div class="form-group">
            @if($image)
                Image Preview
                <img class="img-thumbnail" src="{{ $image->temporaryUrl() }}" alt="">
            @endif
        </div>
        @error('image')
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
