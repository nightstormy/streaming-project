<div xmlns:x-on="http://www.w3.org/1999/xhtml" xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"
                     x-data="{ isUploading: false, progress: 0 }"
                     x-on:livewire-upload-start="isUploading = true"
                     x-on:livewire-upload-finish="isUploading = false , $wire.fileCompleted()"
                     x-on:livewire-upload-error="isUploading = false"
                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                >

                    <div class="card-body">

                        <div class="progress mb-3" x-show="isUploading">
                            <div class="progress-bar" role="progressbar" :style="`width: ${progress}%`"></div>
                        </div>

                        <form x-show="!isUploading">
                            <input type="file" wire:model="videoFile">
                        </form>
                    </div>
                    @error('videoFile')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>












