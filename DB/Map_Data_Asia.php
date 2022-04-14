<?php
// 1. First create n x 2 array with FusionMaps country ID in the first column and our regional identifier in the second column
$mapArray[0][1]="001"; $mapArray[0][2]="AFG"; $mapArray[0][4]="n-Base2010.php";    //  001   AF Afghanistan
$mapArray[1][1]="002"; $mapArray[1][2]="ROA";    //  002   AM Armenia
$mapArray[2][1]="003"; $mapArray[2][2]="AZE"; $mapArray[2][4]="n-../Economy_AZE.php";    //  003   AZ Azerbaijan
$mapArray[3][1]="005"; $mapArray[3][2]="ROA";    //  005   BD Bangladesh
$mapArray[4][1]="006"; $mapArray[4][2]="ROA";    //  006   BT Bhutan
$mapArray[5][1]="007"; $mapArray[5][2]="ROA";    //  007   BN Brunei
$mapArray[6][1]="008"; $mapArray[6][2]="ROA";    //  008   MM Burma 
$mapArray[7][1]="009"; $mapArray[7][2]="ROA";    //  009   KH Cambodia
$mapArray[8][1]="010"; $mapArray[8][2]="XIN"; $mapArray[8][4]="n-../Economy_PRC.php";    //  010   CN China
$mapArray[9][1]="012"; $mapArray[9][2]="ROA";    //  012   TP East Timor
$mapArray[10][1]="013"; $mapArray[10][2]="ROA";    //  013   GE Georgia
$mapArray[11][1]="014"; $mapArray[11][2]="IND";    //  014   IN India
$mapArray[12][1]="015"; $mapArray[12][2]="ROA";    //  015   ID Indonesia
$mapArray[13][1]="016"; $mapArray[13][2]="ROA";    //  016   IR Iran
$mapArray[14][1]="019"; $mapArray[14][2]="ROA";    //  019   JP Japan
$mapArray[15][1]="021"; $mapArray[15][2]="KAZ"; $mapArray[15][4]="n-../Economy_KAZ.php";    //  021   KZ Kazakhstan
$mapArray[16][1]="022"; $mapArray[16][2]="ROA";    //  022   KP Korea (north)
$mapArray[17][1]="023"; $mapArray[17][2]="ROA";    //  023   KR Korea (south)
$mapArray[18][1]="025"; $mapArray[18][2]="KGZ"; $mapArray[18][4]="n-../Economy_KGZ.php";    //  025   KG Kyrgyzstan
$mapArray[19][1]="026"; $mapArray[19][2]="ROA";    //  026   LA Laos
$mapArray[20][1]="028"; $mapArray[20][2]="ROA";    //  028   MY Malaysia
$mapArray[21][1]="030"; $mapArray[21][2]="MNG"; $mapArray[21][4]="n-../Economy_MON.php";    //  030   MN Mongolia
$mapArray[22][1]="031"; $mapArray[22][2]="ROA";    //  031   NP Nepal
$mapArray[23][1]="033"; $mapArray[23][2]="PAK"; $mapArray[23][4]="n-../Economy_PAK.php";    //  033   PK Pakistan
$mapArray[24][1]="034"; $mapArray[24][2]="ROA";    //  034   PH Philippines
$mapArray[25][1]="036"; $mapArray[25][2]="RUS"; $mapArray[25][4]="n-../Economy_RUS.php";    //  036   RU Russian Federation
$mapArray[26][1]="038"; $mapArray[26][2]="ROA";    //  038   SG Singapore
$mapArray[27][1]="039"; $mapArray[27][2]="ROA";    //  039   LK Sri Lanka
$mapArray[28][1]="041"; $mapArray[28][2]="TJK"; $mapArray[28][4]="n-../Economy_TJK.php";    //  041   TJ Tajikistan
$mapArray[29][1]="042"; $mapArray[29][2]="ROA";    //  042   TH Thailand
$mapArray[30][1]="044"; $mapArray[30][2]="TKM"; $mapArray[30][4]="n-../Economy_TKM.php";    //  044   TM Turkmenistan
$mapArray[31][1]="046"; $mapArray[31][2]="UZB"; $mapArray[31][4]="n-../Economy_UZB.php";    //  046   UZ Uzbekistan
$mapArray[32][1]="047"; $mapArray[32][2]="ROA";    //  047   VN Vietnam
$mapArray[33][1]="049"; $mapArray[33][2]="ROA";    //  049   TW Taiwan
$mapArray[34][1]="050"; $mapArray[34][2]="PRC";    //  050   HK Hong Kong
$mapArray[35][1]="051"; $mapArray[35][2]="ROA";    //  051   MO Macau
$mapArray[36][1]="052"; $mapArray[36][2]="ROA";    //  052   TU Turkey
$mapArray[37][1]="053"; $mapArray[37][2]="ROA";    //  053   SY Syria
$mapArray[38][1]="054"; $mapArray[38][2]="ROA";    //  054   IZ Iraq
$mapArray[39][1]="055"; $mapArray[39][2]="ROA";    //  055   SA Saudi Arabia
$mapArray[40][1]="056"; $mapArray[40][2]="ROA";    //  056   YM Yemen
$mapArray[41][1]="057"; $mapArray[41][2]="ROA";    //  057   MU Oman
$mapArray[42][1]="058"; $mapArray[42][2]="ROA";    //  058   AE United Arab Emirates
$mapArray[43][1]="059"; $mapArray[43][2]="ROA";    //  059   QA Qatar
$mapArray[44][1]="060"; $mapArray[44][2]="ROA";    //  060   BA Bahrain
$mapArray[45][1]="061"; $mapArray[45][2]="ROA";    //  061   KU Kuwait
$mapArray[46][1]="062"; $mapArray[46][2]="ROA";    //  062   JO Jordan
$mapArray[47][1]="063"; $mapArray[47][2]="ROA";    //  063   IS Israel
$mapArray[48][1]="064"; $mapArray[48][2]="ROA";    //  064   LE Lebanon

$mapLabel[0][1]="AFG"; $mapLabel[0][2]="Afghanistan";
$mapLabel[1][1]="AZE"; $mapLabel[1][2]="Azerbaijan";
$mapLabel[2][1]="KAZ"; $mapLabel[2][2]="Kazakhstan";
$mapLabel[3][1]="KGZ"; $mapLabel[3][2]="Kyrgyz Republic";
$mapLabel[4][1]="MON"; $mapLabel[4][2]="Mongolia";
$mapLabel[5][1]="PAK"; $mapLabel[5][2]="Pakistan";
$mapLabel[6][1]="PRC"; $mapLabel[6][2]="China";
$mapLabel[7][1]="TJK"; $mapLabel[7][2]="Tajikistan";
$mapLabel[8][1]="TKM"; $mapLabel[8][2]="Turkmenistan";
$mapLabel[9][1]="UZB"; $mapLabel[9][2]="Uzbekistan";
$mapLabel[10][1]="RUS"; $mapLabel[10][2]="Russian Federation";
$mapLabel[11][1]="IND"; $mapLabel[11][2]="India";
$mapLabel[12][1]="HYA"; $mapLabel[12][2]="High Income Asia";
$mapLabel[13][1]="ROA"; $mapLabel[13][2]="Asia";
$mapLabel[14][1]="EUR"; $mapLabel[14][2]="EU";
$mapLabel[15][1]="USA"; $mapLabel[15][2]="United States";
$mapLabel[16][1]="AMS"; $mapLabel[16][2]="Other Americas";
$mapLabel[17][1]="ROW"; $mapLabel[17][2]="Rest of World";
$mapLabel[18][1]="XIN"; $mapLabel[18][2]="Xinjiang";
$mapLabel[19][1]="Asia"; $mapLabel[19][2]="Asia";
$mapLabel[20][1]="LAO"; $mapLabel[20][2]="Lao";
$mapLabel[21][1]="MMR"; $mapLabel[21][2]="Myanmar";
$mapLabel[22][1]="KHM"; $mapLabel[22][2]="Cambodia";
$mapLabel[23][1]="World"; $mapLabel[23][2]="WorldwithCountries";
?>
