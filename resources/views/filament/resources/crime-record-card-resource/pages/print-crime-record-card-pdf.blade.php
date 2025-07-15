 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
     <meta http-equiv="X-UA-Compatible" content="ie=edge" />

     <style>
         body {
             font-family: 'roboto';
             font-size: 11px;
             padding: 5px;
         }

         .gujarati-text {
             font-family: 'gujarati';
         }

         table {
             width: 100%;
             border-collapse: collapse;
             table-layout: fixed;
         }

         td,
         th {
             border: 1px solid black;
             padding: 2px;
             vertical-align: top;
         }

         . {
             border: none !important;
         }

         .header {
             text-align: center;
             font-weight: bold;
             font-size: 14px;
             border: none !important;
         }

         .sub-header {
             text-align: center;
             font-weight: bold;
             border: none !important;
         }

         .col-20 {
             width: 20%;
         }

         .border-right {
             border-right: 1px solid black !important;
         }

         .text-right {
             text-align: right;
         }

         .no-border {
             border: 1px solid #fff;
         }
     </style>
 </head>

 <body>
     <div class="container-fluid p-0">
         <table class="table table-bordered">
             <tr>
                 <td class="col-20 no-border" colspan="2">
                     G.P. Rjt., Sr. 72 Std.-119 3-2016 1,00,000 PA4*<br>
                     H.D., Memo No. PBQ-1067-4499-c dt.4-5-73
                 </td>
                 <td class="header col-20" colspan="1">
                     CRIME RECORD CARD<br>
                     <span class="gujarati-text">મુખ ગુના નોંધણી કાર્ડ</span><br>
                     Police Station: {{ $record->police_station_name }}
                 </td>
                 <td class="col-20 text-right no-border" colspan="2">
                     P.M. 203 e. & g.<br>
                     <span class="gujarati-text">પી.એમ. ૨૦૩ ઇ. અને જી.</span>
                 </td>

             </tr>

             <tr>
                 <td class="col-20">
                     1. Name:
                     @if (!empty($record->name))
                         <span style="margin-left: 10px;"> <strong>{{ $record->name }}</strong></span>
                     @endif
                     <br><span class="gujarati-text">૧. નામ</span>
                 </td>
                 <td class="col-20">
                     4. Born at:
                     @if (!empty($record->place_of_birth))
                         <span style="margin-left: 10px;"><strong>{{ $record->place_of_birth }}</strong></span>
                     @endif
                     <br>
                     <span class="gujarati-text">૪. જનમ સ્થાન</span>
                 </td>
                 <td class="col-20">
                     5. Ht.
                     <span class="gujarati-text">૫. ઊંચાઈ</span><br />
                     @if (!empty($record->height))
                         <span style="margin-left: 10px;"><strong>{{ $record->height }}</strong></span>
                     @endif
                 </td>
                 <td class="col-20">
                     6. Complexion:<br>
                     <span class="gujarati-text">૬. વર્ણ</span> <br>
                     @if (!empty($record->complexion))
                         <span style="margin-left: 10px;"><strong>{{ $record->complexion }}</strong></span>
                     @endif
                 </td>
                 <td class="col-20">
                     14. Ref. No. of P. Stn.:<br>
                     <span class="gujarati-text">૧૪. પો.સ્ટે. રેફરન્સ નં.</span><br>
                     @if (!empty($record->red_no_of_p_stn))
                         <span style="margin-left: 10px;"><strong>{{ $record->red_no_of_p_stn }}</strong></span>
                     @endif
                 </td>
             </tr>

             <tr>
                 <td class="col-20" rowspan="2">
                     2. Alias:
                     <br><span class="gujarati-text">૨. ઉપનામ</span><br>
                     @if (!empty($record->alias))
                         <span style="margin-left: 10px;"> <strong>{{ $record->alias }}</strong>
                     @endif
                     <br> <br> Age:<br><span class="gujarati-text">ઉંમર</span><br>
                 </td>
                 <td class="col-20">
                     7. Build:
                     <br><span class="gujarati-text">૭. આકાર</span><br>
                     @if (!empty($record->build))
                         <span style="margin-left: 10px;"> <strong>{{ $record->build }}</strong></span>
                     @endif
                 </td>
                 <td class="col-20">
                     8. Eyes:
                     <br><span class="gujarati-text">૮. આંખો</span><br>
                     @if (!empty($record->eyes))
                         <span style="margin-left: 10px;"><strong>{{ $record->eyes }}</strong></span>
                     @endif
                 </td>
                 <td class="col-20">
                     9. Hair:<br><span class="gujarati-text">૯. વાળ</span><br>
                     @if (!empty($record->hair))
                         <strong>{{ $record->hair }}</strong>
                     @endif
                 </td>
                 <td class="col-20">
                     15. Dist. M.O.B. No.:<br><span class="gujarati-text">૧૫. જિલ્લાકક્ષાની એમ. ઓ. બી. નં.</span><br>
                     @if (!empty($record->dist_mob_no))
                         <strong>{{ $record->dist_mob_no }}</strong>
                     @endif
                 </td>
             </tr>

             <tr>
                 <td class="col-20" colspan="3">
                     10. Occupation:
                     <span style="margin-left: 10px;"> <strong>{{ $record->education }}</strong></span>
                     <br><span class="gujarati-text">૧૦. પેશા</span><br>
                 </td>
                 <td class="col-20">
                     16. C.I.D. No.<br><span class="gujarati-text">૧૬. સી.આઈ.ડી. નં.</span><br>
                     <strong>{{ $record->cid_no }}</strong>
                 </td>

             </tr>

             <tr>
                 <td class="col-20">
                     3. F.P. Classification<br><span class="gujarati-text">૩. અંગુલીછાપા વર્ગીકરણ</span><br>
                     <strong>{{ $record->fp_classification }}</strong>
                 </td>
                 <td class="col-20">
                     12. Race & Caste<br><span class="gujarati-text">૧૨. જાતિ અને જાતિ</span><br>
                     <strong>{{ $record->religion_caste }}</strong>
                 </td>
                 <td class="col-20" colspan="2">
                     13. Education and Accomplishments<br>
                     <span class="gujarati-text">૧૩. શિક્ષણ અને નિપુણતા</span><br>
                     <strong>{{ $record->mo_classification }}</strong>
                 </td>
                 <td class="col-20">
                     19. Frequents of Stays at<br><span class="gujarati-text">૧૯. રહેવાનું સ્થળ</span><br>
                     <strong>{{ $record->frequents_of_stays_at }}</strong>
                 </td>

             </tr>

             <tr>
                 <td class="col-20" style="height: 200px">
                     17. Address<br>
                     <span>{!! nl2br(e($record->address)) !!}</span>
                 </td>
                 <td class="col-20">
                     Date of Photograph<br>
                     <strong>{{ $record->date_of_photograph }}</strong>
                 </td>
                 <td class="col-20" colspan="2">
                     18. Photograph<br>
                     <strong>{{ $record->style_description }}</strong>
                 </td>
                 <td class="col-20">
                     23. Relatives and Friends<br>
                     <strong>{!! nl2br(e($record->relatives_friends)) !!}</strong>
                     <br>
                     <br>
                     <br>
                     24. Father<br><strong>{{ $record->father_name }}</strong>
                     <br>
                     <br>
                     <br>
                     25. Wife<br><strong>{{ $record->spouse_name }}</strong>
                 </td>

             </tr>

             <tr>
                 <td class="col-20" colspan="5">
                     20. Movements and other information<br><span class="gujarati-text">૨૦. હિલચાલ</span><br>
                     <strong>{{ $record->movements_info }}</strong>
                 </td>
             </tr>

             <tr>
                 <td class="col-20" rowspan="2">
                     21. Police Officers who can identify<br>
                     <span class="gujarati-text">૨૧. ઓળખી શકે એવા પોલીસ અધિકારી</span><br>
                     <strong>{{ $record->police_officers }}</strong>
                 </td>
                 <td class="col-20" colspan="3">
                     22. Summary of Convictions
                 </td>
                 <td class="col-20">
                     26. Associates in Crime (M.O.B. No.)<br>
                     <strong>{{ $record->associates_in_crime }}</strong>
                 </td>

             </tr>

             <tr>
                 <td colspan="3">
                     <table class="table " style="border: none; font-weight: normal;">
                         <thead>
                             <tr>
                                 <th class="">S.No.</th>
                                 <th class="">P.S. Crime No.</th>
                                 <th class="">Sentence</th>
                                 <th class="">Section</th>
                                 <th class="">Date</th>
                             </tr>
                         </thead>
                         <tbody>
                             @if (is_array($record->convictions_summary))
                                 @foreach ($record->convictions_summary as $conviction)
                                     <tr>
                                         <td>{{ $conviction['s_no'] ?? '' }}</td>
                                         <td>{{ $conviction['ps_crime_no'] ?? '' }}</td>
                                         <td>{{ $conviction['sentence'] ?? '' }}</td>
                                         <td>{{ $conviction['section'] ?? '' }}</td>
                                         <td>
                                             @if (!empty($conviction['date']))
                                                 {{ \Carbon\Carbon::parse($conviction['date'])->format('d-m-Y') }}
                                             @endif
                                         </td>
                                     </tr>
                                 @endforeach
                             @endif
                         </tbody>
                     </table>
                 </td>
                 <td>
                     27. Receivers<br>
                     <strong>{{ $record->receivers }}</strong>
                 </td>

             </tr>
         </table>
     </div>

     <div style="page-break-after: always;"></div>

     <table class="table table-bordered mt-4 mb-0 w-100">
         <tr>
             <td class="col-20">
                 28. Classification<br><span class="gujarati-text">વર્ગીકરણ</span>:
                 <strong>{{ $record->mo_classification }}</strong>
             </td>
             <td class="col-20">
                 29. General Particulars<br><span class="gujarati-text">સામાન્ય વિગતો</span><br>
                 <strong>{{ $record->general_particulars }}</strong>
             </td>
             <td class="col-20">
                 30. Dress<br><span class="gujarati-text">પહેરવેશ</span>:
                 <strong>{{ $record->dress_description }}</strong>
             </td>
             <td class="col-20">
                 31. Habits and Vices<br><span class="gujarati-text">દુર્વ્યસનો</span>:
                 <strong>{{ $record->habits_vices }}</strong>
             </td>
             <td class="col-20">
                 32. Sphere of Activity<br><span class="gujarati-text">પ્રવૃત્તિ ક્ષેત્ર</span>:
                 <strong>{{ $record->sphere_of_activity }}</strong>
             </td>
         </tr>
         <tr>
             <td class="col-20" colspan="5">
                 33. Antecedents<br><span class="gujarati-text">પૂર્વવૃત્ત</span>:
                 <strong>{{ $record->antecedents }}</strong>
             </td>
         </tr>
     </table>
 </body>

 </html>
