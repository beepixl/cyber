-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 12:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyber`
--

-- --------------------------------------------------------

--
-- Table structure for table `crime_record_cards`
--

CREATE TABLE `crime_record_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `police_station_name` longtext DEFAULT NULL,
  `record_date` longtext DEFAULT NULL,
  `name` longtext DEFAULT NULL,
  `alias` longtext DEFAULT NULL,
  `age` varchar(11) DEFAULT NULL,
  `fp_classification` longtext DEFAULT NULL,
  `place_of_birth` longtext DEFAULT NULL,
  `height` longtext DEFAULT NULL,
  `complexion` longtext DEFAULT NULL,
  `build` longtext DEFAULT NULL,
  `hair` longtext DEFAULT NULL,
  `eyes` longtext DEFAULT NULL,
  `identification_marks` longtext DEFAULT NULL,
  `languages_known` longtext DEFAULT NULL,
  `religion_caste` longtext DEFAULT NULL,
  `education` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `date_of_photograph` longtext DEFAULT NULL,
  `police_officers` longtext DEFAULT NULL,
  `movements_info` longtext DEFAULT NULL,
  `convictions_summary` longtext DEFAULT NULL,
  `relatives_friends` longtext DEFAULT NULL,
  `father_name` longtext DEFAULT NULL,
  `spouse_name` longtext DEFAULT NULL,
  `associates_in_crime` longtext DEFAULT NULL,
  `receivers` longtext DEFAULT NULL,
  `mo_classification` longtext DEFAULT NULL,
  `general_particulars` longtext DEFAULT NULL,
  `fir_numbers` longtext DEFAULT NULL,
  `dress_description` longtext DEFAULT NULL,
  `style_description` longtext DEFAULT NULL,
  `habits_vices` longtext DEFAULT NULL,
  `sphere_of_activity` longtext DEFAULT NULL,
  `antecedents` longtext DEFAULT NULL,
  `cp_reference` longtext DEFAULT NULL,
  `ho_memo_no` longtext DEFAULT NULL,
  `red_no_of_p_stn` longtext DEFAULT NULL,
  `dist_mob_no` longtext DEFAULT NULL,
  `cid_no` longtext DEFAULT NULL,
  `frequents_of_stays_at` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_record_cards`
--

INSERT INTO `crime_record_cards` (`id`, `police_station_name`, `record_date`, `name`, `alias`, `age`, `fp_classification`, `place_of_birth`, `height`, `complexion`, `build`, `hair`, `eyes`, `identification_marks`, `languages_known`, `religion_caste`, `education`, `address`, `date_of_photograph`, `police_officers`, `movements_info`, `convictions_summary`, `relatives_friends`, `father_name`, `spouse_name`, `associates_in_crime`, `receivers`, `mo_classification`, `general_particulars`, `fir_numbers`, `dress_description`, `style_description`, `habits_vices`, `sphere_of_activity`, `antecedents`, `cp_reference`, `ho_memo_no`, `red_no_of_p_stn`, `dist_mob_no`, `cid_no`, `frequents_of_stays_at`, `created_at`, `updated_at`) VALUES
(1, 'સાયબર ક્રાઇમ ', NULL, 'દુલારીદેવી W/O અનિરુધ્ધ પ્રયાગ મિશ્રા ', NULL, NULL, 'અનટ્રેસ ', 'ભાગલપુર ', '૫ ફુટ ૧ ઇંચ ', 'ઘઉં વર્ણ ', 'પાતળો ', 'કાળા ', 'કાળી ', NULL, NULL, 'હિન્દુ ', 'અભણ ', 'હાલ રહે-શાંતીનગર-૨,ધર્મ કાંટાની ગલીમાં,રાજપીપળા રોડ,કિશનભાઇ વાઘરીના મકાનમાં ભાડેથી,તા.અંક્લેશ્વર જી.ભરૂચ\nમુળ રહે-કિશનપુર,અમખોરીયા થાના-સજોર જી.ભાગલપુર,(બિહાર) ', NULL, 'પો.ઇન્સ. યુ.એલ.મોદી ', NULL, '[{\"s_no\":\"\\u0a97\\u0ac1.\\u0ab0.\\u0aa8\\u0a82.\\u0aaa\\u0abe\\u0ab0\\u0acd\\u0a9f-\\u0aac\\u0ac0 \\u0ae7\\u0ae7\\u0aee\\u0ae8\\u0ae8\\u0ae6\\u0ae8\\u0aea\\u0ae8\\u0aeb\\u0ae6\\u0ae6\\u0ae6\\u0aea\\/\\u0ae8\\u0ae6\\u0ae8\\u0aeb\",\"ps_crime_no\":null,\"sentence\":null,\"section\":\"\\u0aad\\u0abe\\u0ab0\\u0aa4\\u0ac0\\u0aaf \\u0aa8\\u0acd\\u0aaf\\u0abe\\u0aaf \\u0ab8\\u0a82\\u0ab9\\u0abf\\u0aa4\\u0abe \\u0ae8\\u0ae6\\u0ae8\\u0ae9 \\u0aa8\\u0ac0 \\u0a95.\\u0ae9\\u0ae7\\u0aee(\\u0aea),\\u0ae9\\u0ae7\\u0aef(\\u0ae8),\\u0aec\\u0ae7(\\u0ae8),\\u0ae9(\\u0aeb),\\u0aa4\\u0aa5\\u0abe \\u0a86\\u0a87.\\u0a9f\\u0ac0.\\u0a8f\\u0a95\\u0acd\\u0a9f \\u0ae8\\u0ae6\\u0ae6\\u0ae6 \\u0aa8\\u0ac0 \\u0a95.\\u0aec\\u0aec(\\u0ab8\\u0ac0),\\u0aec\\u0aec(\\u0aa1\\u0ac0) \\u0aae\\u0ac1\\u0a9c\\u0aac\",\"date\":null},{\"s_no\":null,\"ps_crime_no\":null,\"sentence\":null,\"section\":null,\"date\":null}]', NULL, NULL, 'અનિરુધ્ધ પ્રયાગ મિશ્રા ', NULL, NULL, 'ઠગાઇ ', 'સાયબર ક્રાઇમ પો.સ્ટે. ગુ.ર.નં.પાર્ટ બી-૧૧૮૨૨૦૨૪૨૫૦૦૦૪/૨૦૨૫\nગુ.બ.તા.ટા.-તા.૦૯/૦૧/૨૦૨૫ થી તા.૨૮/૦૩/૨૦૨૫\nગુ.જા.તા.ટા.-તા.૧૩/૦૫/૨૦૨૫ ટા. ૧૮/૧૫ \nઅધિનિયમ કાયદો અને કલમ-ભારતીય ન્યાય સંહિતા ૨૦૨૩ ની ક.૩૧૮(૪),૩૧૯(૨),૬૧(૨),૩(૫),તથા આઇ.ટી.એક્ટ ૨૦૦૦ ની ક.૬૬(સી),૬૬(ડી) મુજબ\nટૂંક વિગત- તે એવી રીતે છે કે આ ગુનાના કામના આરોપીઓ (૧) વોટ્સએપ નંબર - ૮૮૬૭૯૦૬૮૩૮ ના યુઝર નામે નિશા બાસુ એ પોતાની ઓળખ MIRAE ASSET SHAREKHAN કંપનીના કર્મચારી તરીકે આપી કંપનીમાં ઇન્વેસ્ટમેન્ટ કરી પૈસા કમાવવાની તક જણાવી તથા (૨) MIRAE ASSET Customer Service ના વોટ્સએપ નંબર- ૮૧૨૧૩૮૬૩૧૯, (૩) MIRAE ASSET Customer Service ના વોટ્સએપ નંબર- ૭૦૨૨૬૫૪૧૫૦ નાઓએ પોતાનો સમાન ઇરાદો પાર પાડવા સારૂ આયોજનપુર્વક પુર્વ આયોજીત ગુનાહીત કાવતરૂ રચી  ફરીયાદીને અલગ અલગ કંપનીમાં રોકાણ કરાવી તથા IPO ખરીદ કરાવી સર્વિસ ટેક્ષ, કંપનીના કમીશન ચાર્જ, ગેરંટી મની તથા બેન્ક હેન્ડલીંગ ચાર્જ જેવા અલગ અલગ ચાર્જ અને રોકાણ બતાવી ઉપરોક્ત દર્શાવેલ તમામ બેન્ક એકાઉન્ટોમાં ફરીયાદીના રૂપીયા ભરાવી ફરીયાદીના રોકાણ કરેલા રૂપીયા પરત ન આપી કુલ રૂપીયા ૨૩,૭૭,૨૧૫/- જેટલી રકમ ટ્રાન્સફર કરાવી ઠગાઇ કરી ગુન્હો કરેલ હોય વિગેરે બાબત. ', NULL, 'સાડી', NULL, 'ચા પીવાની ', 'મોજે ૨૭,ગુરૂ સાનિધ્ય,અયોધ્યાનગર-૩,વિજલપોર ', 'આરોપી નામે દુલારીદેવી વા/ઓ અનિરુધ્ધ પ્રયાગ મિશ્રા ઉ.વ. ધંધો.છુટક મજૂરી હાલ રહે-શાંતીનગર-૨,ધર્મ કાંટાની ગલીમાં,રાજપીપળા રોડ,કિશનભાઇ વાઘરીના મકાનમાં ભાડેથી,તા.અંક્લેશ્વર જી.ભરૂચ\nહું ઉપર બતાવેલ હાલના સરનામે છેલ્લા નવેક વર્ષથી રહું છું અને છુટક મજુરીકામ કરું છું.અને મારા પતિ મને છોડીને અલગ રહે છે.મને સંતાનમાં ત્રણ બાળકો છે જેમાં સૌથી મોટો રિતેશ ઉ.વ.૨૩ જે મારી સાથે રહે છે અને ડ્રાઇવીંગ કરે છે.તેનાથી નાની તનુ મિશ્રા ઉ.વ.૨૧ જેના લગ્ન થઇ ગયેલ છે અને અમદાવાદ ખાતે રહે છે.અને સૌથી નાનો આર્યન ઉ.વ.૧૫ જે અમારા ગામ બિહાર ખાતે અમારા પરિવાર સાથે રહે છે.સને-૨૦૨૪ માં દિવાળી તહેવાર પહેલા હુ તથા મારો છોકરો આર્યન રાજસ્થાન ખાતે ગયેલા ત્યારે અમારી મુલાકાત દિનેશ નામના વ્યકતી સાથે થયેલ અને મારો દિકરો તથા આ દિનેશ બેંક એકાઉન્ટની વાત કરતા હતા અને તેઓએ એકબીજાનો મોબાઇલ નંબર લીધેલ હતો અને ત્યારબાદ ફેબ્રુઆરી-૨૦૨૫ માં મારા દિકરા આર્યને દિનેશના કહેવાથી અમોને બેંકમાં એકાઉન્ટ ખોલવા માટે અને નવા સીમકાર્ડ લેવા માટે કહેલ અને અમોને બે બેંક એકાઉન્ટના બદલામાં રૂપીયા ૧૦,૦૦૦/- આપવાની વાત કરેલી જેથી એક મારૂ એકાઉન્ટ ખોલવાનુ હોય તેમજ એક મારી માસી બબીતાબેન પાઠક જેઓને એકાઉન્ટ ખોલવા માટે મેં તેમને જણાવેલ કે હાલમાં સરકાર યોજનાનો લાભ આપે છે અને પૈસા ડાયરેકટ ખાતામાં આવે છે તેવુ કહેલ જેથી અમો ગ્રાહક સેવા કેન્દ્ર,લક્ષ્મણનગર,અંકલેશ્વર ખાતે ગયેલ પંજાબ બેંકમાં મારૂ તથા મારી માસી બબીતાબેન પાઠક નાઓનુ એકાઉન્ટ ખોલાવેલ હતુ.જે બાદ  અને તેના પંદરેક દિવસ પહેલા મેં તથા બબીતાબેને એરટેલના બે નવા સીમકાર્ડ લીધેલા હતા અને તે નંબર બેંકમાં આપેલ હતો ત્યારબાદ અમારા ઘરે ટપાલ મારફતે પાસબુક તથા એ.ટી.એમ. આવેલ જે બંન્ને કીટ લઇને હુ રાજપીપળા ચોકડી ખાતે રોડ પર ગયેલ અને ત્યાં કોઇ અજાણ્યો માણસ આવેલ જેને મેં મારી તથા માસીની બેંક પાસબુકો,એ.ટી.એમ.,સીમકાર્ડ તેને આપી દીધેલ હતુ જે બાદ થોડા દિવસ પછી આ દિનેશનો મારા દિકરા પર ફોન આવેલ અને રૂપીયા લેવા રાજપીપળા ચોકડી ખાતે બોલાવેલ જેથી હુ ત્યાં ગયેલ અને જ્યાં કોઇ અજાણ્યા માણસે મને રૂપીયા ૩૦૦૦/- આપેલા અને બાકીના ૭,૦૦૦/- પછીથી આપવાનુ જણાવેલ હતુ અને આ પૈસા મેં જ રાખી લીધેલા હતા અને માસી બબીતાને આપેલા નહી અને આ દિનેશ અમારા એકાઉન્ટોનુ સુ કરેલ છે તેની મને કોઇ માહીતી નથી એટલી મારી હકીકત મારા લખાવ્યા મુજબ બરાબર અને ખરી છે.\n', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-14 02:53:49', '2025-07-15 04:24:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crime_record_cards`
--
ALTER TABLE `crime_record_cards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crime_record_cards`
--
ALTER TABLE `crime_record_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
