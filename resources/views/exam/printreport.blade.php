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
            <img src="img/logo.png"
                alt="logo"
                width="100"
            >
            <h4>Faridpur Enginnering College, Faridpur</h4>
            <p>{{date("d/m/Y",strtotime($from))}} to {{date("d/m/Y",strtotime($to))}}</p>
        </div>
        <table border="1"
            style="font-size:10px;width:100%;border-collapse:collapse;text-align:center;margin:15px 10px;">
            @foreach ($depts as $dept)

                <tr>
                    <th style="padding: 10px;" colspan="2">Department of {{$dept->name}}</th>
                </tr>
                <tr>
                    <th style="padding: 10px;">Name / Designation</th>
                    <th style="padding: 10px;">Number of
                        @if ($type==1)
                        Invisilation
                        @else
                        Supervision
                        @endif
                    </th>
                </tr>

                @foreach ($dept->teachers as $teacher)
                <tr>
                    <td style="padding: 10px;">
                        {{$teacher->name}}<br>
                        {{$teacher->title}}
                    </th>
                    <td style="padding: 10px;">
                        @if ($type==1)


                        {{
                            // \App\Models\Teacher::withCount("invigilation_duties"=>function($query) use ($from,$to) {
                            //     $query->whereBetween("exam_date",[$from,$to]);
                            // })->where("id",$teacher->id)->first()->invigilation_duties_count
                            $teacher->invigilation_duties()->whereBetween("exam_date",[$from,$to])->count()
                        }}
                        @else
                        {{
                            // \App\Models\Teacher::withCount("supervising_duties"=>function($query) use ($from,$to) {
                            //     $query->whereBetween("exam_date",[$from,$to]);
                            // })->where("id",$teacher->id)->first()->invigilation_duties_count


                            $teacher->supervising_duties()->whereBetween("exam_date",[$from,$to])->count()
                        }}
                        @endif
                    </th>
                    {{-- <th style="padding: 10px;">Exam Time</th> --}}
                </tr>
                @endforeach

            @endforeach
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
