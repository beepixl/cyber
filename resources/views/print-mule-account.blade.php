<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <style>
        html,body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.6;
        }

        html{
            padding: 10px;
        }
        .header {
            text-align: center;
          
            display: flex;
            justify-content: space-between;

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
        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
            font-size: 14px;
            font-weight:bold;
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
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
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
        .table th, .table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        .note {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body onload="window.print()">
    <table>
        <tr style="border:none; text-align:center">
            <td style="text-align: center; vertical-align: middle; border:none">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Logo" class="logo" style="display: block; margin: 0 auto;">
            </td>
            <td style="border:none; text-align:center">
                <h2>
                  
                 NAVSARI CYBER CRIME POLICE STATION
                </h2>
                                          
                        Mota Bazar,Navsari–396445,Gujarat<br>
                        Ph.+91 6359626594 / Email ID: pso-cyber-nav@gujarat.gov.in
                    
            </td>
        </tr>
    </table>
    <div class="container">
        <div class="header">
            <div style="float: left;">Outward No: {{ $muleAccount[0]->outward_no }}/2025</div>
            <div style="float: right;">Date: {{ date('d/m/Y') }}</div>
        </div>
        <div class="notice-title">Notice U/S 94 of BNSS 2023</div>
        <div>
            To, <br>
            The Branch Manager/Nodal Officer<br>
            {{ $muleAccount[0]->nodal_officer }}<br>
            {{ $muleAccount[0]->bank_branch ?? '' }}
        </div>
        <div style="margin-top: 15px; text-align: center;">
            <strong class="notice-title">Sub: Provide complete details of Bank Account Numbers</strong>
        </div>
        <div style="margin-top: 15px;">
            Complaints has been registered at the Cyber Crime Police Station Navsari. During the inquiry, we found some bank accounts in which some fraud transactions has been done.
        </div>
        <table class="table">
            <thead>
                <tr>
                  
                    <th>Account Number</th>
                    <th>IFSC Code</th>
                  
                   
                    
                </tr>
            </thead>
            <tbody>
            @foreach ($muleAccount as $account)
                <tr>
                    <td>{{ $account->account_no }}</td>
                    <td>{{ $account->ifsc_code }}</td>
          
                </tr>
            @endforeach
             
            </tbody>
        </table>
        <div>
            You are requested to provide below mentioned details of the above accounts:
            <ol>
                <li>Complete AOF and KYC documents.</li>
                <li>Account Statement from Account opening date to till date.</li>
                <li>Provide A/c linked Aadhar, PAN, and Mobile Number, Email ID.</li>
                <li>ATM/Credit card number related to the account. Provide the delivery address of the ATM/Credit Card.</li>
                <li>IP login log of Above mention account from Account opening date to till date.</li>
                <li>Any other account number of the account holder in your Branch/bank (account holder's Aadhar/PAN/Mobile number linked account numbers).</li>
                <li>Kindly provide the available balance.</li>
                <li>Mobile number and Email ID changing history (means how many times mobile no. and email ID change).</li>
                <li>Any other important information you have.</li>
            </ol>
        </div>
        <div class="note">
            <strong>Note-</strong>
            <ol>
                <li>Please provide the bank manager's name, email id, and mobile number immediately.</li>
                <li>Send the details immediately what you have right now. For the remaining details, you can take your time and send them later.</li>
            </ol>
        </div>
    </div>
   
    
    <div style="display: flex;">
        <div style="text-align:left;width: 300px;margin-left: 250px;">
            
     
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/seal.png'))) }}" alt="UL Modi" style="width: 80px; height: auto;float: left;">
        
        </div>
        <div style="float: right;margin-right: 50px;">
           
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/sign.png'))) }}" alt="UL Modi" style="width: 80px; height: auto;"><br>
         
            <strong>
              U.L. Modi<br>
                Police Inspector<br>
              Cyber Crime Police Station<br>
             Navsari–396445
            </strong>
        </div>
    </div>
</body>
</html>
