@extends('emails.admin::default')

@section('content')

    <table cellspacing="0" cellpadding="0" border="0" >
        @foreach($data as $label => $value)
            <tr>
                <td style="font-family: Arial, sans-serif; font-weight: normal; font-size: 14px; line-height: 18px; color: #1d1d1b;" >
                    {{ ucwords(specialCharsToSpaces($label)) }}: <strong>{{ ucfirst($value) ?? '---' }}</strong>
                </td>
            </tr>
        @endforeach
    </table>

@endsection

