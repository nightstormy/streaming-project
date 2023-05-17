<div>
    @push('custom-css')
        <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet"/>
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="video-container">

                    <video
                        controls preload="auto"
                        id="yt-video"
                        class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered vjs_video_6388-dimensions"
                        data-setup='{ "aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }'
                    >
                        <source src="{{ asset('videos/' . $video->uid . '/' . $video->processed_file)}}" type="application/x-mpegURL"/>

                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, ad consider upgrading to a web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">
                                supports HTML5 video
                            </a>
                        </p>
                    </video>
                </div>


            </div>
        </div>

    </div>

    @push('scripts')
        <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    @endpush
</div>
