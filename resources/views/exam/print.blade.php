<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <style>
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            /* border: 0; */
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: 2px;
        }
        table{
            border-collapse: collapse;
        }
    </style>
</head>


<body>
    <div id="print_area">
        <div style="text-align:center;">
            <img src="img/logo.png" alt="logo" width="100">
            <h4>{{ $exam->type }}-{{ $exam->exam_year }}</h4>
            <h4>Faridpur Enginnering College, Faridpur</h4>
            <h4>Schedule for Invigilation</h4>
            <div style="margin: 2px;font-size:12px;">
                <p>Exam Time: 10:00AM - 01:00PM</p>
            </div>
        </div>
        <table border="1"
            style="font-size:10px;width:100%;border-collapse:collapse;text-align:center;margin:15px 10px;">
            <thead>
                <tr>
                    <th style="padding: 10px;" colspan="7">Department of CSE/EEE/CIVIL</th>
                </tr>
                <tr>
                    <th style="padding: 10px;">Name</th>
                    <th style="padding: 10px;">Signature</th>
                    <th style="padding: 10px;">Course Code/Name</th>
                    <th style="padding: 10px;">Exam Date</th>
                    <th style="padding: 10px;">Exam Hall</th>
                    <th style="padding: 10px;">Exam Hall Supervisor</th>
                    <th style="padding: 10px;">Signature</th>
                    {{-- <th style="padding: 10px;">Exam Time</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($routines as $routine)
                    <tr>
                        <td>
                            <table width="100%" height="100%" border="1">

                                @for ($i = 0; $i < $routine->exam_duties_count; $i++)
                                    <tr>
                                        <td height="36px" style="padding: 10px;">{{ $routine->teachers[$i]->name }}</td>
                                    </tr>
                                @endfor
                            </table>
                        </td>
                        <td>
                            <table width="100%" height="100%" border="1">

                                @for ($i = 0; $i < $routine->exam_duties_count; $i++)
                                    <tr>
                                        <td height="36px" style="padding: 10px;"></td>
                                    </tr>
                                @endfor
                            </table>
                        </td>
                        <td  style="padding: 10px;">
                            @foreach ($routine->subjects as $subject)
                                {{ $subject->course_code }}<br>
                                {{ $subject->course_name }}<br>
                            @endforeach
                        </td>
                        <td  style="padding: 10px;">{{ $routine->exam_date }}
                        </td>
                        <td  style="padding: 10px;">
                            {{ $routine->exam_center->name }}</td>
                        <td  style="padding: 10px;">
                            @foreach ($routine->supervisors as $supervisor)
                                {{ $supervisor->name }}<br>
                            @endforeach
                        </td>
                        <td  style="padding: 10px;"></td>
                        {{-- <td style="padding: 10px;">{{$routine->exam_time}}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br><br>
        <table style="width:100%;text-align:right;">
            <tr>
                <td></td>
                <td>Dr. Md. Mizanur Rahman</td>
            </tr>
        </table>

    </div>
    <script>
        document.getElementById("btnPrint").addEventListener("click", btnPrint);

        function btnPrint() {
            var printContents = document.getElementById('print_area').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        function close_window() {
            if (confirm("Close Window?")) {
                window.close();
            }
        }
    </script>
</body>

</html>
