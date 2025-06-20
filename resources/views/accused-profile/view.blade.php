<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Suspect Profile Summary - {{ $accusedProfile->name }}</title>
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
            background-color: white;

            font-weight: bold;
            color: #000000;
        }

        img {
            max-height: 80px;
            border-radius: 4px;
        }
    </style>
</head>

<body onload="window.print()">



    <table>
        <tbody>

            <tr>
                <td colspan="4" class="section-header">
                    <h4>Suspect Profile - {{ $accusedProfile->name }} </h4>
                    @if (!empty($accusedProfile->status))
                        <p>{{ $accusedProfile->status }}</p>
                    @endif
                </td>
            </tr>
            <!-- Case Information -->

            <tr>
                <th>Police Station</th>
                <td>{{ $accusedProfile->police_station }}</td>
                <th>FIR No</th>
                <td>{{ $accusedProfile->fir_no }}</td>
            </tr>
            <tr>
                <th>Suspect State</th>
                <td>{{ $accusedProfile->state }}</td>
                <th>Suspect City</th>
                <td>{{ $accusedProfile->city }}</td>
            </tr>

            <tr>
                <th>Fraud Amount</th>
                <td>₹{{ number_format($accusedProfile->fraud_amount, 2) }}</td>
                <th>Disputed Amount</th>
                <td>₹{{ number_format($accusedProfile->disputed_amount, 2) }}</td>
            </tr>
            <tr>
                <th>Layer</th>
                <td>
                    @if (!empty($accusedProfile->layer))
                        Layer {{ $accusedProfile->layer }}
                    @endif
                </td>
                <th>Victim Name</th>
                <td>{{ $accusedProfile->compliant_person }}</td>
            </tr>
            <tr>
                <th>Suspect Role</th>
                <td colspan="3">{{ $accusedProfile->accused_role }}</td>

            </tr>

            <!-- Bank Transactions -->
            {{-- <tr>
                <td colspan="4" class="section-header">Bank Transactions</td>
            </tr> --}}
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
                                <th>No of Complains</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accusedProfile->bank_accounts ?? [] as $txn)
                                <tr>
                                    <td>{{ $txn['layer'] }}</td>
                                    <td>{{ date('d-m-Y', strtotime($txn['transaction_date'])) }}</td>
                                    <td>{{ $txn['transaction_amount'] }}</td>
                                    <td>{{ $txn['dispute_amount'] }}</td>
                                    <td>{{ $txn['bank_name'] }}</td>
                                    <td>{{ $txn['bank_account_no'] }}</td>
                                    <td>{{ $txn['ifsc'] }}</td>
                                    <td>{{ $txn['noofcomplaints'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Personal Info -->
            <tr>
                <th>Full Name </th>
                <td>{{ $accusedProfile->name }}</td>
                <th>Date of Birth </th>
                <td>{{ date('d-m-Y', strtotime($accusedProfile->date_of_birth)) }}</td>
            </tr>
            <tr>

                <th>Photos</th>
                <td colspan="3">
                    @foreach ($accusedProfile->getMedia() as $media)
                        <img src="{{ $media->getUrl() }}" alt="Photo" style="max-width: 300px; height: auto;">
                    @endforeach
                </td>
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
            <!-- Identification -->

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






            <!-- Contact Information -->
            <tr>
                <td colspan="4">
                    <strong>Mobile Numbers</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4">

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
                </td>
            </tr>
            <tr>
                <td colspan="4">

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



            @if (count($accusedProfile->social_media_profiles) > 0)
                <tr>
                    <th>Platform</th>
                    <th colspan="3">Profile Link</th>

                </tr>

                <!-- Family Members -->

                @foreach ($accusedProfile->social_media_profiles ?? [] as $social)
                    <tr>
                        <td>{{ $social['platform'] }}</td>
                        <td colspan="3"><a href="{{ $social['url'] }}" target="_blank">{{ $social['url'] }}</a>
                        </td>

                    </tr>
                @endforeach

            @endif

            @if ($accusedProfile->familyMembers->count() > 0)
                <tr>
                    <td colspan="4">
                        <strong>Family Members</strong>
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Relation</th>
                    <th>Photo</th>
                    <th>Mobile</th>
                </tr>

                <!-- Family Members -->

                @foreach ($accusedProfile->familyMembers ?? [] as $familymember)
                    <tr>
                        <td>{{ $familymember->name }}</td>
                        <td>{{ $familymember->relation }}</td>

                        <td>

                            @foreach ($familymember->getMedia() as $media)
                                <img src="{{ $media->getUrl() }}" alt="Photo"
                                    style="max-width: 300px; height: auto;">
                            @endforeach
                        </td>
                        <td>
                            Mobile: {{ $familymember->mobile_no }}
                            @if ($familymember->remarks)
                                <br>Remarks: {{ $familymember->remarks }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            <!-- Additional Info -->

            <tr>
                <th colspan="4">Additional Information</th>
            </tr>
            <tr>
                <td colspan="4">{{ $accusedProfile->bio }}</td>
            </tr>
            <tr>
                <th colspan="4">Analysis</th>
            </tr>
            <tr>
                <td colspan="4">{{ $accusedProfile->additional_info }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
