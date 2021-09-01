@extends('admin::translate')

@section('title', __('multilanguage::general.language') . ' - ' . $post->getName())

@section('content')

    <table class="table table-striped mobile-block">
        <thead>
            <tr>
                <th scope="col" class="d-none d-md-block">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Warning</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($allRecords as $record)
                <tr>
                    <td class="d-none d-md-block">{{ $record->getId() }}</td>
                    <td>{{ $record->getTitle() }}</td>
                    <td>
                        @foreach($data[$record->getId()] as $warning)
                            <p>{!! $warning !!}</p>
                        @endforeach
                    </td>
                    <td>{{  \Button::edit(route('admin.page.show', [$record, 'translations' => $post->getAlphaCode()])) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $allRecords->links() }}
@endsection
