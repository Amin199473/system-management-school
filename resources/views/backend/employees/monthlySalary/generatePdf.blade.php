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

    <h1>Employee Monthly Salary </h1>
    <h1>Month:{{ date('Y-M',strtotime($details[0]->date)) }} </h1>

    <table id="customers">
        <tr>
            <th>SL</th>
            <th>Details</th>
            <th>Info</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Employee Name</td>
            <td>{{ $details[0]->user->name }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Employee ID NO</td>
            <td>{{ $details[0]->user->id_no }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Per Day Salary</td>
            <td>{{ $salaryPerDay }}$</td>
        </tr>
        <tr>
            <td>4</td>
            <td>basic monthly Salary</td>
            <td>{{ $details[0]->user->salary  }}$</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Total Absent for this month</td>
            <td>{{ $absentCount }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>total Salary decrease</td>
            <td>{{ $totalSalaryMinus }}$</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Salary for this Month</td>
            <td>{{ $totalSalary }}$</td>
        </tr>
    </table>
    <i style="font-size: 10px">Print Data :{{ date('Y M D') }}</i>
</body>

</html>
