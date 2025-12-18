<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Notice - {{ $refund->acknowledgement_no ?? 'N/A' }}</title>
    <style>
        html, body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.6;
            max-width: 800px;
            margin: 10px auto;
          
        }

        html {
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
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
            font-weight: bold;
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
        }
        
        .notice-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .content {
            text-align: justify;
            margin-bottom: 15px;
        }
        
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-left {
            width: 300px;
        }
        
        .signature-right {
            text-align: right;
            margin-right: 50px;
        }
        
        .signature-right img {
            width: 80px;
            height: auto;
        }
    </style>
</head>
<body>
      <div style="margin-bottom: 20px;">
            <table>

        <tr>
            <td width="30%" style="text-align: center; vertical-align: middle;">
                     <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Logo" class="logo" style="display: block; margin: 0 auto;">
            </td>
            <td  style="text-align: left; vertical-align: middle; border-left: 1px solid #000;">
                <h2 style="margin-bottom: 0;">
                    {{ strtoupper('NAVSARI CYBER CRIME POLICE STATION') }}
                </h2>
                Mota Bazar, Navsari–396445, Gujarat<br>
                Ph.+91 6359626594 / Email ID: pi-cyber-nav@gujarat.gov.in
            </td>
        </tr>
    </table>
    
    <div class="container">
        <div style="text-align: right; margin-bottom: 20px;">
            Date: {{ date('d/m/Y') }}
        </div>
        
        <div style="margin-bottom: 20px;">
            <strong>To</strong><br>
            <strong>{{ $refund->suspect_bank_account_name ?? 'Bank Name' }}</strong><br>
            <strong>Nodal Officer</strong>
        </div>
        
       
        
        <div style="margin-bottom: 20px;">
            <h4>Subject: - Intimation Notice Regarding Pending Court Orders for {{ $refund->acknowledgement_no ?? 'N/A' }} for the case of {{ $refund->applicant_name ?? 'N/A' }}.</h4>
        </div>
        
        <div class="content">
            <p>Dear Sir/Madam,</p>
            
            <p>We respectfully inform you that despite repeated reminders and submissions made to your bank, we have observed that the court order has not been complied with, even though clear instructions were provided in the court's ruling. Furthermore, numerous complaints have been received from citizens of the state regarding this matter.</p>
            
            <p>As the Police Inspector, Navsari Cyber Crime Police Station, Gujarat, we hereby notify you that the list detailing non-compliance with the court order, along with all relevant information, is enclosed. Please refer to the detailed list provided below details for complete case-wise information.</p>
        </div>
        
        <div style="margin-bottom: 20px;">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
                <thead>
                    <thead>
                        <th style="padding: 2px;vertical-align: middle;text-align: center;">Sr. No.</th>
                        <th style="padding: 2px;vertical-align: middle;text-align: center;">Account Number</th>
                       
                        <th style="padding: 2px;vertical-align: middle;text-align: center;">Amount</th>
                        </thead>
              
                </thead>
                <tbody>
                    @foreach($relatedRefunds as $index => $relatedRefund)
                        <tr>
                            <td style="padding: 2px;vertical-align: middle;text-align: center;">{{ $index + 1 }}</td>
                            <td style="padding: 2px;vertical-align: middle;text-align: center;">{{ $relatedRefund->suspect_account_number ?? 'N/A' }}</td>
                          
                            <td style="padding: 2px;vertical-align: middle;text-align: center;">{{ $relatedRefund->amount ?  'INR ' . number_format($relatedRefund->amount, 2) : 'N/A' }}</td>
                     
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="content">
            <p>We urge you to comply with the court order immediately within 10 days from the date of this notice.</p>
            
            <p>Failure to comply with the court order or provide a response will be considered your fault, and legal actions will be initiated against your institution. Be advised that such failure may result in serious consequences, including legal penalties and significant reputational damage to your institution.</p>
            
            <p>We request that you take immediate steps to comply with the court's order. If your bank fails to comply with the court order after receiving the full instructions and specific directions, legal action will be taken under Sections 222 and 223 of the BNS Act, as outlined below:</p>
            
            <ul>
                <li><strong>Section 222:</strong> Neglect to assist a public servant when legally obligated to do so.</li>
                <li><strong>Section 223:</strong> Disobedience of a lawful order issued by a public servant.</li>
            </ul>
            
            <p><strong>Contempt of Courts Act 1971:</strong></p>
            
            <p>If a bank fails to comply with a court order, it may be held liable for Contempt of Court under the Contempt of Courts Act, 1971. Specifically:</p>
            
            <ul>
                <li><strong>Section 2(b)</strong> defines "civil contempt" as the willful disobedience of any judgment, decree, direction, order, writ, or other process of a court.</li>
                <li><strong>Section 12</strong> outlines the punishment for contempt of court, which may include fines or imprisonment.</li>
            </ul>
            
            <p>We hope that this matter will be resolved promptly to avoid further legal consequences. We kindly request that you take this matter seriously and act in accordance with the law. Your cooperation in resolving this issue swiftly is necessary to prevent further escalation.</p>
            
            <p>Thank you.</p>
        </div>
        
        <table style="width:100%; border:none; margin-top: 30px;">
            <tr>
                <td style="width:50%; border:none; text-align:left; vertical-align:bottom;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/seal.png'))) }}" alt="Seal" style="width: 80px; height: auto;">
                </td>
                <td style="width:50%; border:none; text-align:right; vertical-align:bottom;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/sign.png'))) }}" alt="UL Modi" style="width: 80px; height: auto;"><br>
                    <strong>
                        (U. L. Modi)<br>
                        Police Inspector<br>
                        Cyber Crime Police Station<br>
                        Navsari
                    </strong>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>

