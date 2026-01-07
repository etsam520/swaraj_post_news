<!DOCTYPE html>
<html ⚡>
<head>
    <meta charset="utf-8">
    <title>{{ $visualStory['title'] }}</title>
    <link rel="canonical" href="self.html">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">

    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-img" src="https://cdn.ampproject.org/v0/amp-img-0.1.js"></script>

    <style amp-custom>
        amp-story-page {
            background-color: black;
        }
        h1 {
            font-size: 32px;
            color: white;
            text-align: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <amp-story standalone
        title="{{ $visualStory['title'] }}"
        publisher="My Website"
        publisher-logo-src="https://via.placeholder.com/50"
        poster-portrait-src="{{ $visualStory['cover_image'] }}">

        <!-- Cover Page (Loads Instantly) -->
        <amp-story-page id="cover">
            <amp-story-grid-layer template="fill">
                <amp-img src="{{ $visualStory['cover_image'] }}" width="800" height="1200" layout="responsive"></amp-img>
            </amp-story-grid-layer>
            <amp-story-grid-layer template="vertical">
                <h1>{{ $visualStory['title'] }}</h1>
                <p>{{ $visualStory['description'] }}</p>
            </amp-story-grid-layer>
        </amp-story-page>

        <!-- Slides: Load One After Another -->
        @foreach($visualStory['slides'] as $index => $slide)
            <amp-story-page id="slide{{ $index }}" class="lazy-slide">
                <amp-story-grid-layer template="fill">
                    @if(Str::endsWith($slide['media'], ['.mp4', '.webm', '.ogg']))
                        <amp-video autoplay loop width="720" height="1280" layout="responsive"
                                   data-src="{{ asset('storage/' . $slide['media']) }}">
                            <source src="{{ asset('storage/' . $slide['media']) }}" type="video/mp4">
                        </amp-video>
                    @else
                        <amp-img data-src="{{ asset('storage/' . $slide['media']) }}" width="800" height="1200" layout="responsive"
                                 animate-in="fade-in" animate-in-delay="2s"></amp-img>
                    @endif
                </amp-story-grid-layer>
            </amp-story-page>
        @endforeach

    </amp-story>
</body>
</html>
