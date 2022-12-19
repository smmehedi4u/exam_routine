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
        h6{
            margin-bottom: 2px;
        }
    </style>
</head>


<body>
    <div id="print_area">
        <div style="text-align:center;">
            <h4>{{ $exam->type }}-{{ $exam->exam_year }}</h4>
            <h4>Faridpur Enginnering College, Faridpur</h4>
            <h4>Schedule for Invigilation</h4>
            <div style="margin: 2px;font-size:12px;">
            <p>Exam Time: 10:00AM - 01:00PM</p>
            </div>
        </div>
        <table border="1"
            style="font-size:12px;width:100%;border-collapse:collapse;text-align:center;margin:15px 10px;">
            <thead>
                <tr>
                    <th style="padding: 10px;" colspan="7">Department of {{ $exam->batch->department->name }}</th>
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
                    <td style="padding: 10px;">
                        {{$routine->exam_duties[0]->teacher->name}}
                    </td>
                    <td style="padding: 10px;"></td>
                    <td rowspan="{{$routine->exam_duties_count}}" style="padding: 10px;">
                        {{$routine->subject->course_code}}<br>
                        {{$routine->subject->course_name}}
                    </td>
                    <td rowspan="{{$routine->exam_duties_count}}" style="padding: 10px;">{{$routine->exam_date}}</td>
                    <td rowspan="{{$routine->exam_duties_count}}" style="padding: 10px;">{{$routine->exam_center->name}}</td>
                    <td rowspan="{{$routine->exam_duties_count}}" style="padding: 10px;">{{$routine->teacher->name}}</td>
                    <td rowspan="{{$routine->exam_duties_count}}" style="padding: 10px;"></td>
                    {{-- <td style="padding: 10px;">{{$routine->exam_time}}</td> --}}
                </tr>
                @for ($i=1;$i<$routine->exam_duties_count;$i++)
                    <tr>
                        <td>{{$routine->exam_duties[$i]->teacher->name}}</td>
                        <td style="padding: 10px;"></td>
                    </tr>
                @endfor
                @endforeach
            </tbody>
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
