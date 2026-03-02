<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\University;

class ImportUniversities extends Command
{
    protected $signature   = 'import:universities';
    protected $description = 'Import all HEC recognized universities into database';

    public function handle()
    {
        $universities = $this->getData();
        $bar = $this->output->createProgressBar(count($universities));
        $bar->start();

        $imported = 0;
        foreach ($universities as $uni) {
            University::firstOrCreate(
                ['name' => $uni['name']],
                [
                    'category'          => $uni['category'],
                    'sector'            => $uni['sector'],
                    'province'          => $uni['province'],
                    'city'              => $uni['city'],
                    'established_since' => $uni['established'],
                    'is_hec_recognized' => true,
                    'is_blacklisted'    => false,
                    'is_on_educhain'    => false,
                ]
            );
            $imported++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        // Mark demo universities as on EduChain
        University::where('name', 'like', '%COMSATS%')->update(['is_on_educhain' => true]);
        University::where('name', 'like', '%National University of Sciences%')->update(['is_on_educhain' => true]);

        $this->info("✅ Imported {$imported} universities successfully.");
        return Command::SUCCESS;
    }

    private function getData(): array
    {
        return [
            // ISLAMABAD
            ['name'=>'Quaid-i-Azam University',                                 'category'=>'General',                  'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>1967],
            ['name'=>'COMSATS University, Islamabad',                           'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2000],
            ['name'=>'National University of Sciences & Technology',            'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Rawalpindi',   'established'=>1991],
            ['name'=>'International Islamic University, Islamabad',             'category'=>'General',                  'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>1980],
            ['name'=>'Allama Iqbal Open University',                            'category'=>'General',                  'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>1974],
            ['name'=>'Federal Urdu University of Arts, Science & Technology',   'category'=>'General',                  'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2002],
            ['name'=>'National University of Modern Languages',                 'category'=>'General',                  'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>1970],
            ['name'=>'Air University',                                          'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2002],
            ['name'=>'Bahria University',                                       'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2000],
            ['name'=>'National Defence University',                             'category'=>'General',                  'sector'=>'public',  'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2007],
            ['name'=>'Riphah International University',                        'category'=>'General',                  'sector'=>'private', 'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2002],
            ['name'=>'Iqra University, Islamabad',                             'category'=>'General',                  'sector'=>'private', 'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>1998],
            ['name'=>'Foundation University Islamabad',                        'category'=>'General',                  'sector'=>'private', 'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2002],
            ['name'=>'Capital University of Science & Technology',             'category'=>'Engineering & Technology', 'sector'=>'private', 'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2000],
            ['name'=>'Mohammad Ali Jinnah University, Islamabad',              'category'=>'General',                  'sector'=>'private', 'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>1998],
            ['name'=>'Hamdard University',                                     'category'=>'Medical',                  'sector'=>'private', 'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>1991],
            ['name'=>'Preston University, Islamabad',                          'category'=>'General',                  'sector'=>'private', 'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>1984],
            ['name'=>'Abasyn University, Islamabad',                          'category'=>'General',                  'sector'=>'private', 'province'=>'Islamabad',         'city'=>'Islamabad',    'established'=>2009],

            // PUNJAB
            ['name'=>'University of the Punjab',                               'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>1882],
            ['name'=>'Lahore University of Management Sciences',               'category'=>'Business',                 'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>1985],
            ['name'=>'University of Engineering & Technology, Lahore',         'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>1974],
            ['name'=>'National University of Computer & Emerging Sciences',    'category'=>'Engineering & Technology', 'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2000],
            ['name'=>'King Edward Medical University',                         'category'=>'Medical',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>1860],
            ['name'=>'University of Health Sciences',                          'category'=>'Medical',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2002],
            ['name'=>'Lahore College for Women University',                    'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2002],
            ['name'=>'University of Education',                                'category'=>'Education',                'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2002],
            ['name'=>'Government College University, Lahore',                  'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2002],
            ['name'=>'Virtual University of Pakistan',                         'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2002],
            ['name'=>'University of Veterinary & Animal Sciences',             'category'=>'Agriculture',              'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2002],
            ['name'=>'University of Central Punjab',                           'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2002],
            ['name'=>'Superior University',                                    'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2004],
            ['name'=>'University of Lahore',                                   'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>1999],
            ['name'=>'Forman Christian College University',                    'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2004],
            ['name'=>'Beaconhouse National University',                        'category'=>'Arts & Design',            'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2003],
            ['name'=>'Minhaj University Lahore',                               'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2005],
            ['name'=>'Lahore Leads University',                                'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2006],
            ['name'=>'National Textile University',                            'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Punjab',            'city'=>'Faisalabad',   'established'=>2002],
            ['name'=>'Government College University, Faisalabad',              'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Faisalabad',   'established'=>2002],
            ['name'=>'University of Agriculture, Faisalabad',                  'category'=>'Agriculture',              'sector'=>'public',  'province'=>'Punjab',            'city'=>'Faisalabad',   'established'=>1961],
            ['name'=>'University of Faisalabad',                               'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Faisalabad',   'established'=>2004],
            ['name'=>'Bahauddin Zakariya University',                          'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Multan',       'established'=>1975],
            ['name'=>'Muhammad Nawaz Shareef University of Agriculture',       'category'=>'Agriculture',              'sector'=>'public',  'province'=>'Punjab',            'city'=>'Multan',       'established'=>2012],
            ['name'=>'The Islamia University of Bahawalpur',                   'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Bahawalpur',   'established'=>1975],
            ['name'=>'Khawaja Fareed University of Engineering & IT',          'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Punjab',            'city'=>'Rahim Yar Khan','established'=>2016],
            ['name'=>'University of Sargodha',                                 'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Sargodha',     'established'=>2002],
            ['name'=>'University of Gujrat',                                   'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Gujrat',       'established'=>2004],
            ['name'=>'University of Sahiwal',                                  'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Sahiwal',      'established'=>2012],
            ['name'=>'University of Okara',                                    'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Okara',        'established'=>2012],
            ['name'=>'Ghazi University',                                       'category'=>'General',                  'sector'=>'public',  'province'=>'Punjab',            'city'=>'Dera Ghazi Khan','established'=>2012],
            ['name'=>'Cholistan University of Veterinary & Animal Sciences',   'category'=>'Agriculture',              'sector'=>'public',  'province'=>'Punjab',            'city'=>'Bahawalpur',   'established'=>2014],
            ['name'=>'COMSATS University, Lahore',                             'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Punjab',            'city'=>'Lahore',       'established'=>2000],
            ['name'=>'COMSATS University, Wah',                                'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Punjab',            'city'=>'Wah',          'established'=>2000],
            ['name'=>'University of Sialkot',                                  'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Sialkot',      'established'=>2012],
            ['name'=>'University of Wah',                                      'category'=>'General',                  'sector'=>'private', 'province'=>'Punjab',            'city'=>'Wah',          'established'=>2007],

            // SINDH
            ['name'=>'University of Karachi',                                  'category'=>'General',                  'sector'=>'public',  'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1951],
            ['name'=>'NED University of Engineering & Technology',             'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1977],
            ['name'=>'Institute of Business Administration',                   'category'=>'Business',                 'sector'=>'public',  'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1955],
            ['name'=>'Aga Khan University',                                    'category'=>'Medical',                  'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1983],
            ['name'=>'University of Sindh',                                    'category'=>'General',                  'sector'=>'public',  'province'=>'Sindh',             'city'=>'Jamshoro',     'established'=>1947],
            ['name'=>'Mehran University of Engineering & Technology',          'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Sindh',             'city'=>'Jamshoro',     'established'=>1977],
            ['name'=>'Liaquat University of Medical & Health Sciences',        'category'=>'Medical',                  'sector'=>'public',  'province'=>'Sindh',             'city'=>'Jamshoro',     'established'=>1951],
            ['name'=>'Dow University of Health Sciences',                      'category'=>'Medical',                  'sector'=>'public',  'province'=>'Sindh',             'city'=>'Karachi',      'established'=>2004],
            ['name'=>'Jinnah Sindh Medical University',                        'category'=>'Medical',                  'sector'=>'public',  'province'=>'Sindh',             'city'=>'Karachi',      'established'=>2012],
            ['name'=>'Dawood University of Engineering & Technology',          'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1962],
            ['name'=>'Shaheed Zulfikar Ali Bhutto Institute of Science & Technology','category'=>'Engineering & Technology','sector'=>'private','province'=>'Sindh',         'city'=>'Karachi',      'established'=>2000],
            ['name'=>'SZABIST University',                                     'category'=>'Engineering & Technology', 'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1995],
            ['name'=>'Iqra University',                                        'category'=>'General',                  'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1998],
            ['name'=>'Hamdard University, Karachi',                            'category'=>'Medical',                  'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1991],
            ['name'=>'Sir Syed University of Engineering & Technology',        'category'=>'Engineering & Technology', 'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1994],
            ['name'=>'Ziauddin University',                                    'category'=>'Medical',                  'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1995],
            ['name'=>'Baqai Medical University',                               'category'=>'Medical',                  'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1988],
            ['name'=>'Indus University',                                       'category'=>'Engineering & Technology', 'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>2003],
            ['name'=>'Greenwich University',                                   'category'=>'General',                  'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>2002],
            ['name'=>'PAF Karachi Institute of Economics & Technology',        'category'=>'Business',                 'sector'=>'private', 'province'=>'Sindh',             'city'=>'Karachi',      'established'=>1996],
            ['name'=>'Isra University',                                        'category'=>'Medical',                  'sector'=>'private', 'province'=>'Sindh',             'city'=>'Hyderabad',    'established'=>1997],
            ['name'=>'Shah Abdul Latif University',                            'category'=>'General',                  'sector'=>'public',  'province'=>'Sindh',             'city'=>'Khairpur',     'established'=>1987],
            ['name'=>'Quaid-e-Awam University of Engineering, Science & Technology','category'=>'Engineering & Technology','sector'=>'public','province'=>'Sindh',           'city'=>'Nawabshah',    'established'=>2001],
            ['name'=>'Sukkur IBA University',                                  'category'=>'Business',                 'sector'=>'public',  'province'=>'Sindh',             'city'=>'Sukkur',       'established'=>1994],
            ['name'=>'Sindh Agriculture University',                           'category'=>'Agriculture',              'sector'=>'public',  'province'=>'Sindh',             'city'=>'Tandojam',     'established'=>1977],
            ['name'=>'Shaheed Benazir Bhutto University',                      'category'=>'General',                  'sector'=>'public',  'province'=>'Sindh',             'city'=>'Nawabshah',    'established'=>2009],

            // KPK
            ['name'=>'University of Peshawar',                                 'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Peshawar',     'established'=>1950],
            ['name'=>'University of Engineering & Technology, Peshawar',       'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'KPK',               'city'=>'Peshawar',     'established'=>1980],
            ['name'=>'Khyber Medical University',                              'category'=>'Medical',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Peshawar',     'established'=>2007],
            ['name'=>'Islamia College University',                             'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Peshawar',     'established'=>2009],
            ['name'=>'Agricultural University Peshawar',                       'category'=>'Agriculture',              'sector'=>'public',  'province'=>'KPK',               'city'=>'Peshawar',     'established'=>1981],
            ['name'=>'Abdul Wali Khan University',                             'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Mardan',       'established'=>2009],
            ['name'=>'University of Malakand',                                 'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Chakdara',     'established'=>2001],
            ['name'=>'University of Swat',                                     'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Swat',         'established'=>2010],
            ['name'=>'Hazara University',                                      'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Mansehra',     'established'=>2002],
            ['name'=>'Kohat University of Science & Technology',               'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'KPK',               'city'=>'Kohat',        'established'=>2001],
            ['name'=>'Gomal University',                                       'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Dera Ismail Khan','established'=>1974],
            ['name'=>'University of Science & Technology Bannu',               'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'KPK',               'city'=>'Bannu',        'established'=>2005],
            ['name'=>'Bacha Khan University',                                  'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Charsadda',    'established'=>2012],
            ['name'=>'Women University Swabi',                                 'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Swabi',        'established'=>2014],
            ['name'=>'University of Chitral',                                  'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Chitral',      'established'=>2015],
            ['name'=>'University of Lakki Marwat',                             'category'=>'General',                  'sector'=>'public',  'province'=>'KPK',               'city'=>'Lakki Marwat', 'established'=>2015],
            ['name'=>'Abasyn University',                                      'category'=>'General',                  'sector'=>'private', 'province'=>'KPK',               'city'=>'Peshawar',     'established'=>2009],
            ['name'=>'Cecos University',                                       'category'=>'Engineering & Technology', 'sector'=>'private', 'province'=>'KPK',               'city'=>'Peshawar',     'established'=>2000],
            ['name'=>'City University of Science & IT',                        'category'=>'Engineering & Technology', 'sector'=>'private', 'province'=>'KPK',               'city'=>'Peshawar',     'established'=>2001],
            ['name'=>'Qurtuba University',                                     'category'=>'General',                  'sector'=>'private', 'province'=>'KPK',               'city'=>'Peshawar',     'established'=>2001],
            ['name'=>'COMSATS University, Abbottabad',                         'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'KPK',               'city'=>'Abbottabad',   'established'=>2000],

            // BALOCHISTAN
            ['name'=>'University of Balochistan',                              'category'=>'General',                  'sector'=>'public',  'province'=>'Balochistan',       'city'=>'Quetta',       'established'=>1970],
            ['name'=>'Balochistan University of Engineering & Technology',     'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'Balochistan',       'city'=>'Khuzdar',      'established'=>2004],
            ['name'=>'Balochistan University of IT, Engineering & Management Sciences','category'=>'Engineering & Technology','sector'=>'public','province'=>'Balochistan',  'city'=>'Quetta',       'established'=>2002],
            ['name'=>'Sardar Bahadur Khan Women University',                   'category'=>'General',                  'sector'=>'public',  'province'=>'Balochistan',       'city'=>'Quetta',       'established'=>2004],
            ['name'=>'University of Turbat',                                   'category'=>'General',                  'sector'=>'public',  'province'=>'Balochistan',       'city'=>'Turbat',       'established'=>2012],
            ['name'=>'Lasbela University of Agriculture, Water & Marine Sciences','category'=>'Agriculture',           'sector'=>'public',  'province'=>'Balochistan',       'city'=>'Uthal',        'established'=>2005],
            ['name'=>'University of Loralai',                                  'category'=>'General',                  'sector'=>'public',  'province'=>'Balochistan',       'city'=>'Loralai',      'established'=>2012],
            ['name'=>'University of Khuzdar',                                  'category'=>'General',                  'sector'=>'public',  'province'=>'Balochistan',       'city'=>'Khuzdar',      'established'=>2012],

            // AJK
            ['name'=>'University of Azad Jammu & Kashmir',                     'category'=>'General',                  'sector'=>'public',  'province'=>'AJK',               'city'=>'Muzaffarabad', 'established'=>1980],
            ['name'=>'Mirpur University of Science & Technology',               'category'=>'Engineering & Technology', 'sector'=>'public',  'province'=>'AJK',               'city'=>'Mirpur',       'established'=>2008],
            ['name'=>'University of Poonch Rawalakot',                         'category'=>'General',                  'sector'=>'public',  'province'=>'AJK',               'city'=>'Rawalakot',    'established'=>2004],

            // GILGIT-BALTISTAN
            ['name'=>'Karakoram International University',                     'category'=>'General',                  'sector'=>'public',  'province'=>'Gilgit-Baltistan',  'city'=>'Gilgit',       'established'=>2002],
        ];
    }
}