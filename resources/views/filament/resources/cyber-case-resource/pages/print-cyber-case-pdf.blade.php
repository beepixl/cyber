<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NCCRP No:{{ $case->nccrp_no }} - ACK No:{{ $case->acknowledgement_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
            text-transform: uppercase;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 80px;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .label {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .logo {

            max-height: 200px;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body>


    <table>
        <tr>
            <td width="30%" style="text-align: center; vertical-align: middle;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}"
                    alt="Logo" class="logo" style="display: block; margin: 0 auto;">
            </td>
            <td>
                <h1 class="text-center">CYBER CRIME POLICE STATION NAVSARI</h1>
                <p>
                    B/h Navsari Town Police Station, Mota Bazar, Navsari – 396445, Gujarat<br>
                    Ph. +91 6359626594<br>
                    Email ID: pi-cyber-nav@gujarat.gov.in
                </p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="label" width="40%">Acknowledgement No:</td>
            <td>{{ $case->acknowledgement_no }}</td>
        </tr>
        <tr>
            <td class="label">NCCRP No:</td>
            <td>{{ $case->nccrp_no }}</td>
        </tr>
        <tr>
            <td class="label">Application Date:</td>
            <td>{{ $case->application_date->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
            <td class="label">Name:</td>
            <td>{{ $case->complainant_name }}</td>
        </tr>
        <tr>
            <td class="label">Mobile:</td>
            <td>{{ $case->complainant_mobile }}</td>
        </tr>
        <tr>
            <td class="label">Email:</td>
            <td>{{ $case->complainant_email }}</td>
        </tr>
        <tr>
            <td class="label">Pincode:</td>
            <td>{{ $case->complainant_pincode }}</td>
        </tr>
        <tr>
            <td class="label">Address:</td>
            <td>{{ $case->complainant_address }}</td>
        </tr>
        <tr>
            <td class="label">Police Station:</td>
            <td>{{ $case->police_station }}</td>
        </tr>
        <tr>
            <td class="label">Fraud Amount:</td>
            <td>{{ $case->fraud_amount }}</td>
        </tr>
        <tr>
            <td class="label">Fraud Amount:</td>
            <td>{{ $case->fraud_amount }}</td>
        </tr>
        <tr>
            <td class="label">Lean Amount:</td>
            <td>{{ $case->lean_amount }}</td>
        </tr>
        <tr>
            <td class="label">Category:</td>
            <td>{{ $case->category }}</td>
        </tr>
        <tr>
            <td class="label">Sub Category:</td>
            <td>{{ $case->sub_category }}</td>
        </tr>
        <tr>
            <td class="label">Status:</td>
            <td>{{ $case->status }}</td>
        </tr>
    </table>
</body>

</html>
