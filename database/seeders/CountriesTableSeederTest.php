<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        Country::create([
            'ar' => ['name' => 'أفغانستان', 'currency' => 'أفغاني'],
            'en' => ['name' => 'Afghanistan', 'currency' => 'AFN'],
            'iso_code'      => 'AFG',
            'phone_code'    => '93',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر آلاند', 'currency' => 'يورو'],
            'en' => ['name' => 'Aland Islands', 'currency' => 'EUR'],
            'iso_code'      => 'ALA',
            'phone_code'    => '+358-18',
        ]);
        Country::create([
            'ar' => ['name' => 'ألبانيا', 'currency' => 'ليك ألباني'],
            'en' => ['name' => 'Albania', 'currency' => 'ALL'],
            'iso_code'      => 'ALB',
            'phone_code'    => '355',
        ]);
        Country::create([
            'ar' => ['name' => 'الجزائر', 'currency' => 'دينار جزائري'],
            'en' => ['name' => 'Algeria', 'currency' => 'DZD'],
            'iso_code'      => 'DZA',
            'phone_code'    => '213',
        ]);
        Country::create([
            'ar' => ['name' => 'ساموا الأمريكية', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'American Samoa', 'currency' => 'USD'],
            'iso_code'      => 'ASM',
            'phone_code'    => '+1-684',
        ]);
        Country::create([
            'ar' => ['name' => 'أندورا', 'currency' => 'يورو'],
            'en' => ['name' => 'Andorra', 'currency' => 'EUR'],
            'iso_code'      => 'AND',
            'phone_code'    => '376',
        ]);
        Country::create([
            'ar' => ['name' => 'أنغولا', 'currency' => 'كوانزا أنغولي'],
            'en' => ['name' => 'Angola', 'currency' => 'AOA'],
            'iso_code'      => 'AGO',
            'phone_code'    => '244',
        ]);
        Country::create([
            'ar' => ['name' => 'أنجويلا', 'currency' => 'دولار شرق الكاريبي'],
            'en' => ['name' => 'Anguilla', 'currency' => 'XCD'],
            'iso_code'      => 'AIA',
            'phone_code'    => '+1-264',
        ]);
        Country::create([
            'ar' => ['name' => 'انتيغا وباربودا', 'currency' => 'دولار شرق الكاريبي'],
            'en' => ['name' => 'Antigua And Barbuda', 'currency' => 'XCD'],
            'iso_code'      => 'ATG',
            'phone_code'    => '+1-268',
        ]);
        Country::create([
            'ar' => ['name' => 'الأرجنتين', 'currency' => 'بيزو أرجنتيني'],
            'en' => ['name' => 'Argentina', 'currency' => 'ARS'],
            'iso_code'      => 'ARG',
            'phone_code'    => '54',
        ]);
        Country::create([
            'ar' => ['name' => 'أرمينيا', 'currency' => 'درام أرميني'],
            'en' => ['name' => 'Armenia', 'currency' => 'AMD'],
            'iso_code'      => 'ARM',
            'phone_code'    => '374',
        ]);
        Country::create([
            'ar' => ['name' => 'أروبا', 'currency' => 'فلورن أروبي'],
            'en' => ['name' => 'Aruba', 'currency' => 'AWG'],
            'iso_code'      => 'ABW',
            'phone_code'    => '297',
        ]);
        Country::create([
            'ar' => ['name' => 'أستراليا', 'currency' => 'دولار أسترالي'],
            'en' => ['name' => 'Australia', 'currency' => 'AUD'],
            'iso_code'      => 'AUS',
            'phone_code'    => '61',
        ]);
        Country::create([
            'ar' => ['name' => 'النمسا', 'currency' => 'يورو'],
            'en' => ['name' => 'Austria', 'currency' => 'EUR'],
            'iso_code'      => 'AUT',
            'phone_code'    => '43',
        ]);
        Country::create([
            'ar' => ['name' => 'أذربيجان', 'currency' => 'مانات أذربيجاني'],
            'en' => ['name' => 'Azerbaijan', 'currency' => 'AZN'],
            'iso_code'      => 'AZE',
            'phone_code'    => '994',
        ]);
        Country::create([
            'ar' => ['name' => 'الباهاما', 'currency' => 'دولار بهامي'],
            'en' => ['name' => 'Bahamas', 'currency' => 'BSD'],
            'iso_code'      => 'BHS',
            'phone_code'    => '+1-242',
        ]);
        Country::create([
            'ar' => ['name' => 'البحرين', 'currency' => 'دينار بحريني'],
            'en' => ['name' => 'Bahrain', 'currency' => 'BHD'],
            'iso_code'      => 'BHR',
            'phone_code'    => '973',
        ]);
        Country::create([
            'ar' => ['name' => 'بنغلاديش', 'currency' => 'تاكا بنغلاديشي'],
            'en' => ['name' => 'Bangladesh', 'currency' => 'BDT'],
            'iso_code'      => 'BGD',
            'phone_code'    => '880',
        ]);
        Country::create([
            'ar' => ['name' => 'بربادوس', 'currency' => 'دولار بربادوسي'],
            'en' => ['name' => 'Barbados', 'currency' => 'BBD'],
            'iso_code'      => 'BRB',
            'phone_code'    => '+1-246',
        ]);
        Country::create([
            'ar' => ['name' => 'روسيا البيضاء', 'currency' => 'روبل روسي'],
            'en' => ['name' => 'Belarus', 'currency' => 'BYN'],
            'iso_code'      => 'BLR',
            'phone_code'    => '375',
        ]);
        Country::create([
            'ar' => ['name' => 'بلجيكا', 'currency' => 'يورو'],
            'en' => ['name' => 'Belgium', 'currency' => 'EUR'],
            'iso_code'      => 'BEL',
            'phone_code'    => '32',
        ]);
        Country::create([
            'ar' => ['name' => 'بيليز', 'currency' => 'دولار بليزي'],
            'en' => ['name' => 'Belize', 'currency' => 'BZD'],
            'iso_code'      => 'BLZ',
            'phone_code'    => '501',
        ]);
        Country::create([
            'ar' => ['name' => 'بنين', 'currency' => 'فرنك غرب أفريقي'],
            'en' => ['name' => 'Benin', 'currency' => 'XOF'],
            'iso_code'      => 'BEN',
            'phone_code'    => '229',
        ]);
        Country::create([
            'ar' => ['name' => 'برمودا', 'currency' => 'دولار برمودي'],
            'en' => ['name' => 'Bermuda', 'currency' => 'BMD'],
            'iso_code'      => 'BMU',
            'phone_code'    => '+1-441',
        ]);
        Country::create([
            'ar' => ['name' => 'بوتان', 'currency' => 'نغولتروم بوتاني'],
            'en' => ['name' => 'Bhutan', 'currency' => 'BTN'],
            'iso_code'      => 'BTN',
            'phone_code'    => '975',
        ]);
        Country::create([
            'ar' => ['name' => 'بوليفيا', 'currency' => 'بوليفيانو بوليفي'],
            'en' => ['name' => 'Bolivia', 'currency' => 'BOB'],
            'iso_code'      => 'BOL',
            'phone_code'    => '591',
        ]);
        Country::create([
            'ar' => ['name' => 'البوسنة والهرسك', 'currency' => 'مارك بوسني قابل للتحويل'],
            'en' => ['name' => 'Bosnia and Herzegovina', 'currency' => 'BAM'],
            'iso_code'      => 'BIH',
            'phone_code'    => '387',
        ]);
        Country::create([
            'ar' => ['name' => 'بوتسوانا', 'currency' => 'بولا بوتسواني'],
            'en' => ['name' => 'Botswana', 'currency' => 'BWP'],
            'iso_code'      => 'BWA',
            'phone_code'    => '267',
        ]);
        Country::create([
            'ar' => ['name' => 'البرازيل', 'currency' => 'ريال برازيلي'],
            'en' => ['name' => 'Brazil', 'currency' => 'BRL'],
            'iso_code'      => 'BRA',
            'phone_code'    => '55',
        ]);
        Country::create([
            'ar' => ['name' => 'إقليم المحيط الهندي البريطاني', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'British Indian Ocean Territory', 'currency' => 'USD'],
            'iso_code'      => 'IOT',
            'phone_code'    => '‎246',
        ]);
        Country::create([
            'ar' => ['name' => 'بروناي', 'currency' => 'دولار بروني'],
            'en' => ['name' => 'Brunei', 'currency' => 'BND'],
            'iso_code'      => 'BRN',
            'phone_code'    => '673',
        ]);
        Country::create([
            'ar' => ['name' => 'بلغاريا', 'currency' => 'ليف بلغاري'],
            'en' => ['name' => 'Bulgaria', 'currency' => 'BGN'],
            'iso_code'      => 'BGR',
            'phone_code'    => '359',
        ]);
        Country::create([
            'ar' => ['name' => 'بوركينا فاسو', 'currency' => 'فرنك غرب أفريقي'],
            'en' => ['name' => 'Burkina Faso', 'currency' => 'XOF'],
            'iso_code'      => 'BFA',
            'phone_code'    => '226',
        ]);
        Country::create([
            'ar' => ['name' => 'بوروندي', 'currency' => 'فرنك بوروندي'],
            'en' => ['name' => 'Burundi', 'currency' => 'BIF'],
            'iso_code'      => 'BDI',
            'phone_code'    => '257',
        ]);
        Country::create([
            'ar' => ['name' => 'كمبوديا', 'currency' => 'ريال كمبودي'],
            'en' => ['name' => 'Cambodia', 'currency' => 'KHR'],
            'iso_code'      => 'KHM',
            'phone_code'    => '855',
        ]);
        Country::create([
            'ar' => ['name' => 'الكاميرون', 'currency' => 'فرنك وسط أفريقي'],
            'en' => ['name' => 'Cameroon', 'currency' => 'XAF'],
            'iso_code'      => 'CMR',
            'phone_code'    => '237',
        ]);
        Country::create([
            'ar' => ['name' => 'كندا', 'currency' => 'دولار كندي'],
            'en' => ['name' => 'Canada', 'currency' => 'CAD'],
            'iso_code'      => 'CAN',
            'phone_code'    => '1',
        ]);
        Country::create([
            'ar' => ['name' => 'الرأس الأخضر', 'currency' => 'إيسكودو جزر الرأس الأخضر'],
            'en' => ['name' => 'Cape Verde', 'currency' => 'CVE'],
            'iso_code'      => 'CPV',
            'phone_code'    => '238',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر كايمان', 'currency' => 'دولار جزر كايمان'],
            'en' => ['name' => 'Cayman Islands', 'currency' => 'KYD'],
            'iso_code'      => 'CYM',
            'phone_code'    => '+1-345',
        ]);
        Country::create([
            'ar' => ['name' => 'جمهورية افريقيا الوسطى', 'currency' => 'فرنك وسط أفريقي'],
            'en' => ['name' => 'Central African Republic', 'currency' => 'XAF'],
            'iso_code'      => 'CAF',
            'phone_code'    => '236',
        ]);
        Country::create([
            'ar' => ['name' => 'تشاد', 'currency' => 'فرنك وسط أفريقي'],
            'en' => ['name' => 'Chad', 'currency' => 'XAF'],
            'iso_code'      => 'TCD',
            'phone_code'    => '235',
        ]);
        Country::create([
            'ar' => ['name' => 'تشيلي', 'currency' => 'بيزو تشيلي'],
            'en' => ['name' => 'Chile', 'currency' => 'CLP'],
            'iso_code'      => 'CHL',
            'phone_code'    => '56',
        ]);
        Country::create([
            'ar' => ['name' => 'الصين', 'currency' => 'رنمينبي'],
            'en' => ['name' => 'China', 'currency' => 'CNY'],
            'iso_code'      => 'CHN',
            'phone_code'    => '86',
        ]);
        Country::create([
            'ar' => ['name' => 'جزيرة الكريسماس', 'currency' => 'دولار أسترالي'],
            'en' => ['name' => 'Christmas Island', 'currency' => 'AUD'],
            'iso_code'      => 'CXR',
            'phone_code'    => '61',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر كوكوس (كيلينغ)', 'currency' => 'دولار أسترالي'],
            'en' => ['name' => 'Cocos (Keeling) Islands', 'currency' => 'AUD'],
            'iso_code'      => 'CCK',
            'phone_code'    => '61',
        ]);
        Country::create([
            'ar' => ['name' => 'كولومبيا', 'currency' => 'بيزو كولومبي'],
            'en' => ['name' => 'Colombia', 'currency' => 'COP'],
            'iso_code'      => 'COL',
            'phone_code'    => '57',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر القمر', 'currency' => 'فرنك قمري'],
            'en' => ['name' => 'Comoros', 'currency' => 'KMF'],
            'iso_code'      => 'COM',
            'phone_code'    => '269',
        ]);
        Country::create([
            'ar' => ['name' => 'الكونغو', 'currency' => 'فرنك كونغولي'],
            'en' => ['name' => 'Congo', 'currency' => 'XAF'],
            'iso_code'      => 'COG',
            'phone_code'    => '242',
        ]);
        Country::create([
            'ar' => ['name' => 'جمهورية الكونغو الديمقراطية', 'currency' => 'فرنك كونغولي'],
            'en' => ['name' => 'Congo The Democratic Republic Of The', 'currency' => 'CDF'],
            'iso_code'      => 'COD',
            'phone_code'    => '243',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر كوك', 'currency' => 'دولار نيوزيلندي'],
            'en' => ['name' => 'Cook Islands', 'currency' => 'NZD'],
            'iso_code'      => 'COK',
            'phone_code'    => '682',
        ]);
        Country::create([
            'ar' => ['name' => 'كوستا ريكا', 'currency' => 'كولون كوستاريكي'],
            'en' => ['name' => 'Costa Rica', 'currency' => 'CRC'],
            'iso_code'      => 'CRI',
            'phone_code'    => '506',
        ]);
        Country::create([
            'ar' => ['name' => 'ساحل العاج', 'currency' => 'فرنك غرب أفريقي'],
            'en' => ['name' => 'Ivory Coast', 'currency' => 'XOF'],
            'iso_code'      => 'CIV',
            'phone_code'    => '225',
        ]);
        Country::create([
            'ar' => ['name' => 'كرواتيا ', 'currency' => 'كونا كرواتية'],
            'en' => ['name' => 'Croatia', 'currency' => 'HRK'],
            'iso_code'      => 'HRV',
            'phone_code'    => '385',
        ]);
        Country::create([
            'ar' => ['name' => 'كوبا', 'currency' => 'بيزو كوبي'],
            'en' => ['name' => 'Cuba', 'currency' => 'CUP'],
            'iso_code'      => 'CUB',
            'phone_code'    => '53',
        ]);
        Country::create([
            'ar' => ['name' => 'قبرص', 'currency' => 'يورو'],
            'en' => ['name' => 'Cyprus', 'currency' => 'EUR'],
            'iso_code'      => 'CYP',
            'phone_code'    => '357',
        ]);
        Country::create([
            'ar' => ['name' => 'جمهورية التشيك', 'currency' => 'كرونة تشيكية'],
            'en' => ['name' => 'Czech Republic', 'currency' => 'CZK'],
            'iso_code'      => 'CZE',
            'phone_code'    => '420',
        ]);
        Country::create([
            'ar' => ['name' => 'الدنمارك', 'currency' => 'كرونة دنماركية'],
            'en' => ['name' => 'Denmark', 'currency' => 'DKK'],
            'iso_code'      => 'DNK',
            'phone_code'    => '45',
        ]);
        Country::create([
            'ar' => ['name' => 'جيبوتي', 'currency' => 'فرنك جيبوتي'],
            'en' => ['name' => 'Djibouti', 'currency' => 'DJF'],
            'iso_code'      => 'DJI',
            'phone_code'    => '253',
        ]);
        Country::create([
            'ar' => ['name' => 'دومينيكا', 'currency' => 'دولار شرق الكاريبي'],
            'en' => ['name' => 'Dominica', 'currency' => 'XCD'],
            'iso_code'      => 'DMA',
            'phone_code'    => '+1-767',
        ]);
        Country::create([
            'ar' => ['name' => 'جمهورية الدومينيكان', 'currency' => 'بيزو دومنيكاني'],
            'en' => ['name' => 'Dominican Republic', 'currency' => 'DOP'],
            'iso_code'      => 'DOM',
            'phone_code'    => '+1-809 and 1-829',
        ]);
        Country::create([
            'ar' => ['name' => 'تيمور الشرقية', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'East Timor', 'currency' => 'USD'],
            'iso_code'      => 'TLS',
            'phone_code'    => '670',
        ]);
        Country::create([
            'ar' => ['name' => 'الإكوادور', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Ecuador', 'currency' => 'USD'],
            'iso_code'      => 'ECU',
            'phone_code'    => '593',
        ]);
        Country::create([
            'ar' => ['name' => 'مصر', 'currency' => 'جنيه مصري'],
            'en' => ['name' => 'Egypt', 'currency' => 'EGP'],
            'iso_code'      => 'EGY',
            'phone_code'    => '20',
        ]);
        Country::create([
            'ar' => ['name' => 'السلفادور', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'El Salvador', 'currency' => 'USD'],
            'iso_code'      => 'SLV',
            'phone_code'    => '503',
        ]);
        Country::create([
            'ar' => ['name' => 'غينيا الإستوائية', 'currency' => 'فرنك وسط أفريقي'],
            'en' => ['name' => 'Equatorial Guinea', 'currency' => 'XAF'],
            'iso_code'      => 'GNQ',
            'phone_code'    => '240',
        ]);
        Country::create([
            'ar' => ['name' => 'إريتريا', 'currency' => 'ناكفا'],
            'en' => ['name' => 'Eritrea', 'currency' => 'ERN'],
            'iso_code'      => 'ERI',
            'phone_code'    => '291',
        ]);
        Country::create([
            'ar' => ['name' => 'استونيا', 'currency' => 'يورو'],
            'en' => ['name' => 'Estonia', 'currency' => 'EUR'],
            'iso_code'      => 'EST',
            'phone_code'    => '372',
        ]);
        Country::create([
            'ar' => ['name' => 'أثيوبيا', 'currency' => 'بير إثيوبي'],
            'en' => ['name' => 'Ethiopia', 'currency' => 'ETB'],
            'iso_code'      => 'ETH',
            'phone_code'    => '251',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر فوكلاند', 'currency' => 'جنيه جزر فوكلاند'],
            'en' => ['name' => 'Falkland Islands', 'currency' => 'FKP'],
            'iso_code'      => 'FLK',
            'phone_code'    => '500',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر فارو', 'currency' => 'كرونة دنماركية'],
            'en' => ['name' => 'Faroe Islands', 'currency' => 'DKK'],
            'iso_code'      => 'FRO',
            'phone_code'    => '298',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر فيجي', 'currency' => 'دولار فيجي'],
            'en' => ['name' => 'Fiji Islands', 'currency' => 'FJD'],
            'iso_code'      => 'FJI',
            'phone_code'    => '679',
        ]);
        Country::create([
            'ar' => ['name' => 'فنلندا', 'currency' => 'يورو'],
            'en' => ['name' => 'Finland', 'currency' => 'EUR'],
            'iso_code'      => 'FIN',
            'phone_code'    => '358',
        ]);
        Country::create([
            'ar' => ['name' => 'فرنسا', 'currency' => 'يورو'],
            'en' => ['name' => 'France', 'currency' => 'EUR'],
            'iso_code'      => 'FRA',
            'phone_code'    => '33',
        ]);
        Country::create([
            'ar' => ['name' => 'غينيا الفرنسية', 'currency' => 'يورو'],
            'en' => ['name' => 'French Guiana', 'currency' => 'EUR'],
            'iso_code'      => 'GUF',
            'phone_code'    => '594',
        ]);
        Country::create([
            'ar' => ['name' => 'بولينيزيا الفرنسية', 'currency' => 'فرنك باسيفيكي'],
            'en' => ['name' => 'French Polynesia', 'currency' => 'XPF'],
            'iso_code'      => 'PYF',
            'phone_code'    => '689',
        ]);
        Country::create([
            'ar' => ['name' => 'أراضي فرنسية جنوبية وأنتارتيكية', 'currency' => 'يورو'],
            'en' => ['name' => 'French Southern and Antarctic Lands', 'currency' => 'EUR'],
            'iso_code'      => 'ATF',
            'phone_code'    => '262',
        ]);
        Country::create([
            'ar' => ['name' => 'الغابون', 'currency' => 'فرنك وسط أفريقي'],
            'en' => ['name' => 'Gabon', 'currency' => 'XAF'],
            'iso_code'      => 'GAB',
            'phone_code'    => '241',
        ]);
        Country::create([
            'ar' => ['name' => 'غامبيا', 'currency' => 'دالاسي غامبي'],
            'en' => ['name' => 'Gambia', 'currency' => 'GMD'],
            'iso_code'      => 'GMB',
            'phone_code'    => '220',
        ]);
        Country::create([
            'ar' => ['name' => 'جورجيا', 'currency' => 'لاري جورجي'],
            'en' => ['name' => 'Georgia', 'currency' => 'GEL'],
            'iso_code'      => 'GEO',
            'phone_code'    => '995',
        ]);
        Country::create([
            'ar' => ['name' => 'ألمانيا', 'currency' => 'يورو'],
            'en' => ['name' => 'Germany', 'currency' => 'EUR'],
            'iso_code'      => 'DEU',
            'phone_code'    => '49',
        ]);
        Country::create([
            'ar' => ['name' => 'غانا', 'currency' => 'سيدي غاني'],
            'en' => ['name' => 'Ghana', 'currency' => 'GHS'],
            'iso_code'      => 'GHA',
            'phone_code'    => '233',
        ]);
        Country::create([
            'ar' => ['name' => 'جبل طارق', 'currency' => 'جنيه جبل طارق'],
            'en' => ['name' => 'Gibraltar', 'currency' => 'GIP'],
            'iso_code'      => 'GIB',
            'phone_code'    => '350',
        ]);
        Country::create([
            'ar' => ['name' => 'اليونان', 'currency' => 'يورو'],
            'en' => ['name' => 'Greece', 'currency' => 'EUR'],
            'iso_code'      => 'GRC',
            'phone_code'    => '30',
        ]);
        Country::create([
            'ar' => ['name' => 'جرينلاند', 'currency' => 'كرونة دنماركية'],
            'en' => ['name' => 'Greenland', 'currency' => 'DKK'],
            'iso_code'      => 'GRL',
            'phone_code'    => '299',
        ]);
        Country::create([
            'ar' => ['name' => 'غرينادا', 'currency' => 'دولار شرق الكاريبي'],
            'en' => ['name' => 'Grenada', 'currency' => 'XCD'],
            'iso_code'      => 'GRD',
            'phone_code'    => '+1-473',
        ]);
        Country::create([
            'ar' => ['name' => 'جوادلوب', 'currency' => 'يورو'],
            'en' => ['name' => 'Guadeloupe', 'currency' => 'EUR'],
            'iso_code'      => 'GLP',
            'phone_code'    => '590',
        ]);
        Country::create([
            'ar' => ['name' => 'غوام', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Guam', 'currency' => 'USD'],
            'iso_code'      => 'GUM',
            'phone_code'    => '+1-671',
        ]);
        Country::create([
            'ar' => ['name' => 'غواتيمالا', 'currency' => 'كتزال غواتيمالي'],
            'en' => ['name' => 'Guatemala', 'currency' => 'GTQ'],
            'iso_code'      => 'GTM',
            'phone_code'    => '502',
        ]);
        Country::create([
            'ar' => ['name' => 'آلدرني', 'currency' => 'جنيه إسترليني'],
            'en' => ['name' => 'Guernsey and Alderney', 'currency' => 'GBP'],
            'iso_code'      => 'GGY',
            'phone_code'    => '+44-1481',
        ]);
        Country::create([
            'ar' => ['name' => 'غينيا', 'currency' => 'فرنك غيني'],
            'en' => ['name' => 'Guinea', 'currency' => 'GNF'],
            'iso_code'      => 'GIN',
            'phone_code'    => '224',
        ]);
        Country::create([
            'ar' => ['name' => 'غينيا بيساو', 'currency' => 'فرنك غرب أفريقي'],
            'en' => ['name' => 'Guinea-Bissau', 'currency' => 'XOF'],
            'iso_code'      => 'GNB',
            'phone_code'    => '245',
        ]);
        Country::create([
            'ar' => ['name' => 'غيانا', 'currency' => 'دولار غياني'],
            'en' => ['name' => 'Guyana', 'currency' => 'GYD'],
            'iso_code'      => 'GUY',
            'phone_code'    => '592',
        ]);
        Country::create([
            'ar' => ['name' => 'هايتي', 'currency' => 'جوردة هايتية'],
            'en' => ['name' => 'Haiti', 'currency' => 'HTG'],
            'iso_code'      => 'HTI',
            'phone_code'    => '509',
        ]);
        Country::create([
            'ar' => ['name' => 'هندوراس', 'currency' => 'لمبيرة هندوراسية'],
            'en' => ['name' => 'Honduras', 'currency' => 'HNL'],
            'iso_code'      => 'HND',
            'phone_code'    => '504',
        ]);
        Country::create([
            'ar' => ['name' => 'هونغ كونغ', 'currency' => 'دولار هونغ كونغ'],
            'en' => ['name' => 'Hong Kong', 'currency' => 'HKD'],
            'iso_code'      => 'HKG',
            'phone_code'    => '852',
        ]);
        Country::create([
            'ar' => ['name' => 'المجر', 'currency' => 'فورنت مجري'],
            'en' => ['name' => 'Hungary', 'currency' => 'HUF'],
            'iso_code'      => 'HUN',
            'phone_code'    => '36',
        ]);
        Country::create([
            'ar' => ['name' => 'أيسلندا', 'currency' => 'كرونة آيسلندية'],
            'en' => ['name' => 'Iceland', 'currency' => 'ISK'],
            'iso_code'      => 'ISL',
            'phone_code'    => '354',
        ]);
        Country::create([
            'ar' => ['name' => 'الهند', 'currency' => 'روبية هندية'],
            'en' => ['name' => 'India', 'currency' => 'INR'],
            'iso_code'      => 'IND',
            'phone_code'    => '91',
        ]);
        Country::create([
            'ar' => ['name' => 'أندونيسيا', 'currency' => 'روبية إندونيسية'],
            'en' => ['name' => 'Indonesia', 'currency' => 'IDR'],
            'iso_code'      => 'IDN',
            'phone_code'    => '62',
        ]);
        Country::create([
            'ar' => ['name' => 'إيران', 'currency' => 'ريال إيراني'],
            'en' => ['name' => 'Iran', 'currency' => 'IRR'],
            'iso_code'      => 'IRN',
            'phone_code'    => '98',
        ]);
        Country::create([
            'ar' => ['name' => 'العراق', 'currency' => 'دينار عراقي'],
            'en' => ['name' => 'Iraq', 'currency' => 'IQD'],
            'iso_code'      => 'IRQ',
            'phone_code'    => '964',
        ]);
        Country::create([
            'ar' => ['name' => 'أيرلندا', 'currency' => 'يورو'],
            'en' => ['name' => 'Ireland', 'currency' => 'EUR'],
            'iso_code'      => 'IRL',
            'phone_code'    => '353',
        ]);
        Country::create([
            'ar' => ['name' => 'الكيان الصهيوني', 'currency' => 'شيكل إسرائيلي'],
            'en' => ['name' => 'Israel', 'currency' => 'ILS'],
            'iso_code'      => 'ISR',
            'phone_code'    => '972',
        ]);
        Country::create([
            'ar' => ['name' => 'إيطاليا', 'currency' => 'يورو'],
            'en' => ['name' => 'Italy', 'currency' => 'EUR'],
            'iso_code'      => 'ITA',
            'phone_code'    => '39',
        ]);
        Country::create([
            'ar' => ['name' => 'جامايكا', 'currency' => 'دولار جامايكي'],
            'en' => ['name' => 'Jamaica', 'currency' => 'JMD'],
            'iso_code'      => 'JAM',
            'phone_code'    => '+1-876',
        ]);
        Country::create([
            'ar' => ['name' => 'اليابان', 'currency' => 'ين ياباني'],
            'en' => ['name' => 'Japan', 'currency' => 'JPY'],
            'iso_code'      => 'JPN',
            'phone_code'    => '81',
        ]);
        Country::create([
            'ar' => ['name' => 'جيرسي', 'currency' => 'جنيه إسترليني'],
            'en' => ['name' => 'Jersey', 'currency' => 'GBP'],
            'iso_code'      => 'JEY',
            'phone_code'    => '+44-1534',
        ]);
        Country::create([
            'ar' => ['name' => 'الأردن', 'currency' => 'دينار أردني'],
            'en' => ['name' => 'Jordan', 'currency' => 'JOD'],
            'iso_code'      => 'JOR',
            'phone_code'    => '962',
        ]);
        Country::create([
            'ar' => ['name' => 'كازاخستان', 'currency' => 'تينغ كازاخستاني'],
            'en' => ['name' => 'Kazakhstan', 'currency' => 'KZT'],
            'iso_code'      => 'KAZ',
            'phone_code'    => '7',
        ]);
        Country::create([
            'ar' => ['name' => 'كينيا', 'currency' => 'شيلينغ كيني'],
            'en' => ['name' => 'Kenya', 'currency' => 'KES'],
            'iso_code'      => 'KEN',
            'phone_code'    => '254',
        ]);
        Country::create([
            'ar' => ['name' => 'كيريباس', 'currency' => 'دولار أسترالي'],
            'en' => ['name' => 'Kiribati', 'currency' => 'AUD'],
            'iso_code'      => 'KIR',
            'phone_code'    => '686',
        ]);
        Country::create([
            'ar' => ['name' => 'كوريا الشمالية', 'currency' => 'وون كوري شمالي'],
            'en' => ['name' => 'Korea North', 'currency' => 'KPW'],
            'iso_code'      => 'PRK',
            'phone_code'    => '850',
        ]);
        Country::create([
            'ar' => ['name' => 'كوريا الجنوبية', 'currency' => 'وون كوري جنوبي'],
            'en' => ['name' => 'Korea South', 'currency' => 'KRW'],
            'iso_code'      => 'KOR',
            'phone_code'    => '82',
        ]);
        Country::create([
            'ar' => ['name' => 'كوسوفو', 'currency' => 'يورو'],
            'en' => ['name' => 'Kosovo', 'currency' => 'EUR'],
            'iso_code'      => 'XKX',
            'phone_code'    => '383',
        ]);
        Country::create([
            'ar' => ['name' => 'الكويت', 'currency' => 'دينار كويتي'],
            'en' => ['name' => 'Kuwait', 'currency' => 'KWD'],
            'iso_code'      => 'KWT',
            'phone_code'    => '965',
        ]);
        Country::create([
            'ar' => ['name' => 'قرغيزستان', 'currency' => 'سوم قيرغيزستاني'],
            'en' => ['name' => 'Kyrgyzstan', 'currency' => 'KGS'],
            'iso_code'      => 'KGZ',
            'phone_code'    => '996',
        ]);
        Country::create([
            'ar' => ['name' => 'لاوس', 'currency' => 'كيب لاوي'],
            'en' => ['name' => 'Laos', 'currency' => 'LAK'],
            'iso_code'      => 'LAO',
            'phone_code'    => '856',
        ]);
        Country::create([
            'ar' => ['name' => 'لاتفيا', 'currency' => 'يورو'],
            'en' => ['name' => 'Latvia', 'currency' => 'EUR'],
            'iso_code'      => 'LVA',
            'phone_code'    => '371',
        ]);
        Country::create([
            'ar' => ['name' => 'لبنان', 'currency' => 'ليرة لبنانية'],
            'en' => ['name' => 'Lebanon', 'currency' => 'LBP'],
            'iso_code'      => 'LBN',
            'phone_code'    => '961',
        ]);
        Country::create([
            'ar' => ['name' => 'ليسوتو', 'currency' => 'راند جنوب أفريقي'],
            'en' => ['name' => 'Lesotho', 'currency' => 'LSL'],
            'iso_code'      => 'LSO',
            'phone_code'    => '266',
        ]);
        Country::create([
            'ar' => ['name' => 'ليبيريا', 'currency' => 'دولار ليبيري'],
            'en' => ['name' => 'Liberia', 'currency' => 'LRD'],
            'iso_code'      => 'LBR',
            'phone_code'    => '231',
        ]);
        Country::create([
            'ar' => ['name' => 'ليبيا', 'currency' => 'دينار ليبي'],
            'en' => ['name' => 'Libya', 'currency' => 'LYD'],
            'iso_code'      => 'LBY',
            'phone_code'    => '218',
        ]);
        Country::create([
            'ar' => ['name' => 'ليختنشتاين', 'currency' => 'فرنك سويسري'],
            'en' => ['name' => 'Liechtenstein', 'currency' => 'CHF'],
            'iso_code'      => 'LIE',
            'phone_code'    => '423',
        ]);
        Country::create([
            'ar' => ['name' => 'ليتوانيا', 'currency' => 'يورو'],
            'en' => ['name' => 'Lithuania', 'currency' => 'EUR'],
            'iso_code'      => 'LTU',
            'phone_code'    => '370',
        ]);
        Country::create([
            'ar' => ['name' => 'لوكسمبورغ', 'currency' => 'يورو'],
            'en' => ['name' => 'Luxembourg', 'currency' => 'EUR'],
            'iso_code'      => 'LUX',
            'phone_code'    => '352',
        ]);
        Country::create([
            'ar' => ['name' => 'ماكاو', 'currency' => 'باتاكا ماكاوية'],
            'en' => ['name' => 'Macau', 'currency' => 'MOP'],
            'iso_code'      => 'MAC',
            'phone_code'    => '853',
        ]);
        Country::create([
            'ar' => ['name' => 'مقدونيا', 'currency' => 'دينار مقدوني'],
            'en' => ['name' => 'Macedonia', 'currency' => 'MKD'],
            'iso_code'      => 'MKD',
            'phone_code'    => '389',
        ]);
        Country::create([
            'ar' => ['name' => 'مدغشقر', 'currency' => 'أرياري مدغشقري'],
            'en' => ['name' => 'Madagascar', 'currency' => 'MGA'],
            'iso_code'      => 'MDG',
            'phone_code'    => '261',
        ]);
        Country::create([
            'ar' => ['name' => 'مالاوي', 'currency' => 'كواشا ملاوية'],
            'en' => ['name' => 'Malawi', 'currency' => 'MWK'],
            'iso_code'      => 'MWI',
            'phone_code'    => '265',
        ]);
        Country::create([
            'ar' => ['name' => 'ماليزيا', 'currency' => 'رينغيت ماليزي'],
            'en' => ['name' => 'Malaysia', 'currency' => 'MYR'],
            'iso_code'      => 'MYS',
            'phone_code'    => '60',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر المالديف', 'currency' => 'روفيا مالديفية'],
            'en' => ['name' => 'Maldives', 'currency' => 'MVR'],
            'iso_code'      => 'MDV',
            'phone_code'    => '960',
        ]);
        Country::create([
            'ar' => ['name' => 'مالي', 'currency' => 'فرنك غرب أفريقي'],
            'en' => ['name' => 'Mali', 'currency' => 'XOF'],
            'iso_code'      => 'MLI',
            'phone_code'    => '223',
        ]);
        Country::create([
            'ar' => ['name' => 'مالطا', 'currency' => 'يورو'],
            'en' => ['name' => 'Malta', 'currency' => 'EUR'],
            'iso_code'      => 'MLT',
            'phone_code'    => '356',
        ]);
        Country::create([
            'ar' => ['name' => 'جزيرة مان', 'currency' => 'جنيه إسترليني'],
            'en' => ['name' => 'Isle of Man', 'currency' => 'GBP'],
            'iso_code'      => 'IMN',
            'phone_code'    => '+44-1624',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر مارشال', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Marshall Islands', 'currency' => 'USD'],
            'iso_code'      => 'MHL',
            'phone_code'    => '692',
        ]);
        Country::create([
            'ar' => ['name' => 'مارتينيك', 'currency' => 'يورو'],
            'en' => ['name' => 'Martinique', 'currency' => 'EUR'],
            'iso_code'      => 'MTQ',
            'phone_code'    => '596',
        ]);
        Country::create([
            'ar' => ['name' => 'موريتانيا', 'currency' => 'أوقية موريتانية'],
            'en' => ['name' => 'Mauritania', 'currency' => 'MRO'],
            'iso_code'      => 'MRT',
            'phone_code'    => '222',
        ]);
        Country::create([
            'ar' => ['name' => 'موريشيوس', 'currency' => 'روبي موريشي'],
            'en' => ['name' => 'Mauritius', 'currency' => 'MUR'],
            'iso_code'      => 'MUS',
            'phone_code'    => '230',
        ]);
        Country::create([
            'ar' => ['name' => 'مايوت', 'currency' => 'يورو'],
            'en' => ['name' => 'Mayotte', 'currency' => 'EUR'],
            'iso_code'      => 'MYT',
            'phone_code'    => '262',
        ]);
        Country::create([
            'ar' => ['name' => 'المكسيك', 'currency' => 'بيزو مكسيكي'],
            'en' => ['name' => 'Mexico', 'currency' => 'MXN'],
            'iso_code'      => 'MEX',
            'phone_code'    => '52',
        ]);
        Country::create([
            'ar' => ['name' => 'ولايات ميكرونيزيا الموحدة', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Micronesia', 'currency' => 'USD'],
            'iso_code'      => 'FSM',
            'phone_code'    => '691',
        ]);
        Country::create([
            'ar' => ['name' => 'مولدوفا', 'currency' => 'ليو مولدوفي'],
            'en' => ['name' => 'Moldova', 'currency' => 'MDL'],
            'iso_code'      => 'MDA',
            'phone_code'    => '373',
        ]);
        Country::create([
            'ar' => ['name' => 'موناكو', 'currency' => 'يورو'],
            'en' => ['name' => 'Monaco', 'currency' => 'EUR'],
            'iso_code'      => 'MCO',
            'phone_code'    => '377',
        ]);
        Country::create([
            'ar' => ['name' => 'منغوليا', 'currency' => 'توغروغ منغولي'],
            'en' => ['name' => 'Mongolia', 'currency' => 'MNT'],
            'iso_code'      => 'MNG',
            'phone_code'    => '976',
        ]);
        Country::create([
            'ar' => ['name' => 'الجبل الأسود', 'currency' => 'يورو'],
            'en' => ['name' => 'Montenegro', 'currency' => 'EUR'],
            'iso_code'      => 'MNE',
            'phone_code'    => '382',
        ]);
        Country::create([
            'ar' => ['name' => 'مونتسيرات', 'currency' => 'دولار شرق الكاريبي'],
            'en' => ['name' => 'Montserrat', 'currency' => 'XCD'],
            'iso_code'      => 'MSR',
            'phone_code'    => '+1-664',
        ]);
        Country::create([
            'ar' => ['name' => 'المغرب', 'currency' => 'درهم مغربي'],
            'en' => ['name' => 'Morocco', 'currency' => 'MAD'],
            'iso_code'      => 'MAR',
            'phone_code'    => '212',
        ]);
        Country::create([
            'ar' => ['name' => 'موزمبيق', 'currency' => 'متكال موزمبيقي'],
            'en' => ['name' => 'Mozambique', 'currency' => 'MZN'],
            'iso_code'      => 'MOZ',
            'phone_code'    => '258',
        ]);
        Country::create([
            'ar' => ['name' => 'ميانمار', 'currency' => 'كيات ميانماري'],
            'en' => ['name' => 'Myanmar', 'currency' => 'MMK'],
            'iso_code'      => 'MMR',
            'phone_code'    => '95',
        ]);
        Country::create([
            'ar' => ['name' => 'ناميبيا', 'currency' => 'راند جنوب أفريقي'],
            'en' => ['name' => 'Namibia', 'currency' => 'NAD'],
            'iso_code'      => 'NAM',
            'phone_code'    => '264',
        ]);
        Country::create([
            'ar' => ['name' => 'ناورو', 'currency' => 'دولار أسترالي'],
            'en' => ['name' => 'Nauru', 'currency' => 'AUD'],
            'iso_code'      => 'NRU',
            'phone_code'    => '674',
        ]);
        Country::create([
            'ar' => ['name' => 'نيبال', 'currency' => 'روبية نيبالية'],
            'en' => ['name' => 'Nepal', 'currency' => 'NPR'],
            'iso_code'      => 'NPL',
            'phone_code'    => '977',
        ]);
        Country::create([
            'ar' => ['name' => 'هولندا', 'currency' => 'يورو'],
            'en' => ['name' => 'Netherlands', 'currency' => 'EUR'],
            'iso_code'      => 'NLD',
            'phone_code'    => '31',
        ]);
        Country::create([
            'ar' => ['name' => 'كاليدونيا الجديدة', 'currency' => 'فرنك باسيفيكي'],
            'en' => ['name' => 'New Caledonia', 'currency' => 'XPF'],
            'iso_code'      => 'NCL',
            'phone_code'    => '687',
        ]);
        Country::create([
            'ar' => ['name' => 'نيوزيلندا ', 'currency' => 'دولار نيوزيلندي'],
            'en' => ['name' => 'New Zealand', 'currency' => 'NZD'],
            'iso_code'      => 'NZL',
            'phone_code'    => '64',
        ]);
        Country::create([
            'ar' => ['name' => 'نيكاراغوا', 'currency' => 'كوردبا نيكاراغوا'],
            'en' => ['name' => 'Nicaragua', 'currency' => 'NIO'],
            'iso_code'      => 'NIC',
            'phone_code'    => '505',
        ]);
        Country::create([
            'ar' => ['name' => 'النيجر', 'currency' => 'فرنك غرب أفريقي'],
            'en' => ['name' => 'Niger', 'currency' => 'XOF'],
            'iso_code'      => 'NER',
            'phone_code'    => '227',
        ]);
        Country::create([
            'ar' => ['name' => 'نيجيريا', 'currency' => 'نيرة نيجيرية'],
            'en' => ['name' => 'Nigeria', 'currency' => 'NGN'],
            'iso_code'      => 'NGA',
            'phone_code'    => '234',
        ]);
        Country::create([
            'ar' => ['name' => 'نييوي', 'currency' => 'دولار نيوزيلندي'],
            'en' => ['name' => 'Niue', 'currency' => 'NZD'],
            'iso_code'      => 'NIU',
            'phone_code'    => '683',
        ]);
        Country::create([
            'ar' => ['name' => 'جزيرة نورفولك', 'currency' => 'دولار أسترالي'],
            'en' => ['name' => 'Norfolk Island', 'currency' => 'AUD'],
            'iso_code'      => 'NFK',
            'phone_code'    => '672',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر ماريانا الشمالية', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Northern Mariana Islands', 'currency' => 'USD'],
            'iso_code'      => 'MNP',
            'phone_code'    => '+1-670',
        ]);
        Country::create([
            'ar' => ['name' => 'النرويج', 'currency' => 'كرونة نروجية'],
            'en' => ['name' => 'Norway', 'currency' => 'NOK'],
            'iso_code'      => 'NOR',
            'phone_code'    => '47',
        ]);
        Country::create([
            'ar' => ['name' => 'سلطنة عمان', 'currency' => 'ريال عماني'],
            'en' => ['name' => 'Oman', 'currency' => 'OMR'],
            'iso_code'      => 'OMN',
            'phone_code'    => '968',
        ]);
        Country::create([
            'ar' => ['name' => 'باكستان', 'currency' => 'روبية باكستانية'],
            'en' => ['name' => 'Pakistan', 'currency' => 'PKR'],
            'iso_code'      => 'PAK',
            'phone_code'    => '92',
        ]);
        Country::create([
            'ar' => ['name' => 'بالاو', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Palau', 'currency' => 'USD'],
            'iso_code'      => 'PLW',
            'phone_code'    => '680',
        ]);
        Country::create([
            'ar' => ['name' => 'الأراضي الفلسطينية', 'currency' => 'شيكل إسرائيلي'],
            'en' => ['name' => 'Palestinian Territory', 'currency' => 'ILS'],
            'iso_code'      => 'PSE',
            'phone_code'    => '970',
        ]);
        Country::create([
            'ar' => ['name' => 'بناما', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Panama', 'currency' => 'USD'],
            'iso_code'      => 'PAN',
            'phone_code'    => '507',
        ]);
        Country::create([
            'ar' => ['name' => 'بابوا غينيا الجديدة', 'currency' => 'بابوا غينيا الجديدة'],
            'en' => ['name' => 'Papua new Guinea', 'currency' => 'PGK'],
            'iso_code'      => 'PNG',
            'phone_code'    => '675',
        ]);
        Country::create([
            'ar' => ['name' => 'باراغواي', 'currency' => 'غواراني باراغواي'],
            'en' => ['name' => 'Paraguay', 'currency' => 'PYG'],
            'iso_code'      => 'PRY',
            'phone_code'    => '595',
        ]);
        Country::create([
            'ar' => ['name' => 'بيرو', 'currency' => 'سول بيروفي جديد'],
            'en' => ['name' => 'Peru', 'currency' => 'PEN'],
            'iso_code'      => 'PER',
            'phone_code'    => '51',
        ]);
        Country::create([
            'ar' => ['name' => 'الفلبين', 'currency' => 'بيسو فلبيني'],
            'en' => ['name' => 'Philippines', 'currency' => 'PHP'],
            'iso_code'      => 'PHL',
            'phone_code'    => '63',
        ]);
        Country::create([
            'ar' => ['name' => 'بيتكيرن', 'currency' => 'دولار نيوزيلندي'],
            'en' => ['name' => 'Pitcairn', 'currency' => 'NZD'],
            'iso_code'      => 'PCN',
            'phone_code'    => '870',
        ]);
        Country::create([
            'ar' => ['name' => 'بولندا', 'currency' => 'زلوتي بولندي'],
            'en' => ['name' => 'Poland', 'currency' => 'PLN'],
            'iso_code'      => 'POL',
            'phone_code'    => '48',
        ]);
        Country::create([
            'ar' => ['name' => 'البرتغال', 'currency' => 'يورو'],
            'en' => ['name' => 'Portugal', 'currency' => 'EUR'],
            'iso_code'      => 'PRT',
            'phone_code'    => '351',
        ]);
        Country::create([
            'ar' => ['name' => 'بورتوريكو', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Puerto Rico', 'currency' => 'USD'],
            'iso_code'      => 'PRI',
            'phone_code'    => '+1-787 and 1-939',
        ]);
        Country::create([
            'ar' => ['name' => 'قطر', 'currency' => 'ريال قطري'],
            'en' => ['name' => 'Qatar', 'currency' => 'QAR'],
            'iso_code'      => 'QAT',
            'phone_code'    => '974',
        ]);
        Country::create([
            'ar' => ['name' => 'ريونيون', 'currency' => 'يورو'],
            'en' => ['name' => 'Reunion', 'currency' => 'EUR'],
            'iso_code'      => 'REU',
            'phone_code'    => '262',
        ]);
        Country::create([
            'ar' => ['name' => 'رومانيا', 'currency' => 'ليو روماني'],
            'en' => ['name' => 'Romania', 'currency' => 'RON'],
            'iso_code'      => 'ROU',
            'phone_code'    => '40',
        ]);
        Country::create([
            'ar' => ['name' => 'روسيا', 'currency' => 'روبل روسي'],
            'en' => ['name' => 'Russia', 'currency' => 'RUB'],
            'iso_code'      => 'RUS',
            'phone_code'    => '7',
        ]);
        Country::create([
            'ar' => ['name' => 'رواندا', 'currency' => 'فرنك رواندي'],
            'en' => ['name' => 'Rwanda', 'currency' => 'RWF'],
            'iso_code'      => 'RWA',
            'phone_code'    => '250',
        ]);
        Country::create([
            'ar' => ['name' => 'سانت هيلانة', 'currency' => 'جنيه سانت هيليني'],
            'en' => ['name' => 'Saint Helena', 'currency' => 'SHP'],
            'iso_code'      => 'SHN',
            'phone_code'    => '290',
        ]);
        Country::create([
            'ar' => ['name' => 'سانت كيتس ونيفيس', 'currency' => 'دولار شرق الكاريبي'],
            'en' => ['name' => 'Saint Kitts And Nevis', 'currency' => 'XCD'],
            'iso_code'      => 'KNA',
            'phone_code'    => '+1-869',
        ]);
        Country::create([
            'ar' => ['name' => 'القديسة لوسيا', 'currency' => 'دولار شرق الكاريبي'],
            'en' => ['name' => 'Saint Lucia', 'currency' => 'XCD'],
            'iso_code'      => 'LCA',
            'phone_code'    => '+1-758',
        ]);
        Country::create([
            'ar' => ['name' => 'سانت بيير وميكلون', 'currency' => 'يورو'],
            'en' => ['name' => 'Saint Pierre and Miquelon', 'currency' => 'EUR'],
            'iso_code'      => 'SPM',
            'phone_code'    => '508',
        ]);
        Country::create([
            'ar' => ['name' => 'سانت فنسنت وجزر غرينادين', 'currency' => 'دولار شرق الكاريبي'],
            'en' => ['name' => 'Saint Vincent And The Grenadines', 'currency' => 'XCD'],
            'iso_code'      => 'VCT',
            'phone_code'    => '+1-784',
        ]);
        Country::create([
            'ar' => ['name' => 'سانت بارتيليمي', 'currency' => 'يورو'],
            'en' => ['name' => 'Saint-Barthelemy', 'currency' => 'EUR'],
            'iso_code'      => 'BLM',
            'phone_code'    => '590',
        ]);
        Country::create([
            'ar' => ['name' => 'سانت مارتن', 'currency' => 'يورو'],
            'en' => ['name' => 'Saint-Martin', 'currency' => 'EUR'],
            'iso_code'      => 'MAF',
            'phone_code'    => '590',
        ]);
        Country::create([
            'ar' => ['name' => 'ساموا', 'currency' => 'تالا ساموي'],
            'en' => ['name' => 'Samoa', 'currency' => 'WST'],
            'iso_code'      => 'WSM',
            'phone_code'    => '685',
        ]);
        Country::create([
            'ar' => ['name' => 'سان مارينو', 'currency' => 'يورو'],
            'en' => ['name' => 'San Marino', 'currency' => 'EUR'],
            'iso_code'      => 'SMR',
            'phone_code'    => '378',
        ]);
        Country::create([
            'ar' => ['name' => 'ساو تومي وبرينسيبي', 'currency' => 'دوبرا ساو تومي وبرينسيب'],
            'en' => ['name' => 'Sao Tome and Principe', 'currency' => 'STD'],
            'iso_code'      => 'STP',
            'phone_code'    => '239',
        ]);
        Country::create([
            'ar' => ['name' => 'المملكة العربية السعودية', 'currency' => 'ريال سعودي'],
            'en' => ['name' => 'Saudi Arabia', 'currency' => 'SAR'],
            'iso_code'      => 'SAU',
            'phone_code'    => '966',
        ]);
        Country::create([
            'ar' => ['name' => 'السنغال', 'currency' => 'فرنك غرب أفريقي'],
            'en' => ['name' => 'Senegal', 'currency' => 'XOF'],
            'iso_code'      => 'SEN',
            'phone_code'    => '221',
        ]);
        Country::create([
            'ar' => ['name' => 'صربيا', 'currency' => 'دينار صربي'],
            'en' => ['name' => 'Serbia', 'currency' => 'RSD'],
            'iso_code'      => 'SRB',
            'phone_code'    => '381',
        ]);
        Country::create([
            'ar' => ['name' => 'سيشيل', 'currency' => 'روبية سيشلية'],
            'en' => ['name' => 'Seychelles', 'currency' => 'SCR'],
            'iso_code'      => 'SYC',
            'phone_code'    => '248',
        ]);
        Country::create([
            'ar' => ['name' => 'سيرا ليون', 'currency' => 'ليون سيراليوني'],
            'en' => ['name' => 'Sierra Leone', 'currency' => 'SLL'],
            'iso_code'      => 'SLE',
            'phone_code'    => '232',
        ]);
        Country::create([
            'ar' => ['name' => 'سنغافورة', 'currency' => 'دولار سنغافوري'],
            'en' => ['name' => 'Singapore', 'currency' => 'SGD'],
            'iso_code'      => 'SGP',
            'phone_code'    => '65',
        ]);
        Country::create([
            'ar' => ['name' => 'سلوفاكيا', 'currency' => 'يورو'],
            'en' => ['name' => 'Slovakia', 'currency' => 'EUR'],
            'iso_code'      => 'SVK',
            'phone_code'    => '421',
        ]);
        Country::create([
            'ar' => ['name' => 'سلوفينيا', 'currency' => 'يورو'],
            'en' => ['name' => 'Slovenia', 'currency' => 'EUR'],
            'iso_code'      => 'SVN',
            'phone_code'    => '386',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر سليمان', 'currency' => 'دولار جزر سليمان'],
            'en' => ['name' => 'Solomon Islands', 'currency' => 'SBD'],
            'iso_code'      => 'SLB',
            'phone_code'    => '677',
        ]);
        Country::create([
            'ar' => ['name' => 'الصومال', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Somalia', 'currency' => 'USD'],
            'iso_code'      => 'SOM',
            'phone_code'    => '252',
        ]);
        Country::create([
            'ar' => ['name' => 'جنوب أفريقيا', 'currency' => 'راند جنوب أفريقي'],
            'en' => ['name' => 'South Africa', 'currency' => 'ZAR'],
            'iso_code'      => 'ZAF',
            'phone_code'    => '27',
        ]);
        Country::create([
            'ar' => ['name' => 'جنوب السودان', 'currency' => 'جنيه جنوب سوداني'],
            'en' => ['name' => 'South Sudan', 'currency' => 'SSP'],
            'iso_code'      => 'SSD',
            'phone_code'    => '211',
        ]);
        Country::create([
            'ar' => ['name' => 'إسبانيا', 'currency' => 'يورو'],
            'en' => ['name' => 'Spain', 'currency' => 'EUR'],
            'iso_code'      => 'ESP',
            'phone_code'    => '34',
        ]);
        Country::create([
            'ar' => ['name' => 'سيريلانكا', 'currency' => 'روبية سريلانكي'],
            'en' => ['name' => 'Sri Lanka', 'currency' => 'LKR'],
            'iso_code'      => 'LKA',
            'phone_code'    => '94',
        ]);
        Country::create([
            'ar' => ['name' => 'السودان', 'currency' => 'جنيه سوداني'],
            'en' => ['name' => 'Sudan', 'currency' => 'SDG'],
            'iso_code'      => 'SDN',
            'phone_code'    => '249',
        ]);
        Country::create([
            'ar' => ['name' => 'سورينام', 'currency' => 'دولار سورينامي'],
            'en' => ['name' => 'Suriname', 'currency' => 'SRD'],
            'iso_code'      => 'SUR',
            'phone_code'    => '597',
        ]);
        Country::create([
            'ar' => ['name' => 'سوازيلاند', 'currency' => 'راند جنوب أفريقي'],
            'en' => ['name' => 'Swaziland', 'currency' => 'SZL'],
            'iso_code'      => 'SWZ',
            'phone_code'    => '268',
        ]);
        Country::create([
            'ar' => ['name' => 'السويد', 'currency' => 'كرونة سويدية'],
            'en' => ['name' => 'Sweden', 'currency' => 'SEK'],
            'iso_code'      => 'SWE',
            'phone_code'    => '46',
        ]);
        Country::create([
            'ar' => ['name' => 'سويسرا', 'currency' => 'فرنك سويسري'],
            'en' => ['name' => 'Switzerland', 'currency' => 'CHF'],
            'iso_code'      => 'CHE',
            'phone_code'    => '41',
        ]);
        Country::create([
            'ar' => ['name' => 'سوريا', 'currency' => 'ليرة سورية'],
            'en' => ['name' => 'Syria', 'currency' => 'SYP'],
            'iso_code'      => 'SYR',
            'phone_code'    => '963',
        ]);
        Country::create([
            'ar' => ['name' => 'تايوان', 'currency' => 'دولار تايواني جديد'],
            'en' => ['name' => 'Taiwan', 'currency' => 'TWD'],
            'iso_code'      => 'TWN',
            'phone_code'    => '886',
        ]);
        Country::create([
            'ar' => ['name' => 'طاجيكستان', 'currency' => 'ساماني طاجيكي'],
            'en' => ['name' => 'Tajikistan', 'currency' => 'TJS'],
            'iso_code'      => 'TJK',
            'phone_code'    => '992',
        ]);
        Country::create([
            'ar' => ['name' => 'تنزانيا', 'currency' => 'شلن تنزاني'],
            'en' => ['name' => 'Tanzania', 'currency' => 'TZS'],
            'iso_code'      => 'TZA',
            'phone_code'    => '255',
        ]);
        Country::create([
            'ar' => ['name' => 'تايلاند', 'currency' => 'بات تايلاندي'],
            'en' => ['name' => 'Thailand', 'currency' => 'THB'],
            'iso_code'      => 'THA',
            'phone_code'    => '66',
        ]);
        Country::create([
            'ar' => ['name' => 'توجو', 'currency' => 'فرنك غرب أفريقي'],
            'en' => ['name' => 'Togo', 'currency' => 'XOF'],
            'iso_code'      => 'TGO',
            'phone_code'    => '228',
        ]);
        Country::create([
            'ar' => ['name' => 'توكيلاو', 'currency' => 'دولار نيوزيلندي'],
            'en' => ['name' => 'Tokelau', 'currency' => 'NZD'],
            'iso_code'      => 'TKL',
            'phone_code'    => '690',
        ]);
        Country::create([
            'ar' => ['name' => 'تونغا', 'currency' => 'بانغا تونغي'],
            'en' => ['name' => 'Tonga', 'currency' => 'TOP'],
            'iso_code'      => 'TON',
            'phone_code'    => '676',
        ]);
        Country::create([
            'ar' => ['name' => 'ترينيداد وتوباغو', 'currency' => 'دولار ترينيداد وتوباغو'],
            'en' => ['name' => 'Trinidad And Tobago', 'currency' => 'TTD'],
            'iso_code'      => 'TTO',
            'phone_code'    => '+1-868',
        ]);
        Country::create([
            'ar' => ['name' => 'تونس', 'currency' => 'دينار تونسي'],
            'en' => ['name' => 'Tunisia', 'currency' => 'TND'],
            'iso_code'      => 'TUN',
            'phone_code'    => '216',
        ]);
        Country::create([
            'ar' => ['name' => 'تركيا', 'currency' => 'ليرة تركية'],
            'en' => ['name' => 'Turkey', 'currency' => 'TRY'],
            'iso_code'      => 'TUR',
            'phone_code'    => '90',
        ]);
        Country::create([
            'ar' => ['name' => 'تركمانستان', 'currency' => 'منات تركمانستاني'],
            'en' => ['name' => 'Turkmenistan', 'currency' => 'TMT'],
            'iso_code'      => 'TKM',
            'phone_code'    => '993',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر تركس وكايكوس', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Turks And Caicos Islands', 'currency' => 'USD'],
            'iso_code'      => 'TCA',
            'phone_code'    => '+1-649',
        ]);
        Country::create([
            'ar' => ['name' => 'توفالو', 'currency' => 'دولار أسترالي'],
            'en' => ['name' => 'Tuvalu', 'currency' => 'AUD'],
            'iso_code'      => 'TUV',
            'phone_code'    => '688',
        ]);
        Country::create([
            'ar' => ['name' => 'أوغندا', 'currency' => 'شيلينغ أوغندي'],
            'en' => ['name' => 'Uganda', 'currency' => 'UGX'],
            'iso_code'      => 'UGA',
            'phone_code'    => '256',
        ]);
        Country::create([
            'ar' => ['name' => 'أوكرانيا', 'currency' => 'هريفنا أوكرانية'],
            'en' => ['name' => 'Ukraine', 'currency' => 'UAH'],
            'iso_code'      => 'UKR',
            'phone_code'    => '380',
        ]);
        Country::create([
            'ar' => ['name' => 'الإمارات العربية المتحدة', 'currency' => 'درهم إماراتي'],
            'en' => ['name' => 'United Arab Emirates', 'currency' => 'AED'],
            'iso_code'      => 'ARE',
            'phone_code'    => '971',
        ]);
        Country::create([
            'ar' => ['name' => 'المملكة المتحدة', 'currency' => 'جنيه إسترليني'],
            'en' => ['name' => 'United Kingdom', 'currency' => 'GBP'],
            'iso_code'      => 'GBR',
            'phone_code'    => '44',
        ]);
        Country::create([
            'ar' => ['name' => 'الولايات المتحدة', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'United States', 'currency' => 'USD'],
            'iso_code'      => 'USA',
            'phone_code'    => '1',
        ]);
        Country::create([
            'ar' => ['name' => 'أوروغواي', 'currency' => 'بيزو أوروغواي'],
            'en' => ['name' => 'Uruguay', 'currency' => 'UYU'],
            'iso_code'      => 'URY',
            'phone_code'    => '598',
        ]);
        Country::create([
            'ar' => ['name' => 'أوزبكستان', 'currency' => 'سوم أوزبكستاني'],
            'en' => ['name' => 'Uzbekistan', 'currency' => 'UZS'],
            'iso_code'      => 'UZB',
            'phone_code'    => '998',
        ]);
        Country::create([
            'ar' => ['name' => 'فانواتو', 'currency' => 'فاتو فانواتي'],
            'en' => ['name' => 'Vanuatu', 'currency' => 'UZS'],
            'iso_code'      => 'VUT',
            'phone_code'    => '678',
        ]);
        Country::create([
            'ar' => ['name' => 'فنزويلا', 'currency' => 'بوليفار فنزويلي'],
            'en' => ['name' => 'Venezuela', 'currency' => 'VUV'],
            'iso_code'      => 'VEN',
            'phone_code'    => '58',
        ]);
        Country::create([
            'ar' => ['name' => 'فيتنام', 'currency' => 'دونغ فيتنامي'],
            'en' => ['name' => 'Vietnam', 'currency' => 'VND'],
            'iso_code'      => 'VNM',
            'phone_code'    => '84',
        ]);
        Country::create([
            'ar' => ['name' => 'جزر فيرجن البريطانية', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Virgin Islands - British', 'currency' => 'USD'],
            'iso_code'      => 'VGB',
            'phone_code'    => '+1-284',
        ]);
        Country::create([
            'ar' => ['name' => 'واليس وفوتونا', 'currency' => 'فرنك باسيفيكي'],
            'en' => ['name' => 'Wallis And Futuna', 'currency' => 'XPF'],
            'iso_code'      => 'WLF',
            'phone_code'    => '681',
        ]);
        Country::create([
            'ar' => ['name' => 'الصحراء الغربية', 'currency' => 'درهم مغربي'],
            'en' => ['name' => 'Western Sahara', 'currency' => 'MAD'],
            'iso_code'      => 'ESH',
            'phone_code'    => '212',
        ]);
        Country::create([
            'ar' => ['name' => 'اليمن', 'currency' => 'ريال يمني'],
            'en' => ['name' => 'Yemen', 'currency' => 'YER'],
            'iso_code'      => 'YEM',
            'phone_code'    => '967',
        ]);
        Country::create([
            'ar' => ['name' => 'زامبيا', 'currency' => 'كواشا زامبي'],
            'en' => ['name' => 'Zambia', 'currency' => 'ZMW'],
            'iso_code'      => 'ZMB',
            'phone_code'    => '260',
        ]);
        Country::create([
            'ar' => ['name' => 'زيمبابوي', 'currency' => 'دولار أمريكي'],
            'en' => ['name' => 'Zimbabwe', 'currency' => 'ZWL'],
            'iso_code'      => 'ZWE',
            'phone_code'    => '263',
        ]);
    }
}
