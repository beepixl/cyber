<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accused Profile Summary - {{ $accusedProfile->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
            text-align: left;
        }

        th {
            background-color: #fff;
            font-weight: bold;
        }

        .section-header {
            background-color: lightgrey;
            font-size: 16px;
            font-weight: bold;
            color: #000000;
        }

        img {
            max-height: 80px;
            border-radius: 4px;
        }
    </style>
</head>

<body>



    <table>
        <tbody>
            <tr>

                <td colspan="4">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <!-- Left Logo -->
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/nvscrime.png'))) }}"
                            alt="Left Logo" style="height: 80px;">

                        <!-- Center Text -->
                        <div style="text-align: center; flex: 1;">
                            <h1 style="margin: 0;">CYBER CRIME POLICE STATION NAVSARI</h1>
                            <p style="margin: 0;">
                                B/h Navsari Town Police Station, Mota Bazar, Navsari – 396445, Gujarat<br>
                                Ph. +91 6359626594<br>
                                Email ID: pi-cyber-nav@gujarat.gov.in
                            </p>
                        </div>

                        <!-- Right Logo -->
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}"
                            alt="Right Logo" style="height: 80px;">
                    </div>
                </td>


            </tr>
            <tr>
                <td colspan="4" class="section-header">
                    <h1>Accused Profile - {{ $accusedProfile->name }} (FIR No: {{ $accusedProfile->fir_no }})</h1>
                </td>
            </tr>
            <!-- Case Information -->
            <tr>
                <td colspan="4" class="section-header">Case Information</td>
            </tr>
            <tr>
                <th>Police Station</th>
                <td>{{ $accusedProfile->police_station }}</td>
                <th>Case Date</th>
                <td>{{ $accusedProfile->case_date?->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>State</th>
                <td>{{ $accusedProfile->state }}</td>
                <th>City</th>
                <td>{{ $accusedProfile->city }}</td>
            </tr>

            <tr>
                <th>Fraud Amount</th>
                <td>₹{{ number_format($accusedProfile->fraud_amount, 2) }}</td>
                <th>Victim Name</th>
                <td>{{ $accusedProfile->compliant_person }}</td>
            </tr>



            <!-- Personal Info -->
            <tr>
                <td colspan="4" class="section-header">Personal Information</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $accusedProfile->date_of_birth?->format('d/m/Y') }}</td>
                <th>Photos</th>
                <td>
                    @foreach ($accusedProfile->getMedia() as $media)
                        <img src="{{ $media->getUrl() }}" alt="Photo" style="max-width: 300px; height: auto;">
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Father's Name</th>
                <td>{{ $accusedProfile->fathers_name }}</td>
                <th>Mother's Name</th>
                <td>{{ $accusedProfile->mothers_name }}</td>


            </tr>

            <!-- Identification -->
            <tr>
                <td colspan="4" class="section-header">Identification</td>
            </tr>
            <tr>
                <th>Aadhar Number</th>
                <td>{{ $accusedProfile->aadhar_number }}</td>

                <th>PAN Number</th>
                <td>{{ $accusedProfile->pan_number }}</td>
            </tr>
            <tr>
                <th>GSTIN</th>
                <td>{{ $accusedProfile->gstin }}</td>
                <td></td>
                <td></td>
            </tr>

            <!-- Business Details -->
            <tr>
                <td colspan="4" class="section-header">Business Details</td>
            </tr>
            <tr>
                <th>Business Name</th>
                <td>{{ $accusedProfile->business_name }}</td>

                <th>Business Type</th>
                <td>{{ $accusedProfile->business_type }}</td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>{{ $accusedProfile->number }}</td>

                <th>Email</th>
                <td>{{ $accusedProfile->email }}</td>
            </tr>

            <!-- Accused Role -->
            <tr>
                <td colspan="4" class="section-header">Accused Role</td>
            </tr>
            <tr>
                <th>Role in Case</th>
                <td colspan="3">{{ $accusedProfile->accused_role }}</td>

            </tr>

            <!-- Bank Transactions -->
            <tr>
                <td colspan="4" class="section-header">Bank Transactions</td>
            </tr>
            <tr>
                <td colspan="4">
                    <table>
                        <thead>
                            <tr>
                                <th>Layer</th>
                                <th>Transaction Date</th>
                                <th>Amount</th>
                                <th>Dispute</th>
                                <th>Bank</th>
                                <th>Account No</th>
                                <th>IFSC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accusedProfile->bank_accounts ?? [] as $txn)
                                <tr>
                                    <td>{{ $txn['layer'] }}</td>
                                    <td>{{ $txn['transaction_date'] }}</td>
                                    <td>{{ $txn['transaction_amount'] }}</td>
                                    <td>{{ $txn['dispute_amount'] }}</td>
                                    <td>{{ $txn['bank_name'] }}</td>
                                    <td>{{ $txn['bank_account_no'] }}</td>
                                    <td>{{ $txn['ifsc'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Contact Information -->
            <tr>
                <td colspan="4" class="section-header">Contact Information</td>
            </tr>
            <tr>
                <td colspan="4">
                    <strong>Mobile Numbers</strong>
                    <table>
                        <thead>
                            <tr>
                                <th>Mobile</th>
                                <th>Remarks</th>
                                <th>From Where</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accusedProfile->mobile_numbers ?? [] as $mob)
                                <tr>
                                    <td>{{ $mob['mobile'] }}</td>
                                    <td>{{ $mob['remarks'] }}</td>
                                    <td>{{ $mob['from_where'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <strong>Email Addresses</strong>
                    <table>
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Remarks</th>
                                <th>From Where</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accusedProfile->email_addresses ?? [] as $email)
                                <tr>
                                    <td>{{ $email['email'] }}</td>
                                    <td>{{ $email['remarks'] }}</td>
                                    <td>{{ $email['from_where'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Locations -->
            <tr>
                <td colspan="4" class="section-header">Locations</td>
            </tr>
            <tr>
                <td colspan="4">
                    <table>
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>City</th>
                                <th>District</th>
                                <th>State</th>
                                <th>Remarks</th>
                                <th>From Where</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accusedProfile->locations ?? [] as $loc)
                                <tr>
                                    <td>{{ $loc['address'] }}</td>
                                    <td>{{ $loc['city'] }}</td>
                                    <td>{{ $loc['district'] }}</td>
                                    <td>{{ $loc['state'] }}</td>
                                    <td>{{ $loc['remarks'] }}</td>
                                    <td>{{ $loc['from_where'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Family Members -->
            <tr>
                <td colspan="4" class="section-header">Family Members</td>
            </tr>
            @foreach ($accusedProfile->familyMembers ?? [] as $member)
                <tr>
                    <td>{{ $member->relation }}</td>
                    <td>{{ $member->name }}</td>
                    <td>
                        @if ($member->getFirstMedia('family_member_photos'))
                            <img src="{{ $member->getFirstMedia('family_member_photos')->getUrl() }}"
                                alt="{{ $member->name }}">
                        @endif
                    </td>
                    <td>
                        Mobile: {{ $member->mobile_no }}
                        @if ($member->remarks)
                            <br>Remarks: {{ $member->remarks }}
                        @endif
                    </td>
                </tr>
            @endforeach

            <!-- Additional Info -->
            <tr>
                <td colspan="4" class="section-header">Additional Information</td>
            </tr>
            <tr>
                <th>Bio</th>
                <td>{{ $accusedProfile->bio }}</td>

                <th>Analysis</th>
                <td>{{ $accusedProfile->additional_info }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
