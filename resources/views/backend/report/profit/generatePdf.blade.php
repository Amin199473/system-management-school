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
    @php

    @endphp
    <h1>Monthly-Yearly Reports Profit</h1>

    <table id="customers">
        <tr>
            <td colspan="2" style="text-align: center">
                <h4>Report Date: {{date('d M Y',strtotime($sdate))}} - {{date('d M Y',strtotime($edate))}}</h4>
            </td>
        </tr>
        <tr>
            <td width="50%"><h4>Purpose</h4></td>
            <td width="50%"><h4>Amount</h4></td>
        </tr>
        <tr>
            <td>Student Fee</td>
            <td>{{$student_fee}}$</td>
        </tr>
        <tr>
            <td>Employee Salary</td>
            <td>{{$emp_salary}}$</td>
        </tr>
        <tr>
            <td>Other Cost</td>
            <td>{{ $other_cost}}$</td>
        </tr>
        <tr>
            <td>Total Cost</td>
            <td>{{ $total_cost}}$</td>
        </tr>
        <tr>
            <td>Profit</td>
            <td>{{ $profit }}$</td>
        </tr>
    </table>
    <i style="font-size: 10px">Print Data :{{ date('Y M D') }}</i>

    <hr style="border: dashed 2px; width:95%; color:#000; margin-top:50px">
</body>

</html>
