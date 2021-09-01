<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

    <title></title>

    <style type="text/css">
        body{
            width:100% !important;
            -webkit-text-size-adjust:100%;
            -ms-text-size-adjust:100%;
            margin:0;
            padding:0;
        }

        table td {
            border-collapse: collapse;
        }

        /* End reset */

        @media screen and (max-width: 560px) {
            /* This sets elements to 100% width and fixes the height issues too, a god send */
            *[class="100p"] {
                width:100% !important;
                height:auto !important;
            }

            /* 100percent width section with 20px padding */
            *[class="100pad"] {
                width:100% !important;
                padding-left:20px;
                padding-right:20px;
            }
        }
    </style>
</head>

<body>
    <table border="0" cellpadding="0" cellspacing="0" style="margin: 0; padding: 0" width="100%">
        <tr>
            <td valign="top">
                @yield('content')

            </td>
        </tr>
    </table>
</body>

</html>
