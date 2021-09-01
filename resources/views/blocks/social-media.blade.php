@foreach($socialMedia as $social)
    <a href="{{ $social->getUrl(true) }}" class="text-white" target="_blank">
        @if($template === 'ICON' || $template === 'BOTH')
            @if($social->getIcon())
                <i class="fab {{ $social->getIcon() }} fa-2x"></i>
            @endif
        @endif

        @if($template === 'LABEL' || $template === 'BOTH')
            {{ $social->getService() }}
        @endif
    </a>
@endforeach
