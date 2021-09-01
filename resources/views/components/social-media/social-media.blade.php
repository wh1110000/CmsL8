<{{ $container }} class="social{{ $containerClass ? ' '.$containerClass : '' }}">
    @foreach($socialMedia as $social)
        @if($social->getName())
            <{{ $list }} class="{{ $listClass }}">
                <a href="{{ $social->getUrl(true) }}" class="micro" target="_blank">

                    @if(in_array($template, ['icon', 'both']))

                        @if($social->getIcon())

                            <i class="{{ $social->getIcon() }} @if($template == 'both') mr-2 @endif"></i>

                        @elseif($template=='icon')

                            <span>{{ $social->getService() }}</span>

                        @endif
                    @endif

                    @if(in_array($template, ['label', 'both']))

                        <span>{{ $social->getService() }}</span>

                    @endif

                </a>
            </{{ $list }}>
        @endif
    @endforeach
</{{ $container }}>
