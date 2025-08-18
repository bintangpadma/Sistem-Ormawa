<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SK Panitia {{$event->name}}</title>
    <style>
        @font-face {
            font-family: 'xd-prime-regular';
            src: url("{{ base_path('public/assets/font/xd-prime/XDPrime-Regular.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'xd-prime-medium';
            src: url("{{ base_path('public/assets/font/xd-prime/XDPrime-Medium.ttf') }}") format('truetype');
        }

        * {
            font-family: 'xd-prime-regular' !important;
        }
    </style>
</head>
<body>
<img src="{{public_path('assets/image/event/' . $event->image_path)}}" alt="Logo Path" style="width: 120px !important; height: 120px !important;">
<h4 style="text-transform: uppercase; text-align: center;">STRUKTUR KEPANITIAAN <br> {{$event->name}}</h4>

<table>
    <tr>
        <td style="font-size: 0.875rem; padding: 4px;">PELINDUNG</td>
        <td style="font-size: 0.875rem; padding: 4px;">: Dr. I Made Artana, S.Kom., M.M.</td>
    </tr>
    <tr>
        <td style="font-size: 0.875rem; padding: 4px;">PENANGGUNG JAWAB</td>
        <td style="font-size: 0.875rem; padding: 4px;">: Dr. Ni Made Satvika Iswari, S.T., M.T.</td>
    </tr>
    <tr>
        <td style="font-size: 0.875rem; padding: 4px;">KETUA STEERING COMMITTEE</td>
        <td style="font-size: 0.875rem; padding: 4px;">: A.A. Istri Ita Paramitha, S.Pd., M.Kom.</td>
    </tr>
</table>

<table style="width: 100%; margin-top: 24px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="font-size: 0.875rem; padding: 6px; border: 1px solid black; text-align: center; background-color: green; color: white;">Jabatan</td>
        <td style="font-size: 0.875rem; padding: 6px; border: 1px solid black; text-align: center; background-color: green; color: white;">Nama Lengkap</td>
        <td style="font-size: 0.875rem; padding: 6px; border: 1px solid black; text-align: center; background-color: green; color: white;">NIM</td>
    </tr>
    @foreach($eventRecruitments as $eventRecruitment)
        <tr>
            <td style="font-size: 0.875rem; padding: 6px; border: 1px solid black;">{{$eventRecruitment->event_division->name}}</td>
            <td style="font-size: 0.875rem; padding: 6px; border: 1px solid black;">{{$eventRecruitment->student_name}}</td>
            <td style="font-size: 0.875rem; padding: 6px; border: 1px solid black;">{{$eventRecruitment->student_code}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
