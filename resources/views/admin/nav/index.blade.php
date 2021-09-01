@extends('admin::admin')

@section('title', __('cms::general.nav'))

@section('content')

    <div class="row">
        <div class="col-xl-3">
            {{ Button::add('admin.nav.nav.show', true, false)->label('Add New Nav')->modal()->render() }}

            <ul class="block-list mt-4">


               @foreach($navs as $navItem)
                   <li>
                        <span class="title">{{ $navItem->getTitle() }}</span>

                        <div class="buttons-sm">
                            {{ Button::show(['admin.nav.index', $navItem]) }}

                            {{ Button::edit(['admin.nav.nav.show', $navItem], true, false)->modal()->render() }}

                            {{ Button::delete(['admin.nav.delete', $navItem], true, false)->setAttributes(['data-redirect'=> request()->route()->parameter('nav') == $navItem->getLink()  ? route('admin.nav.index') : 'true'])->render() }}

                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-xl-9 mt-4 mt-xl-0">
            @if($nav->exists)
                {{ Html::block('open', $nav->getTitle(), [ Button::add(['admin.nav.page.addToNav', $nav->link], $nav->exists, false)->label('Add Page')->modal()->render() ]) }}

                    @if($nav->exists)

                        <div class="dd" data-href="{{ route('admin.nav.reorder', $nav) }}">
                            <ol class="block-list">
                                @forelse($nav->pages as $page)
                                    <li class="dd-item" data-id="{{ $page->getId() }}">
                                        <span class="title">{{ $page->getTitle() }}</span>

                                        <div class="buttons-sm">
                                            {{ Button::edit(['admin.nav.page.edit', $page->getId()], true, false)->modal()->render() }}

                                            {{ Button::delete(['admin.nav.page.delete', $page->getId()], true, false)->setAttributes(['data-redirect' => 'true'])->render() }}
                                        </div>
                                    </li>
                                @empty
                                @endforelse
                            </ol>
                        </div>

                    @else
                        <p class="text-center">Please select nav</p>
                    @endif

                {{ Html::block('close') }}

            @endif
        </div>
    </div>
    <script type="text/javascript">

            $('.dd').nestable({
                listClass: 'block-list',
                itemClass : 'dd-item',
                handleClass : 'title',
                maxDepth: 1,
                callback: function(l,e) {

                    //$('.dd').each(function (index, value) {
                       // data = $('dd').nestable('toArray');
                    //});

                    var json = $('.dd').nestable('toArray');

                    var ids = $(json).map(function () {

                        return this.id;

                    }).get();

                    $.ajax({
                        url: l.attr('data-href'),
                        type: 'PUT',
                        data: {'data' : ids, _method: '_patch'},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(result) {
                        }
                    });
                }
            });



    </script>

@endsection
