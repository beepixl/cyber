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
            font-size: 12px;

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
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 2px;
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

            max-height: 100px;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>

    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .notice-title {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;

        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        .note {
            margin-top: 20px;
            font-style: italic;
        }

        </head><body><table><tr style="border:none"><td width="30%" style="text-align: center; vertical-align: middle;border:none"><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Logo" class="logo" style="display: block; margin: 0 auto;"></td><td style="border:none"><h2>CYBER CRIME POLICE STATION NAVSARI</h2><p>B/h Navsari Town Police Station,
        Mota Bazar,
        Navsari – 396445,
        Gujarat<br>Ph.+91 6359626594 / Email ID: pi-cyber-nav@gujarat.gov.in </p></td></tr></table><div class="container"><div class="header"><div style="float: left;">Outward No: {{ $case->outward_no }}/2025</div><div style="float: right;">Date: {{ date('d/m/Y') }}</div></div><div class="notice-title">Notice U/S 94 of BNSS 2023</div><div>To, <br>The Nodal Officer<br>@if ($case->nodal_officer){{ $case->nodal_officer }} @else {{ $case->bank_name }} @endif</div><div style="margin-top: 15px; text-align: center;"><strong class="notice-title">Sub: Provide complete details of Bank Account Numbers</strong></div><div style="margin-top: 15px;">Complaint No. <strong>{{ $case->acknowledgement_no }}</strong> has been registered at the Cyber Crime Police Station Navsari. During the inquiry, we found some bank accounts in which some fraud transactions has been done. </div><table class="table"><thead><tr><th>{{ $case->info_type }}</th><th>Other Details</th></tr></thead><tbody><tr><td>{{ $case->to_account_id }}</td><td>{{ $case->ifsc_code }} {!! $case->remarks !!}</td></tr></tbody></table><div>You are requested to provide below mentioned details of the above accounts: <ol><li>Complete AOF and KYC documents.</li><li>Account Statement from Account opening date to till date.</li><li>Provide A/c linked Aadhar, PAN, and Mobile Number, Email ID.</li><li>ATM/Credit card number related to the account. Provide the delivery address of the ATM/Credit Card.</li><li>IP login log of Above mention account from Account opening date to till date.</li><li>Any other account number of the account holder in your Branch/bank (account holder's Aadhar/PAN/Mobile number linked account numbers).</li>
 <li>Kindly provide the available balance.</li> <li>Mobile number and Email ID changing history (means how many times mobile no. and email ID change).</li> <li>Any other important information you have.</li> </ol> </div> <div class="note"> <strong>Note-</strong> <ol> <li>Please provide the bank manager's name, email id, and mobile number immediately.</li>
 <li>Send the details immediately what you have right now. For the remaining details, you can take your time and send them later.</li> </ol> </div> </div> <div style="display: flex;"> <p style="text-align: left;"> <div style="text-align:left;width: 300px;margin-left: 250px;"> <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/seal.png'))) }}" alt="UL Modi" style="width: 80px; height: auto;float: left;"> </div> <div style="float: right;margin-right: 50px;"> <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/sign.png'))) }}" alt="UL Modi" style="width: 80px; height: auto;"><br> <strong>(U.L. Modi)<br> Police Inspector<br> Cyber Crime Police Station<br> Navsari</strong> </p> </div> </div> </body> </html>
