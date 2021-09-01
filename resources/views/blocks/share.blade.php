@if(isset($post))
    <div class="share">
        <span>{{ __('cms::general.share') }}</span>

        <div class="list">
            <ul>
                <li><a href="http://www.facebook.com/share.php?u={{ rawurlencode(url()->current()) }}&title={{ $post->getTitle() }}" class="share-btn facebook" target="_blank">Facebook</a></li>
                <li><a href="http://twitter.com/intent/tweet?url={{ rawurlencode(url()->current()) }}" class="share-btn twitter" target="_blank">Twitter</a></li>
                <li><a href="https://www.linkedin.com/shareArticle?url={{ rawurlencode(url()->current()) }}&title={{ $post->getTitle() }}" class="share-btn linked-in" target="_blank">LinkedIn</a></li>
            </ul>
        </div>
    </div>
@endif
