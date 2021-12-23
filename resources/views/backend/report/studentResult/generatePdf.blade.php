<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

    </style>
</head>

<body>

    <h1>Student Results Report</h1>

    @foreach ($allData as $data)
        <table id="customers">
            <tr>
                <td>Student ID</td>
                <td>{{ $data->student->id_no }}</td>
            </tr>
            <tr>
                <td>Roll No</td>
                @php
                    $Roll_no = App\models\AssignStudent::where('student_id', $data->student_id)->first();
                @endphp
                <td>{{ $Roll_no->roll }}</td>
            </tr>
            <tr>
                <td>Student Name</td>
                <td>{{ $data->student->name }}</td>
            </tr>
            <tr>
                <td>Class</td>
                <td>{{ $data->class->name }}</td>
            </tr>
            <tr>
                <td>Session</td>
                <td>{{ $data->year->name }}</td>
            </tr>
            @php
                $allMarks = App\Models\StudentMarks::with(['assign_subject', 'year'])
                    ->where('year_id', $data->year_id)
                    ->where('class_id', $data->class_id)
                    ->where('exam_type_id', $data->exam_type_id)
                    ->where('id_no', $data->id_no)
                    ->get();
                $total_marks = 0;
                $total_point = 0;
            @endphp
            @foreach ($allMarks as $key => $mark)
                @php
                    $get_mark = $mark->marks;
                    $total_marks = (float) $total_marks + (float) $get_mark;

                    $total_subject = App\Models\StudentMarks::where('year_id', $mark->year_id)
                        ->where('class_id', $mark->class_id)
                        ->where('exam_type_id', $mark->exam_type_id)
                        ->where('student_id', $mark->student_id)
                        ->get()
                        ->count();
                    $grade_marks = App\Models\MarksGrade::where([['start_marks', '<=', (int) $get_mark], ['end_marks', '>=', (int) $get_mark]])->first();
                    $grade_name = $grade_marks->grade_name;
                    $grade_point = number_format((float) $grade_marks->grade_point, 2);
                    $total_point = (float) $total_point + (float) $grade_point;
                @endphp
                <tr>
                    <td>get Mark</td>
                    <td>{{ $get_mark }}</td>
                </tr>
                <tr>
                    <td>Letter Grade</td>
                    <td>{{ $grade_name }}</td>
                </tr>
                <tr>
                    <td>Grade Point</td>
                    <td>{{ $grade_point }}</td>
                </tr>

            @endforeach
            <tr>
                <td>Total Maks</td>
                <td>{{ $total_marks }}</td>
            </tr>

            @php
                $count_fail = App\models\StudentMarks::where('year_id',$data->year_id)
                ->where('class_id', $data->class_id)
                ->where('exam_type_id', $data->exam_type_id)
                ->where('id_no', $data->id_no)
                ->where('marks', '<', '33')
                ->get()->count();
                $total_grade = 0;

                $point_for_letter_grade = (float) $total_point / (float) $total_subject;
                $total_grade = App\Models\MarksGrade::where([['start_point', '<=', (int) $point_for_letter_grade], ['end_point', '>=', (int) $point_for_letter_grade]])->first();

                $grade_point_avg = (float) $total_point / (float) $total_subject;
            @endphp
            <tr>
                <td>Grade Point Average</td>
                <td>
                    @if ($count_fail > 0)
                        0.00
                    @else
                        {{ number_format((float) $grade_point_avg, 2) }}
                    @endif
                </td>
            </tr>

            <tr>
                <td>Letter Grade </td>
                <td>
                    @if ($count_fail > 0)
                        F
                    @else
                        {{ $total_grade->grade_name }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Total Marks with Fraction</td>
                <td>{{ $total_marks }}</td>
            </tr>
            <tr>
                <td><strong>Remark</strong></td>
                <td>
                    @if ($count_fail > 0)
                    <strong> Fail</strong>
                    @else
                        {{ $total_grade->remarks }}
                    @endif
                </td>
            </tr>
        </table>
        <br><br>
    @endforeach

    <i style="font-size: 10px">Print Data :{{ date('Y M D') }}</i>

    <hr style="border: dashed 2px; width:95%; color:#000; margin-top:50px">
</body>

</html>
