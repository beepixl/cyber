<?php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
?>
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
                <td style="width:60%">{{ $accusedProfile->name }}</td>
                <th>Date of Birth </th>
                <td>{{ date('d-m-Y', strtotime($accusedProfile->date_of_birth)) }}</td>
            </tr>
            <tr>

                <th>Photos</th>
                <td colspan="3">
                    @foreach ($accusedProfile->getMedia() as $media)
                        <img src="{{ $media->getUrl() }}" alt="Photo"
                            style="max-width: 300px; height: auto;max-height:100px;">
                    @endforeach
                    @php
                        $mapLinks = collect($accusedProfile->locations ?? [])
                            ->pluck('map_link')
                            ->filter()
                            ->unique();
                    @endphp
                    @if ($mapLinks->isNotEmpty())

                        @foreach ($mapLinks as $index => $mapLink)
                            @php
                                echo QrCode::size(100)->generate($mapLink);

                            @endphp
                        @endforeach

                    @endif
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
                                {{-- <th>Map Link</th> --}}
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
                                    <td>{{ $loc['from_where'] }} </td>
                                    {{-- <td>
                                        @if (!empty($loc['map_link']))
                                            @php
                                                echo QrCode::generate($loc['map_link']);
                                            @endphp
                                        @endif
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- Identification -->

            @php
                $hasAadhar = !empty($accusedProfile->aadhar_number);
                $hasPan = !empty($accusedProfile->pan_number);
            @endphp

            @if ($hasAadhar && $hasPan)
                <tr>
                    <th>Aadhar Number</th>
                    <td>{{ $accusedProfile->aadhar_number }}</td>
                    <th>PAN Number</th>
                    <td>{{ $accusedProfile->pan_number }}</td>
                </tr>
            @elseif ($hasAadhar)
                <tr>
                    <th>Aadhar Number</th>
                    <td colspan="3">{{ $accusedProfile->aadhar_number }}</td>
                </tr>
            @elseif ($hasPan)
                <tr>
                    <th>PAN Number</th>
                    <td colspan="3">{{ $accusedProfile->pan_number }}</td>
                </tr>
            @endif







            <!-- Contact Information -->
            @if (!empty($accusedProfile->mobile_numbers) && count($accusedProfile->mobile_numbers) > 0)
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
                                @foreach ($accusedProfile->mobile_numbers as $mob)
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
            @endif
            @if (!empty($accusedProfile->email_addresses) && count($accusedProfile->email_addresses) > 0)
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
                                @foreach ($accusedProfile->email_addresses as $email)
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
            @endif

            <!-- Locations -->



            @php
                $hasValidSocialUrls = false;
                if (
                    !empty($accusedProfile->social_media_profiles) &&
                    is_array($accusedProfile->social_media_profiles)
                ) {
                    foreach ($accusedProfile->social_media_profiles as $social) {
                        if (!empty($social['url'])) {
                            $hasValidSocialUrls = true;
                            break;
                        }
                    }
                }
            @endphp
            @if ($hasValidSocialUrls)
                <tr>
                    <td colspan="4">
                        <strong>Social Media Profiles</strong>
                    </td>
                </tr>
                <tr>
                    <th>Platform</th>
                    <th colspan="3">Profile Link</th>
                </tr>
                @foreach ($accusedProfile->social_media_profiles as $social)
                    <tr>
                        <td>{{ $social['platform'] ?? '' }}</td>
                        <td colspan="3">
                            @if (!empty($social['url']))
                                <a href="{{ $social['url'] }}" target="_blank">{{ $social['url'] }}</a>
                            @endif
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

            @if (!empty($accusedProfile->bio) || !empty($accusedProfile->additional_info))
                <tr>
                    <th colspan="4">Additional Information</th>
                </tr>
            @endif
            @if (!empty($accusedProfile->bio))
                <tr>
                    <td colspan="4">{!! nl2br(e($accusedProfile->bio)) !!}</td>
                </tr>
            @endif
            @if (!empty($accusedProfile->additional_info))
                <tr>
                    <th colspan="4">Analysis</th>
                </tr>

                <tr>
                    <td colspan="4">{!! nl2br(e($accusedProfile->additional_info)) !!}</td>
                </tr>
            @endif
            @if (!empty($accusedProfile->cdr_analysis))
                <tr>
                    <td colspan="4">
                        <strong>CDR Analysis</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table>
                            <thead>
                                <tr>
                                    <th>B Party Name</th>
                                    <th>Mobile Number</th>
                                    <th>Address</th>
                                    <th>Other Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accusedProfile->cdr_analysis as $cdr)
                                    <tr>
                                        <td>{{ $cdr['B Party Name'] ?? '' }}</td>
                                        <td>{{ $cdr['Mobile Number'] ?? '' }}</td>
                                        <td>{{ $cdr['Address'] ?? '' }}</td>
                                        <td>{{ $cdr['Other Info'] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</body>

</html>
