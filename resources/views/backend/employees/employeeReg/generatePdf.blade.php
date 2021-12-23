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

    <h1>Employee Information Details</h1>

    <table id="customers">
        <tr>
            <th>SL</th>
            <th>Student Details</th>
            <th>Student Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Employee Name</td>
            <td>{{ $employee->name }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Employee ID NO</td>
            <td>{{ $employee->id_no }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Father Name</td>
            <td>{{ $employee->father_name }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Mother Name</td>
            <td>{{ $employee->mother_name }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Mobile</td>
            <td>{{ $employee->mobile }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Address</td>
            <td>{{ $employee->address }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Gender</td>
            <td>{{ $employee->gender }}</td>
        </tr>
        <tr>
            <td>8</td>
            <td>Religion</td>
            <td>{{ $employee->religion }}</td>
        </tr>
        <tr>
            <td>9</td>
            <td>Date Of Birth</td>
            <td>{{date('d-m-Y',strtotime($employee->date_of_birth)) }}</td>
        </tr>
        <tr>
            <td>10</td>
            <td>Join Date</td>
            <td>{{ date('d-m-Y',strtotime($employee->join_date)) }}</td>
        </tr>
        <tr>
            <td>11</td>
            <td>Designation</td>
            <td>{{ $employee->designation->name }}</td>
        </tr>
        <tr>
            <td>12</td>
            <td>Salary</td>
            <td>{{ $employee->salary}}$</td>
        </tr>
    </table>
    <i style="font-size: 10px">Print Data :{{ date('Y M D') }}</i>
</body>

</html>
