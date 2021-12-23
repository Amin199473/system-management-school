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

    <h1>User Information Details</h1>

    <table id="customers">
        <tr>
            <th>SL</th>
            <th>Student Details</th>
            <th>Student Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Student ID NO</td>
            <td>{{ $assignStudent->student->id_no }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Roll</td>
            <td>{{ $assignStudent->roll }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Student Name</td>
            <td>{{ $assignStudent->student->name }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Father Name</td>
            <td>{{ $assignStudent->student->father_name }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Mother Name</td>
            <td>{{ $assignStudent->student->mother_name }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Mobile</td>
            <td>{{ $assignStudent->student->mobile }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Address</td>
            <td>{{ $assignStudent->student->address }}</td>
        </tr>
        <tr>
            <td>8</td>
            <td>Gender</td>
            <td>{{ $assignStudent->student->gender }}</td>
        </tr>
        <tr>
            <td>9</td>
            <td>Religion</td>
            <td>{{ $assignStudent->student->religion }}</td>
        </tr>
        <tr>
            <td>10</td>
            <td>Date Of Birth</td>
            <td>{{ $assignStudent->student->date_of_birth }}</td>
        </tr>
        <tr>
            <td>11</td>
            <td>Discount</td>
            <td>{{ $assignStudent->discount->discount }} %</td>
        </tr>
        <tr>
            <td>12</td>
            <td>Year</td>
            <td>{{ $assignStudent->year->name }}</td>
        </tr>
        <tr>
            <td>13</td>
            <td>Class</td>
            <td>{{ $assignStudent->class->name }}</td>
        </tr>
        <tr>
            <td>14</td>
            <td>group</td>
            <td>{{ $assignStudent->group->name }}</td>
        </tr>
        <tr>
            <td>15</td>
            <td>shift</td>
            <td>{{ $assignStudent->shift->name }}</td>
        </tr>
    </table>
    <i style="font-size: 10px">Print Data :{{ date('Y M D') }}</i>
</body>

</html>
