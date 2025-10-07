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
            font-size: 14px;
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
<body onload="window.print()">
 
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
        {{ $ipdr->nodal_officer }}
        
    
    </div>
    <div class="header-right">
        Outward No: {{ $ipdr->outward_no }}<br>
        {{ $ipdr->police_station }} Police Station<br>
        Date:<td>{{ \Carbon\Carbon::parse($ipdr->date)->format('d/m/Y') }}</td>

    </div>
</div>
        <div style="margin-top: 15px; text-align: center;">
            Ref: {{ $ipdr->fir_or_case_no }} Dated {{ \Carbon\Carbon::parse($ipdr->date)->format('d/m/Y') }} Registered at {{ $ipdr->police_station }} Police Station, Navsari, Gujarat, India
        </div>
        <div style="margin-top: 15px;">
        Please provide the IP Detail Record (IPDR) of the following destination IP:
        </div>
        <table class="table">
            <thead>
            <tr> 
                <th rowspan="2" style="text-align:center">IP TYPE</th> 
                <th rowspan="2" style="text-align:center">IP Address</th>
                <th  style="text-align:center">FDATE</th>
                <th rowspan="2" style="text-align:center">FTIME</th> 
                <th style="text-align:center">TDATE</th> <th rowspan="2" style="text-align:center">TTIME</th> 
            </tr>
            </thead>
            <tbody>
  @php
    $entries = is_array($ipdr->entries) ? $ipdr->entries : json_decode($ipdr->entries, true);
    $isJio = ($ipdr->nodal_officer ?? '') === 'RELIANCE JIO';
@endphp

@if($entries)
    @foreach($entries as $index => $entry)
        @php
            // Parse UTC and shift to IST
            $datetime = \Carbon\Carbon::parse($entry['timestamp_utc'], 'UTC')->setTimezone('Asia/Kolkata');

            // FTIME -1 min, TTIME +1 min
            $ftimeObj = $datetime->copy()->subMinutes(1);
            $ttimeObj = $datetime->copy()->addMinutes(1);

            if ($isJio) {
                // JIO format
                $fromDate = $datetime->format('Ymd'); 
                $toDate   = $datetime->format('Ymd'); 
                $ftime    = $ftimeObj->format('His');
                $ttime    = $ttimeObj->format('His');
            } else {
                // Other operators format
                $fromDate = $ftimeObj->format('d/m/y'); 
                $toDate   = $ttimeObj->format('d/m/y'); 
                $ftime    = $ftimeObj->format('H:i:s');
                $ttime    = $ttimeObj->format('H:i:s');
            }
        @endphp

        <tr>
            <!-- <td style="text-align: center;">{{ $index + 1 }}</td> -->
            <td style="text-align: center;">{{ $entry['iptype'] ?? '-' }}</td>
            <td style="text-align: center;">{{ $entry['ipaddress'] ?? '-' }}</td>

            {{-- From Date --}}
            <td style="text-align: center;">{{ $fromDate }}</td>
         

            {{-- FTIME --}}
            <td style="text-align: center;">{{ $ftime }}</td>
            {{-- To Date again --}}
            <td style="text-align: center;">{{ $toDate }}</td>
            {{-- TTIME --}}
            <td style="text-align: center;">{{ $ttime }}</td>
        </tr>
    @endforeach
@endif


             
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
        <td>{{ $ipdr->sho }}</td>
    </tr>
    <tr>
        <td>Designation of the SHO :</td>
        <td>Police Inspector</td>
    </tr>
    <tr>
        <td>Contact Details of the SHO :</td>
        <td>{{ $ipdr->contact_sho }}</td>
    </tr>

    <tr><td colspan="2" style="height: 15px;"></td></tr>

    <tr>
        <td>Signature of the Authorized officer :</td>
        <td>.................................</td>
    </tr>
    <tr>
        <td>Name of the Authorized officer :</td>
        <td>{{ $ipdr->officer }}</td>
    </tr>
    <tr>
        <td>Designation of the Authorized Officer :</td>
        <td>Dy. SP, Navsari Division, Navsari</td>
    </tr>

    <tr><td colspan="2" style="height: 15px;"></td></tr>

    <tr colspan="2">
        <td>Place : NAVSARI</td>
    <tr colspan="2">
        <td> Date : {{ \Carbon\Carbon::parse($ipdr->date)->format('d/m/Y') }}</td>

    </tr>
</table>



      
    </div>
</body>
</html>
