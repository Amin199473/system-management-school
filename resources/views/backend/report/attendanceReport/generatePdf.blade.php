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

    <h1>Employee Attendance Report </h1>
    <h3>Employee Name : {{$singleAttendance[0]['user']['name']}}</h3>
    <h3>Employee ID No: {{$singleAttendance[0]['user']['id_no']}}</h3>
    <h3>Month:{{$month}} </h3>

    <table id="customers">

        <tr>
            <td width="50%"><h4>Date</h4></td>
            <td width="50%"><h4>Attendance Status</h4></td>
        </tr>
        @foreach ($singleAttendance as $key=>$value )
        <tr>
            <td width="50%">{{date('d-m-Y',strtotime($value->date))}}</td>
            <td width="50%">{{$value->attendance_status}}</td>
        </tr>
        @endforeach

        <tr>
            <td colspan="2">
                <strong>Total Absents: {{$absents}} </strong>
                <br>
                <br>
                <strong>Total Leave: {{$leaves}} </strong>
            </td>
        </tr>
    </table>
    <i style="font-size: 10px">Print Data :{{ date('Y M D') }}</i>
</body>

</html>
