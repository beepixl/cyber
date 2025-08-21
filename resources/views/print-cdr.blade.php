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
       
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
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
            border: 1px solid #fff;
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
<body>
 
    <div class="container">
    <div class="text-center">
            <h2>
                  
                  <u>Annexure IX</u>
  
  
                  </h2>
                  Proforma to seek Call Data/Detail Record<br>
                  (Request u/s 95 of BNSS 2023)
            </div>
   
       
            <style>
    .letter-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        font-family: Arial, sans-serif;
        font-size: 14px;
        margin-bottom: 10px;
    }
    .header-left {
        max-width: 60%;
    }
    .header-right {
        text-align: left;
    }
</style>

<div class="letter-header">
    <div class="header-left">
        To, <br>
        The Nodal Officer<br>
        {{ $cdr->nodal_officer }}
    </div>
    <div class="header-right">
        Outward No: {{ $cdr->outward_no }}<br>
        {{ $cdr->police_station }} Police Station<br>
        Date:<td>{{ \Carbon\Carbon::parse($cdr->date)->format('d/m/Y') }}</td>

    </div>
</div>
        <div style="margin-top: 15px; text-align: center;">
            <u><strong class="notice-title">Sub: Request to provide SDR, CDR and CAF</strong></u>
        </div>
        <div style="margin-top: 15px;">
        Please provide the Subscriber Details Record (SDR), Call Details Records (CDR) and Customer Acquisition Form (CAF) of the following mobile numbers:
        </div>
        <table class="table">
            <thead>
           
    <tr >
        <th rowspan="2" style="text-align:center">S. no</th>
        <th rowspan="2" style="text-align:center">Mobile/IMEI No.</th>
        <th colspan="2" style="text-align:center">Period</th>
        <th rowspan="2" style="text-align:center">FIR /case No.</th>
    </tr>
    <tr >
        <th style="text-align:center">From</th>
        <th style="text-align:center">To</th>
    </tr>
    <tr>
    <td style="text-align: center;">1</td>
                
    <td style="text-align: center;">
    {!! nl2br(e(
        collect(explode("\n", $cdr->mobile_or_imei_no))
            ->map(fn($line) => trim($line) . ' (CAF)')
            ->implode("\n")
    )) !!}
</td>


                
              
        
<td style="text-align: center;">{{ \Carbon\Carbon::parse($cdr->period_from)->format('d/m/Y') }}</td>
<td style="text-align: center;">{{ \Carbon\Carbon::parse($cdr->period_to)->format('d/m/Y') }}</td>

<td style="text-align: center;">{{ $cdr->fir_or_case_no }}</td>
    </tr>
          
                </tr>

             
            </tbody>
        </table>
        <div>
        <table cellspacing="0" cellpadding="6" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 14px;">
    <tr>
        <td colspan="2" style="font-weight: bold; padding-bottom: 8px;">Certificate</td>
    </tr>
    <tr>
    <td colspan="2" style="text-align: justify;">
        <ol style="margin: 0; padding-left: 18px;">
            <li>The subscriber identity has been ascertained and it is ensured that the person in question is not someone whose call details are of a sensitive nature.</li>
            <li>The number is not subscribed in the name of a sitting MP/MLAsss.</li>
        </ol>
    </td>
</tr>


    <tr><td colspan="2" style="height: 15px;"></td></tr>

    <tr>
        <td>Signature of the SHO :</td>
        <td>................................</td>
    </tr>
    <tr>
        <td>Name of the SHO :</td>
        <td>{{ $cdr->sho }}</td>
    </tr>
    <tr>
        <td>Designation of the SHO :</td>
        <td>Police Inspector</td>
    </tr>
    <tr>
        <td>Contact Details of the SHO :</td>
        <td>{{ $cdr->contact_sho }}</td>
    </tr>

    <tr><td colspan="2" style="height: 15px;"></td></tr>

    <tr>
        <td>Signature of the Authorized officer :</td>
        <td>.................................</td>
    </tr>
    <tr>
        <td>Name of the Authorized officer :</td>
        <td>{{ $cdr->officer }}</td>
    </tr>
    <tr>
        <td>Designation of the Authorized Officer :</td>
        <td>Dy. SP, Navsari Division, Navsari</td>
    </tr>

    <tr><td colspan="2" style="height: 15px;"></td></tr>

    <tr colspan="2">
        <td>Place : NAVSARI</td>
    <tr colspan="2">
        <td> Date : {{ \Carbon\Carbon::parse($cdr->date)->format('d/m/Y') }}</td>

    </tr>
</table>



      
    </div>
</body>
</html>
