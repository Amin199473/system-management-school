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
    <h1>User Exam Fee Details</h1>

    <table id="customers">
        <tr>
            <th>SL</th>
            <th>Student Details</th>
            <th>Student Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Student Name</td>
            <td>{{ $assignStudent->student->name }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Student ID NO</td>
            <td>{{ $assignStudent->student->id_no }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Roll</td>
            <td>{{ $assignStudent->roll }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Father Name</td>
            <td>{{ $assignStudent->student->father_name }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Year</td>
            <td>{{ $assignStudent->year->name }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Class</td>
            <td>{{ $assignStudent->class->name }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>group</td>
            <td>{{ $assignStudent->group->name }}</td>
        </tr>
        <tr>
            <td>8</td>
            <td>shift</td>
            <td>{{ $assignStudent->shift->name }}</td>
        </tr>
        <tr>
            <td>9</td>
            <td>Exam Type  Fee</td>
            <td>{{ $originalfee }}</td>
        </tr>
        <tr>
            <td>10</td>
            <td>Discount</td>
            <td>{{ $assignStudent->discount->discount }}%</td>
        </tr>
        <tr>
            <td>11</td>
            <td>Discount Fee</td>
            <td>{{ $discounttablefee}}$</td>
        </tr>
        <tr>
            <td>12</td>
            <td>Fee For This Student of {{ $examType->name }}</td>
            <td>{{ $finalfee }}</td>
        </tr>
    </table>
    <i style="font-size: 10px">Print Data :{{ date('Y M D') }}</i>

    <hr style="border: dashed 2px; width:95%; color:#000; margin-top:50px">
</body>

</html>
