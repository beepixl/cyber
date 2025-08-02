 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
     <meta http-equiv="X-UA-Compatible" content="ie=edge" />

     <style>
         .fixed-box {
             width: 297mm;
             height: 210mm;
             /* border: 1px solid #000; */
             background-color: #fff;
             padding: 10mm;
             box-sizing: border-box;
             /* include padding in total size */
             background-color: #f0f0f0;
             /* border: 1px solid #ccc; */
             overflow: auto;
             /* or hidden, scroll, visible */
             padding: 16px;
         }

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
             border: none !important;
         }

         td,
         th {
             border: none !important;
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

         .col-10 {
             width: 10%;
         }

         .col-15 {
             width: 15%;
         }

         .col-20 {
             width: 20%;
         }

         .border-right {}

         .text-right {
             text-align: right;
         }

         .no-border {
             border: none !important;
         }

         .bl {
             border-left: 1px solid black !important
         }
     </style>
 </head>

 <body class="fixed-box">
     <div class="container-fluid p-0">
         <table class="table">
             <tr style="border-bottom: 1px solid black">
                 <td class="col-20 no-border">
                     <h4> G.P. Rjt., Sr. 72 Std.-119 3-2016 1,00,000 PA4*<br>
                         H.D., Memo No. PBQ-1067-4499-c dt.4-5-73</h4>
                 </td>
                 <td class="header" colspan="3">
                     <h3>CRIME RECORD CARD<br>
                         <span class="gujarati-text">મુખ્‍ય ગુના નોંધણી કાર્ડ</span>
                         <br>Navsari Police or Police Station: {{ $record->police_station_name }}
                     </h3>

                 </td>
                 <td class="col-20 text-right no-border" colspan="1">
                     <h3> P.M. 203 e. & g.<br>
                         <span class="gujarati-text">પી.એમ. ૨૦૩ ઇ. અને જી.</span>
                     </h3>
                 </td>

             </tr>

             <tr>
                 <td class="col-15">
                     1. Name:
                     @if (!empty($record->name))
                         <span style="margin-left: 10px;"> <strong>{{ $record->name }}</strong></span>
                     @endif
                     <br><span class="gujarati-text">૧. નામ</span>
                 </td>
                 <td class="col-20 bl">
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
                 <td class="col-15 bl">
                     14. Ref. No. of P. Stn.:<br>
                     <span class="gujarati-text">૧૪. પો.સ્ટે. રેફરન્સ નં.</span><br>
                     @if (!empty($record->red_no_of_p_stn))
                         <span style="margin-left: 10px;"><strong>{{ $record->red_no_of_p_stn }}</strong></span>
                     @endif
                 </td>
             </tr>

             <tr>
                 <td class="col-10" rowspan="2">
                     2. Alias:
                     <br><span class="gujarati-text">૨. ઉપનામ</span><br>
                     @if (!empty($record->alias))
                         <span style="margin-left: 10px;"> <strong>{{ $record->alias }}</strong>
                     @endif
                     <br />
                     Age: @if (!empty($record->age))
                         <span style="margin-left: 10px;"> <strong>{{ $record->age }}</strong>
                     @endif
                     <br><span class="gujarati-text">ઉંમર</span><br> <br> <br>
                 </td>
                 <td class="col-20 bl">
                     7. Build:
                     <br><span class="gujarati-text">૭. બાંધો</span><br>
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
                 <td class="col-20 bl">
                     15. Dist. M.O.B. No.:<br><span class="gujarati-text">૧૫. ડીસ્ટ્રીક્ટ એમ. ઓ. બી. નં.</span><br>
                     @if (!empty($record->dist_mob_no))
                         <strong>{{ $record->dist_mob_no }}</strong>
                     @endif
                 </td>
             </tr>

             <tr>
                 <td class="col-20" colspan="3">
                     10. Occupation:
                     <span style="margin-left: 10px;"> <strong>{{ $record->education }}</strong></span>
                     <br><span class="gujarati-text">૧૦. ધંધો </span><br>

                     11. Marks and Peculiarieties<br>
                     ૧૧. ચિન્હો અને વિશિષ્ટતાઓ
                 </td>
                 <td class="col-20 bl">
                     16. C.I.D. No.<br><span class="gujarati-text">૧૬. સી.આઈ.ડી. નં.</span><br>
                     <strong>{{ $record->cid_no }}</strong>
                 </td>

             </tr>

             <tr style="border-bottom:1px solid black">
                 <td class="col-10">
                     3. F.P. Classification<br><span class="gujarati-text">૩. અંગુલીછાપા વર્ગીકરણ</span><br>
                     <strong>{{ $record->fp_classification }}</strong>
                 </td>
                 <td class="col-20 bl">
                     12. Race & Caste<br><span class="gujarati-text">૧૨. જાતિ અને જ્ઞાતિ </span><br>
                     <strong>{{ $record->religion_caste }}</strong>
                 </td>
                 <td class="col-20" colspan="2">
                     13. Education and Accomplishments<br>
                     <span class="gujarati-text">૧૩. શિક્ષણ અને નિપૂણતા</span><br>
                     <strong>{{ $record->mo_classification }}</strong>
                 </td>
                 <td class="col-20 bl">
                     19. Frequents of Stays at<br><span class="gujarati-text">૧૯. કયે સ્થળે વારંવાર આવે છે અથવા રહે છે.
                     </span><br>
                     <strong>{{ $record->frequents_of_stays_at }}</strong>
                 </td>

             </tr>

             <tr>
                 <td class="col-20" style="height: 200px">
                     17. Address<br>
                     ૧૭. સરનામું
                     <span>{!! nl2br(e($record->address)) !!}</span>
                 </td>
                 <td class="col-20 bl" colspan="2">
                     Date of Photograph<br>
                     ફોટો લીધાની તારીખ
                     <strong>{{ $record->date_of_photograph }}</strong>
                 </td>
                 <td class="col-20">
                     18. Photograph<br>
                     ૧૮. ફોટોગ્રાફ
                     <strong>{{ $record->style_description }}</strong>
                 </td>
                 <td class="col-20 bl">
                     23. Relatives and Friends<br>
                     ૨૩. સગા તથા મિત્રો
                     <strong>{!! nl2br(e($record->relatives_friends)) !!}</strong>
                     <br>
                     <br>
                     <br>
                     24. Father<br> ૨૪. પિતા <strong>{{ $record->father_name }}</strong>
                     <br>
                     <br>
                     <br>
                     25. Wife<br> ૨૫. પત્નિ <strong>{{ $record->spouse_name }}</strong>
                 </td>

             </tr>

             <tr>
                 <td class="col-20" style="border:1px solid black !important">
                     20. Movements and other information<br><span class="gujarati-text"> ૨૦. હિલચાલ અને બીજી
                         માહિતી</span><br>
                     <strong>{{ $record->movements_info }}</strong>
                 </td>
                 <td colspan="3" style="border-right:1px solid black !important">
                 </td>
                 <td></td>
             </tr>

             <tr style="border-top:1px solid black !important">
                 <td class="col-20" rowspan="2">
                     21. Police Officers who can identify<br>
                     <span class="gujarati-text">૨૧. તેને ઓળખી શકે તેવા પોલીસ અમલદારો</span><br>
                     <strong>{{ $record->police_officers }}</strong>
                 </td>
                 <td class="col-20 bl" colspan="3">
                     22. Summary of Convictions
                     <br>૨૨. થયેલ સજાઅનો ટુંક અહેવાલ
                 </td>
                 <td class="col-20 bl">
                     26. Associates in Crime (M.O.B. No.)<br>૨૬. ગુન્હાની સોબતી અને તેમના એમ.ઓ.બી. નં.
                     <br>
                     <strong>{{ $record->associates_in_crime }}</strong>
                 </td>

             </tr>

             <tr>
                 <td colspan="3" class="bl">
                     <table class="table " style="border: none; font-weight: normal; font-size:9px;">
                         <thead>
                             <tr>
                                 <th class="">S.No.<br>અ.નં.</th>
                                 <th class="">P.S. Crime No.<br> પો.સ્ટે. ગુ.ર.નં.</th>
                                 <th class="">Sentence<br>સજા</th>
                                 <th class="">Section<br>કલમ</th>
                                 <th class="">Date<br>તારીખ</th>
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
                 <td class="bl">
                     27. Receivers<br>
                     ૨૭. માલ લેનાર <br>
                     <strong>{{ $record->receivers }}</strong>
                 </td>

             </tr>
         </table>
     </div>

     <div style="page-break-after: always;"></div>
     <br><br>
     <table class="table table-bordered mt-40 mb-0 w-100" style="border-top:1px solid black !important">
         <tr>
             <td class="col-20" style="height: 150px">
                 M.O.<br><br><br>
                 28. Classification<br><span class="gujarati-text">૨૮. વર્ગીકરણ પધ્ધતિનું </span>:
                 <strong>{{ $record->mo_classification }}</strong>
             </td>
             <td class="col-20 bl" colspan="4" rowspan="4" style="height: 450px">
                 <div style="text-align:center !important;border-bottom: 1px solid black">29. General
                     Particulars<br><span class="gujarati-text">૨૯.
                         સામાન્ય
                         વિગતો</span></div><br>
                 <strong
                     style="text-align: left !important;
                     !important;">{!! nl2br(e($record->general_particulars)) !!}</strong>
             </td>

         </tr>
         <tr style="border-top:1px solid black !important;height: 100px">
             <td class="col-20">
                 30. Dress<br>૩૦. પોષાક:
                 <strong>{{ $record->dress_description }}</strong>
             </td>
         </tr>
         <tr style="height: 100px">
             <td class="col-20">
                 31. Habits and Vices<br> ૩૧. ટેવો અને કૃત્યો:
                 <strong>{{ $record->habits_vices }}</strong>
             </td>
         </tr>
         <tr style="height: 100px">
             <td class="col-20">
                 32. Sphere of Activity<br>૩૨. પ્રવૃત્તિનું ક્ષેત્રફળ:
                 <strong>{{ $record->sphere_of_activity }}</strong>
             </td>
         </tr>
         <tr style="border-top:1px solid black !important">
             <td class="col-20" colspan="5">
                 33. Antecedents<br>૩૩. પૂર્વ ઇતિહાસ:
                 <strong>{{ $record->antecedents }}</strong>
             </td>
         </tr>
     </table>
 </body>

 </html>
